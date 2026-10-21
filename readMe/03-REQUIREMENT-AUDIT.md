# Requirement audit

This audit distinguishes implementation from observed tests. The final marking decision belongs to the lecturer and supplied assignment criteria.

| Requirement | Current provision | Verification/status |
| --- | --- | --- |
| Consistent design and active navigation | Shared header/footer and CSS | Recorded Task 1 navigation/layout evidence |
| HTML5, CSS, JavaScript, PHP, SQL | Templates, CSS, interactions, PDO seat retrieval and booking SQL | Source present; selected behaviour tested |
| At least four connected pages | Home, Seats & rates, Book a session, About | Recorded local navigation tests |
| Form validation and errors | HTML, JavaScript and PHP checks | Required/email/closing-time evidence; additional edge cases unperformed |
| PHP storage/retrieval | Seat listing and customer/booking queries | Recorded local booking and dashboard evidence |
| At least three related tables | customers → bookings ← seats, plus separate admins | Schema documented; final Task 3 local review pending |
| Admin authentication | Hash verification, sessions, protected page and logout | Recorded login/logout/protected-access cases |
| Admin CRUD | Booking creation, reads, cancellation update and deletion; seat creation | Recorded selected cases; cancellation is the update operation |
| Simple report | Daily confirmed booking count and value | Recorded dashboard changes; three additional SQL reports await execution evidence |
| Public viewing/addition | Seat listing and booking form | Recorded local results |
| Mobile layout | Flexible grid, media query and stacking | Visual evidence with viewport measurement limitations |
| Source/images/SQL ZIP | Full assembled source, local SVG, SQL and evidence in this package | Archive integrity checked during assembly |
| GitHub and README | Organized folders, root guide and setup | Actual URL and repository update must be supplied by group |
| Report and contributions | Consolidated DOCX/PDF, diagrams, explanations and evidence | Member details, confirmations and real Task 3 results remain |

## Limits

Additional manual security/concurrency edge cases are listed in the test records, not presented as passed or automatically mandatory. The session-based cooldown is not account-wide rate limiting. No production-security claim is made. Seat locking depends on InnoDB and consistent booking writers. Report totals represent booking value, not received revenue. Customer email reuse retains the original name. There is no public account, payment flow or self-service cancellation feature.
