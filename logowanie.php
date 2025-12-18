<?php
session_start();
require "db-connection.php";

$info = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$name]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_type"] = $user["type"];

            if ($user["type"] == 1) {
                header("Location: admin_panel.php");
            } else {
                header("Location: user_panel.php");
            }
            exit;

        } else {
            $info = "Nieprawidłowy login lub hasło.";
        }

    } catch (PDOException $e) {
        $info = "Błąd logowania.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>

<h2>Logowanie</h2>

<?php if (!empty($info)): ?>
    <p style="color:red"><?= htmlspecialchars($info) ?></p>
<?php endif; ?>

<?php if (isset($_GET["logout"]) && $_GET["logout"] == 1): ?>
    <script>alert("Zostałeś pomyślnie wylogowany");</script>
<?php endif; ?>

<form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
    <input type="text" name="username" placeholder="Nazwa użytkownika" required><br><br>
    <input type="password" name="password" placeholder="Hasło" required><br><br>
    <input type="submit" value="Zaloguj się">
</form>

</body>
</html>
