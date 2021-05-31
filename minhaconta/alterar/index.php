<!DOCTYPE html>
<?php
    include "../../connect.php";
    session_start();

    $user = $_SESSION['user'];

    $sql = "SELECT * FROM public.usuario WHERE login = '$user'";
    $res = pg_query($conecta, $sql);
    $retornoU = pg_fetch_array($res);

    $idUsuario = $retornoU['id_usuario'];

    $sql = "SELECT * FROM public.cliente WHERE id_usuario = ".$idUsuario;
    $res = pg_query($conecta, $sql);
    $retornoC = pg_fetch_array($res);

    $sql = "SELECT * FROM public.endereco WHERE id_usuario = ".$idUsuario;
    $res = pg_query($conecta, $sql);
    $retornoE = pg_fetch_array($res);

    if(isset($_POST['subAlt']))
    {
        $nome = htmlspecialchars($_POST['nome']);
        $sobre = htmlspecialchars($_POST['sobrenome']);
        $sex = htmlspecialchars($_POST['sexo']);
        $user = htmlspecialchars($_POST['user']);
        $senhaPlain = htmlspecialchars($_POST['senha']);
        $senha = md5(htmlspecialchars($_POST['senha']));
        $nasc = strtotime(htmlspecialchars($_POST['data_nasc']));
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['telefone']);
        $cel = htmlspecialchars($_POST['celular']);
        $cep = htmlspecialchars($_POST['cep']);
        $cidade = htmlspecialchars($_POST['cidade']);
        $pais = htmlspecialchars($_POST['pais']);
        $estado = htmlspecialchars($_POST['uf']);
        $bairro = htmlspecialchars($_POST['bairro']);
        $rua = htmlspecialchars($_POST['rua']);
        $num = htmlspecialchars($_POST['numero']);
        $comp = htmlspecialchars($_POST['comp']);

        $sqlU = "UPDATE public.usuario SET login = '$user', email = '$email', senha= '$senha' WHERE id_usuario = $idUsuario";
        $queryU = pg_query($conecta, $sqlU);
        $affectU = pg_affected_rows($queryU);
        
        if($affectU <= 0)
        {
            echo '<script>alert("Erro na alteração de USUÁRIO!");</script>';
            exit;
        }

        $nascimento = date("Y-m-d", $nasc);
        
        $sqlC = "UPDATE public.cliente SET nome = '$nome', sobrenome = '$sobre', sexo = '$sex', data_nasc = '$nascimento', telefone = '$tel', celular = '$cel' WHERE id_usuario = $idUsuario";
        $queryC = pg_query($conecta, $sqlC);
        $affectC = pg_affected_rows($queryC);
        
        if($affectC <= 0)
        {
            echo '<script>alert("Erro na alteração de CLIENTE!");</script>';
            exit;
        }
        
        $sqlE = "UPDATE public.endereco SET endereco = '$rua', numero = '$num', complemento = '$comp', bairro = '$bairro', cep = '$cep', cidade = '$cidade', estado = '$estado', pais = '$pais' WHERE id_usuario = $idUsuario";
        $queryE = pg_query($conecta, $sqlE);
        $affectE = pg_affected_rows($queryE);

        if($affectE <= 0)
        {
            echo '<script>alert("Erro na alteração de ENDEREÇO!");</script>';
            exit;
        }

        $_SESSION['user'] = $user;
        $_SESSION['senha'] = $senhaPlain;
        header('Location: ../');
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
            <a href="../../index.php"><img src="../../imagens/icone.png" id="logoImg" ></a>
        </div>
        <div id="areabusca">
            <div id="divBuscaI">
                <form action="../../produtos/" method="get">
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
                        <a href="../../index.php" class="inativo">Home</a>
                        <a href="../../produtos/index.php" class="inativo">Produtos</a>
                        <a href="../../criadores.php"  class="inativo">Criadores</a>
                        <a href="../../contato.php"  class="inativo">Contato</a>
                        <a href="../../minhaconta/index.php"  class="ativo">Minha conta&nbsp;<img src="../../icones/login.png" alt="Login" id="loginImg"></a>
                        <a href="../../carrinho/index.php"  class="inativo">Carrinho&nbsp;<img src="../../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"></a>               
                 </div>            

       <div id="produtoExibe">
            <form action="" method="post">
            <div>
                    <h4 id="subcadastro">Dados Login</h4>
                    <hr id="linhacadastro">
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Usuário: </div>
                        <input type="text" class="cadDireita" id="caixaCadastro" name="user" value="<?php echo $retornoU['login']; ?>" required />
                    </div>
                    
                    <div class="wrapCad"> 
                        <div class="cadEsquerda"><i id="botMostraSenha" class="fas fa-eye"></i> Senha: </div>
                        <input type="password" class="cadDireita" id="caixaSenha" name="senha" value="<?php echo $_SESSION['senha']; ?>" required />
                    </div>
                    
                    <div>
                        <br><br>
                        <h4 id="subcadastro">Dados Gerais</h4><hr id="linhacadastro">
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Primeiro Nome: </div>
                        <input type="text" class="cadDireita" id="caixaCadastro" name="nome" value="<?php echo $retornoC['nome']; ?>" required/>
                    </div>
                    <div class="wrapCad">
                        <div class="cadEsquerda">Sobrenome: </div>
                        <input type="text" class="cadDireita" id="caixaCadastro" name="sobrenome" value="<?php echo $retornoC['sobrenome']; ?>" required/>
                    </div>
                    <div class="wrapCad">
                        <div class="cadEsquerda">Sexo: </div>
                        <select name="sexo" id="caixaCadastro" required>
                            <option value="m" <?php if($retornoC['sexo'] == 'm') { echo 'selected'; } ?>>Masculino</option>
                            <option value="f" <?php if($retornoC['sexo'] == 'f') { echo 'selected'; } ?>>Feminino</option>
                            <option value="o" <?php if($retornoC['sexo'] == 'o') { echo 'selected'; } ?>>Outro</option>
                        </select>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Data de nascimento: </div>
                        <input type="date" class="cadDireita" id="caixaCadastro" name="data_nasc" value="<?php echo $retornoC['data_nasc']; ?>" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Email: </div>
                        <input type="email" name="email" size="30" maxlength="50" id="caixaCadastro" class="cadDireita" value="<?php echo $retornoU['email']; ?>" required/>
                    </div>
                    
                     <div class="wrapCad">
                        <div class="cadEsquerda">Telefone: </div>
                        <input type="text" name="telefone" value="<?php echo $retornoC['telefone']; ?>" maxlength="11" placeholder="(DDD) 9999-9999" id="caixaCadastro" class="cadDireita" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Celular: </div>
                        <input type="text" name="celular" value="<?php echo $retornoC['celular']; ?>"  maxlength="12" placeholder="(DDD) 99999-9999" id="caixaCadastro" class="cadDireita" required/>
                    </div>

                     <div class="wrapCad">
                        <div class="cadEsquerda">CEP: </div>
                        <input type="text" value="<?php echo $retornoE['cep']; ?>" id="cep" name="cep" maxlength="8" size="8" class="cadDireita"/>
                    </div>
                    <div id="erroCep"></div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Cidade: </div> 
                        <input type="text" id="cidade" value="<?php echo $retornoE['cidade']; ?>" name="cidade" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">País: </div>
                        <input type="text" id="pais" value="<?php echo $retornoE['pais']; ?>" name="pais" required/>
                    </div>

                    <div class="wrapCad">
                        <div class="cadEsquerda">Estado: </div>
                        <input type="text" id="uf" value="<?php echo $retornoE['estado']; ?>" name="uf" required/>
                    </div>

                    <div class="wrapCad">
                        <div class="cadEsquerda">Bairro: </div>
                        <input type="text" id="bairro" value="<?php echo $retornoE['bairro']; ?>" name="bairro" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Rua: </div>
                        <input type="text" id="rua" value="<?php echo $retornoE['endereco']; ?>" name="rua" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Número de endereço: </div>
                        <input type="number" id="caixaCadastro" value="<?php echo $retornoE['numero']; ?>" name="numero" required/>
                    </div>

                    <div class="wrapCad">
                        <div class="cadEsquerda">Complemento: </div>
                        <input type="text" id="comp" value="<?php echo $retornoE['complemento']; ?>" name="comp"/>
                    </div>
                    
                    <br>
                    <center>
                    <input class="botalteracao" type="submit" value="Alterar Cadastro" id="button" name="subAlt">
                    <input class="botcancela" type="reset" name="limpaBot" id="button" value="Cancelar Alterações"> 
                    
                    <a id="botsairUser" href="../">Voltar</a>
                    </center>
                    
                    <br>
            </form>
        </div>
            
        <br>
            <div class="rodape" id="menuRodape" class="menuRodape">
                <a href="../../index.php" class="inativoRodape">Home</a>
                <a href="../../produtos/index.php" class="inativoRodape">Produtos</a>
                <a href="../../criadores.php"  class="inativoRodape">Criadores</a>
                <a href="../../contato.php" class="inativoRodape">Contato</a>
                <a href="../../minhaconta/index.php"  class="ativoRodape">Minha conta&nbsp;<img src="../../icones/login.png" alt="Login" id="loginImg"></a>
                <a href="../../carrinho/index.php" class="inativoRodape">Carrinho&nbsp;<img src="../../icones/carrinho.png" alt="Carrinho" id="carrinhoImg"></a>
                 <br><br>
                Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
                <br><br>
                <a href="#top" class="inativoRodape">Voltar ao topo</a>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="cadastro.js"></script>
                <script src="../../app.js"></script>
             </div>
    </div>
    </center>
</body>
</html>