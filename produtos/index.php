<!DOCTYPE html>
<?php
    include "../connect.php";
    session_start();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../imagens/icone.png" type="image/png" />
    <link rel="shortcut icon"  href="../imagens/icone.png" type="image/png" />
    <title>Produtos</title>
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
                <form action="" method="get">
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
                <h1>Produtos</h1>
            </div>
        </div>
              <div id="menuInicial" class="menuInit">
                    <a href="../index.php" class="inativo">Home</a>
                    <a href="../produtos/index.php" class="ativo">Produtos</a>
                    <a href="../criadores.php"  class="inativo">Criadores</a>
                    <a href="../contato.php"  class="inativo">Contato</a>
                    <a href="../minhaconta/index.php"  class="inativo">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
                    <a href="../carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"><?php if(isset($_SESSION['carrinho'])){ echo ' ('.count($_SESSION['carrinho']).')'; } ?></a>
            </div>         
         
    <div id="menuProduto">
        <?php
            $ordem = $_GET['opcao'];
            if(isset($ordem))
            {
                switch($ordem)
                {
                    case 'alfabetico':
                        echo '<select name="opcao" id="selectMenuProduto"><option value="alfabetico" selected="selected">Ordem alfabética</option><option value="menorpreco">Preço crescente</option><option value="maiorpreco">Preço decrescente</option></select>';
                        break;
                    case 'maiorpreco':
                        echo '<select name="opcao" id="selectMenuProduto"><option value="alfabetico">Ordem alfabética</option><option value="menorpreco">Preço crescente</option><option value="maiorpreco" selected="selected">Preço decrescente</option></select>';
                        break;
                    case 'menorpreco':
                        echo '<select name="opcao" id="selectMenuProduto"><option value="alfabetico">Ordem alfabética</option><option value="menorpreco" selected="selected">Preço crescente</option><option value="maiorpreco">Preço decrescente</option></select>';
                        break;
                    default:
                        echo '<select name="opcao" id="selectMenuProduto"><option value="alfabetico" selected="selected">Ordem alfabética</option><option value="menorpreco">Preço crescente</option><option value="maiorpreco">Preço decrescente</option></select>';
                }
            }
            else{
                echo '<select name="opcao" id="selectMenuProduto"><option value="alfabetico" selected="selected">Ordem alfabética</option><option value="menorpreco">Preço crescente</option><option value="maiorpreco">Preço decrescente</option></select>';
            }
        ?>
    </div>
         
     <div id="produtosPagina">
        <?php
            if(isset($_GET['pesquisa']))
            {
                $termo = $_GET['pesquisa'];
                $sqlString = "SELECT * FROM public.produtos WHERE nome ILIKE '%$termo%' ORDER BY nome";
                $res = pg_query($conecta, $sqlString);
                $retorno = pg_fetch_assoc($res);
                do
                {
                    if($retorno['nome'] == NULL)
                    {
                        echo 'Nenhum produto encontrado na pesquisa!';
                    }
                    else
                    {
                        $nome = $retorno['nome'];
                        if($retorno['estoque'] > 0)
                        {
                            $disp = 'DISPONÍVEL';
                            echo '<div class="cont_produto"><a href="../produto/index.php?id='.$retorno['id'].'"><img src="'.$retorno['imagem'].'" alt="Produto">'.$nome.'<br>R$'.$retorno['preco'].'<br>'.$disp.'</a></div>'.PHP_EOL;
                        }
                        else
                        {
                            $disp = 'INDISPONÍVEL';
                            echo '<div class="cont_produto"><img src="'.$retorno['imagem'].'" alt="Produto">'.$nome.'<br>R$'.$retorno['preco'].'<br>'.$disp.'</div>'.PHP_EOL;
                        }
                    }
                }
                while($retorno = pg_fetch_assoc($res));
                echo '<span class="stretch"></span>'.PHP_EOL;
            }
            else
            {
                if(isset($ordem))
                {
                    switch($ordem)
                    {
                        case 'alfabetico':
                            $sqlString = 'SELECT * FROM public.produtos ORDER BY nome';
                            break;
                        case 'maiorpreco':
                            $sqlString = 'SELECT * FROM public.produtos ORDER BY preco DESC';
                            break;
                        case 'menorpreco':
                            $sqlString = 'SELECT * FROM public.produtos ORDER BY preco ASC';
                            break;
                        default:
                            $sqlString = 'SELECT * FROM public.produtos ORDER BY nome';
                    }
                }
                else{
                    $sqlString = 'SELECT * FROM public.produtos ORDER BY nome';
                }
                $res = pg_query($conecta, $sqlString);
                $retorno = pg_fetch_assoc($res);
                do
                {
                    $nome = $retorno['nome'];
                    if($retorno['estoque'] > 0)
                    {
                        $disp = 'DISPONÍVEL';
                        echo '<div class="cont_produto"><a href="../produto/index.php?id='.$retorno['id'].'"><img src="'.$retorno['imagem'].'" alt="Produto">'.$nome.'<br>R$'.$retorno['preco'].'<br>'.$disp.'</a></div>'.PHP_EOL;
                    }
                    else
                    {
                        $disp = 'INDISPONÍVEL';
                        echo '<div class="cont_produto"><img src="'.$retorno['imagem'].'" alt="Produto">'.$nome.'<br>R$'.$retorno['preco'].'<br>'.$disp.'</div>'.PHP_EOL;
                    }
                }
                while($retorno = pg_fetch_assoc($res));
                echo '<span class="stretch"></span>'.PHP_EOL;
            }
        ?>
    </div>
          <br>
        <div class="rodape" id="menuRodape" class="menuRodape">
            <a href="../index.php" class="inativoRodape">Home</a>
            <a href="../produtos/index.php" class="ativoRodape">Produtos</a>
            <a href="../criadores.php"  class="inativoRodape">Criadores</a>
            <a href="../contato.php" class="inativoRodape">Contato</a>
            <a href="../minhaconta/index.php"  class="inativoRodape">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
            <a href="../carrinho/index.php" class="inativoRodape">Carrinho&nbsp;<img src="../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"></a>
             <br><br>
            Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
            <br><br>
            <a href="#top" class="inativoRodape">Voltar ao topo</a>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="../app.js"></script>
         </div>
    </div>
  </center>
</body>
</html>