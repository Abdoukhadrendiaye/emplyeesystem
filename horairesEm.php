<?php
include('conn.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: dashboard.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $jour = $_POST['jour'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $heure_depart = $_POST['heure_depart'];

    $sql = "INSERT INTO horaires (employee_id, jour, heure_arrivee, heure_depart)
            VALUES ('$employee_id', '$jour', '$heure_arrivee', '$heure_depart')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Horaire ajouté avec succès!";
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>

<form method="POST" action="add_schedule.php">
    <label for="employee_id">Employé :</label>
    <select name="employee_id">
        <?php
        $result = $conn->query("SELECT id, nom FROM employees WHERE role='employe'");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nom']}</option>";
        }
        ?>
    </select>

    <label for="jour">Jour :</label>
    <select name="jour">
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <!-- Autres jours -->
    </select>

    <label for="heure_arrivee">Heure d'Arrivée :</label>
    <input type="time" name="heure_arrivee" required>

    <label for="heure_depart">Heure de Départ :</label>
    <input type="time" name="heure_depart" required>

    <button type="submit">Ajouter l'horaire</button>
</form>
