USE levelup_db;
SELECT DATE(start_at) AS booking_date, COUNT(*) AS sessions, SUM(total) AS booked_value
FROM bookings WHERE status='confirmed' GROUP BY DATE(start_at) ORDER BY booking_date DESC;
