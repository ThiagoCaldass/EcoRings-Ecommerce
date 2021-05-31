<!DOCTYPE html>
<?php
    include "../connect.php";
    include "../email/email.php";

    session_start();
    if(isset($_POST['subLimpa']))
    {
        $_SESSION['carrinho'] = NULL;
    }
    if(isset($_POST['subExclui']))
    {
        $id = $_POST['id'];
        $tam = $_POST['tamEx'];
        $novo = array();
        $cont = 0;
        foreach($_SESSION['carrinho'] as $produto)
        {
            if($produto[0] != $id && $produto[2] != $tam)
            {
                $novo[$cont] = $produto;
            }
            $cont++;
        }
        $_SESSION['carrinho'] = NULL;
        $_SESSION['carrinho'] = array();

        $contNovo = 0;
        foreach($novo as $produto)
        {
            $_SESSION['carrinho'][$contNovo] = $produto;
            $contNovo++;
        }
    }
    if(isset($_POST['subCompra']))
    {
        if(isset($_SESSION['user']))
        {
            $sqlId = "SELECT * FROM public.usuario WHERE login = '".$_SESSION['user']."'";
            $queryId = pg_query($conecta, $sqlId);
            $fetchId = pg_fetch_array($queryId);
            $id = $fetchId['id_usuario'];

            $texto = '';
            $cont = 0;
            foreach($_SESSION['carrinho'] as $produto)
            {
                $idProd = $produto[0];
                $sqlString = 'SELECT * FROM public.produtos WHERE id = '.$idProd;
                $resul = pg_query($conecta, $sqlString);
                $retorno = pg_fetch_array($resul);
                if($cont != 0)
                {
                    $texto = $texto.', ';
                }
                $texto = $texto.'<i>'.$retorno['nome'].'</i>';
                $cont++;
                /////////////
                $esNovo = $retorno['estoque'] - $produto[1];
                $venNovo = $retorno['vendidos'] + $produto[1];
                $sqlString = "UPDATE public.produtos SET estoque = $esNovo, vendidos = $venNovo WHERE id = $idProd";
                $resul = pg_query($conecta, $sqlString);
                
                $tam = $produto[2];
                if($tam == 16)
                {
                    $tam = 'p';
                } elseif($tam == 18)
                {
                    $tam = 'm';
                } elseif($tam == 20)
                {
                    $tam = 'g';
                }

                $sqlTam = 'SELECT * FROM public.produtos_tamanhos WHERE id = '.$idProd;
                $resulTam = pg_query($conecta, $sqlTam);
                $retorno = pg_fetch_array($resulTam);
                $tamEs = $retorno[$tam] - $produto[1];
                $sqlString = "UPDATE public.produtos_tamanhos SET $tam = $tamEs WHERE id = $idProd";
                $resul = pg_query($conecta, $sqlString);
                /////////
            }
            $sql = "SELECT * FROM public.usuario WHERE login = '".$_SESSION['user']."'";
            $res = pg_query($conecta, $sql);
            $ret = pg_fetch_array($res);
            sendEmail($ret['email'], $ret['login'], "Obrigado por comprar com EcoRings!", "Muito obrigado por comprar $texto conosco!");
            /////////////////
            foreach($_SESSION['carrinho'] as $produto)
            {
                $idProd = $produto[0];
                $sqlString = "SELECT * FROM public.produtos WHERE id = $idProd";
                $resul = pg_query($conecta, $sqlString);
                $retorno = pg_fetch_array($resul);
                $qntCompra = $produto[1];
                $sqlIn = "INSERT INTO public.compras (id_usuario, id_produto, data, qnt, valor_unit) VALUES ($id, $idProd, '".date('Y-m-d')."', $qntCompra, ".$retorno['preco'].")";
                $res = pg_query($conecta, $sqlIn);
            }
            $ultimo = 0;
            $sqlUl = 'SELECT * FROM public.compras ORDER BY id ASC';
            $queryUl = pg_query($conecta, $sqlUl);
            $assoc = pg_fetch_assoc($queryUl);
            do
            {
                $ultimo = $assoc['id'];
            } while($assoc = pg_fetch_assoc($queryUl));
            $pedido = '';
            foreach($_SESSION['carrinho'] as $produto)
            {
                $sqlString = 'SELECT * FROM public.produtos WHERE id = '.$produto[0];
                $resul = pg_query($conecta, $sqlString);
                $retorno = pg_fetch_array($resul);
                if($cont != 0)
                {
                    $pedido .= '<br>';
                }
                $pedido .= '<i>'.$produto[1].'x '.$retorno['nome'].'</i>';
            }
            sendEmail('ecoringscti@gmail.com', 'COMPRA', "PEDIDO n. $ultimo", "$pedido");
            $_SESSION['carrinho'] = NULL;
            $_SESSION['compra'] = $ultimo;
            header("Location: ../finalizacompra/");
        }
        else
        {
            echo '<script>alert("Você deve estar cadastrado para realizar a compra!!!");</script>';
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../imagens/icone.png" type="image/png" />
    <link rel="shortcut icon"  href="../imagens/icone.png" type="image/png" />
    <title>Carrinho</title>
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
                <h1>Carrinho</h1>
            </div>
        </div>
                        <div id="menuInicial" class="menuInit">
                            <a href="../index.php" class="inativo">Home</a>
                            <a href="../produtos/index.php" class="inativo">Produtos</a>
                            <a href="../criadores.php"  class="inativo">Criadores</a>
                            <a href="../contato.php"  class="inativo">Contato</a>
                            <a href="../minhaconta/index.php"  class="inativo">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
                            <a href="../carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"><?php if(isset($_SESSION['carrinho'])){ echo ' ('.count($_SESSION['carrinho']).')'; } ?></a>
                        </div>
         
         <?php
                if(isset($_SESSION['carrinho']) && $_SESSION['carrinho'] != NULL)
                { 
                    ?>
                    <div id="CarrinhoExibeCheio">  
                            <?php
                           // echo '<div id="produtos">'.PHP_EOL;
                            foreach($_SESSION['carrinho'] as $produto)
                            {
                                echo '<div class="cont_produtoCarrinho">'.PHP_EOL;
                                $sqlString = 'SELECT * FROM public.produtos WHERE id = '.$produto[0];
                                $res = pg_query($conecta, $sqlString);
                                $retorno = pg_fetch_array($res);
                                echo 'Nome: '.$retorno['nome'].'<br><img src="'.$retorno['imagem'].'" alt="Produto"><br>Preço: '.$retorno['preco'].'<br>Tamanho: '.$produto[2].'<br>Quantidade: '.$produto[1];
                                echo '<br><form action="" method="post"><input type="hidden" value="'.$produto[0].'" name="id"><input type="hidden" value="'.$produto[2].'" name="tamEx"><input type="submit" value="Excluir produto" name="subExclui" id="botExcluirProd"></form><br>';
                                echo '</div>';
                            }
                             echo '<br><form action="" method="post"><input type="submit" value="Limpar carrinho" name="subLimpa" id="botLimpaAlt"><input type="submit" value="Concluir compra" name="subCompra" id="botLimpaAlt"></form><br>';
                            echo '<span class="stretch"></span>'.PHP_EOL;
                            echo '</div>'.PHP_EOL;
                            ?>
                            <div id="botContinuarCompra">
                                <br>
                                <a href="../produtos">Continuar comprando<i id="exibeCarrinho" class="fas fa-cart-plus"></i></a>
                            </div>
                            <?php
                        }
                        else{
                            ?>
                     </div>
          <div id="CarrinhoExibeVazio"> 
                        <div id="imgcarrinhovazio">
                            <img src="../icones/carrinhovazio.png" id="logoImg" >
                        </div>

                        <div id="carrinhovazio1">
                            <h3><b>Seu carrinho de compras ainda está vazio!</b></h3> 
                        </div>

                        <div id="carrinhovazio2">
                            Seus produtos selecionados aparecerão aqui. Para adicionar produtos ao seu carrinho, navegue pela loja, utilize a busca do site ou clique no botão abaixo.
                        </div>
                        <br>
                    <div id="botContinuarCompra">
                        <br>
                        <a href="../produtos">Continuar comprando<i id="exibeCarrinho" class="fas fa-cart-plus"></i></a>
                    </div>
             <br>
                        <?php
                    }
                ?>
           </div>
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
  </center>
</body>
</html>