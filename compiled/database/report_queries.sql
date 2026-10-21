USE levelup_db;
SELECT DATE(start_at) AS booking_date, COUNT(*) AS sessions, SUM(total) AS booked_value
FROM bookings WHERE status='confirmed' GROUP BY DATE(start_at) ORDER BY booking_date DESC;



-- Report 1: Overall confirmed bookings and revenue
SELECT
    COUNT(*) AS total_bookings,
    SUM(total) AS total_revenue
FROM bookings
WHERE status = 'confirmed';

-- Report 2: Bookings and revenue by seat category
SELECT
    s.category AS seat_category,
    COUNT(b.id) AS total_bookings,
    SUM(b.total) AS total_revenue
FROM bookings b
JOIN seats s ON b.seat_id = s.id
WHERE b.status = 'confirmed'
GROUP BY s.category;

-- Report 3: Detailed customer booking report
SELECT
    b.id AS booking_id,
    c.name AS customer_name,
    s.label AS gaming_pc,
    b.start_at,
    b.end_at,
    TIMESTAMPDIFF(HOUR, b.start_at, b.end_at) AS duration_hours,
    b.total AS total_price,
    b.status
FROM bookings b
JOIN customers c ON b.customer_id = c.id
JOIN seats s ON b.seat_id = s.id
ORDER BY b.id;
