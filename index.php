<?php
require "db-connection.php";

$info = "";
$infoSuccess = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Pobieranie danych z formularza
    $email = $_POST["email"] ?? "";
    $message = $_POST["message"] ?? "";

    try {
        // Przygotowanie zapytania SQL
        $sql = "INSERT INTO messages (email, message) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);

        // Wykonanie zapytania z danymi
        $stmt->execute([$email, $message]);

        $infoSuccess = "Wiadomość została pomyślnie wysłana!";

    } catch (PDOException $e) {
        $info = "Coś poszło nie tak: " . $e->getMessage();
    }

    // Zamknięcie połączenia
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

    <label for="email">Adres e-mail:</label><br>
    <input type="email" id="email" name="email" placeholder="Podaj swój email" required><br><br>

    <label for="message">Wiadomość:</label><br>
    <textarea id="message" name="message" placeholder="Wpisz wiadomość" required></textarea><br><br>

    <input type="submit" value="Wyślij wiadomość">

</form>

</body>
</html>
 