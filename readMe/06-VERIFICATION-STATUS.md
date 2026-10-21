# Verification status

Updated: 21 October 2026

## Source and archive verification

The supplied current GitHub ZIP passed archive-integrity checking. The revised compiled administrator dashboard, bootstrap, configuration example, matching Task 2 dashboard and root .gitignore match the supplied Task 2 candidate. The updated Task 2 implementation/test guide is included. Compiled JavaScript passed node --check. These checks do not execute PHP or MySQL.

The archive contains 82 evidence screenshots: 62 for Task 1 and 20 for Task 2. No config.local.php file is included. Historical PHP originals remain reference files; run compiled/ in XAMPP.

## Recorded local manual testing

Tester: **Zaenudin Nasmi Bin Adi Rupawan (B20250508)**

Environment: Windows, XAMPP, Chrome, local compiled application.

Task 1 results include database import and connection after local configuration, customer navigation, BND 6 booking creation, conflicting/adjacent intervals, administrator access, cancellation/deletion/report updates, browser validation, responsive layouts and FAQ controls. See 04-TEST-CHECKLIST.md for the individual cases.

Additional Task 2 results include:

- QA-PC-01 created and publicly listed at BND 4.50/hour; duplicate label rejected.
- LU-3 created for two hours/BND 9, displayed, cancelled and deleted; daily confirmed-booking totals changed accordingly.
- Incorrect password rejected; repeated failures produced cooldown feedback and a later correct login succeeded. Exact cooldown duration was not independently timed.
- Login page appeared after the instructed logout and direct-dashboard sequence.
- PHP rejected a session ending after 22:00 during the instructed JavaScript-disabled test. Images show the message, not the DevTools setting.
- An altered booking CSRF token was rejected. Other forms and a missing token were not exercised.
- User-run XAMPP PHP lint showed no syntax errors in 15 compiled PHP files, including local configuration.

Evidence is under EVIDENCE/task1/ and EVIDENCE/Task 2/. Duplicate-seat-label screenshots are in Duplicate seat label/. Responsive width labels are user-organized groups; screenshots generally exclude the dimensions toolbar and do not independently establish exact viewport heights.

## Remaining verification

- Premium filter; complete keyboard/focus/skip-link checks.
- Same interval on another seat, rebooking a cancelled interval and simultaneous competing requests.
- Missing CSRF token, other protected forms and independent HTTP status capture.
- Tampered admin rates/category; missing/non-positive action IDs and already-cancelled actions.
- Other tampered booking input cases, controlled database outage and duplicate-email database inspection.
- Clean installation and final application/Task 3 SQL compatibility.

## Database and documentation status

The schema contains four tables; bookings references customers and seats. Additional SQL queries for overall confirmed booking value, category totals and detailed bookings are present. Their execution/results and final database ownership still require Task 3 confirmation. Booking value is not proof of payment or received revenue.

Task 1 write-up and selected Task 2 results have been incorporated into the updated Word report supplied separately. No Word/PDF report is included in the current source ZIP. Confirm the Task 2 member name/ID, repository URL and actual contributions, and finish Task 3 report sections before final submission. Some historical task-folder handoff wording remains provisional.

Task 1 owns customer interface and responsive evidence; Task 2 owns PHP processing, authentication and administrator review; Task 3 owns final database design, SQL and reporting review. All members must reconcile compiled files and run final acceptance checks. Testing a teammate's functionality does not transfer authorship. Selected successful tests do not establish comprehensive security, concurrency safety or whole-group completion.
