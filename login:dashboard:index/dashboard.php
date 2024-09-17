<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header('Location: login.php');
}

echo "Bienvenue, " . $_SESSION['role'];

if ($_SESSION['role'] == 'admin') {
    echo "<a href='add_schedule.php'>Ajouter Horaires</a>";
}
echo "<a href='clock_in.php'>Pointage</a>";
?>
