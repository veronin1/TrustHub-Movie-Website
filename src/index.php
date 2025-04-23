<?php
// connect to database
require 'database_connect.php';

// gets first 12 movies for featured movies section
$res = $conn->query("SELECT id, title, year FROM movies LIMIT 12");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TrustHub Movie Reviews</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- import jetbrains mono font -->
  <link 
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" 
    rel="stylesheet">
  <!-- custom styling -->
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/homepage.css">
</head>
<body>

  <!-- navigation bar -->
  <nav class="navbar">
    <div class="logo">
      <a href="index.php"><img src="images/logo.jpg" alt="TrustHub Logo"></a>
      <a href="index.php"><h1>TrustHub Reviews</h1></a>
    </div>
    <div class="nav-items">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="movies.php">Browse Movies</a></li>
        <li><a href="submit_review.php">Write a Review</a></li>
      </ul>
    </div>
  </nav>

  <!-- "about us" section -->
  <section class="about-section">
    <div class="about-text">
      <h3>About TrustHub</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet mollis orci. Fusce quis nunc augue. Fusce lacinia nibh est, nec maximus elit mattis at. Aenean malesuada mi quam, vitae hendrerit leo accumsan nec. Pellentesque elementum malesuada lacus, sed sagittis est dapibus vitae. Fusce vestibulum quam lorem, vel facilisis magna lacinia sit amet. Mauris faucibus tortor feugiat, vulputate erat nec, tincidunt metus.
      </p>
    </div>
    <div class="about-img">
      <img src="images/cinema_popcorn.jpg" alt="Image of Cinema with Popcorn in forefront">
    </div>
  </section>

  <!-- featured movies -->
  <section class="featured-section">
    <h4>Featured Movies</h4>
    <div class="movie-grid">
    <?php while ($m = $res->fetch_assoc()): ?>
        <!-- loop through each movie record from the database -->
        <!-- $m holds the current movies data as an  array -->
        <div class="movie-card">
          <h5><?php echo htmlspecialchars($m['title']); ?></h5>
          <p class="year">(<?php echo $m['year']; ?>)</p>
          <a href="movie.php?id=<?php echo $m['id']; ?>" class="details-link">View Details</a>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <!-- footer -->
  <footer class="site-footer">
    <p>© 2025 TrustHub Movie Reviews | Harry Newman</p>
  </footer>

</body>
</html>
