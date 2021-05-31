<!DOCTYPE html>
<?php
    include "../connect.php";
    session_start();

    $id = $_GET['id'];
    $sqlTam = 'SELECT * FROM public.produtos_tamanhos WHERE id = '.$id;
    $resulTam = pg_query($conecta, $sqlTam);
    $retornoTam = pg_fetch_array($resulTam);

    if(isset($_POST['botCompra']))
    {
        $quantidade = $_POST['qnt'];
        $tamanho = $_POST['tam'];
        if($tamanho == 16)
        {
            $tam = 'p';
        } elseif($tamanho == 18)
        {
            $tam = 'm';
        } elseif($tamanho == 20)
        {
            $tam = 'g';
        }
        if($retornoTam[$tam] < $quantidade)
        {
            echo "<script> alert('O produto que você procura não está disponível nesse tamanho!'); </script>";
        }
        else
        {
            $tam = count($_SESSION['carrinho']);
            if($_SESSION['carrinho'] == NULL)
            {
                $_SESSION['carrinho'] = array();
            }
            $conf = true;
            $cont = 0;
            foreach($_SESSION['carrinho'] as $produto)
            {
                if($produto[0] == $id && $produto[2] == $tamanho)
                {
                    $novoQnt = $produto[1] + $quantidade;
                    $_SESSION['carrinho'][$cont] = array($id, $novoQnt, $tamanho);
                    $conf = false;
                }
                $cont++;
            }
            if($conf)
            {
                $_SESSION['carrinho'][$tam] = array($id, $quantidade, $tamanho);
            }
            header('Location: ../carrinho');
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../imagens/icone.png" type="image/png" />
    <link rel="shortcut icon"  href="../imagens/icone.png" type="image/png" />
    <title>Produto</title>
</head>
<body>
   <center>
     <div id="cria">
         <a name="top"></a>
         <div id="cima">
        <div id="alLogo">
            <a href="../index.php"><img src="../imagens/icone.png" id="logoImg" ></a>
        </div>
        <div id="areabusca">
            <div id="divBuscaI">
                <form action="../produtos/" method="get">
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
                             header('Location: ../');
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
                <h1>Produto</h1>
            </div>
        </div>
                      <div id="menuInicial" class="menuInit">
                            <a href="../index.php" class="inativo">Home</a>
                            <a href="../produtos/index.php" class="ativo">Produtos</a>
                            <a href="../criadores.php"  class="inativo">Criadores</a>
                            <a href="../contato.php"  class="inativo">Contato</a>
                            <a href="../minhaconta/index.php"  class="inativo">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
                            <a href="../carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"></a>
                        </div>

            <div id="produtoExibe"><form action="" method="post">
                <?php
                    $codigo = $_GET['id'];
                    $sqlString = 'SELECT * FROM public.produtos WHERE id = '.$codigo;
                    $res = pg_query($conecta, $sqlString);
                    $retorno = pg_fetch_array($res);
                    echo '<img src="'.$retorno['imagem'].'" alt="Produto" class="imagemProduto">'.PHP_EOL;
                    echo '<div class="textoProduto">';
                    echo '<div class="tituloProduto">'.$retorno['nome'].'</div>'.PHP_EOL;
                    echo '<div class="precoProduto">R$'.$retorno['preco'].'</div>'.PHP_EOL;
                    echo '<br><div class="descricaoProduto">'.$retorno['descricao'].'</div>'.PHP_EOL;
                    if($retorno['estoque'] > 0)
                    {
                         ?>
                    <div id="selecione">
                      <br>
                       Selecione:
                    </div>
                    <?php
                        echo '<b>Selecione a quantidade: </b><br><input type="number" value="1" name="qnt" id="selectProd">';
                        ?>
                        <br><br>
                        <b>Selecione o tamanho: </b> <br> <select name="tam" id="tam">
                            <option value="16">16 <?php echo '('.$retornoTam['p'].' em estoque)' ?></option>
                            <option value="18">18 <?php echo '('.$retornoTam['m'].' em estoque)' ?></option>
                            <option value="20">20 <?php echo '('.$retornoTam['g'].' em estoque)' ?></option>
                        </select>
                        <?php
                        echo '<br><br><input type="submit" value="Comprar" id="botCompra" name="botCompra">';
                    }
                    else
                    {
                        echo '<br><br>PRODUTO INDISPONÍVEL';
                    }
                    echo '</div>'.PHP_EOL;

                ?>
            </form></div>
            <br>
        <div class="rodape" id="menuRodape" class="menuRodape">
            <a href="../index.php" class="inativoRodape">Home</a>
            <a href="../produtos/index.php" class="ativoRodape">Produtos</a>
            <a href="../criadores.php"  class="inativoRodape">Criadores</a>
            <a href="../contato.php" class="inativoRodape">Contato</a>
            <a href="../minhaconta/index.php"  class="inativoRodape">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
            <a href="../carrinho/index.php" class="inativoRodape">Carrinho&nbsp;<img src="../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"><?php if(isset($_SESSION['carrinho'])){ echo ' ('.count($_SESSION['carrinho']).')'; } ?></a>
             <br><br>
            Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
            <br><br>
            <a href="#top" class="inativoRodape">Voltar ao topo</a>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="app.js"></script>
         </div>
            <script src="../app.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        </div>
    </center>
</body>
</html>