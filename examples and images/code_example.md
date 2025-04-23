
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
