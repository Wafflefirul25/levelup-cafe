# Setup and next steps

## Windows / XAMPP
1. Extract the ZIP. Put the `Level-Up` folder into `C:\xampp\htdocs\`.
2. Start Apache and MySQL in XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`. Import `Level-Up/compiled/database/proposed_schema.sql`. It creates `levelup_db` and four tables. Use a fresh coursework database; this is not a migration for an existing database with a different structure.
4. The default connection is localhost / levelup_db / root / blank password, for a local XAMPP installation. If your setup differs, configure `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` in the server environment, or adjust the local bootstrap without committing credentials. There is no automatic `.env` loader.
5. Open Command Prompt and run the following. Use your own long password; these variables apply only to this terminal session.

```bat
cd C:\xampp\htdocs\Level-Up\compiled
set LEVELUP_ADMIN_USER=your-admin-name
set LEVELUP_ADMIN_PASSWORD=your-own-long-password
C:\xampp\php\php.exe database\create_admin.php
set LEVELUP_ADMIN_PASSWORD=
```

6. Visit `http://localhost/Level-Up/compiled/index.php`. Do not double-click PHP files or use a static Live Server extension.
7. Open Seats & rates. Four sample stations should appear. Submit a future booking and keep its reference.
8. Use Administrator login in the footer. Test create/view/update/delete and the report using `04-TEST-CHECKLIST.md`.
9. For Task 1 alone, open `http://localhost/Level-Up/task-1/`. It uses the same database for seat listing; its submit handler deliberately reports integration pending. It never claims a booking was saved.

## While Task 3 is pending
1. Learn the four customer pages, shared PHP includes, CSS and JavaScript. Record your Task 1 explanations and genuine design decisions.
2. Review the proposed table/field contract together. Freeze names before parallel edits.
3. Ask Task 2 to review the proposed revised authentication and booking handler. Do not silently replace their originals.
4. Ask Task 3 for final schema SQL, sample data, ERD, data dictionary, report SQL and database setup notes. They may adopt and improve the proposal; document actual review and changes honestly.
5. Test mobile layouts at 360, 390, 768 and 1366 pixels. Capture actual results for your report.
6. Write your report sections now. Leave database findings and untested results labelled pending.
7. When Task 3 arrives, reconcile field names with PHP queries, import into a fresh database, then rerun integration tests. Back up any data before changing an existing schema.
8. Only after acceptance, replace draft schema naming/status, complete names/IDs, finalize the report and create the submission ZIP.

## GitHub upload
1. Use the group's existing repository. Make a backup branch or download the existing repository before reorganizing it.
2. Upload this folder's CONTENTS into the repository root: README.md, .gitignore and all named folders. Avoid creating a second nested copy of the repository.
3. Keep `compiled/` as the integration folder; do not overwrite its home page with Task 2's PHP test page.
4. Commit with a clear description, e.g. `Add Task 1 customer pages and integration draft`.
5. Give teammates their owned folders. Reconcile reviewed work into compiled; editing a source folder does not automatically update compiled.
6. Never upload real passwords, database exports with personal information, or local server logs.
7. Check the README and SQL are visible on GitHub. Copy the actual repository URL into your report and LMS submission.
8. Download or create a ZIP of the final source tree, including local SVG artwork and SQL. Label ZIP and report with group names/student IDs. This delivered draft ZIP has not been uploaded to GitHub for you.

## Common problems
- No seats: start MySQL, import schema and check credentials. Do not present fake availability as live data.
- Admin login fails: the revised code expects `password_hash`, not the original plain-text `password` column. Use the proposed schema and create_admin script; an existing admin table needs an agreed migration.
- Headers already sent: no echo/HTML/whitespace before redirects. The original database.php echoed on connect; compiled does not.
- HTTP 403: reload the form to get a fresh session token.
- Overlap rejection: choose another interval or seat. Back-to-back intervals are allowed.
