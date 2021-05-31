<!DOCTYPE html>
<?php
    $usuarioAdm = 'ecoRings';
    $senhaAdm = 'ecoringsanual';

    include "../connect.php";
    session_start();

    if(isset($_POST['sair']))
    {
        session_destroy();
        header("Location: ../minhaconta/");
    }

    if(isset($_POST['sub']))
    {
        if($_POST['user'] == $usuarioAdm && $_POST['senha'] == $senhaAdm)
        {
            header('Location: ../adm');
            exit;
        }
        $user = htmlspecialchars($_POST['user']);
        $senhaPlain = htmlspecialchars($_POST['senha']);
        $senha = md5(htmlspecialchars($_POST['senha']));
        pg_close($conecta);
        include '../connect.php';
        $sql = "SELECT * FROM public.usuario WHERE login = '$user'";
        $res = pg_query($conecta, $sql);
        if ($res == NULL)
        {
            ?>
	<script>
		alert("Esse usuário não está cadastrado no servidor! Redigite por favor.");
		$('input[name=user]').val('');
        $('input[name=senha]').val('');
	</script>
	<?php
        }
        else
        {
            $vals = pg_fetch_object($res);
            if($vals->excluido != 'n')
            {
                ?>
                <script>
                    alert("Cadastro incorreto!");
                </script>
                <?php
            }
            elseif ($vals->senha != $senha)
            {
                ?>
		<script>
			alert("Senha incorreta! Redigite por favor.");
			$('input[name=senha]').val('');

		</script>
		<?php
            }
            else 
            {
                pg_close($conecta);
                include "../connect.php";
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['senha'] = $senhaPlain;
                ECHO '<script type="text/javascript">window.open("index.php","_self")</script>';
            }
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
    <title>Minha Conta</title>
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
                <h1>Minha Conta</h1>
            </div>
        </div>
                  <div id="menuInicial" class="menuInit">
                        <a href="../index.php" class="inativo">Home</a>
                        <a href="../produtos/index.php" class="inativo">Produtos</a>
                        <a href="../criadores.php"  class="inativo">Criadores</a>
                        <a href="../contato.php"  class="inativo">Contato</a>
                        <a href="../minhaconta/index.php"  class="ativo">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
                        <a href="../carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"><?php if(isset($_SESSION['carrinho'])){ echo ' ('.count($_SESSION['carrinho']).')'; } ?></a>               
                 </div>         

         
        <div id="contaProdutoExibe">
            <?php
            if(!isset($_SESSION['user']))
            {
            ?>
                <center><h1>Já possui login?</h1></center>
                <h2><center>Entre com sua conta:</center></h2>
               <div id="inputLogin">
                    <form action="" method="post" id="formLogin">
                        Usuário: <br>
                        <input type="text" name="user" id="caixaCadastro" placeholder="Digite seu usuário..."><br>
                        Senha: <br>
                        <input type="password" name="senha" id="caixaCadastro" placeholder="Digite sua senha..."><br>
                        <input type="submit" name="sub" value="Login" id="botLogin">
                    </form>
                </div>
                <center><h1>Novo por aqui?</h1></center>
                <h2><center>Cadastre-se:</center></h2>
                <div id="botsLogin">
                    <a href="../cadastro" id="botCadastro">Cadastrar</a>
                </div>
            <?php
            }
            else
            {
                $user = $_SESSION['user'];
                $senha = $_SESSION['senha'];
                include '../connect.php';
                $sql = "SELECT * FROM public.usuario WHERE login = '$user'";
                $query = pg_query($conecta, $sql);
                $fetch = pg_fetch_array($query);
                ?>
                
                <div class="mostracad">
                <br>
                <?php
                echo 'Login: '.$fetch['login'].'<br>Email: '.$fetch['email'];
                ?>
                    <div class="botoesConta">
                        <div id="botalterar">
                            <a href="alterar/" class="botaoConta">Alterar Cadastro</a><br>
                        </div>
                        <div id="botexcluir">
                            <a href="excluir/" class="botaoConta">Excluir Cadastro</a>
                        </div>
                         <form action="" method="post">
                            <input type="submit" name="sair" value="Sair" id="botsair" />
                        </form>
                        
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
            
        <br>
             <div class="rodape" id="menuRodape" class="menuRodape">
                <a href="../index.php" class="inativoRodape">Home</a>
                <a href="../produtos/index.php" class="inativoRodape">Produtos</a>
                <a href="../criadores.php"  class="inativoRodape">Criadores</a>
                <a href="../contato.php" class="inativoRodape">Contato</a>
                <a href="../minhaconta/index.php"  class="ativoRodape">Minha conta&nbsp;<img src="../icones/login.png" alt="Login" id="loginImg"></a>
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