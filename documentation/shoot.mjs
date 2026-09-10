import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';
import { fileURLToPath } from 'node:url';

// Captures the landing page at four widths plus one shot per section.
// Run from the project root with the dev server up:  node documentation/shoot.mjs
const BASE = process.env.BASE || 'http://127.0.0.1:8000';
const OUT =
    process.env.OUT ||
    fileURLToPath(new URL('../screenshots/', import.meta.url));
mkdirSync(OUT, { recursive: true });

const viewports = {
  desktop: { width: 1440, height: 900 },
  laptop: { width: 1280, height: 800 },
  tablet: { width: 820, height: 1180 },
  mobile: { width: 390, height: 844 },
};

const sections = [
  ['navbar', 'header[data-nav]'],
  ['hero', '#top'],
  ['features', '#features'],
  ['showcase', '#showcase'],
  ['pricing', '#pricing'],
  ['testimonials', '#testimonials'],
  ['contact', '#contact'],
  ['cta', '#visit'],
  ['footer', 'footer'],
];

const browser = await chromium.launch();

async function autoScroll(page) {
  await page.evaluate(async () => {
    await new Promise((resolve) => {
      let y = 0;
      const step = () => {
        window.scrollBy(0, 600);
        y += 600;
        if (y < document.body.scrollHeight) setTimeout(step, 120);
        else { window.scrollTo(0, 0); resolve(); }
      };
      step();
    });
  });
  await page.waitForLoadState('networkidle');
}

async function fullPage(name, viewport, opts = {}) {
  const ctx = await browser.newContext({ viewport, deviceScaleFactor: 1, colorScheme: opts.dark ? 'dark' : 'light' });
  const page = await ctx.newPage();
  await page.goto(BASE, { waitUntil: 'networkidle' });
  await page.addStyleTag({ content: '*{transition:none!important;animation:none!important} .reveal{opacity:1!important;transform:none!important}' });
  await autoScroll(page);
  await page.waitForTimeout(800);
  await page.screenshot({ path: `${OUT}/${name}.jpg`, fullPage: true, type: 'jpeg', quality: 82 });
  await ctx.close();
}

async function sectionShots() {
  const ctx = await browser.newContext({ viewport: viewports.desktop, deviceScaleFactor: 1.5 });
  const page = await ctx.newPage();
  await page.goto(BASE, { waitUntil: 'networkidle' });
  await page.addStyleTag({ content: '*{transition:none!important;animation:none!important} .reveal{opacity:1!important;transform:none!important}' });
  await autoScroll(page);
  await page.waitForTimeout(600);
  for (const [name, sel] of sections) {
    const el = page.locator(sel).first();
    await el.scrollIntoViewIfNeeded();
    await page.waitForTimeout(200);
    await el.screenshot({ path: `${OUT}/section-${name}.jpg`, type: 'jpeg', quality: 86 });
  }
  await ctx.close();
}

async function mobileNavOpen() {
  const ctx = await browser.newContext({ viewport: viewports.mobile, deviceScaleFactor: 2 });
  const page = await ctx.newPage();
  await page.goto(BASE, { waitUntil: 'networkidle' });
  await page.click('[data-nav-toggle]');
  await page.waitForTimeout(300);
  await page.screenshot({ path: `${OUT}/mobile-nav-open.jpg`, type: 'jpeg', quality: 86 });
  await ctx.close();
}

await fullPage('desktop-full', viewports.desktop);
await fullPage('laptop-full', viewports.laptop);
await fullPage('tablet-full', viewports.tablet);
await fullPage('mobile-full', viewports.mobile);
await fullPage('desktop-dark-full', viewports.desktop, { dark: true });
await sectionShots();
await mobileNavOpen();

await browser.close();
console.log('screenshots written to', OUT);
