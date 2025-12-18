<?php
session_start();
session_unset();
session_destroy();

header("Location: logowanie.php?logout=1");
exit;
