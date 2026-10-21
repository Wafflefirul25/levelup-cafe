# Requirement audit

Status means code is present, not that acceptance testing has passed. No PHP/MySQL runtime or browser execution was available during generation.

| Assignment requirement | Current provision | Owner / remaining work |
| --- | --- | --- |
| Clean consistent interface and active navigation | Shared CSS/header/footer | Task 1: verify rendered pages |
| HTML5, CSS, JavaScript, PHP, SQL | Task 1 templates, styles, JS, PDO seat SELECT | Task 1: understand examples; all review |
| At least four interconnected pages | Home, Seats & rates, Book a session, About | Task 1: test all links |
| Validation and errors | HTML fields, JS time check; compiled server validation | Task 1 + Task 2: test with JS disabled and tampered POST |
| Store/retrieve with PHP/database | PDO seat queries and compiled booking insert | Task 2 + Task 3: test against actual DB |
| Three related tables | Proposed customers → bookings ← seats; separate admins | Task 3: review/finalize four-table schema |
| Admin login/logout | Revised hash verification and sessions | Task 2: test and approve replacements |
| Admin create/view/update/delete | Create booking through customer form/create seat; view bookings; cancel updates booking status; delete booking | Task 2: validate CRUD acceptance; cancellation is the current update operation |
| Simple admin report | Daily confirmed session count and booked value | Task 3 query ownership; Task 2 protected page |
| Users view selected/add records | View seats, submit booking in compiled | Task 1 UI + Task 2 handler |
| Mobile support and testing | CSS breakpoint and overflow wrapper | Task 1: actual screen-size tests still pending |
| Code ZIP with source, images, SQL | This package includes PHP/CSS/JS, local SVG and proposed SQL | All: replace proposal with approved final work |
| Repository + brief README | GitHub-ready source tree and root README | User: upload to actual repo and supply link |
| Documentation | Setup, division, tests and contributions scaffold | All: write final report and actual evidence |
| Individual contributions and labels | Contribution template | All: fill complete names/IDs accurately |
| Optional advanced features | Not required | Do not delay required work for optional extras |

The poll is sufficient as a high-level division after adding the explicit responsibilities above. The supplied Task 2 files alone do not cover full CRUD, bookings, related tables, reports or a complete UI. The assembled draft supplies possible implementation, but final Task 3 review and integration testing remain outstanding.

## Changes proposed to Task 2
- Fix `<?php//` opening in dashboard and missing `>` in viewport meta tag.
- Remove successful-connection echo before redirects and stop exposing raw PDO errors.
- Replace raw password equality with password_hash/password_verify; agree the new password_hash column.
- Regenerate session ID on login; guard admin page; add CSRF tokens and POST logout.
- Add server booking validation, database-derived price, transaction and overlap check.
- Add create/view/cancel/delete operations and protected daily report rendering.

## Limits to understand
Session-based login cooldown is basic and can be bypassed with a new session; production deployment needs stronger rate limiting and HTTPS configuration. No claim of production security is made. The interval locking relies on InnoDB and every booking writer taking the same seat lock. Hard delete removes data from later reports. Report totals are booked value, not paid revenue. Customer identity is not verified by email; repeated email addresses reuse the existing customer record without changing its name. There is no self-service booking lookup or cancellation for customers in this version.
