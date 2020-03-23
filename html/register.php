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
        $emailErr = $passwordErr = "";
         $email = $password = "";
        $err=false;

        if (!$_SERVER["REQUEST_METHOD"] == "POST"){
            //Man kommer till sidan första gången: Tomt formulär ska visas.
            require("../templates/userdata.php");
        }else {
            //Man har klickat på submit-knappen:
  
            if (empty($_POST["email"])) {
                $emailErr = "E-postadress är obligatoriskt";
            } else {
                $email = test_input($_POST["email"]);
                $emailErr = "Fel E-postadress";

            if (empty($_POST["password"])) {
                $passwordErr = "Du måste ange lösenord";
            } else {
                $password = test_input($_POST["password"]);
                $hashed = password_hash($password, PASSWORD_DEFAULT);

            }
            

            echo $password . "<br>";
            echo $firstname . "<br>";
            echo $lastname . "<br>";
            echo $email . "<br>";
            echo $website . "<br>";
            echo $comment . "<br>";
            echo $gender . "<br>";
            echo $hashed;

            if($err){
                //Man har fyllt i formuläret fel. Formulär ska visas, men med vissa värden förifyllda så att man inte behöver fylla i dem igen.
            require("../templates/userdata.php");
            } else {
                //Man har fyllt i formuläret rätt. 
                //Data ska sparas
                try {
                    require("../includes/settings.php");
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpw);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO users (firstname, lastname, password    , email)
                    VALUES ('$firstname', '$lastname', '$hashed ', '$email')";
                    // use exec() because no results are returned
                    $conn->exec($sql);
                    echo "New record created successfully";
                    }
                catch(PDOException $e)
                    {
                    echo $sql . "<br>" . $e->getMessage();
                    }
                
                $conn = null;
                //välkomstsidan ska visas.

                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>    
