<?php
require "db-connection.php";

try {
    $stmt = $pdo->query("SELECT * FROM products");
} catch (PDOException $e) {
    exit("Błąd zapytania: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Produkty</title>
    <style>
        .produkty {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        article {
            width: 250px;
            border: 1px solid #ccc;
            padding: 15px;
        }

        img {
            width: 100%;
        }

        .cena {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<h2>Nasze produkty</h2>

<div class="produkty">

<?php if ($stmt->rowCount() > 0): ?>

    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

        <article>
            <span class="cena">
                <?= number_format($row['price'], 2, ',', ' ') ?> zł
            </span>

            <figure>
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="">
            </figure>

            <h3><?= htmlspecialchars($row['name']) ?></h3>

            <p><?= htmlspecialchars($row['description']) ?></p>

            <a href="#">Kup teraz</a>
        </article>

    <?php endwhile; ?>

<?php else: ?>
    <p>Brak produktów w bazie danych.</p>
<?php endif; ?>

</div>

</body>
</html>

<?php
$pdo = null;
?>
