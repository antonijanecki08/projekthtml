<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: logowanie.php");
    exit;
}
?>

<h2>Panel użytkownika</h2>
<p>Witaj <?= htmlspecialchars($_SESSION["user_name"]) ?></p>

<a href="logout.php">Wyloguj się</a>
