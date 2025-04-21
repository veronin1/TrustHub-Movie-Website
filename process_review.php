<?php
include 'database_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mid    = (int)$_POST['movie_id'];
    $rate   = (int)$_POST['rating'];
    $text   = $conn->real_escape_string($_POST['review']);

    $sql = "
      INSERT INTO reviews (movie_id, rating, review)
      VALUES ($mid, $rate, '$text')
    ";

    if ($conn->query($sql)) {
        echo "<p>Thank you! Your review has been submitted.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
    echo '<p><a href="movies.php?movie_id='.$mid.'">View all reviews for this movie</a></p>';
}
?>
