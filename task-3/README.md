# Task 3 Database and Reports

Project: Level Up: Design and Development of a Web-Based Gaming Café Seat and Time Slot Booking System.
Assigned member: Muhammad Zainul Abidin Bin Haji Jabidi (B20250211).

## Files

- database/proposed_schema.sql: exact copy of the schema in the reviewed compiled application.
- database/report_queries.sql: exact copy of all four current report queries.
- docs/ERD.png: relationship diagram of the actual schema.
- docs/DATA-DICTIONARY.csv: every column, type, nullability, key/default and purpose.
- docs/DATABASE-AND-REPORTS.md: completed design and SQL explanations, matching Sections 7–8 of the shared report.
- TEST-RECORD.md: existing observations and unperformed Task 3 checks, kept separate.
- CONTRIBUTION.md: allocation and truthful contribution confirmation instructions.
- evidence/README.md: pointer to the shared EVIDENCE/Task 3/ location.

## Installation and review

Run the website from compiled/, not task-3/. These SQL copies do not automatically update compiled/database/.

Use a fresh isolated local installation to check import. The schema explicitly creates and selects levelup_db. If that database already contains evidence, do not overwrite/drop it. CREATE TABLE IF NOT EXISTS does not upgrade or validate an existing schema; INSERT IGNORE does not reset existing seats. Back up existing work and use an isolated environment for a genuine fresh-install check.

Start Apache/MySQL, import database/proposed_schema.sql in phpMyAdmin, confirm the four tables and four initial seats, and configure compiled/includes/config.local.php from its example. Create an administrator with the existing compiled/database/create_admin.php CLI script if none exists. Follow readMe/01-SETUP.md for the existing project's administrator commands. Keep local credentials out of GitHub.

Run database/report_queries.sql in phpMyAdmin and compare the results with stored records. Daily, overall and category summaries filter confirmed bookings. The detailed report includes both statuses. total_revenue is an existing alias for confirmed booking value, not payments. Empty aggregate SUM results can be NULL.

Complete TEST-RECORD.md with actual results. No SQL/PHP source change is needed merely to demonstrate contribution. Review and credit existing source accurately. AI assistance with code and documentation is disclosed in the shared report.
