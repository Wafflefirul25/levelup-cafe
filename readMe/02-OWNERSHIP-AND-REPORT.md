# Ownership and report division

The poll covers three broad development areas, but does not explicitly allocate JavaScript, booking workflow, testing, integration or documentation. The following additions close those planning gaps without moving ownership away from each member.

| Area | Task 1: you | Task 2: PHP/security member | Task 3: database/reports member |
| --- | --- | --- | --- |
| Main ownership | Customer UI, navigation, responsive design | Application behaviour, administrator portal, security | Data model, SQL scripts, reports |
| HTML5/CSS | Four pages, shared design, mobile forms | Apply shared UI to admin pages | Review report table readability |
| JavaScript | Seat category filter, price estimate, closing-time check | Ensure server checks still work without JS | Verify price/SQL assumptions |
| PHP | Includes, escaped database-rendered seat cards, user-facing errors | PDO integration, booking insert, validation, conflict checks, login/logout, admin CRUD | Agree field names and review retrieval/report queries |
| SQL | Explain the seat-list SELECT used in your page | Execute prepared queries through PHP | Own final schema, foreign keys, sample data, retrieval and report SQL |
| Tests | Navigation, keyboard, mobile widths, JS | Auth, validation, permissions, CRUD, booking concurrency | Relationships, import, joins, report totals |
| Shared responsibility | Integration, final review, contribution statements and submission | Integration, final review, contribution statements and submission | Integration, final review, contribution statements and submission |

The brief requires all five technologies in the application; it does not say each member must independently implement every technology. Task 1 nonetheless includes all five through the customer UI and SQL-backed seat listing. Your small SELECT does not replace Task 3's schema/report responsibility.

## One shared report, with sections owned by members
Use the exact title: **Level Up: Design and Development of a Web-Based Gaming Café Seat and Time Slot Booking System**.

| Suggested report section | Lead author | What to write and provide |
| --- | --- | --- |
| Cover and contents | Task 1 assembles; everyone verifies | Module, lecturer, full names, complete IDs, submission date |
| 1. Purpose and main functions | Task 1; others confirm | Seat AND interval booking, users/admins, scope and assumptions |
| 2. Interface design and navigation | Task 1 | Sitemap, simple wireframe, four pages, colours, responsive layout, screenshots |
| 3. Technologies and customer workflow | Task 1 with Task 2 | HTML/CSS/JS/PHP/SQL examples, form fields, price estimate vs server total |
| 4. Database design | Task 3 | ERD, three related core tables, admins table, keys, types and data dictionary |
| 5. PHP features and security | Task 2 | Booking flow, auth, sessions, hashing, prepared statements, CSRF, escaping, CRUD |
| 6. Reports | Task 3 with Task 2 | GROUP BY/SUM/COUNT query, report meaning, screenshot and checked totals |
| 7. Setup | Task 3 database steps; Task 2 PHP/admin steps; Task 1 assembles | Requirements, import, configuration, admin creation and local URL |
| 8. Testing | Everyone writes own tests | Inputs, expected result, actual result and evidence; mark tests not run |
| 9. Challenges and solutions | Everyone contributes | Real issues encountered, fixes, limitations; do not invent testing claims |
| 10. Individual contributions | Everyone | Name/ID, files, work actually understood/reviewed, commits and AI assistance |
| 11. Conclusion and references | Task 1 assembles; all review | Outcomes, remaining limits, actual references and acknowledgements |

This is a recommended report structure, not an additional mandated template. The assignment explicitly asks for purpose/functions, setup, challenges/solutions and individual contributions. The technical sections support the marking criteria. Presentation is outside this package.

## Preserve attribution
Task 2 originals are preserved exactly under original/. Proposed replacements and compiled integration additions are AI-assisted draft work, not evidence that your friend wrote them. Task 3 work is still pending. Each teammate should review, understand, test, improve and accurately record their own contribution. The original index was only a PHP test page; the compiled index is the Task 1 home page.

## Missing details
- Task 1 full name and complete enrolment number: the supplied cover shows “Waffle” and an incomplete “B2025”.
- Confirm which named teammate owns Task 2 versus Task 3; the screenshots do not prove the mapping.
- Final database/report files from Task 3 and their agreed schema contract.
- Real testing results and screenshots from XAMPP, including concurrent booking checks.
- Final agreed hours, prices, categories and booking rules. Current assumptions: BND, 10:00–22:00, hourly starts, 1–4 hours, at most 90 days ahead, one seat per booking.
- Final report, actual GitHub repository link and final labelled submission files.
- Confirm deadline arrangements: the uploaded brief and cover say 21 October 2026.
