<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./Trumbowyg-main/dist/plugins/colors/ui/trumbowyg.colors.min.css">
    <link rel="stylesheet" href="./Trumbowyg-main/dist/ui/trumbowyg.min.css">
    <title>Cadastro</title>

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
    
<?php

if (isset($_SESSION['login'])) {
   
    if(isset($_GET['logout'])){
        unset($_SESSION['login']);
        header('location:index.php');
    }else { echo '<p id="boanoitelogin">Seja bem vindo '. $_SESSION['login'].'</p>';
    
    echo'<div class="botaoLogout">';
    echo' <a href="index.php?logout=true"><strong>Logout</strong></a>';
    echo'</div>';
    }
}
else{
    header('location:login.php');
    }
?>
 
    <div class="cabecalho"><a href="index.php"><img src="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80" alt=""></a></div>
    <div class="espaco"></div>
        <form class="formCreate" action="create.php" method="post">
            
            <div class="campoFormCreate">
            <h2>Insira os dados</h2>
                <label for="criarTituloTexto"><strong>Titulo</strong></label><br><br>
                <input type="text" name="criarTituloTexto" id="criarTituloTexto" required>
            </div>
            <div class="campoFormCreate">
                <label for="criarData"><strong>Data</strong></label><br><br>
                <input type="date" name="criarData" id="criarData" required>
            </div>
            <div class="campoFormCreateText">
                <label for="criarText"><strong>Conteudo</strong></label><br><br>
                <textarea id="editor" name="criarText" required></textarea >
            </div>
        <input type="submit" id="enviarCreate" name="enviar">
    </form>
    <!-- Import jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    
    <!-- Import Trumbowyg -->
    <script src="./Trumbowyg-main/dist/trumbowyg.min.js"></script>
    <script src="./Trumbowyg-main/dist/plugins/colors/trumbowyg.colors.min.js"></script>
        <script>
            $('#editor').trumbowyg( );
        </script>
         <?php
        $conexao = pg_connect("host=localhost dbname=***** user=**** password=*****");

        if(isset($_POST['enviar'])){
        $textoCriarTitulo=pg_escape_literal( $_POST['criarTituloTexto'] );
        $textoCriar= pg_escape_literal( $_POST['criarText']) ;
        $dataCriar= $_POST['criarData'];
        $dateCriar = DateTime::createFromFormat('d/m/Y', $dataCriar);
        $dataCriar=  pg_escape_literal($dataCriar);

        $sqlInsert="INSERT INTO publicacao (titulo,conteudo,data,privado) VALUES ($textoCriarTitulo,$textoCriar,$dataCriar,false)";
      
        if (pg_query($conexao, $sqlInsert)) {
            
            header('location:index.php');
          } else {
            header('location:index.php');
          }
  
        }
    ?>
    </body>
    </html>