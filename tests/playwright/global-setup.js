import { chromium } from '@playwright/test';
import { mkdirSync } from 'fs';
import { dirname } from 'path';

const AUTH_FILE = 'tests/playwright/.auth.json';

export default async function globalSetup() {
  // Ensure the directory exists
  mkdirSync(dirname(AUTH_FILE), { recursive: true });

  const browser = await chromium.launch();
  const page    = await browser.newPage();

  await page.goto('http://localhost:8000/admin/login');
  await page.fill('input[name="email"]', 'admin@example.com');
  await page.fill('input[name="password"]', 'Admin@1234');
  await page.click('button[type="submit"]');
  await page.waitForURL('**/admin**', { timeout: 15_000 });

  await page.context().storageState({ path: AUTH_FILE });
  await browser.close();
}
