<!DOCTYPE html>
<?php
    include "../connect.php";
    include "../email/email.php";

    session_start();
    if(isset($_POST['subBot']))
    {
        $nome = htmlspecialchars($_POST['nome']);
        $sobre = htmlspecialchars($_POST['sobrenome']);
        $sex = htmlspecialchars($_POST['sexo']);
        $user = htmlspecialchars($_POST['user']);
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

        include '../connect.php';
        $sqlU = "INSERT INTO public.usuario (id_usuario, login, email, senha, excluido) VALUES (DEFAULT, '$user', '$email', '$senha', 'n')";
        $queryU = pg_query($conecta, $sqlU);
        $affectU = pg_affected_rows($queryU);
        
        if($affectU <= 0)
        {
            echo '<script>alert("Erro no cadastro de USUÁRIO!");</script>';
            exit;
        }

        $nascimento = date("Y-m-d", $nasc);
        
        $sqlId = "SELECT * FROM public.usuario WHERE login = '$user'";
        
        $queryId = pg_query($conecta, $sqlId);
        $fetchId = pg_fetch_array($queryId);
        $id = $fetchId['id_usuario'];
        
        $sqlC = "INSERT INTO public.cliente (id_usuario, nome, sobrenome, sexo, data_nasc, telefone, celular, excluido) VALUES ($id, '$nome', '$sobre', '$sex', '$nascimento', '$tel', '$cel', 'n')";
        $queryC = pg_query($conecta, $sqlC);
        $affectC = pg_affected_rows($queryC);
        
        if($affectC <= 0)
        {
            echo '<script>alert("Erro no cadastro de CLIENTE!");</script>';
            exit;
        }
        
        $sqlE = "INSERT INTO public.endereco (id_endereco, id_usuario, endereco, numero, complemento, bairro, cep, cidade, estado, pais) VALUES (DEFAULT, $id, '$rua', '$num', '$comp', '$bairro', '$cep', '$cidade', '$estado', '$pais')";
        
        $queryE = pg_query($conecta, $sqlE);
        
        $affectE = pg_affected_rows($queryE);
        if($affectE <= 0)
        {
            echo '<script>alert("Erro no cadastro de ENDEREÇO!");</script>';
            exit;
        }
        else
        {
            sendEmail($email, $nome, "Bem-vindo à EcoRings!", "Obrigado por se cadastrar na EcoRings. Estamos muito felizes em poder te ajudar. <br> Não perca tempo, comece suas compras agora mesmo e fique atento nas novidades! ");
          
         
            pg_close($conecta);
            include "../connect.php";
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['senha'] = $senha;
            ECHO '<script type="text/javascript">window.open("../minhaconta/index.php","_self")</script>';
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../imagens/icone.png" type="image/png" />
    <link rel="shortcut icon"  href="../imagens/icone.png" type="image/png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" 
          crossorigin="anonymous">
    <title>Cadastro</title>
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
                    <h1>Cadastro</h1>
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

            <div id="userCadastro">
                
                <form action="" method="post">
                    <div>
                        <h4 id="subcadastro">Dados Login</h4>
                        <hr id="linhacadastro">
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Usuário: </div>
                        <input type="text" class="cadDireita" id="caixaCadastro" name="user" required/>
                    </div>
                    
                    <div class="wrapCad"> <!--MUDANCA-->
                        <div class="cadEsquerda"><i id="botMostraSenha" class="fas fa-eye"></i> Senha: </div>
                        <input type="password" class="cadDireita" id="caixaSenha" name="senha" required/>
                    </div>
                    
                    <div>
                        <br><br>
                        <h4 id="subcadastro">Dados Gerais</h4><hr id="linhacadastro">
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Primeiro Nome: </div>
                        <input type="text" class="cadDireita" id="caixaCadastro" name="nome" required/>
                    </div>
                    <div class="wrapCad">
                        <div class="cadEsquerda">Sobrenome: </div>
                        <input type="text" class="cadDireita" id="caixaCadastro" name="sobrenome" required/>
                    </div>
                    <div class="wrapCad">
                        <div class="cadEsquerda">Sexo: </div>
                        <select name="sexo" id="caixaCadastro" required>
                            <option disabled selected>Selecionar...</option>
                            <option value="m">Masculino</option>
                            <option value="f">Feminino</option>
                            <option value="o">Outro</option>
                        </select>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Data de nascimento: </div>
                        <input type="date" class="cadDireita" id="caixaCadastro" name="data_nasc" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Email: </div>
                        <input type="email" name="email" size="30" maxlength="50" id="caixaCadastro" class="cadDireita" required/>
                    </div>
                    
                     <div class="wrapCad">
                        <div class="cadEsquerda">Telefone: </div>
                        <input type="text" name="telefone"  maxlength="11" placeholder="(DDD) 9999-9999" id="caixaCadastro" class="cadDireita" required/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Celular: </div>
                        <input type="text" name="celular"  maxlength="12" placeholder="(DDD) 99999-9999" id="caixaCadastro" class="cadDireita" required/>
                    </div>

                     <div class="wrapCad">
                        <div class="cadEsquerda">CEP: </div>
                        <input type="text" id="cep" name="cep" maxlength="8" size="8" class="cadDireita"/>
                    </div>
                    <div id="erroCep"></div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Cidade: </div> 
                        <input type="text" id="cidade" name="cidade"/>
                    </div>

                    <div class="wrapCad">
                        <div class="cadEsquerda">Estado: </div>
                        <input type="text" id="uf" name="uf"/>
                    </div>

                    <div class="wrapCad">
                        <div class="cadEsquerda">Bairro: </div>
                        <input type="text" id="bairro" name="bairro"/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Rua: </div>
                        <input type="text" id="rua" name="rua"/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">País: </div>
                        <input type="text" id="pais" name="pais"/>
                    </div>
                    
                    <div class="wrapCad">
                        <div class="cadEsquerda">Número de endereço: </div>
                        <input type="number" id="caixaCadastro" name="numero"/>
                    </div>

                    <div class="wrapCad">
                        <div class="cadEsquerda">Complemento: </div>
                        <input type="text" id="comp" name="comp"/>
                    </div>
                    
                    <br>

                    <input id="botao" type="submit" name="subBot" id="button" value="Enviar">

                    &nbsp;

                    <input id="botao" type="reset" name="limpaBot" id="button" value="Limpar">  
                </form>
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
            <script src="https://cdn.jsdelivr.net/npm/places.js@1.10.0"></script>
            <script src="cadastro.js"></script>
            <script src="../jquery.mask.js"></script>
            <script src="../app.js"></script>
         </div>
       </div>
    </center>
</body>
</html>