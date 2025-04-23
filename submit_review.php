<?php
require 'database_connect.php';

// pre-select ?id if given
$default_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// get list of all movies for the dropdown
$list = $conn->query("SELECT id, title FROM movies ORDER BY title");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Write a Review</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- jetbrains mono font -->
  <link 
    href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" 
    rel="stylesheet">

  <!-- styles -->
  <link rel="stylesheet" href="styles/global.css">
  <link rel="stylesheet" href="styles/review.css">
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
        <li><a class="active" href="submit_review.php">Write a Review</a></li>
      </ul>
    </div>
  </nav>

  <!-- page header -->
  <header class="page-header">
    <h2>Write a Review</h2>
  </header>

  <!-- review form -->
  <main class="content">
    <section class="review-section">
      <form class="contact-form" method="post" action="process_review.php">
        <!-- Movie selector -->
        <label for="movie_id">Movie:</label>
        <select name="movie_id" id="movie_id" required>
          <option value="">-- choose a movie --</option>
          <?php while ($m = $list->fetch_assoc()): ?>
            <option value="<?php echo $m['id']; ?>"
              <?php if ($m['id']==$default_id) echo 'selected'; ?>>
              <?php echo htmlspecialchars($m['title']); ?>
            </option>
          <?php endwhile; ?>
        </select>

        <!-- rating -->
        <label for="rating">Rating (1–5):</label>
        <select name="rating" id="rating" required>
          <option value="">--</option>
          <?php for ($i=1; $i<=5; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>

        <!-- review text -->
        <label for="review">Your Review:</label>
        <textarea name="review" id="review" rows="5" required></textarea>

        <!-- submit button -->
        <input type="submit" value="Submit Review">
      </form>
    </section>
  </main>

  <!-- footer -->
  <footer class="site-footer">
    <p>© 2025 TrustHub Movie Reviews | Harry Newman</p>
  </footer>

</body>
</html>
