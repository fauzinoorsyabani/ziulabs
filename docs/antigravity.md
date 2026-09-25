# Antigravity development guide

This guide is for working on Geo Booster in Antigravity IDE. Open the repository root (`geo-booster/`) as the project; do not open only `php-app/static/`, since the PHP application is the editable source of truth.

## Requirements and local run

Install PHP 8.2 or newer and make sure `php` is available in the IDE terminal's `PATH`. From the repository root, start the local development server with:

```bash
./run-local.sh
```

The launcher runs PHP's built-in server at `http://127.0.0.1:8080` with `php-app/public/` as its document root. Stop it with Ctrl+C. The built-in server is for local development only, not production hosting.

## Source and production export

- `php-app/public/` contains the canonical PHP application source and public assets. Make application changes here.
- `php-app/config/` contains application configuration/data and must remain outside the public web root. Do not put credentials or private data in tracked files.
- `php-app/static/` is the generated static export used for the production site's static catalogue. Treat it as a build output, not the canonical source for application behavior.
- `php-app/static/index.html` may contain optimized CDN image URLs. Preserve its existing CDN mapping and check that external image URLs begin with `https://`, never `/https://`.

If the static export needs to be regenerated for a separately requested deployment, rebuild it from the PHP source in a deliberate change and review the result before publishing:

```bash
cd php-app
rm -rf static/assets
mkdir -p static/assets
php public/index.php > static/index.html
cp public/assets/style.css static/assets/style.css
cp -R public/assets/products static/assets/products
cp public/.htaccess static/.htaccess
```

These commands regenerate production output; routine PHP edits and documentation-only changes do not require a rebuild or redeploy. Verify all image URLs and catalogue content in the generated output before deployment.

## Safe editing and validation

Keep this project catalogue-first. Do not add payment processing, a database, automatic fulfilment, or catalogue/SKU changes without a separately approved product task. Preserve the current legal and security guidance, security headers, and Content Security Policy approach. Never expose `config/`, storage, `.env` files, tokens, product credentials, customer data, OTPs, or payment secrets through the public web root or Git.

Before committing PHP changes, run the relevant syntax checks and review the diff:

```bash
php -l php-app/public/index.php
php -l php-app/config/app.php
git diff --check
git status --short
git diff
```

Stage only files belonging to the intended change. Review the staged diff before committing:

```bash
git diff --cached --check
git diff --cached --stat
git diff --cached
```

Push only to the confirmed canonical repository and intended branch. A successful GitHub push does not by itself establish that Vercel deployed the change.

## Production reference

The current production URL is <https://geo-booster-fauzins-projects.vercel.app/>. Production currently uses a static export. Do not claim that a GitHub push automatically deploys to Vercel unless that integration has been explicitly verified.

For project architecture, business constraints, and development practices, see [System Design](architecture.md), [Project Management](project-management.md), [Agentic Engineering](agentic-engineering.md), and the top-level [README](../README.md).

## Antigravity workflow

1. Open the repository root in Antigravity.
2. Read this guide and the project guidance relevant to the change.
3. Run `./run-local.sh` and verify the local page at `http://127.0.0.1:8080`.
4. Edit the canonical PHP source under `php-app/public/` for application behavior; do not make hand-edited static output the only source of a behavior change.
5. Run syntax checks and inspect the complete diff, including staged changes.
6. Commit and push only the reviewed, intended files. Treat Vercel deployment as a separate status from the GitHub push.
