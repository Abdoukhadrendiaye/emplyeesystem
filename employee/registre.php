<?php
session_start();
include_once "header.php";

    

if(isset($_POST['nom'])&& isset($_POST['prenom'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['role'])
&& !empty(trim($_POST['nom']))
&& !empty(trim($_POST['prenom']))
&& !empty(trim($_POST['email']))
&& !empty(trim($_POST['password']))
&& !empty(trim($_POST['role']))
){
   
$nom=htmlspecialchars(trim($_POST['nom']));
$prenom=htmlspecialchars(trim($_POST['prenom']));
$email=htmlspecialchars(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
$password=htmlspecialchars(trim($_POST['password']));
$telephone=htmlspecialchars(trim($_POST['role']));

if($email===false){
    $_SESSION['error']="email invalide";
    header('location:registre.php');
}
include_once "conn.php";
$password_hasher=password_hash($password,PASSWORD_BCRYPT);

try {
     //var_dump($_POST);
    $sql=$db->prepare("INSERT INTO employees(nom, prenom, email, password, role) VALUES( ?, ?, ?, ?, ?)");
    $sql->execute([$nom, $prenom, $email, $password_hasher, $role]);

$_SESSION['user_name']=$nom;
$_SESSION['user_id']=$db->lastInsertId();
$_SESSION['prenom']=$prenom;
$_SESSION['logged_in']=true;



    $_SESSION['message']="employer creer avec succes";
    header('location:');
} catch (PDOException $e) {
   die("erreur".$e->getMessage());
}
} 
else{
    $_SESSION['error']="veiller remplir tous les champs";
    
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    <div class="row">
        <div class="col-md-6 border bg-info rounded" style="width:50%; margin: 7%; ">
          <h1 class="text-center text-light">Inscrivez-vous ici</h1>
        <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
 if(!empty($_SESSION['error'] )){
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']);//permet de supprimer le message deja afficher//
}
}
        ?>
        <form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nom</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="prenom">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputPassword1" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Role</label>
  <select name="role">
        <option value="employe">Employé</option>
        <option value="admin">Administrateur</option>
    </select>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>
        <div class="col-md-6"></div>
    </div>
</body>
</html>