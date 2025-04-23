<?php
require 'database_connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// geth movie info
$stmt = $conn->prepare("SELECT title, year FROM movies WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($title, $year);
if (!$stmt->fetch()) {
  die('Movie not found.');
}
$stmt->close();

// get this movie’s reviews
$rq = $conn->prepare("
  SELECT rating, review 
  FROM reviews 
  WHERE movie_id = ? 
  ORDER BY created_at DESC
");
$rq->bind_param('i', $id);
$rq->execute();
$rq->bind_result($rating, $review);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($title); ?> Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- JetBrains Mono font -->
  <link 
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" 
    rel="stylesheet">
  <!-- global + homepage CSS -->
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
        <li><a href="submit_review.php?id=<?php echo $id; ?>">Write Review</a></li>
      </ul>
    </div>
  </nav>

  <!-- page header -->
  <header class="page-header">
    <h2><?php echo htmlspecialchars($title); ?> (<?php echo $year; ?>)</h2>
  </header>

  <!-- main content -->
  <main class="content">
    <section class="featured-section">
      <h4>Reviews</h4>

      <?php $has = false; ?>
      <?php while ($rq->fetch()): $has = true; ?>
        <!-- each review in text card -->
        <div class="about-text">
          <p><strong>Rating:</strong> <?php echo $rating; ?>/5</p>
          <p><?php echo nl2br(htmlspecialchars($review)); ?></p>
        </div>
      <?php endwhile; ?>

      <?php if (!$has): ?>
        <div class="about-text">
          <p>No reviews. <a href="submit_review.php?id=<?php echo $id; ?>">Write a Review!</a></p>
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
<?php $rq->close(); ?>
