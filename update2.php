<html>
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
        $id=$_GET['id'];
        }
    }
    else{
        header('location:login.php');
        }
       
        $conexao = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=3T3K3Q");

        if( !$conexao ) {
        die( "Erro de conexÃ£o com o banco de dados");
        }
    $IDp=$_POST['IDp'];
        if(isset($_POST['enviarUpdate'])){
            $conexao = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=3T3K3Q");
          
            $textoCriarTitulo=pg_escape_literal( $_POST['criarTituloTexto'] );
            $textoCriar=pg_escape_literal($_POST['criarText']) ;
            $dataCriar=pg_escape_literal($_POST['criarData'] );
            $sqlUpdate="UPDATE publicacao SET titulo=$textoCriarTitulo, conteudo=$textoCriar, data=$dataCriar, privado=false  WHERE id=$IDp";

        if(pg_query($conexao,$sqlUpdate)){

            header('location:index.php');
        }
        
          pg_close($conexao);
        }
    ?>
    </body>
</html>