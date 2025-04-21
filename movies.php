<?php
include 'database_connect.php';
$res = $conn->query("SELECT * FROM movies");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Browse Movies</title>
</head>
<body>
  <h1>Browse Movies</h1>
  <ul>
    <?php while ($m = $res->fetch_assoc()): ?>
      <li>
        <?php echo htmlspecialchars($m['title']) . " ({$m['year']})"; ?>
        — <a href="submit_review.php?movie_id=<?php echo $m['id']; ?>">
            Write Review
          </a>
      </li>
    <?php endwhile; ?>
  </ul>
  <p><a href="movies.php">Refresh list</a></p>
</body>
</html>
