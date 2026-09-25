---
name: geo-booster-engineering
description: Guardrails for building ZiuLabs, a PHP digital-product commerce SaaS.
---

# ZiuLabs Engineering Skill

## Use when

Use this skill for any change to catalog, order, payment, admin, fulfillment, customer data, or public product claims.

## Required workflow

1. Read `README.md` and the relevant file in `docs/`.
2. State the user outcome, acceptance criteria, files likely to change, and security impact.
3. Keep PHP server-rendered and dependency-light unless an ADR approves a different choice.
4. Validate all input on the server and escape all output in HTML.
5. Use prepared statements, CSRF protection, RBAC, rate limiting, and audit logging for sensitive actions.
6. Never expose credentials, payment secrets, raw webhook payloads, or unnecessary PII.
7. Run `php -l` and the narrowest relevant test before reporting completion.
8. Report changes, verification, risks, and follow-up work.

## Non-negotiable product guardrail

Only publish products with verified source and rights to distribute. Never represent an unofficial or policy-violating account as official. If the source cannot be verified, keep the SKU unpublished and escalate to the product owner.
