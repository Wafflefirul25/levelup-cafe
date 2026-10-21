# Task 1 — customer interface

Owner: Task 1 member. Four interconnected PHP pages contain semantic HTML5. assets/style.css supplies responsive CSS; assets/app.js supplies a seat filter, estimated total and closing-time validation. PHP includes reuse layout and escape database output. `includes/bootstrap.php::seats()` executes SQL SELECT for database-backed seat cards. This demonstrates all five required web technologies.

The database schema here is a proposed local integration dependency for Task 3 to review. Task 1 does not claim ownership of final database design or admin functionality. `submit_booking.php` and `login.php` deliberately explain the integration boundary; run compiled for functional booking/authentication. The compiled booking handler belongs to Task 2 review.

Main pages: index.php, seats.php, booking.php, about.php. See ../readMe for setup and tests. No generated dependency or remote image service is required. station.svg is original local vector artwork included in the project.

Simple wireframe: header/navigation, page title and explanation, primary content/cards/form, footer. Home adds a two-column hero; narrow screens stack the columns.
