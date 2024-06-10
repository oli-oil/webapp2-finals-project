<?php

require 'config.php';

$dsn = "mysql:host=$hostName;dbname=$dbName;charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('secret123' === $password) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: secondpagepost.php");
                    exit;
                } else {
                    echo "Invalid Password";
                }
            } else {
                echo "User not found!";
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAD2 - FINALS PROJECT</title>
    <link rel="stylesheet" href="landingpage.css">

</head>
<body>
    <div class = "form-container">
        <h1> ⊰⊹ Login Form ⊹⊱ </h1>
        <div class = "actualForm-container">
        <form id = "actualForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class = "inputContainer">
            <input type = "text" id = "username" placeholder="Your Username Here..." name = "username" required>
            </div>
            <div class = "inputContainer">
            <input type = "password" id = "password" placeholder="Your Password Here..." name = "password" required >
            </div> 
            <div class = "buttonDiv">
            <button class = "button">Login
                <div class = "hoverOver"> <div></div></div>
            </button>
            </div>
        </form>
        </div>
    </div>
</body>

</html>