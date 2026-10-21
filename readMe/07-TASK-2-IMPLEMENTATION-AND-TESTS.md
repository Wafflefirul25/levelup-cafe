# Task 2 implementation and acceptance checks

## Current handoff status

Selected Task 2 acceptance tests were performed in Windows/XAMPP and Chrome on 21 October 2026 by Zaenudin Nasmi Bin Adi Rupawan (B20250508). Screenshots document the revised application running locally. The results below distinguish observed passes from checks not yet performed. Task 2 report integration, confirmed group contribution details and final database integration remain separate handoff work.

## Files and ownership

- Run `compiled/` in Apache. It contains the assembled application.
- `task-2/proposed-revised/` contains matching Task 2 entry points and relies on the compiled includes/assets. Do not run that directory as a separate website.
- `task-2/original/` and `WD Assignment/` are preserved historical files.
- Task 1 files and all supplied evidence are preserved.
- This Task 2 revision did not alter the database schema. Task 3 owns final database review. Preserve newer SQL files already added to GitHub; reconcile them before a final integrated test.
- The user is now working through Task 2. Final authorship and teammate allocation must reflect the work each person actually performs; no teammate identity or contribution is invented.

## Changes in this revision

1. Admin cancellation/deletion validates positive booking IDs and reports success only when a row changes.
2. Already-cancelled/missing bookings return a no-change message.
3. Seat prices accept a positive number with at most two decimal places; duplicate labels show a friendly error.
4. Both rejected and successful admin POST actions redirect to a fresh dashboard GET. Existing records are reloaded rather than appearing empty after invalid input.
5. Database retrieval failures display an unavailable message instead of claiming that no bookings exist.
6. PHP strict session mode is enabled alongside existing HttpOnly/SameSite cookie settings.
7. Optional ignored `compiled/includes/config.local.php` separates local database credentials from committed source. Environment settings remain supported.

## Existing features retained

- Administrator password hashes verified with password_verify; session ID and CSRF token rotate on login.
- Login errors are generic; five failures cause a 60-second session-based cooldown. This is a coursework safeguard, not account-wide rate limiting.
- POST-only logout clears session state and expires the session cookie.
- CSRF validation protects booking, admin action, login and logout POSTs.
- PDO prepared queries and escaped HTML output handle user data.
- Booking validation checks name/email, seat, future date within 90 days, hourly start, one-to-four-hour duration and closing time.
- Transactions lock the selected seat before querying overlaps; adjacent intervals remain allowed. Simultaneous-request testing is still required before claiming that case passed.
- Customer email reuse retains the original stored customer name; this is current behaviour, not a customer-profile editing feature.
- Booking CRUD uses public booking creation, joined dashboard reads, status updates through cancellation and permanent deletion. It does not edit a reservation's date/time.
- The daily report groups confirmed bookings and sums reserved session value, not payments.

## Install this revision safely

1. Back up your existing local project and database. Do not delete or reimport an existing database for this update.
2. Copy the revised `compiled/` files into your XAMPP project, preserving any local configuration.
3. Copy `compiled/includes/config.example.php` to `compiled/includes/config.local.php`. Enter your actual MySQL credentials only in config.local.php. No SQL/schema change is required.
4. Open `http://localhost/Level-Up/compiled/` (adjust folder name to your local installation).
5. Use your existing administrator account. No password is included in this package.
6. From the project root, run the PHP syntax command in section below.
7. Perform the acceptance cases below and save screenshots under `EVIDENCE/Task 2/`. Task 1 evidence is under `EVIDENCE/task1/`. Keep historical evidence unchanged.

## PHP syntax check — Windows PowerShell

Run from the project root after extraction:

```powershell
Get-ChildItem .\compiled -Recurse -Filter *.php | ForEach-Object { & 'C:\xampp\php\php.exe' -l $_.FullName }
```

Expected: every compiled PHP file reports `No syntax errors detected`. Historical originals are excluded because they are preserved for attribution, not the runtime application.

## Recorded acceptance results

Evidence paths below are relative to `EVIDENCE/Task 2/`. “Passed” describes the selected observed case, not comprehensive coverage of a feature.

| Case | Actual result | Status | Evidence folder |
| --- | --- | --- | --- |
| Valid login | Dashboard opened signed in as levelupadmin. | Passed | Multiple invalid credentials |
| Booking creation and pricing | QA-PC-01 at BND 4.50/hour for two hours on 23 October 2026, 14:00–16:00, showed BND 9 and returned LU-3 with the same total. | Passed | Book seat w new seat |
| Read bookings | Dashboard listed LU-3 with Task 2 Test, QA-PC-01, correct times, BND 9 and confirmed status. | Passed | Admin new book,cancel,delete |
| Cancellation | LU-3 remained with cancelled status; the 23 October report row was excluded. LU-1 remained unchanged. | Passed | Admin new book,cancel,delete |
| Deletion | LU-3 disappeared from the dashboard. The remaining report showed 22 October, one session and BND 6. | Passed | Admin new book,cancel,delete |
| Create seat | QA-PC-01 was created as Standard and appeared in the public listing at BND 4.50/hour. | Passed | New seat created |
| Duplicate seat label | Submitting QA-PC-01 again produced a unique-label conflict message. LU-1 and report totals remained visible. | Passed | Conflict same seat |
| Incorrect password | Generic invalid-credentials error; login page remained visible. | Passed | Invalid password |
| Cooldown and recovery | After the instructed repeated failures, a one-minute wait message appeared. A later correct login opened the dashboard. Exact duration was not independently timed. | Observed blocking and recovery | Multiple invalid credentials |
| Logout/protected access | Following logout and the instructed direct dashboard request, login.php appeared with no booking data. Screenshots show the resulting login page; request sequence is based on the tester's execution. | Observed result | Logged out |
| PHP closing-time validation | 21:00 for two hours returned “Sessions must finish by 22:00.” The test was performed with JavaScript disabled as instructed; screenshots show the inactive estimate and server message, not the DevTools setting. | Passed for this case | Javascript disabled booking |
| Altered booking CSRF token | Hidden token was changed to invalid-test. Submission returned “Invalid form token. Reload the page.” The later dashboard still showed only LU-1 and one session/BND 6. | Passed for this booking form | CSRF Test |
| PHP syntax | XAMPP PHP lint reported no syntax errors in all 15 compiled PHP files listed, including local configuration. | Passed | powershell syntax |

### Additional observed booking conflict and cleanup

During the initial attempt to locate the CSRF token, an unchanged valid form created LU-4 for seat #5 on 24 October 2026, 14:00–15:00, at BND 4.50. A subsequent request for that interval was rejected as already reserved. LU-4 was then deleted, leaving LU-1 and the original report total intact. This sequence was supplied separately in the testing conversation; it is not the duplicate-seat-label case and is not the completed CSRF test. Retain those screenshots separately if citing that overlap result in the final report.

### Checks not yet performed or fully evidenced

| Check | Status |
| --- | --- |
| Tampered admin rate 4.555, zero rate and invalid category | Pending |
| Missing or non-positive booking action ID; already-cancelled action | Pending |
| CSRF rejection on admin action, login and logout forms | Pending; only the booking form was exercised |
| Missing CSRF token | Pending; an altered token was tested |
| Independent HTTP 403 status capture | Pending; visible rejection was recorded |
| Same interval on another seat and rebooking a cancelled interval | Pending |
| Simultaneous requests for the same seat and interval | Pending |
| Customer-table duplicate-email inspection | Pending |
| Controlled database-outage behaviour | Pending |
| Fresh installation and compatibility with the final Task 3 SQL | Pending |

### Evidence labels

The folder named `Conflict same seat` shows duplicate **seat-label creation**, not overlapping time-slot booking. Its current name is retained to match the uploaded evidence; use the accurate description in captions and test results. The evidence ZIP contains screenshots, not a database export. A visible dashboard row or total establishes the observed output, not a complete database integrity audit.

Use a disposable test database if you do not want QA seats or bookings mixed with existing evidence. The dashboard does not delete seats; database cleanup belongs to the database owner.

## Report text — Section 5

The PHP booking handler accepts POST requests and validates the CSRF token and booking details. It checks the customer name and email, selected active seat, future date, start time and duration. Rates come from the database, so changing the browser estimate cannot set the stored booking total. A transaction locks the seat row before checking confirmed bookings for overlap. An existing interval conflicts when its start is earlier than the requested end and its end is later than the requested start. Adjacent intervals are allowed. Valid bookings reuse or create a customer record, insert the reservation and commit; rejected requests roll back. A redirect displays a confirmation reference or a friendly error.

## Report text — Section 6

Administrator login retrieves a stored password hash through a prepared query and checks it with password_verify. Successful login regenerates the session ID and CSRF token. Protected pages require the authenticated session. Logout accepts POST, checks the form token, clears the session and expires its cookie. A session-based cooldown follows five failed login attempts.

The dashboard provides joined booking records, status updates through cancellation and permanent deletion. Administrators create bookings through the booking form and add seats through a protected form. Positive IDs and seat values are checked on the server. Cancellation and deletion messages distinguish changed records from missing or already-cancelled records. Duplicate-seat errors are handled without hiding the existing dashboard records. All admin submissions redirect to a fresh GET. The daily report counts confirmed sessions and sums reserved booking value by date. PDO queries, escaped HTML and CSRF tokens provide basic database and request protection. These controls are implemented; unperformed security tests must remain identified as pending.

## Validation limits

PHP and MySQL were unavailable in the assistant preparation environment, but subsequent user-run XAMPP checks supplied the manual results recorded above. The 15-file lint result is from the user’s local PHP installation. No automated PHP execution or independent timing is claimed. The local screenshots do not prove that the same code and final SQL are already present together on GitHub; verify the final assembled download before submission.

## Contribution and acknowledgement

The original PHP files remain attributed to the Task 2 member who supplied them. AI assistance produced proposed revisions and documentation. Zaenudin Nasmi Bin Adi Rupawan performed the recorded local installation and manual tests while working through Task 2. The group must confirm final Task 2 authorship and names/IDs according to actual reviewed changes. Testing another member’s functionality does not transfer authorship automatically.

