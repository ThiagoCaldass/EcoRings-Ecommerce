<!DOCTYPE html>
<?php
    include "../connect.php";
    session_start();
    
    if(isset($_POST['sair']))
    {
        session_destroy();
        header("Location: ../minhaconta/");
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" 
          crossorigin="anonymous">
    <title>Administração</title>
</head>
<body>
   <center>
        <div id="cria">
            <a name="top"></a>
            <div id="cima">
                <div id="alLogo">
                    <a href="../index.php"><img src="../imagens/icone.png" id="logoImg" ></a>
                </div>
                        <div id="titulo">
                           <br><br><br>
                            <h1>    Administração   </h1>
                        </div>
            </div>

                            <div id="menuInicial" class="menuInit">
                                <a href="#" class="ativo">Menu Adm</a>
                                <a href="analise/" class="inativo">Análise</a>
                                <a href="cadastroproduto/" class="inativo">Cadastro de Produto</a>
                                <a href="pesquisa/" class="inativo">Pesquisa de Clientes</a>
                                <a href="fluxo/" class="inativo">Fluxo</a>
                            </div>

                      <div id="contaProdutoExibe">

                        <div id="menuadm">
                            Olá administrador, seja bem-vindo!
                        </div>
                         <form action="" method="post" >
                                <input id="botsair" type="submit" name="sair" value="Sair"/>
                         </form>
                    </div>
                    <br> 

             <div class="rodape" id="menuRodape" class="menuRodape">
                <a href="#" class="ativo">Menu Adm</a>
                                <a href="analise/" class="inativo">Análise</a>
                                <a href="cadastroproduto/" class="inativo">Cadastro de Produto</a>
                                <a href="pesquisa/" class="inativo">Pesquisa de Clientes</a>
                                <a href="fluxo/" class="inativo">Fluxo</a>
                 <br><br>
                Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
                <br><br>
                <a href="#top" class="inativoRodape">Voltar ao topo</a>
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/places.js@1.10.0"></script>
                <script src="cadastro.js"></script>
                <script src="../app.js"></script>
             </div>
       </div>
    </center>
</body>
</html>