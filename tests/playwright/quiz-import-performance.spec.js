import { test, expect } from '@playwright/test';
import { writeFileSync, unlinkSync } from 'fs';
import { tmpdir } from 'os';
import { join } from 'path';

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------

/**
 * Generate a CSV file with `rowCount` quiz question rows.
 * Uses subject_id / module_id so no name-lookup overhead on the server.
 * Returns the temp file path.
 */
function generateCsv(rowCount, subjectId, moduleId) {
  const header = [
    'quiz_title', 'quiz_description',
    'subject_id', 'module_id',
    'question_text', 'question_type',
    'option_1', 'option_2', 'option_3', 'option_4',
    'correct_choice_index', 'rationale', 'notes',
  ].join(',');

  const rows = [header];
  for (let i = 1; i <= rowCount; i++) {
    rows.push([
      `Performance Test Quiz`,
      `Auto-generated performance test`,
      subjectId,
      moduleId,
      `Performance question ${i}: What is the result of ${i} + ${i}?`,
      `multiple_choice`,
      `${i * 2}`,          // correct
      `${i * 2 + 1}`,
      `${i * 2 + 2}`,
      `${i * 2 + 3}`,
      `0`,                 // option_1 is correct
      `Because ${i} + ${i} = ${i * 2}`,
      `perf-test`,
    ].join(','));
  }

  const filePath = join(tmpdir(), `quiz_perf_${Date.now()}.csv`);
  writeFileSync(filePath, rows.join('\n'), 'utf8');
  return filePath;
}

/** Log in as admin and return the page ready for use. */
async function loginAsAdmin(page, email, password) {
  await page.goto('/admin/login');
  await page.fill('input[name="email"]', email);
  await page.fill('input[name="password"]', password);
  await page.click('button[type="submit"]');
  await page.waitForURL('**/admin**');
}

// ---------------------------------------------------------------------------
// Config — update these to match your local environment
// ---------------------------------------------------------------------------
const ADMIN_EMAIL    = 'admin@example.com';
const ADMIN_PASSWORD = 'password';
const SUBJECT_ID     = 1;   // must exist in your DB
const MODULE_ID      = 1;   // must exist in your DB
const ROW_COUNT      = 5000;

// ---------------------------------------------------------------------------
// Test
// ---------------------------------------------------------------------------
test('imports 5000 quiz questions within acceptable time', async ({ page }) => {
  // 1. Generate CSV
  const csvPath = generateCsv(ROW_COUNT, SUBJECT_ID, MODULE_ID);

  try {
    // 2. Log in
    await loginAsAdmin(page, ADMIN_EMAIL, ADMIN_PASSWORD);

    // 3. Navigate to import page
    await page.goto('/importQuiz');
    await expect(page.locator('h2, h3').filter({ hasText: /import quiz/i })).toBeVisible();

    // 4. Attach the generated CSV
    await page.setInputFiles('#csv-upload', csvPath);

    // 5. Record start time and submit
    const startTime = Date.now();
    await page.click('#import-btn');

    // 6. Wait for success or error message (up to 5 minutes)
    const resultLocator = page.locator('.bg-green-50, .bg-red-50');
    await resultLocator.waitFor({ timeout: 5 * 60 * 1000 });

    const elapsed = (Date.now() - startTime) / 1000;

    // 7. Assert success
    const successBox = page.locator('.bg-green-50');
    const errorBox   = page.locator('.bg-red-50');

    const isSuccess = await successBox.isVisible();
    const isError   = await errorBox.isVisible();

    if (isError) {
      const errorText = await errorBox.textContent();
      throw new Error(`Import failed: ${errorText}`);
    }

    expect(isSuccess).toBe(true);

    const successText = await successBox.textContent();
    console.log(`\n✅ Import result: ${successText.trim()}`);
    console.log(`⏱  Total time: ${elapsed.toFixed(2)}s`);
    console.log(`📊 Rows: ${ROW_COUNT} | Avg: ${(elapsed / ROW_COUNT * 1000).toFixed(2)}ms per row`);

    // 8. Performance assertion — 5000 rows should complete within 3 minutes
    expect(elapsed).toBeLessThan(180);

    // 9. Confirm the success message mentions the expected count
    expect(successText).toMatch(/imported \d+ questions/i);

  } finally {
    // Clean up temp file
    try { unlinkSync(csvPath); } catch {}
  }
});
