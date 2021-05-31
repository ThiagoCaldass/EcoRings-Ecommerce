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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
    
    <link rel="icon" href="imagens/icone.png" type="image/x-icon" />
    <title>Home</title>
</head>
<body>
    <center>
     <div id="mae">
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
                <h1>Home</h1>
            </div>
        </div>
              <div id="menuInicial" class="menuInit">
                    <a href="index.php" class="ativo">Home</a>
                    <a href="produtos/index.php" class="inativo">Produtos</a>
                    <a href="criadores.php"  class="inativo">Criadores</a>
                    <a href="contato.php"  class="inativo">Contato</a>
                    <a href="minhaconta/index.php"  class="inativo">Minha conta&nbsp;<img src="icones/login.png" alt="Login" id="loginImg"></a>
                    <a href="carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="icones/carrinho.png" alt="Carrinho" id="carrinhoImg"><?php if(isset($_SESSION['carrinho'])){ echo ' ('.count($_SESSION['carrinho']).')'; } ?></a>  
              </div>


    <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- "bolinhas" -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
        
            <!-- SLIDES -->
        
            <div class="carousel-inner">
                <div class="item active">
                    <a href="produtos/"><img src="imagens/slide3.jpg"></a>
                    <div class="carousel-caption">
                        <h3>Anel</h3>
                        <p>Verde</p>
                    </div>
                </div>
        
                <div class="item">
                    <a href="produtos/"><img src="imagens/slide4.jpg"></a>
                    <div class="carousel-caption">
                        <h3>Anel</h3>
                        <p>Verde e roxo</p>
                    </div>
                </div>
            
                <div class="item">
                    <a href="produtos/"><img src="imagens/slide1.jpg"></a>
                    <div class="carousel-caption">
                        <h3>Anel</h3>
                        <p>Vermelho e marrom</p>
                    </div>
                </div>

                <div class="item">
                    <a href="produtos/"><img src="imagens/slideCombo.jpg"></a>
                    <div class="carousel-caption">
                        <h3>Anéis</h3>
                        <p>Variadas cores</p>
                    </div>
                </div>
            </div>
        
            <!-- controles -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Próximo</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Anterior</span>
            </a>
    </div>
    <br>
    <div id="videoCont">
        <div id="textoVideo">
            <center> <h4>Vídeo</h4> </center><br>
            <p>Anel customizado de cores variadas feito a partir de madeira de skate reciclado. Todos os tamanhos disponíveis. Feito sob medida. 
            Os anéis de skate são construídos manualmente a partir de madeira colorida de skate. Assim, são descritas as vantagens de comprá-lo.</p>
        </div>
        <div id="filme_yt">
            <iframe width="448" height="252" src="https://www.youtube.com/embed/xsYnUl8FJto" frameborder="0" allow="autoplay; encrypted-media"></iframe>
        </div>
    </div>
    <br>
    <!---->
    <div id="produtosHome">
        <center>Produtos mais vendidos</center>
        <br>
        <?php
            $sqlString = 'SELECT * FROM public.produtos ORDER BY vendidos DESC LIMIT 3';
            $res = pg_query($conecta, $sqlString);
            $retorno = pg_fetch_assoc($res);
            do
            {
                if($retorno['estoque'] > 0)
                {
                    $disp = 'DISPONÍVEL';
                    echo '<div class="cont_produtoHome"><a href="produto/index.php?id='.$retorno['id'].'"><img src="'.$retorno['imagem'].'" alt="Produto">'.$retorno['nome'].'<br>R$'.$retorno['preco']."<br>$disp</a></div>".PHP_EOL;
                }
                else
                {
                    $disp = 'INDISPONÍVEL';
                    echo '<div class="cont_produtoHome"><img src="'.$retorno['imagem'].'" alt="Produto">'.$retorno['nome'].'<br>R$'.$retorno['preco']."<br>$disp</div>".PHP_EOL;
                }
            }
            while($retorno = pg_fetch_assoc($res));
            echo '<span class="stretch"></span>'.PHP_EOL;
        ?>
    </div>
    <br><br>
    
     <div class="rodape" id="menuRodape" class="menuRodape">
        <a href="#" class="ativoRodape">Home</a>
        <a href="produtos/" class="inativoRodape">Produtos</a>
        <a href="criadores.php"  class="inativoRodape">Criadores</a>
        <a href="contato.php" class="inativoRodape">Contato</a>
        <a href="minhaconta/"  class="inativoRodape">Minha conta&nbsp;<img src="icones/login.png" alt="Login" id="loginImg"></a>
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