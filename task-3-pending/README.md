# Task 3 handoff — pending

No final Task 3 files have been supplied. `compiled/database/proposed_schema.sql` and report_queries.sql are AI-assisted proposals to review, not a claim of teammate completion.

Please provide: final schema SQL, sample/seed SQL, ERD, data dictionary, report query and explanation, fresh-import instructions, database tests, and contribution notes. Use at least three RELATED tables. Proposed core: customers (1) to bookings (many), seats (1) to bookings (many). admins is a fourth independent authentication table; it is not counted as one of the three related core tables.

Contract used by compiled PHP:
- admins: id, username, password_hash
- customers: id, name, email (unique)
- seats: id, label (unique), category Standard/Premium, hourly_rate, active
- bookings: id, customer_id, seat_id, start_at, end_at, total, status confirmed/cancelled, created_at

InnoDB, foreign keys and seat_time index are required for the proposed design. Datetimes represent Brunei local time. Booking intervals are half-open: overlap means existing.start < requested.end AND existing.end > requested.start. Back-to-back bookings are allowed. Every booking writer must lock the seat row before checking overlap and inserting inside one transaction.

Report: group confirmed bookings by session start date; COUNT(*) sessions and SUM(total) booked value. It is not payment revenue. Agree any schema change with Task 2, then update all queries and run tests. Do not import this proposal over an incompatible existing schema without a reviewed migration.
