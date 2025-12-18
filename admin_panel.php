<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != 1) {
    header("Location: logowanie.php");
    exit;
}
?>

<h2>Panel administratora</h2>
<p>Witaj <?= htmlspecialchars($_SESSION["user_name"]) ?></p>

<a href="logout.php">Wyloguj się</a>
