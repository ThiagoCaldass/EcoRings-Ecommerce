<!DOCTYPE html>
<?php
    include "connect.php";
    session_start();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bodyCriadores.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="icon" href="imagens/icone.png" type="image/x-icon" />
    <title>Contato</title>
</head>
<body>
    <center>
         <div id="cria">
            <a name="top"></a>
            <div id="cima">
        <div id="alLogo">
            <a href="index.php"><img src="imagens/icone.png" id="logoImg" ></a>
        </div>
        <div id="areabusca">
            <div id="divBuscaI">
                <form action="produtos/" method="get">
                    <input type="text" id="txtBuscaI" placeholder="Buscar..." name="pesquisa" />
                    <label for="subPesq"><i class="fas fa-search" id="lupaPesquisa"></i></label>
                    <input type="submit" value="" id="subPesq" style="display: none;">
                </form>
            </div>
         </div> 
                    
                    <div id="bemvindo">
                        <?php
                        if(isset($_POST['sair']))
                        {
                            session_destroy();
                             header('Location: index.php');
                        }
                        if(!isset($_SESSION['user']))
                        {}
                        else
                        {   
                            $user = $_SESSION['user'];
                            ?>
                            <div id="quadOla">
                            <?php
                            echo "Olá, $user";  
                            ?>
                            <form action="" method="post">
                                <input type="submit" name="sair" value="Sair" id="botsairUser" />
                            </form>
                            </div>
                            <?php

                        }
                        ?>   
                    </div>
         
            <div id="titulo">
                <h1>Contato</h1>
            </div>
        </div>
                      <div id="menuInicial" class="menuInit">
                            <a href="index.php" class="inativo">Home</a>
                            <a href="produtos/index.php" class="inativo">Produtos</a>
                            <a href="criadores.php"  class="inativo">Criadores</a>
                            <a href="contato.php"  class="ativo">Contato</a>
                            <a href="minhaconta/index.php"  class="inativo">Minha conta&nbsp;<img src="icones/login.png" alt="Login" id="loginImg"></a>
                            <a href="carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="icones/carrinho.png" alt="Carrinho" id="carrinhoImg"><?php if(isset($_SESSION['carrinho'])){ echo ' ('.count($_SESSION['carrinho']).')'; } ?></a>                        
                    </div>

            <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.3442451901624!2d-49.02730268542257!3d-22.340626985302606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94bf67ba4accea4f%3A0xc015eb23d210db44!2sCTI+-+Col%C3%A9gio+T%C3%A9cnico+Industrial+%22Prof.+Isaac+Portal+Rold%C3%A1n%22!5e0!3m2!1spt-BR!2sbr!4v1533222328880" frameborder="0" style="border:0" allowfullscreen></iframe>
            <br><br>
            
            <div class="contatos">
               <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
                
                <a id="face" href="https://www.facebook.com/EcoRings-1008075839379067/" style="color: #333333ff"><i class="fab fa-facebook"></i></a>
                Eco Rings
                &nbsp; &nbsp; &nbsp;
                <a id="insta" href="https://www.instagram.com/ecorings/?hl=pt-br" style="color: #333333ff"><i class="fab fa-instagram"></i></a>
                  @EcoRings
                &nbsp; &nbsp; &nbsp;
                <a id="tt" href="https://twitter.com/EcoRingsCTI" style="color: #333333ff"><i class="fab fa-twitter"></i></a>
                @EcoRingsCTI
                &nbsp; &nbsp; &nbsp;
                <a id="gmail" href="https://accounts.google.com/ServiceLogin/signinchooser?hl=pt-BR&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin" style="color: #333333ff"><i class="far fa-envelope"></i></a>
                ecoringscti@gmail.com
                <br><br>

            </div>
<!--            Telefone: <a href="tel:+55-14-98104-2231">(14) 98104-2231</a>-->
             
             <div class="rodape" id="menuRodape" class="menuRodape">
                <a href="index.php" class="inativoRodape">Home</a>
                <a href="produtos/index.php" class="inativoRodape">Produtos</a>
                <a href="criadores.php"  class="inativoRodape">Criadores</a>
                <a href="contato.php" class="ativoRodape">Contato</a>
                <a href="minhaconta/index.php"  class="inativoRodape">Minha conta&nbsp;<img src="icones/login.png" alt="Login" id="loginImg"></a>
                <a href="carrinho/index.php" class="inativoRodape">Carrinho&nbsp;<img src="icones/carrinho.png" alt="Carrinho" id="carrinhoImg"></a>
                 <br><br>
                Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
                <br><br>
                <a href="#top" class="inativoRodape">Voltar ao topo</a></div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="app.js"></script>
        </div>
    </center>
</body>
</html>