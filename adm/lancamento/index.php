<!DOCTYPE html>
<?php
    include "../../connect.php";
    session_start();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../../style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Lançamentos</title>
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
                            <h1>   Lançamento  </h1>
                        </div>
            </div>
                      <div id="menuInicial" class="menuInit">
                            <a href="#" class="inativo">Menu Adm</a>
                            <a href="../analise/index.php" class="inativo">Análise</a>
                            <a href="../cadastroproduto/index.php" class="ativo">Cadastro de Produto</a>
                            <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
                        </div>
            <h1>Empresa: EcoRings</h1>
            <hr>
            <div id=""></div>
            <br>
        <div class="rodape" id="menuRodape" class="menuRodape">
            <a href="#" class="inativo">Menu Adm</a>
            <a href="../analise/index.php" class="inativo">Análise</a>
            <a href="../cadastroproduto/index.php" class="ativo">Cadastro de Produto</a>
            <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
             <br><br>
            Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
            <br><br>
            <a href="#top" class="inativoRodape">Voltar ao topo</a>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="app.js"></script>
         </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="prodcadastro.js"></script>
            <script src="../../app.js"></script>
        </div>
    </center>
</body>
</html>