<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80"> 
    <title>Pesquisar</title>

</head>
<?php
session_start();?>  
<?php

if (isset($_SESSION['login'])) {
   
    if(isset($_GET['logout'])){
        unset($_SESSION['login']);
        header('location:index.php');
    }else { 
        $conexao = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=3T3K3Q");
        function clear($input){
            global $connect;
           
             $var=pg_escape_literal($input);
    
             $var=htmlspecialchars ($var);
             return $var;}

        $ID=$_GET['id'];
        $PESQUISAR=Clear($_POST['pesquisarIndex']);

     if(isset($_POST['pesquisar'])){

         if($sqlBuscar=pg_query($conexao,"SELECT * FROM publicacao WHERE titulo LIKE '%$PESQUISAR%'")){
             $RPesquisar=true;
             echo '$sqlBuscar';
         }else{
             $RPesquisar=false;
         }
    }
        pg_close($conexao);
    }
}
else{
    header('location:login.php');
    }
    ?>
    <form action="index.php">
    <input type="hidden" name="retornoPesquisar" value="<?php echo $RPesquisar?>">
    </form>
    </body>
    </html>