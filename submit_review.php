<?php
include 'database_connect.php';
$movie_id = isset($_GET['movie_id']) ? (int)$_GET['movie_id'] : 0;
$mres = $conn->query("SELECT * FROM movies WHERE id=$movie_id");
$movie = $mres->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Review <?php echo htmlspecialchars($movie['title']); ?></title>
</head>
<body>
  <h1>Review: <?php echo htmlspecialchars($movie['title']); ?> (<?php echo $movie['year']; ?>)</h1>
  <form action="process_review.php" method="post">
    <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">

    <label for="rating">Rating (1–5):</label>
    <select name="rating" id="rating">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php endfor; ?>
    </select>

    <br><br>
    <label for="review">Your Review:</label><br>
    <textarea name="review" id="review" rows="4" cols="50"></textarea>

    <br><br>
    <input type="submit" value="Submit Review">
  </form>
  <p><a href="movies.php">← Back to list</a></p>
</body>
</html>