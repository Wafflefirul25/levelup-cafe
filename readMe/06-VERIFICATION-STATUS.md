# Verification status

Updated: 21 October 2026

## Initial preparation checks

- Both JavaScript files passed `node --check` during initial preparation.
- The five supplied Task 2 files matched their preserved originals byte-for-byte during initial preparation.
- Four customer pages and their includes/assets were present in the relevant task and compiled folders.
- The proposed schema contained four tables, with bookings referencing customers and seats.
- The initial project ZIP passed an archive-integrity check.

These preparation checks are distinct from subsequent manual testing.

## Subsequent manual testing

Tester: **Zaenudin Nasmi Bin Adi Rupawan (B20250508)**

Environment: Windows, XAMPP, Chrome and the local compiled application.

Observed results recorded in the checklist and supplied screenshots:

- SQL import succeeded and four sample seats loaded after correcting local connection credentials.
- Four customer pages and administrator login opened; active customer navigation links changed appropriately.
- A two-hour Standard-seat booking displayed and stored BND 6 as LU-1.
- A conflicting interval was rejected; an adjacent interval was accepted as LU-2 for BND 3.
- Administrator login, logout, signed-out access protection and incorrect-password rejection were observed.
- The dashboard displayed bookings; cancellation retained a cancelled row, and deletion removed it.
- The daily report changed from two confirmed sessions/BND 9 to one/BND 6 after cancellation and stayed at one/BND 6 after deletion of the cancelled booking.
- Required-field, malformed-email and closing-time browser feedback were observed.
- Narrow and wider customer layouts and FAQ expansion/collapse were visually checked.

Evidence is organized in EVIDENCE.zip into 360E, 390E, 768E and functional-test folders. Width labels are user-organized evidence groups; screenshots generally exclude the dimensions toolbar, and exact heights are not consistently recorded.

## Documentation

The Task 1 member reports completion of their write-up. The report and these files distinguish recorded results from pending checks. Task 2 final review, Task 3 final database/report work and their contribution details remain assigned to those members.

## Not yet verified

- PHP syntax checks with a PHP executable.
- Premium filter result and a complete keyboard/focus/skip-link test.
- Same interval on a different seat and rebooking a cancelled interval.
- Simultaneous requests for the same seat and interval.
- Missing/invalid CSRF tokens and tampered requests.
- Server-side rejection with JavaScript disabled.
- Five-failure login cooldown.
- Seat creation and duplicate-label handling.
- Controlled database outage and repeated-customer-email inspection.
- A clean installation of the final assembled package after Task 3 delivery.

These checks are not claimed as passed. See `04-TEST-CHECKLIST.md` for the detailed test record. Successful selected tests do not establish full security, concurrency safety or final group completion.

## Final integration ownership

Task 1: customer interface, responsive evidence and interface documentation.
Task 2: PHP processing, authentication, security and administrator review.
Task 3: final database schema, SQL and reporting review.
All members: reconcile compiled files, confirm contributions, run final acceptance tests and assemble the submission.
