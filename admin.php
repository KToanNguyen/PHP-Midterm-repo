<?php
require "includes\connect.php";

//READ QUERY
$sql = "SELECT * FROM reviews ORDER BY id";

//Query preparing
$stmt = $pdo->prepare($sql);

//Execute!
$stmt->execute();

//Retriving all reviews
$reviews = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Review Submission</title>
    <link href="style/bootstrap.css" rel="stylesheets" />
</head>
<body>
      <h2>Reviews</h2>

  <?php if (count($reviews) === 0): ?>
    <p>No review yet.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($reviews as $review): ?>
        <?php echo htmlspecialchars($review) ?>
        <p><a href="create.php">Update</p>
        <p><a href="delete.php">Delete</p>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  
</body>
</html>