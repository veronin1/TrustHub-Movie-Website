<?php
// Movie details and its reviews 
require 'database_connect.php';

// get & cast the ID from the URL
$movieId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// get the movie’s title & year in one flat query
$movieResult = $conn->query("
  SELECT title, year
  FROM movies
  WHERE id = $movieId
");
if (!$movieResult || $movieResult->num_rows === 0) {
    die('Movie not found.');
}
$movieInfo   = $movieResult->fetch_assoc();
$movieTitle  = $movieInfo['title'];
$releaseYear = $movieInfo['year'];

// get all its reviews, newest first, in one query
$reviewsResult = $conn->query("
  SELECT rating, review
  FROM reviews
  WHERE movie_id = $movieId
  ORDER BY id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($movieTitle); ?> Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- JetBrains Mono font -->
  <link 
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" 
    rel="stylesheet">
  <!-- styling -->
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/homepage.css">
</head>
<body>

  <!-- navbar -->
  <nav class="navbar">
    <div class="logo">
      <a href="index.php"><img src="images/logo.jpg" alt="TrustHub Logo"></a>
      <a href="index.php"><h1>TrustHub Reviews</h1></a>
    </div>
    <div class="nav-items">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="movies.php">Browse Movies</a></li>
        <li><a href="submit_review.php?id=<?php echo $movieId; ?>">Write Review</a></li>
      </ul>
    </div>
  </nav>

  <!-- page header -->
  <header class="page-header">
    <h2><?php echo htmlspecialchars($movieTitle); ?> (<?php echo $releaseYear; ?>)</h2>
  </header>

  <!-- main content -->
  <main class="content">
    <section class="featured-section">
      <h4>Reviews</h4>

      <?php if ($reviewsResult->num_rows): ?>
        <?php while ($review = $reviewsResult->fetch_assoc()): ?>
          <!-- each review in a text card -->
          <div class="about-text">
            <p><strong>Rating:</strong> <?php echo $review['rating']; ?>/5</p>
            <p><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="about-text">
          <p>No reviews. <a href="submit_review.php?id=<?php echo $movieId; ?>">
            Write a Review!
          </a></p>
        </div>
      <?php endif; ?>

    </section>
  </main>

  <!-- footer -->
  <footer class="site-footer">
    <p>© 2025 TrustHub Movie Reviews | Harry Newman</p>
  </footer>

</body>
</html>
