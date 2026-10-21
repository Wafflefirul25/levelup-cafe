# Level Up

## Design and Development of a Web-Based Gaming Café Seat and Time Slot Booking System

CI2214 Web Development 1 group project. Customers browse stations and reserve one seat for a date/time interval. Administrators manage bookings and seats and view a daily confirmed-booking report.

## Current status

The application and Task 1/2 recorded tests are included. Task 3 database design, ERD, full data dictionary and four report-query explanations are prepared from the checked-in SQL. The project owner now reports that the tests work, without additional screenshots/logs or itemized results. Final contribution confirmation, the Task 2 Muhammad Wafirul Asyraf bin Seriman (B20250513)
 (https://github.com/Wafflefirul25/levelup-cafe.git) remain to be supplied. Existing observed passes and new user-reported results are distinguished in the test records.

## Folder guide

| Folder | Purpose |
| --- | --- |
| compiled/ | Runnable PHP/MySQL application; use this in XAMPP |
| task-1/ | Customer-interface source and integration-boundary examples |
| task-2/original/ | Preserved original PHP; historical reference, not the application to run |
| task-2/proposed-revised/ | Task 2 entry-point copies; rely on compiled includes/assets |
| task-3/ | Database SQL copies, ERD, dictionary, explanations and verification record |
| task-3-pending/ | Historical pointer to the current Task 3 folder |
| readMe/ | Setup, allocation, requirements, contributions and recorded tests |
| EVIDENCE/ | Task 1/2 screenshots and location for actual Task 3 evidence |
| report/ | Consolidated editable report and matching PDF |
| WD Assignment/ | Preserved historical PHP files; reference only |

## Run locally

Requires PHP 8.1+ with PDO MySQL, Apache and MySQL 8+ or MariaDB 10.4+ with InnoDB. Extract Level-Up to C:/xampp/htdocs/Level-Up, import compiled/database/proposed_schema.sql into a fresh isolated local installation, configure the ignored compiled/includes/config.local.php and create an administrator using the existing CLI script if none exists. Open http://localhost/Level-Up/compiled/.

Follow [setup](readMe/01-SETUP.md) for commands. Do not reimport over an existing evidence database to simulate a fresh installation. GitHub stores source; GitHub Pages does not execute this PHP/MySQL app.

## Features and limits

Four connected customer pages use HTML5, CSS, JavaScript, PHP and SQL. Booking uses server-derived prices, validation and interval checks. Authentication uses password hashes and sessions; protected actions use CSRF checks. Booking CRUD consists of public creation, joined reads, cancellation as status update and permanent deletion. The daily report sums confirmed booked value, not payments. No online payments, customer accounts or email delivery are included.

See [test results](readMe/04-TEST-CHECKLIST.md), [Task 2 details](readMe/07-TASK-2-IMPLEMENTATION-AND-TESTS.md) and [Task 3 results record](task-3/TEST-RECORD.md).

## Group and submission

- Task 1: Zaenudin Nasmi Bin Adi Rupawan (B20250508).
- Task 2: Muhammad Wafirul Asyraf bin Seriman (B20250513)
- Task 3: Muhammad Zainul Abidin Bin Haji Jabidi (B20250211).

Confirm actual work in [contributions](readMe/05-CONTRIBUTIONS.md). The shared report contains the concise AI acknowledgement. Complete [remaining submission items](readMe/09-FINAL-SUBMISSION.md) before uploading. Presentation is handled separately.

## Latest user-reported update

The project owner reports that the tests work. No additional test screenshots, logs or individual result tables were supplied with this update. This statement is user-reported, not an independently observed acceptance result. Existing Task 1/2 screenshots remain the evidence for their recorded cases. Earlier Pending/Not run labels describe the previously supplied record, rather than independently established current execution status. No extra evidence files are fabricated.
