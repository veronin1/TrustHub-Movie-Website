# TrustHub Movie Reviews Website

This README explains how the TrustHub Movie Reviews codebase meets the assignment brief requirements.

---

## 1. Directories

```
trusthub/
  --> database.sql             # SQL schema for `movies` and `reviews` tables
  --> database_connect.php     # MySQLi connection script
  --> index.php                # Homepage, also shows featured movies
  --> movies.php               # Script for browsing all movies in the database
  --> movie.php                # Script for showing singular movie details & reviews
  --> submit_review.php        # Review submission form
  --> process_review.php       # Script for user review POST and insertion into database
css/
  --> global.css               # Global styling (navbar, footer, header, font, etc)
  --> homepage.css             # Homepage-specific styling (about section, movie cards, etc)
  --> movies.css               # Movies listing styling (movie cards, movie grid)
  --> review.css               # Review page styleing (form styling)
images/
  --> cinema_popcorn.jpg       # About us homepage image
  --> logo.jpg                 # Used in the navigation bar, all pages
  --> thank_you.png            # After a user submits a review, thank you image appears.
```

---

## 2. Meeting the Brief

The website meets the key requirements by:

1. **Multi-page structure** (LO3):
   - **index.php** (Homepage wireframe)
   - **movies.php** (Movies Listing page)
   - **movie.php** (Movie Details/Reviews)
   - **submit_review.php** & **process_review.php** (Review Submission flow)

2. **Database integration** (LO3):
   - **database.sql** defines `movies` and `reviews` tables
   - **database_connect.php** uses PHP’s MySQLi extension to connect
   - All pages include `database_connect.php` at the top to share one connection.

3. **Form handling & CRUD operations** (LO3):
   - Users select and submit ratings (1–5) and review text via `submit_review.php`.
   - `process_review.php` reads `$_POST`, escapes input with real_escape_string(), then inserts the review into the database.
   - Reviews are displayed on `movie.php`, satisfying the consumption and creation of data.

4. **Front-end layout & responsiveness** (LO2, LO3):
   - Separate CSS files to mimic "medium fidelity designs" (front-end) - (grid layouts, card styles, responsive breakpoints).
   - HTML structure supports accessibility and responsiveness.

5. **Security & best practice** (LO3):
   - Using `$_GET['id']` to `(int)` prevents SQL injection via URL parameters.
   - All user input in `$_POST` is secured with `real_escape_string()` before insertion. real_escape_string() is used to "escape" special characters in a string for safe use in SQL queries, preventing SQL injection.
   - Adding backslashes before characters like single quotes ('), double quotes ("), backslashes (\), and others.
   - `htmlspecialchars()` is used to prevent XSS attacks by removing special HTML characters, converting them into their HTML equivalents so they are rendered as text rather than executed as code. Converting characters like <, >, &, ", and ' into safe entities (e.g., &lt;, &gt;, &amp;, &quot;, &#39;).
   - `nl2br()` preserves line breaks in the user's input by converting newline characters (\n) into HTML <br> tags, ensuring text formatting is maintained.

---

## 3. Code Examples

### `database_connect.php`
```php
$conn = new mysqli(
  \$hostname, \$username, \$password, \$database
);
if (\$conn->connect_error) {
  die('Connection failed: ' . \$conn->connect_error);
}
```
- **Purpose**: Centralises DB credentials and connection logic into 1 script for reusability (DRY methodology).
- **`die()`**: Immediately stops the script if connection failure, showing an error.

### `index.php`
```php
\$res = \$conn->query(
  "SELECT id, title, year FROM movies LIMIT 12"
);
while (\$m = \$res->fetch_assoc()):
  // echo card for \$m['title'], \$m['year']
endwhile;
```
- **`query()`**: Executes the SQL query.
- **`fetch_assoc()`**: Returns each row as an associative array (key-value).
- **Loop**: embeds php loops in HTML to create card grids.

### `movies.php`
Same code as `index.php`, but orders by title:
```php
\$res = \$conn->query(
  "SELECT id, title, year FROM movies ORDER BY title"
);
```

### `movie.php`
```php
\$id = (int) \$_GET['id']; // cast to int
\$mvRes = \$conn->query("SELECT title, year FROM movies WHERE id = \$id");
\$mv = \$mvRes->fetch_assoc();

\$revRes = \$conn->query(
  "SELECT rating, review FROM reviews WHERE movie_id = \$id ORDER BY id DESC"
);

while (\$r = \$revRes->fetch_assoc()):
  // print rating and cleaned user input
endwhile;
```
- **Type cast**: `(int)` ensures the URL parameters become integers.
- **`ORDER BY id DESC`**: Shows newest reviews first.

### `submit_review.php`
```php
\$default_id = (int)\$_GET['id'];
\$list       = \$conn->query("SELECT id, title FROM movies ORDER BY title");

while (\$m = \$list->fetch_assoc()):
  <option value="{\$m['id']}" <?php if (\$m['id']==\$default_id) echo 'selected'; ?> >
    <?php echo htmlspecialchars(\$m['title']); ?>
  </option>
endwhile;
```
- Lists all movies for review selection.
- **`selected` attribute**: Pre-selects if id (i.e. movie_id=15) is passed in the URL

### `process_review.php`)
```php
if (\$_SERVER['REQUEST_METHOD']==='POST') {
  \$mid  = (int)\$_POST['movie_id'];
  \$rate = (int)\$_POST['rating'];
  \$text = \$conn->real_escape_string(\$_POST['review']);
  \$conn->query("INSERT INTO reviews (...) VALUES (...)" );
}
```
- **Method check**: Ensures only POST submissions are processed.
- Prevents SQL injection in free-text fields.
---

