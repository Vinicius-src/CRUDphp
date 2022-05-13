<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="lab21.css">
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80">
    <link rel="stylesheet" href="style1.css">
    <title>Pincipal</title>
</head>
<?php
session_start();?>
<style>
     body{
        padding: 0;
        margin: 0;
      

     }
     table{
         margin-top:110px;
         margin:auto;
         width: 90vw;
         height:auto;
         text-align: center;
     }
</style>
<body>
<div class="cabecalho"><a href="index.php"><img src="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80" alt=""></a></div>
    <div class="espaco"></div>
    <?php
    if (isset($_SESSION['login'])) {
       
        if(isset($_GET['logout'])){
            unset($_SESSION['login']);
            header('location:index.php');
        
        }else { echo '<p id="boanoitelogin">Seja bem vindo '. $_SESSION['login'].'</p>';
        
        echo'<div class="botaoLogout">';
        echo' <a href="index.php?logout=true"><strong>Logout</strong></a>';
        echo'</div>';

        echo '<div class="botaoCriar">';
        echo '<a href="create.php"><img src="https://cdn-icons-png.flaticon.com/512/1004/1004733.png" alt="criar"></a>';
        echo '</div>';
    }
    }
    else{
        echo '<div class="botaoLogin">';
        echo "<a href='login.php'><strong>Login</strong></a>";
        echo '</div>';
        }
    
?>

<table border= 1>
    
        <tr>
        <th>Titulo</th>
        <th>Data</th>
    </tr>
<?php

$conn = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=****");
if( !$conn ) {
	die( "Erro de conexão com o banco de dados");
}

$result=pg_query($conn, "SELECT * FROM publicacao");

while ($row = pg_fetch_assoc($result)) {
      $date = new DateTime( $row['data']  );
     
        echo "<tr>";
        echo "<td> <a href='read.php?id=".$row['id']."'> ".htmlspecialchars($row['titulo'])."</a></td>";
        echo "<td>" .$date->format('d/m/Y')."</td>";
        echo "</tr>";
        
}


pg_close($conn);


?>
</table>


</body>
</html>