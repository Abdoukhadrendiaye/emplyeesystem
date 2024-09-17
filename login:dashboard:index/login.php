<?php
include('conn.php');
include('header.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM employees WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            $_SESSION['employee_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header('Location: dashboard.php');
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun compte trouvé avec cet email.";
    }
}
?>

<div class="row">
    <div class="col-6 center shadow p-3 mt-5 bg-body rounded" style="margin:20px">
    <form  method="POST" action="login.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Address Email</label>
    <input type="email" name="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" class="form-control" id="exampleInputPassword1" required>
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
    </div>
</div>