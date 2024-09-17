<?php
include('conn.php');
session_start();

$employee_id = $_SESSION['employee_id'];
$date = date('Y-m-d');
$heure_arrivee = date('H:i:s');

$sql = "INSERT INTO attendance (employee_id, date, heure_arrivee) VALUES ('$employee_id', '$date', '$heure_arrivee')";
if ($conn->query($sql) === TRUE) {
    echo "Pointage d'arrivée enregistré.";
} else {
    echo "Erreur : " . $conn->error;
}
?>
