<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAD2 - FINALS PROJECT</title>
    <link rel="stylesheet" href="thirdpagepost.css">

</head>
<body>
    <div class="postContainer">
        <h1> ⊰⊹ Post Page ⊹⊱</h1>
        <div id="postDetails">  
        <?php

        require 'config.php';

        if (!isset($_SESSION['user_id'])) {
            header("Location: landingpage.php");
            exit;
        }

        $dsn = "mysql:host=$hostName;dbname=$dbName;charset=UTF8";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            $pdo = new PDO($dsn, $user, $password, $options);

            if ($pdo) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $query = "SELECT * FROM `posts` WHERE id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $id]);

                    $post = $statement->fetch(PDO::FETCH_ASSOC);

                    if ($post) {
                        echo '<h3>Title: ' . $post['title'] . '</h3>';
                        echo '<p>Body: ' . $post['body'] . '</p>';
                    } else {
                        echo "No post found with ID $id!";
                    }
                } else {
                    echo "No post ID provided!";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        </div>
    </div>
</body>
</html>