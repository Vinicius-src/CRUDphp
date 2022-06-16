<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80">
    <link rel="stylesheet" href="./css/index.css">
    <title>Pincipal</title>
</head>
<?php
session_start();?>
<style>
     body{
        padding: 0;
        margin: 0;
      

     }

</style>
<body>
<div class="cabecalho"><a href="index.php"><img src="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80" alt=""></a></div>
    <div class="espaco">
     <form action="index.php" method="post" class="campoPesquisar" >
            <label for="pesquisarIndex"><strong>Pesquisar</strong></label><br>
            <input type="search" name="pesquisarIndex" id="pesquisarIndex" >
        <input  type="submit" name="pesquisar" value="Pesquisar">
     </form>


    </div>
    <?php
    
    if (isset($_SESSION['login']) ) {
       
        if(isset($_GET['logout'])){
            unset($_SESSION['login']);
            header('location:index.php');
        
        }else { 
            if (isset($_SESSION['login'])) {
        echo '<p id="boanoitelogin">Seja bem vindo '. $_SESSION['login'].'</p>';
        echo'<div class="botaoLogout">';
        echo' <a href="index.php?logout=true"><strong>Logout</strong></a>';
        echo'</div>';

        echo '<div class="botaoCriar">';
        echo '<a href="create.php"><img src="https://cdn-icons-png.flaticon.com/512/1004/1004733.png" alt="criar"></a>';
        echo '</div>';
            }
            }
 
} else{
        echo '<div class="botaoLogin">';
        echo "<a href='login.php'><strong>Login</strong></a>";
        echo '</div>';
        }
    
?>

<table border=2 >
    
        <tr>
        <th>Titulo</th>
        <th>Data</th>
    </tr>
<?php

$conexao = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=3T3K3Q");

if( !$conexao ) {
	die( "Erro de conexão com o banco de dados");
}
    
    if(isset($_POST['pesquisar'])){
        $PESQUISAR=$_POST['pesquisarIndex'];
      
         $sqlBuscar=pg_query($conexao,"SELECT * FROM publicacao WHERE titulo LIKE '%$PESQUISAR%'");
        $pegarPesquisa= pg_fetch_assoc($sqlBuscar);
        if($pegarPesquisa){
                   do{
                        $date = new DateTime( $pegarPesquisa['data']  );
                        echo "<tr>";
                        echo "<td> <a href='read.php?id=".$pegarPesquisa['id']."'> ".htmlspecialchars($pegarPesquisa['titulo'])."</a></td>";
                        echo "<td>" .$date->format('d/m/Y')."</td>";
                        echo "</tr>";
                    
                            
                   } while($pegarPesquisa= pg_fetch_assoc($sqlBuscar));

                   
                }else{
                    $result=pg_query($conexao, "SELECT * FROM publicacao");
                    while ($pegarTabela = pg_fetch_assoc($result)) {
                        $date = new DateTime( $pegarTabela['data']  );
                            echo "<tr>";
                            echo "<td> <a href='read.php?id=".$pegarTabela['id']."'> ".htmlspecialchars($pegarTabela['titulo'])."</a></td>";
                            echo "<td>" .$date->format('d/m/Y')."</td>";
                            echo "</tr>";
                        
    
                    }    
                
                }  
            
        }else{
            $result=pg_query($conexao, "SELECT * FROM publicacao");
        while ($pegarTabela = pg_fetch_assoc($result)) {
            $date = new DateTime( $pegarTabela['data']  );
                echo "<tr>";
                echo "<td> <a href='read.php?id=".$pegarTabela['id']."'> ".htmlspecialchars($pegarTabela['titulo'])."</a></td>";
                echo "<td>" .$date->format('d/m/Y')."</td>";
                echo "</tr>";
            


        
            }
    }
pg_close($conexao);
?>
</table>


</body>
</html>