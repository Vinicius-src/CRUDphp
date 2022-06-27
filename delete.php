<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Trumbowyg-main/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="./Trumbowyg-main/dist/plugins/colors/ui/trumbowyg.colors.min.css">
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80"> 
    <title>Delete</title>

</head>
<?php
session_start();?>  
<?php

if (isset($_SESSION['login'])) {
   
    if(isset($_GET['logout'])){
        unset($_SESSION['login']);
        header('location:index.php');
    }else { 
        $conexao = pg_connect("host=localhost dbname=**** user=**** password=****");

        $ID=$_GET['id'];
     
        $sql =pg_query($conexao,"DELETE from publicacao WHERE id= $ID");
        
        pg_close($conexao);
        header('location:index.php');
    }
}
else{
    header('location:login.php');
    }
    ?>
    </body>
    </html>