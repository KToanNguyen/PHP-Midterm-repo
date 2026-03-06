<?php
require "includes\connect.php";

//Grab data and sanitize
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
$rating = $_POST['rating'];
$reviewtext = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS);

//Server-side validation
$errors =[];

if($title === null || $title === ''){ //title require
    $errors[] = "- Please provide a title! (Incase the book you're thinking of is non-existent)";
}

if($author === null || $author === ''){ //author require
    $errors[] = "- Your book is written by a ghost?";
}

// Require at least 1 number in rating
if ($rating === null|| $rating === '') {
    $errors[] = "THIS IS NOT A HOW-MUCH-YOU-DO-NOT-CARE APP";
}

if($reviewtext === null || $reviewtext === ''){ //review with text
    $errors[] = "At least give us some of your thought, haiya!";
}

//Error messages looping through: display errors for user(s) and exit
if(!empty($errors)){
    foreach ($errors as $error) : ?>
        <li>
            <?php echo "<li>" . htmlspecialchars($error) . "</li>" ?>
        </li>
    <?php endforeach;
    //Stop scripting
    exit;
}

//Creating query
try{ 
    $stmt = $pdo->prepare(
        //For Creating and Updating
        "INSERT INTO reviews(title, author, rating, review_text) 
        VALUE(:title, :author, :rating, :review_text)
        ON DUPLICATE KEY UPDATE
            title = VALUES(title),
            author = VALUES(author),
            rating = VALUES(rating),
            review_text = VALUES(review_text),"
    );
    //Execute!
    $stmt->execute([':title' => $title, ':author' => $author, ':rating' => $rating, ':review_text' => $reviewtext,]);
    //Invoice ID
    $id = $pdo->lastInsertId();
}
catch (PDOException $e) {//Error
    die("Database error: " . $e->getMessage());
}
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Review Submission</title>
    <link href="style/bootstrap.css" rel="stylesheets" />
</head>
<body>
    <h2>Thank you for your review!</h2>
</body>
</html>