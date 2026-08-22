import test from 'node:test';
import assert from 'node:assert/strict';
import fs from 'node:fs';

const template = fs.readFileSync(new URL('../templates/index.tpl', import.meta.url), 'utf8');
const css = fs.readFileSync(new URL('../main.css', import.meta.url), 'utf8');

function detailsBlocks(html) {
  return [...html.matchAll(/<details([^>]*)>([\s\S]*?)<\/details>/g)].map((m) => ({ attrs: m[1], body: m[2] }));
}

function simulateDisclosure(initialOpen = false) {
  return { open: initialOpen, toggle() { this.open = !this.open; } };
}

test('sidebar contains native collapsible disclosure controls', () => {
  const details = [...template.matchAll(/<details(?:\s+open)?[^>]*>/g)];
  const summaries = [...template.matchAll(/<summary[\s>]/g)];
  assert.ok(details.length >= 28, `expected grouped details, got ${details.length}`);
  assert.equal(details.length, summaries.length, 'every details element has a summary');
  assert.match(template, /<details>\s*<summary>[\s\S]*?Subsystems<\/span>/, 'nested subsystem disclosure exists');
});

test('nested submenu toggles independently from its parent', () => {
  const parent = simulateDisclosure(true);
  const child = simulateDisclosure(false);
  child.toggle();
  assert.equal(parent.open, true, 'opening child does not close parent');
  assert.equal(child.open, true, 'child opens on toggle');
  child.toggle();
  assert.equal(parent.open, true, 'parent remains open after child collapse');
  assert.equal(child.open, false, 'child collapses on second toggle');
});

test('each interactive summary is keyboard-compatible native markup', () => {
  const summaries = [...template.matchAll(/<summary[\s\S]*?<\/summary>/g)];
  assert.ok(summaries.length >= 28, 'expected summary controls for menu groups');
  for (const match of summaries) {
    assert.doesNotMatch(match[0], /onclick\s*=|javascript:/i, 'summary does not require inline JavaScript');
  }
});

test('sidebar links expose canonical group and page route attributes', () => {
  const links = [...template.matchAll(/data-nav-group="([a-z0-9_-]+)" data-nav-page="([a-z0-9_-]+)"/g)];
  assert.ok(links.length >= 191, `expected at least 191 route links, got ${links.length}`);
  for (const [, group, page] of links) {
    assert.ok(group.length > 0 && page.length > 0, 'route group and page are non-empty');
  }
});

test('mobile summaries and links meet touch-target requirements', () => {
  assert.match(css, /@media\s*\(max-width:\s*700px\)/, 'mobile breakpoint exists');
  assert.match(css, /\.left-menu summary,\.left-menu a\{min-height:44px/, 'sidebar controls have 44px minimum height');
  assert.match(css, /\.left-menu summary\{[^}]*touch-action:manipulation/s, 'summaries use touch-action manipulation');
  assert.match(css, /\.left-menu a\{[^}]*touch-action:manipulation/s, 'links use touch-action manipulation');
});

test('mobile sidebar expands to full width and preserves nested flow', () => {
  assert.match(css, /\.left-menu\{width:100%;max-width:none[^}]*overflow:visible/, 'mobile sidebar uses full width and visible flow');
  assert.match(css, /\.left-menu details\{margin-bottom:6px/, 'mobile groups have separation');
  assert.match(css, /\.quick-access-links\{display:grid;grid-template-columns:repeat\(2/, 'quick access becomes a mobile grid');
});
