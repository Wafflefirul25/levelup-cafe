# Acceptance test results

Test date: 21 October 2026
Environment: Windows, XAMPP, Chrome, local compiled application
Tester: Zaenudin Nasmi Bin Adi Rupawan (B20250508)

These results record manual testing. Untested features remain pending.

## Completed tests

| Test | Actual result | Status |
| --- | --- | --- |
| Database import | SQL imported successfully and four sample seats were inserted. | Passed |
| Database connection | Initially failed because the connection sent no password. After correcting local credentials, all four seats loaded. | Passed after configuration fix |
| Navigation | Home, Seats & rates, Book a session, About and administrator login pages opened. Active main links were highlighted. | Passed |
| Price calculation | PC-01 for two hours displayed BND 6 estimated total and BND 6 in the confirmation. | Passed |
| Create booking | PC-01 on 22 October 2026, 14:00–16:00, was saved as LU-1. Database record matched the confirmation. | Passed |
| Overlapping booking | PC-01 on the same date, 15:00–16:00, was rejected. No extra booking was inserted. | Passed |
| Adjacent booking | PC-01 on the same date, 16:00–17:00, was accepted as LU-2 for BND 3. | Passed |
| Administrator login | Correct credentials opened the dashboard and displayed stored bookings. | Passed |
| View records | Dashboard displayed LU-1 and LU-2 with their times, prices and statuses. | Passed |
| Daily report | Two confirmed bookings worth BND 6 and BND 3 produced 2 sessions and BND 9 booked value. | Passed |
| Update through cancellation | Cancelling LU-2 changed its status to cancelled while retaining the record. Report changed to 1 session and BND 6. | Passed |
| Delete booking | Deleting cancelled LU-2 removed it from the dashboard and database. LU-1 remained; report stayed at 1 session and BND 6. | Passed |
| Logout and protected access | After logout, opening admin_dashboard.php directly redirected to login without displaying bookings. | Passed |
| Login again | Correct credentials restored dashboard access after logout. | Passed |
| Incorrect password | An incorrect password displayed a generic error and did not open the dashboard. | Passed |
| Required-field validation | Submitting an empty form displayed the browser's required-field message. | Passed |
| Email validation | Entering abc as the email displayed the browser's invalid-email message. | Passed |
| Closing-time JavaScript validation | A 21:00 start for two hours displayed the message requiring sessions to end by 22:00. | Passed |
| Invalid attempts and database | After the validation tests, only the original LU-1 booking remained. | Passed |
| Responsive layout | Narrow and wider previews showed readable content, stacked or multi-column cards, and appropriately arranged form fields across all four customer pages. Evidence is organized into labelled width groups; measurement limitations are stated below. | Visually checked |
| FAQ controls | About-page questions expanded and collapsed; visible answers fitted the layout. | Passed |

## Responsive layout evidence

Evidence is organized under `EVIDENCE/task1/360E`, `EVIDENCE/task1/390E` and `EVIDENCE/task1/768E`, representing the user's labelled preview-width groups (360, 390 and 768 pixels). Screenshots cover the four customer pages in narrow and wider layouts, including stacked cards, form fields, navigation and expandable FAQs.

Most captures exclude the device toolbar. The folder labels identify the intended width groups; exact viewport measurements and heights are not independently established by the images. Heights were not consistently recorded. No height has been invented.

## Task 2 revision: additional recorded results

Evidence is under `EVIDENCE/Task 2/`. These are selected observed cases, not comprehensive security or database-integrity verification.

| Test | Actual result | Status |
| --- | --- | --- |
| Seat creation and retrieval | QA-PC-01 appeared as Standard at BND 4.50/hour. | Passed |
| Duplicate seat label | Creating QA-PC-01 again produced a friendly unique-label error; existing records stayed visible. | Passed |
| Booking creation and pricing | QA-PC-01, 23 October 2026, 14:00–16:00, created LU-3 for BND 9. | Passed |
| Read, cancel and delete | LU-3 appeared confirmed, remained after cancellation, then disappeared after deletion. | Passed |
| Report changes | Cancelling LU-3 excluded its 23 October report row; deleting it left LU-1 and one session/BND 6. | Passed |
| Incorrect password | Generic error; dashboard did not open. | Passed |
| Login cooldown and recovery | Repeated failures produced the one-minute wait message; later correct login succeeded. Exact elapsed time was not independently measured. | Observed |
| Logout and protected access | After the instructed logout/direct-dashboard sequence, login.php appeared without booking data. Request sequence is based on tester execution. | Observed |
| PHP closing-time validation | In the instructed JavaScript-disabled test, 21:00 for two hours returned “Sessions must finish by 22:00.” Captures show the server message, not the DevTools setting. | Passed for this case |
| Altered booking CSRF token | Setting the hidden token to invalid-test produced the invalid-token message. Final dashboard still showed LU-1 and one session/BND 6. | Passed for booking form |
| Local PHP syntax | XAMPP lint showed no syntax errors in 15 compiled PHP files, including local configuration. | Passed |

The earlier folder `Conflict same seat` has been renamed `Duplicate seat label`; those images concern seat creation, not overlapping reservations. During a separate initial CSRF attempt, an unchanged form created LU-4, a repeat interval was rejected and LU-4 was deleted. Those separate conversation captures are not included in this evidence folder; retain them if citing that sequence.

## Remaining tests

| Test | Status |
| --- | --- |
| Premium category filter | Not yet recorded |
| Keyboard navigation, focus and skip link | Not run |
| Same interval on a different seat; rebooking a cancelled interval | Not run |
| Simultaneous requests for the same seat and interval | Not run |
| Missing booking CSRF token | Not run; altered token was tested |
| CSRF rejection on administrator actions, login and logout | Not run |
| Independent HTTP 403 status capture | Not recorded |
| Tampered admin rate 4.555, zero rate and invalid category | Not run |
| Missing/non-positive action IDs and already-cancelled actions | Not run |
| Other tampered booking inputs beyond the recorded closing-time case | Not run |
| Controlled database-outage test | Not run |
| Customer-table check for duplicate emails | Not run |
| Clean installation and compatibility with final Task 3 SQL | Pending |

## Notes

- Screenshots provide evidence for the completed manual tests.
- The observed live-reload WebSocket error appeared to originate from
  development tooling; its removal has not been verified.
- Database credentials must remain local and must not be committed.
- Task 2 must review the PHP/security implementation.
- Task 3's final database and reporting review is still pending.
- Passing these tests does not mean all assignment checks are complete.
## Documentation status

The tester reports completion of the Task 1 write-up. This checklist records the specific demonstrated test results available for review. Completion of the write-up does not change an unrecorded test into a passed test. Tasks 2 and 3 retain responsibility for their final implementation reviews and contribution statements.
