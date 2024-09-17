<?php
include('config.php');
session_start();

$employee_id = $_SESSION['employee_id'];
$date = date('Y-m-d');
$heure_depart = date('H:i:s');

$sql = "UPDATE attendance SET heure_depart='$heure_depart' WHERE employee_id='$employee_id' AND date='$date'";
if ($conn->query($sql) === TRUE) {
    echo "Pointage de départ enregistré.";
} else {
    echo "Erreur : " . $conn->error;
}
?>
