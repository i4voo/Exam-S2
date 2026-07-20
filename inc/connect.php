<?php
    function db_connect(){
        static $connect;
        $connect=mysqli_connect('localhost','root','','VENTE_PRODUIT');
        if(!$connect){
            die("Erreur de connexion : ".mysqli_connect_error());
        }
        mysqli_set_charset($connect,'utf8mb4');
        return $connect;
    }

    