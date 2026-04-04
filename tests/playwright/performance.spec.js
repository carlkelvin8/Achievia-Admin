import { test, expect } from '@playwright/test';
import { writeFileSync, unlinkSync } from 'fs';
import { tmpdir } from 'os';
import { join } from 'path';

const THRESHOLDS = {
  fast:   2000,
  medium: 4000,
  slow:   8000,
};

async function measurePage(page, url, threshold = THRESHOLDS.medium) {
  const start    = Date.now();
  const response = await page.goto(url, { waitUntil: 'networkidle', timeout: 30_000 });
  const elapsed  = Date.now() - start;
  const httpStatus = response?.status() ?? 0;
  const status   = elapsed <= threshold ? 'pass' : elapsed <= threshold * 1.5 ? 'warn' : 'fail';
  return { elapsed, httpStatus, status, url };
}

function logResult({ url, elapsed, httpStatus, status }) {
  const icon = status === 'pass' ? '✅' : status === 'warn' ? '⚠️ ' : '❌';
  console.log(`${icon} [${httpStatus}] ${String(url).padEnd(40)} ${elapsed}ms`);
}

function generateCsv(rowCount, subjectId = 1, moduleId = 1) {
  const header = [
    'quiz_title','quiz_description','subject_id','module_id',
    'question_text','question_type',
    'option_1','option_2','option_3','option_4',
    'correct_choice_index','rationale','notes',
  ].join(',');
  const rows = [header];
  for (let i = 1; i <= rowCount; i++) {
    rows.push([
      `Perf Quiz ${i % 10}`, `Performance test`,
      subjectId, moduleId,
      `Question ${i}: What is ${i} + ${i}?`, `multiple_choice`,
      `${i*2}`, `${i*2+1}`, `${i*2+2}`, `${i*2+3}`,
      `0`, `Because ${i}+${i}=${i*2}`, `perf`,
    ].join(','));
  }
  const path = join(tmpdir(), `perf_quiz_${Date.now()}.csv`);
  writeFileSync(path, rows.join('\n'), 'utf8');
  return path;
}

test.describe('Performance Tests', () => {

  // Dashboard
  test('Dashboard loads fast', async ({ page }) => {
    const r = await measurePage(page, '/admin', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Students
  test('Students list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/admin/students', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  test('Students page 2 loads fast', async ({ page }) => {
    const r = await measurePage(page, '/admin/students?page=2', THRESHOLDS.medium);
    logResult(r);
    expect([200, 302, 404]).toContain(r.httpStatus);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Teachers
  test('Teachers list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/admin/teachers', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Courses
  test('Courses list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/courses', THRESHOLDS.fast);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.fast);
  });

  test('Create course form loads fast', async ({ page }) => {
    const r = await measurePage(page, '/courses/create', THRESHOLDS.fast);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.fast);
  });

  // Subjects
  test('Subjects list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/subjects', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  test('Subjects filtered by course loads fast', async ({ page }) => {
    const r = await measurePage(page, '/subjects?course_id=1', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Modules
  test('Modules list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/admin/modules', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  test('Modules filtered by subject loads fast', async ({ page }) => {
    const r = await measurePage(page, '/admin/modules?subject=1', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Quizzes
  test('Quiz list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/quizzes', THRESHOLDS.slow);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.slow);
  });

  test('Quiz list with search loads fast', async ({ page }) => {
    const r = await measurePage(page, '/quizzes?search=test', THRESHOLDS.slow);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.slow);
  });

  test('Quiz list filtered by subject loads fast', async ({ page }) => {
    const r = await measurePage(page, '/quizzes?subject_id=1', THRESHOLDS.slow);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.slow);
  });

  test('Quiz list page 2 loads fast', async ({ page }) => {
    const r = await measurePage(page, '/quizzes?page=2', THRESHOLDS.slow);
    logResult(r);
    expect([200, 302, 404]).toContain(r.httpStatus);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.slow);
  });

  test('Create quiz form loads fast', async ({ page }) => {
    const r = await measurePage(page, '/quizzes/create', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Mnemonics
  test('Mnemonics list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/mn', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  test('Mnemonics filtered by subject loads fast', async ({ page }) => {
    const r = await measurePage(page, '/mn?subject_id=1', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Abbreviations
  test('Abbreviations list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/abbreviation', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Procedures
  test('Procedures list loads fast', async ({ page }) => {
    const r = await measurePage(page, '/procedures', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  test('Procedures filtered by subject loads fast', async ({ page }) => {
    const r = await measurePage(page, '/procedures?subject_id=1', THRESHOLDS.medium);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.medium);
  });

  // Import form
  test('Import quiz form loads fast', async ({ page }) => {
    const r = await measurePage(page, '/importQuiz', THRESHOLDS.fast);
    logResult(r);
    expect(r.httpStatus).toBe(200);
    expect(r.elapsed).toBeLessThan(THRESHOLDS.fast);
  });

  // 5000-row import
  test('Import 5000 quiz questions completes within 3 minutes', async ({ page }) => {
    test.setTimeout(4 * 60 * 1000);
    const csvPath = generateCsv(5000);
    try {
      await page.goto('/importQuiz');
      await page.setInputFiles('#csv-upload', csvPath);
      const start = Date.now();
      await page.click('#import-btn');
      await page.locator('.bg-green-50, .bg-red-50').waitFor({ timeout: 3 * 60 * 1000 });
      const elapsed = Date.now() - start;
      const isError = await page.locator('.bg-red-50').isVisible();
      if (isError) throw new Error(await page.locator('.bg-red-50').textContent());
      const msg = await page.locator('.bg-green-50').textContent();
      console.log(`\n✅ 5000-row import: ${msg.trim()}`);
      console.log(`⏱  ${(elapsed/1000).toFixed(2)}s | ${(elapsed/5000).toFixed(2)}ms/row`);
      expect(elapsed).toBeLessThan(180_000);
      expect(msg).toMatch(/imported \d+ questions/i);
    } finally {
      try { unlinkSync(csvPath); } catch {}
    }
  });

  // Consistency checks
  test('Dashboard is consistently fast across 3 loads', async ({ page }) => {
    const times = [];
    for (let i = 0; i < 3; i++) {
      const { elapsed } = await measurePage(page, '/admin', THRESHOLDS.medium);
      times.push(elapsed);
    }
    const avg = Math.round(times.reduce((a, b) => a + b, 0) / times.length);
    const max = Math.max(...times);
    console.log(`\n📊 Dashboard 3x: [${times.join('ms, ')}ms] avg=${avg}ms max=${max}ms`);
    expect(max).toBeLessThan(THRESHOLDS.medium);
  });

  test('Quiz list is consistently fast across 3 loads', async ({ page }) => {
    const times = [];
    for (let i = 0; i < 3; i++) {
      const { elapsed } = await measurePage(page, '/quizzes', THRESHOLDS.slow);
      times.push(elapsed);
    }
    const avg = Math.round(times.reduce((a, b) => a + b, 0) / times.length);
    const max = Math.max(...times);
    console.log(`\n📊 Quiz list 3x: [${times.join('ms, ')}ms] avg=${avg}ms max=${max}ms`);
    expect(max).toBeLessThan(THRESHOLDS.slow);
  });
});
