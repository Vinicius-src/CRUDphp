<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="icon" href="https://cdn.discordapp.com/avatars/819930985788866660/34e3e8e297d49daeb9333ff4e814d1c3.webp?size=80">
    <style>
        *{
            margin: 0;
            border: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body{
                min-height: 100vh;
                min-width: 100vw;
                
                align-items: center;
                justify-content: center;

            }
        main.container{
            background: white;
            max-width: 350px;
            min-height: 40vh;
            padding: 2rem;
            box-shadow: 5px 5px 13px rgba(0, 0, 0,0.2);
            border-radius: 8px;
            border: solid black 1px;
            position: absolute;
                top: 150px;
                left: 40%;
            z-index: 0;
            
        }
        main h2{
            font-weight: 600;
            margin-bottom: 2rem;
            padding-bottom: 2px;
            position: relative;
        }
        main h2::before{
            content: '';
            position: absolute;
            height: 4px;
            width: 25px;
            bottom: 3px;
            left: 0;
            border-radius: 8px;
            background: linear-gradient(45deg, #00a000,#4a00e0);
        }
        form{
            display: flex;
            flex-direction: column;
        }
        
        .inputs{
        position: relative;

        }
        form .inputs:first-child{
            margin-bottom: 1.5rem;
        }
        .inputs .linha::before{
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            bottom: -5px;
            left: 0;
            background: black;
        }
        .inputs .linha::after{
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            bottom: -5px;
            left: 0;
            background: linear-gradient(45deg, #00a000,#4a00e0);
            transform: scaleX(0);
        }
        .inputs input:focus ~ .linha::after{
            transform: scaleX(1);
        }
        .inputs input{
            outline: none;
            font-size: 0.9rem;
            color: black;
        }
        .inputs input::placeholder{
            color: rgba(0, 0, 0,0.2);

        }
        form input[type="submit"]{
            margin-top: 2rem;
            padding: 0.4rem;
            background: linear-gradient( to left,#4a00e0,#00a000);
            color: white;
            font-size: 0.9rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        form input[type="submit"]:hover{
            letter-spacing: 9.5px;
            background:  linear-gradient(to right,#4a00e0, #63d452);
        }
        .mensagemerro{
            display: flex;
            position: absolute;
                top: 400px;
                left: 41%;
            text-align: center;
            font-size: 12px;
            color: red;
            z-index: 1;
        }
        @media(max-width: 800px) {

            main.container{
            position: absolute;
                top: 150px;
                left: 20%;
            z-index: 0;
            
        }
        }


    </style>
</head>
<body>
    <?php
session_start();   
    
    if(!isset($_SESSION['login'])){

        $conexao = pg_connect("host=localhost dbname=viniciuschaga user=aluno password=****");
        if( !$conexao ) {
            die( "Erro de conexÃ£o com o banco de dados");
        }
        
        
        if(isset($_POST['continuar'])){
            

            $usernameLogin=$_POST['username'];
            $passwordLogin=$_POST['password'];

            $passwordLogin=md5( $passwordLogin);
            
            $usernameLogin=pg_escape_literal($conexao, $usernameLogin );

            $passwordLogin=pg_escape_literal($conexao, $passwordLogin );

            
           
        
        
            $sql=pg_query($conexao, "SELECT * FROM usuario where login=$usernameLogin and senha= $passwordLogin");
            $row=pg_fetch_assoc($sql);
    
            pg_close($conexao);
        
            if(isset($row['login'])){ 
                 
                $_SESSION['login']=$row['login'];
                
                 header('location:index.php');
                 
            }else{
               
                echo'<div class="mensagemerro" ><p>Usuario e senha errado tente novamente!</p></div>';
            }
        }
    }else if(isset($_SESSION['login'])){
        header('location:index.php');
    
    }

    ?>
    
        <main class="container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="inputs"> 
                    <input  type="text" name="username" id="username"
                    placeholder="Enter your Username">
                        <div class="linha"></div>
                </div>
                <div class="inputs"> 
                    <input  type="password" name="password" id="password"
                    placeholder="Enter yout Passeword">
                        <div class="linha"></div>
                </div>
                    <input  type="submit" name="continuar" value="continuar">
            </form>
            
        </main>
</body>
</html>