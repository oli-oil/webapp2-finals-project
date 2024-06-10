<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAD2 - FINALS PROJECT</title>
    <link rel="stylesheet" href="secondpage.css">
</head>
<body>
    <div id ="postContainer">
        <h1> ⊰⊹ Posts Page - Lists ⊹⊱ </h1>
        <hr>
        <ul id = "postLists"  style = "text-decoration: none">
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
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM `posts` WHERE userId = :id";
                $statement = $pdo->prepare($query);
                $statement->execute([':id' => $user_id]);

               
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($rows as $row) {
                    echo '<li><a href="thirdpagepost.php?id=' . $row['id'] . '">' . $row['title'] . '</li>';
                }

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        </ul>
    </div>
</body>

</html>