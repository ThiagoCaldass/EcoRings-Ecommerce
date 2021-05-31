<!DOCTYPE html>
<?php
    include "../../connect.php";
    session_start();
    $user = $_SESSION['user'];
    $senha = $_SESSION['senha'];
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../../imagens/icone.png" type="image/png" />
    <link rel="shortcut icon"  href="../../imagens/icone.png" type="image/png" />
    <title>Minha Conta</title>
</head>
<body>
   <center>
          <div id="cria">
            <a name="top"></a>
            <div id="cima">
                <div id="alLogo">
                    <a href="../index.php"><img src="../../imagens/icone.png" id="logoImg" ></a>
                </div>
                        <div id="titulo">
                           <br><br><br>
                            <h1>Pesquisa de Clientes</h1>
                        </div>
            </div>
                     
                      <div id="menuInicial" class="menuInit">
                            <a href="../index.php" class="ativo">Menu Adm</a>
                            <a href="../analise/" class="inativo">Análise</a>
                            <a href="../cadastroproduto/" class="inativo">Cadastro de Produto</a>
                            <a href="../pesquisa/" class="inativo">Pesquisa de Clientes</a>
                            <a href="../fluxo/" class="inativo">Fluxo</a>
                       </div>        
                        
         <div id="contaProdutoExibe">
            <form action="" method="post"> 
                <select name="campo" id="op1">
                    <option disabled selected>Selecione uma opção de pesquisa...</option>
                    <option value="login">Login</option>
                    <option value="email">Email</option>
                    <option value="nome">Nome</option>
                    <option value="sobre">Sobrenome</option>
                    <option value="telefone">Telefone</option>
                    <option value="celular">Celular</option>
                </select><br>
                <input type="text" name="valor" id="op2" placeholder=" Valor para a pesquisa..."><br>
                <input  id="botPesquisa" type="submit" value="Pesquisar" name="pesq">
                <br>
            </form>
            <?php
            if(isset($_POST['pesq']))
            {
                pg_close($conecta);
                include '../../connect.php';
                $op = $_POST['campo'];
                $valor = $_POST['valor'];
                if($op == 'login' || $op == 'email')
                {
                    $tabela = 'usuario';
                }
                else
                {
                    $tabela = 'cliente'; 
                }
                $sql = "SELECT * FROM public.$tabela WHERE $op ILIKE '%$valor%'";
                $res = pg_query($conecta, $sql);
                $assoc = pg_fetch_assoc($res);
            ?>
                
                <div id="tabconsulta">
                <div id="infotabela">
                    <?php
                        echo 'Informações da tabela consultada: <br><br>';
                    ?>
                </div>
                    <?php
                        do
                        {
                            if($assoc['login'] == NULL && $assoc['nome'] == NULL)
                            {
                                echo 'Nenhum dado referente a pesquisa localizado.';
                                break;
                            }
                            else
                            {
                                echo "<div id='dadotabela'><br>";
                                if($tabela == 'usuario')
                                {
                                    
                                    echo "<div id='alinhadado'>Usuário: ".$assoc['login']."<br>Email: ".$assoc['email']."</div><br>";
                                }
                                else
                                {
                                    echo "<div id='alinhadado'>Nome: ".$assoc['nome']."<br>Sobrenome: ".$assoc['sobrenome']."<br>Sexo: ".$assoc['sexo'].
                                    "<br>Data de nascimento: ".date('d/m/Y',  strtotime($assoc['data_nasc']))."<br>Telefone: ".$assoc['telefone'].
                                    "<br>Celular: ".$assoc['celular']."</div><br>";
                                }
                                echo "</div><br>";
                            } 
                            
                        } while($assoc = pg_fetch_assoc($res));
                    }
                    ?>
                </div>
          </div>
        <br>
             <div class="rodape" id="menuRodape" class="menuRodape">
                  <a href="../index.php" class="ativo">Menu Adm</a>
                  <a href="../analise/" class="inativo">Análise</a>
                  <a href="../cadastroproduto/" class="inativo">Cadastro de Produto</a>
                  <a href="../pesquisa/" class="inativo">Pesquisa de Clientes</a>
                  <a href="../fluxo/" class="inativo">Fluxo</a>
                 <br><br>
                Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
                <br><br>
                <a href="#top" class="inativoRodape">Voltar ao topo</a>
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="../../app.js"></script>
             </div>
    </div>
    </center>
</body>
</html>