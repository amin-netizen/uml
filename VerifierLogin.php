<?php
include ('Employe.php');
include ('EmployeDAO.php');
include ('EmployeService.php');



if(!empty($_POST['email']) and !empty($_POST['password'])){

    $empSev =  new EmployeService();
    $Emp = $empSev->login($_POST['email']);
    $passwdFromInput = sha1($_POST['password']);
    $passwdFromDb = $Emp->getPasswd();

    if($_POST['email'] == $Emp->getEmail() and $passwdFromInput == $passwdFromDb ){

        session_start();
        $_SESSION['cin']=$Emp->getCIN();
        $_SESSION['nom']=$Emp->getNom();
        $_SESSION['prenom']=$Emp->getPrenom();
        $_SESSION['img']=$Emp->getPhoto();
        $_SESSION['email']=$Emp->getEmail();

        header("location:GestionEmploye.php");
    }else{
        header("location:login.php?error=incorrect");
    }
}

?>

