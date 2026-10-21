# Level Up
## Design and Development of a Web-Based Gaming Café Seat and Time Slot Booking System

WD1 group coursework. Task 1 documentation and recorded manual testing are complete. Selected Task 2 tests are also recorded, including seat creation, duplicate-label handling, booking CRUD, PHP syntax, login cooldown, server closing-time validation and altered booking-token rejection. Task 2 final contribution confirmation, remaining edge-case checks and Task 3 final database/report review remain pending. See `readMe/04-TEST-CHECKLIST.md` and `readMe/07-TASK-2-IMPLEMENTATION-AND-TESTS.md` for results and limitations.

| Folder | Purpose |
| --- | --- |
| `readMe/` | Setup, report division, requirement audit, test checklist and handoff |
| `task-1/` | Customer-facing pages: HTML5, CSS, JavaScript, PHP and a SQL retrieval example |
| `task-2/original/` | Latest supplied PHP files, preserved byte-for-byte; reference only |
| `task-2/proposed-revised/` | Proposed replacements for Task 2 to review; depend on compiled includes/assets |
| `task-3-pending/` | Database/report handoff; not a claim of completed teammate work |
| `compiled/` | Current assembled application; run this directory in XAMPP |

Start with [setup](readMe/01-SETUP.md), then [ownership and report division](readMe/02-OWNERSHIP-AND-REPORT.md).

Requires PHP 8.1+ with PDO MySQL and MySQL 8+ or MariaDB 10.4+ using InnoDB. Import `compiled/database/proposed_schema.sql`, create an admin with the CLI script, and visit `http://localhost/Level-Up/compiled/`.

No online payment, customer accounts, email delivery or public hosting is included. GitHub stores source; GitHub Pages cannot execute this PHP/MySQL application. All café rates and hours are illustrative assumptions.

Group members: replace the placeholders in `readMe/05-CONTRIBUTIONS.md` with full names, student IDs and verified contributions before submission. Understand and acknowledge AI assistance as required by the assignment.
