<?php
<<<<<<< HEAD
    function db_connect(){
        static $connect;
        $connect=mysqli_connect('localhost','root','','VENTE_PRODUIT');
        if(!$connect){
            die("Erreur de connexion : ".mysqli_connect_error());
        }
        mysqli_set_charset($connect,'utf8mb4');
        return $connect;
    }


    function login($ETU){
        $req="select * from membre where numero_etu='$ETU';";
        $resultat=mysqli_query($bdd,$req);
        $login=mysqli_num_rows($resultat);
        return $login;
    }

    function check_etu($ETU){
        $req="select*from membre where numero_etu='$ETU'";
        $resultat=mysqli_query($bdd,$req);
        $nb=mysqli_num_rows($resultat);
        if($nb==0){
            return 1;
        }
        return 0;
    }


    function inscription($ETU,$nom){
        $req="insert into membre set numero_etu='$ETU', nom='$nom'";
        mysqli_query($bdd,$req);
    }
=======
include_once('connect.php');
>>>>>>> origin/Iavo-V1
