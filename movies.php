<?php
// movies.php — list all movies
require 'database_connect.php';

// gets list of all movies
$res = $conn->query("SELECT id, title, year FROM movies ORDER BY title");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Browse Movies</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- JetBrains Mono font -->
  <link 
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" 
    rel="stylesheet">

  <!-- styling -->
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/movies.css">
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
        <li><a class="active" href="movies.php">Browse Movies</a></li>
        <li><a href="submit_review.php">Write a Review</a></li>
      </ul>
    </div>
  </nav>

  <!-- page header -->
  <header class="page-header">
    <h2>All Movies</h2>
  </header>

  <!-- movies grid -->
  <main class="content">
    <section class="movie-section">
      <div class="movie-grid">
        <?php while ($m = $res->fetch_assoc()): ?>
          <!-- loop through each movie record -->
          <div class="movie-card">
            <h3><?php echo htmlspecialchars($m['title']); ?></h3>
            <p class="year">(<?php echo $m['year']; ?>)</p>
            <a href="movie.php?id=<?php echo $m['id']; ?>" class="details-link">
              View Details
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  </main>

  <!-- footer-->
  <footer class="site-footer">
    <p>© 2025 TrustHub Movie Reviews | Harry Newman</p>
  </footer>

</body>
</html>
