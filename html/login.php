<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Userdata</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

    <?php require '../templates/header.php'; ?>

    <?php
        // define variables and set to empty values
        $firstnameErr = $lastnameErr = $emailErr = $genderErr = $passwordErr = "";
        $firstname = $lastname = $email = $gender = $comment = $website = $password = "";
        $err=false;

        if (!$_SERVER["REQUEST_METHOD"] == "POST"){
            //Man kommer till sidan första gången: Tomt formulär ska visas.
            require("../templates/userdata.php");
        }
        
        else{
             if (empty($_POST["email"])) {
                $emailErr = "E-postadress är obligatoriskt";
            } else {
                $email = test_input($_POST["email"]);
                $emailErr = "Fel E-postadress";
            }
       
            if (empty($_POST["password"])) {
                $passwordErr = "Du måste ange lösenord";
            } else {
                $password = test_input($_POST["password"]);
                $hashed = password_hash($password, PASSWORD_DEFAULT);

            }
        } 