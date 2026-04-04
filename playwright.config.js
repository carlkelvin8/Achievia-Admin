import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './tests/playwright',
  globalSetup: './tests/playwright/global-setup.js',
  timeout: 5 * 60 * 1000,
  expect: { timeout: 10_000 },
  webServer: {
    command: 'php artisan serve',
    url: 'http://localhost:8000',
    reuseExistingServer: true, // won't start a new one if already running
    timeout: 30_000,
  },
  use: {
    baseURL: 'http://localhost:8000',
    headless: true,
    storageState: 'tests/playwright/.auth.json',
  },
});
