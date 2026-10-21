# Task 3 Verification Record

## Previously observed integration results

These results were supplied during Zaenudin Nasmi Bin Adi Rupawan's local testing, not attributed as new Task 3 tests:

- Schema import and four initial seat records loaded after local connection configuration.
- LU-1/LU-2 daily report: two sessions/BND 9; cancellation of LU-2 reduced it to one/BND 6; deleting the cancelled row preserved that total.
- Later LU-3 creation/cancellation/deletion changed the daily report as described in the shared report and existing Task 2 evidence.

## Task 3 checks without separately supplied evidence

The latest user update reports the tests working overall. It does not supply individual query outputs, measured totals, tester/date details or new screenshots. The table below identifies what was previously unconfirmed; it is not a claim that these checks now failed or were never run. Record precise results only when supplied.

| Check | Expected result | Actual result | Status | Evidence |
| --- | --- | --- | --- | --- |
| Fresh isolated schema import | Four tables, expected primary/foreign keys and four seed seats | Not supplied | Overall success user-reported; individual result unverified | Not supplied |
| Structure compared with dictionary | Columns, types, nullability, defaults and keys match | Source documented; local verification not supplied | Overall success user-reported; individual result unverified | Not supplied |
| Daily report | Count and sum match confirmed rows by session date | Earlier integration observations above; new Task 3 result not supplied | Overall success user-reported; individual result unverified | Existing Task 2 evidence for earlier results |
| Overall report | Count and total match all confirmed rows | Not supplied | Overall success user-reported; individual result unverified | Not supplied |
| Category report | Counts and values match confirmed rows joined to seat categories | Not supplied | Overall success user-reported; individual result unverified | Not supplied |
| Detailed report | Names, seats, intervals, durations, totals and both statuses match stored rows | Not supplied | Overall success user-reported; individual result unverified | Not supplied |
| Final application integration | Seat listing, booking, login, cancellation/deletion and report work with the final schema | Earlier local cases observed; final package check not supplied | Overall success user-reported; individual result unverified | Not supplied |

## Optional calculation example on an isolated database

If no other confirmed records exist, create a future PC-01 booking from 14:00–16:00 (BND 6) and PC-03 from 14:00–15:00 (BND 5) on the same date. Expected daily and overall totals: two sessions/BND 11. Category values: Standard BND 6; Premium BND 5.

Cancel the Premium booking. Summaries should become one confirmed session/BND 6; detailed report should retain the cancelled row. Delete the cancelled booking; detailed report should omit it and summaries should remain unchanged. These are expected outcomes, not completed test results. Test records and extra QA seats affect totals; compare against the database actually used.

## Latest user-reported update

The project owner reports that the tests work. No additional test screenshots, logs or individual result tables were supplied with this update. This statement is user-reported, not an independently observed acceptance result. Existing Task 1/2 screenshots remain the evidence for their recorded cases. Earlier Pending/Not run labels describe the previously supplied record, rather than independently established current execution status. No extra evidence files are fabricated.
