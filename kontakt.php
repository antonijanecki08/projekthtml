<?php
require "db-connection.php";

$info = "";
$infoSuccess = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $message = $_POST["message"] ?? "";

    try {
        $sql = "INSERT INTO messages (name, email, message)
                VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $message]);

        $infoSuccess = "Wiadomość została pomyślnie wysłana!";
    } catch (PDOException $e) {
        $info = "Coś poszło nie tak: " . $e->getMessage();
    }

    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz kontaktowy</title>
</head>
<body>

<h2>Wyślij wiadomość</h2>

<?php if (!empty($info)) : ?>
    <p style="color:red;">
        <?= htmlspecialchars($info) ?>
    </p>
<?php elseif (!empty($infoSuccess)) : ?>
    <p style="color:green;">
        <?= htmlspecialchars($infoSuccess) ?>
    </p>
<?php endif; ?>

<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">

    <label for="name">Imię:</label><br>
    <input type="text" id="name" name="name" placeholder="Podaj imię" required><br><br>

    <label for="email">Adres e-mail:</label><br>
    <input type="email" id="email" name="email" placeholder="Podaj swój email" required><br><br>

    <label for="message">Wiadomość:</label><br>
    <textarea id="message" name="message" placeholder="Wpisz wiadomość" required></textarea><br><br>

    <input type="submit" value="Wyślij wiadomość">

</form>

</body>
</html>
