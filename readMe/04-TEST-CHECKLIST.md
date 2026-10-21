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

Evidence is organized in EVIDENCE.zip under 360E, 390E and 768E, representing the user's labelled preview-width groups (360, 390 and 768 pixels). Screenshots cover the four customer pages in narrow and wider layouts, including stacked cards, form fields, navigation and expandable FAQs.

Most captures exclude the device toolbar. The folder labels identify the intended width groups; exact viewport measurements and heights are not independently established by the images. Heights were not consistently recorded. No height has been invented.

## Remaining tests

| Test | Status |
| --- | --- |
| Premium category filter | Not yet recorded |
| Keyboard navigation, focus and skip link | Not run |
| Same interval on a different seat | Not run |
| Booking a cancelled interval again | Not run |
| Simultaneous requests for the same seat and interval | Not run |
| Missing or invalid CSRF token | Not run |
| Tampered form requests and server-side validation | Not run |
| Closing-time rejection with JavaScript disabled | Not run |
| Five incorrect logins and cooldown | Not run |
| Create seat and duplicate-label handling | Not run |
| Controlled database-outage test | Not run |
| Customer-table check for duplicate emails | Not run |
| Local PHP syntax checks | Not run |

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
