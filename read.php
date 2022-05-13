<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80">
    <link rel="stylesheet" href="style1.css">
    
    <title>Conteudo</title>
</head>
<style>
    <?php session_start();?>
   body{
        padding: 0;
        margin: 0;
      

     }
     
     </style>
   
<body>
<div class="cabecalho"><a href="index.php"><img src="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80" alt=""></a></div>
<div id="setaVoltar"><a href="./"><img src="https://i.pinimg.com/originals/6e/9e/de/6e9edef87d33f61c4de0a9ed0e5f1d9b.png" alt="seta"></a></div>
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
    
    echo '<div class="botaoEditar">';
    echo '<a href="upadate.php"><img src="https://cdn-icons-png.flaticon.com/512/1160/1160515.png" alt="editar"></a>';
    echo '</div>';
    
    echo '<div class="botaoDeletar">';
    echo '<a href="#modalDeleta">';
    echo '<img src="https://media.discordapp.net/attachments/880872510923616317/974699021195173938/isondelete.jpg?width=473&height=473" alt="delete">';
    echo "</a>";
    echo '</div>';

    echo '<div class="modalDeleta" id="modalDeleta">';
    echo '<div class="conteudoModalDelete">';
    echo '<h2>Você realmente deseja EXCLUIR esse documento ?</h2><br>';
    echo "<a href='delete.php?id=".$_GET['id']."' class='simBotaoModal'>";
    echo "Sim</a>";
    echo "<a href='read.php?id=".$_GET['id']."' class='naoBotaoModal'>";
    echo "Não</a>";
    echo '</div>';
    echo '</div>';
    }
}
else{
    echo '<div class="botaoLogin">';
    echo "<a href='login.php'><strong>Login</strong></a>";

    echo '</div><br><br>';
    }
?>
    

<table border=1>
        <tr>
            <th>conteudo</th>
        </tr>
<?php
    $conn = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=*****");
    if( !$conn ) {
    die( "Erro de conexÃ£o com o banco de dados");
    }

    $result=pg_query($conn, "SELECT * FROM publicacao where id=".$_GET['id']);

while ($row = pg_fetch_assoc($result)) {

    $id=$_GET['id'];
        
        echo "<tr>";
        echo "<td>".$row['conteudo']."</td>";
        echo "</tr>";
}
?>

</table>
</body>
</html>