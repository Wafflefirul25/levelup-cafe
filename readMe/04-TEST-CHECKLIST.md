# Acceptance tests — NOT RUN

Run on a fresh test database. Record date, tester, browser, actual result and evidence. Never mark expected results as observed results.

| Test | Action | Expected |
| --- | --- | --- |
| Setup | Import SQL; create admin | Four tables; four seats; hashed admin credential |
| Navigation | Follow all four main links and footer login | Correct page, active main link, no broken assets |
| Responsive | Inspect at 360/390/768/1366px | Readable text/forms/nav; tables scroll in container |
| Keyboard | Tab through links/forms/details | Visible focus; labels and skip link work |
| Filter | Choose Premium on seat page | Only Premium cards visible |
| Price | PC-01, two hours | Estimate B$6; server confirmation B$6 |
| Valid booking | Future date, PC-01, 14:00, 2 hours | One booking, correct customer/seat, LU reference |
| Conflict | Same date/seat at 15:00 for one hour | Rejected without extra booking |
| Adjacent | Same date/seat at 16:00 | Accepted when prior booking ends at 16:00 |
| Other seat | Same interval on PC-02 | Accepted |
| Closing time | 21:00 for 2 hours | Rejected by JS and by server with JS disabled |
| Tampering | Alter price or submit invalid seat/hours/email/past date | Server ignores client price and rejects invalid input |
| Repeated email | Use existing email again | Existing customer linked; no duplicate email row |
| Concurrency | Two separate sessions submit same seat/interval together | Only one booking commits; second rejected or safely fails |
| CSRF | Missing or wrong token | HTTP 403; no mutation |
| Invalid login | Wrong credentials five times | Generic error and per-session cooldown |
| Direct access | Open admin dashboard signed out | Redirect to login |
| Admin CRUD | Create booking, view, cancel, delete | Record appears, updates, then is removed |
| Create seat | Valid and duplicate label submissions | Valid added; duplicate handled without raw SQL error |
| Report | Two confirmed bookings B$6/B$5 on same day | 2 sessions, B$11 booked value |
| Cancel/report | Cancel B$6 booking | 1 session, B$5; cancelled slot can be booked again |
| Logout | Submit dashboard logout; revisit dashboard | Session removed; protected page unavailable |
| DB outage | Stop MySQL and load seats/login | Friendly error; no raw connection details |
| No JavaScript | Disable JS and book | Native validation and all server checks still operate |

## Local syntax checks
On Windows PowerShell from Level-Up:
```powershell
Get-ChildItem task-1,compiled -Recurse -Filter *.php | ForEach-Object { & C:\xampp\php\php.exe -l $_.FullName }
```
The preserved Task 2 originals intentionally retain their original issues. Do not run them as the submitted application. PHP lint is necessary but does not replace database/browser tests.
