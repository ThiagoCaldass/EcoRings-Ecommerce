<!DOCTYPE html>
<?php
    include "../../connect.php";
    session_start();
    $sub = $_POST['subCad'];
    if(isset($sub))
    {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descri = $_POST['descricao'];
        $img = $_POST['img'];
        $p = $_POST['p'];
        $m = $_POST['m'];
        $g = $_POST['g'];
        $total = $p + $m + $g;
        $sqlStr = "INSERT INTO public.produtos (nome, preco, descricao, imagem, estoque) VALUES ('$nome', $preco, '$descri', '$img', $total)";
        $query = pg_query($conecta, $sqlStr);
        $num = pg_affected_rows($query);

        $sqlSel = "SELECT * FROM public.produtos_tamanhos WHERE nome = '$nome'";
        $querySel = pg_query($conecta, $sqlSel);
        $fetch = pg_fetch_array($querySel);
        $id = $fetch['id'];

        $sqlTam = "INSERT INTO public.produtos_tamanhos (id, p, m, g) VALUES ($id, $p, $m, $g)";
        $queryTam = pg_query($conecta, $sqlTam);
        $numTam = pg_affected_rows($queryTam);

        if($num + $numTam > 0)
        {
            ?>
            <script>
                document.getElementById('formCad').reset;
                alert('Cadastro realizado com sucesso!');
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                alert('Falha no cadastro! Favor tente novamente.');
            </script>
            <?php
        }
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Cadastro de Produtos</title>
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
                            <h1>    Cadastro de Produto   </h1>
                        </div>
            </div>
                      <div id="menuInicial" class="menuInit">
                            <a href="../index.php" class="inativo">Menu Adm</a>
                            <a href="../analise/index.php" class="inativo">Análise</a>
                            <a href="../cadastroproduto/index.php" class="ativo">Cadastro de Produto</a>
                            <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
                            <a href="../fluxo/" class="inativo">Fluxo</a>
                        </div>
            <form action="" method="POST" id="formCad">
                <div id="cadastro">
                    <div class="wrapCad">
                        <div id="cadEsquerda">Nome do produto: &nbsp;</div><input type="text" class="cadDireita" id="caixaCadastro2" name="nome" required> 
                    </div>
                    <div class="wrapCad">
                        <div id="cadEsquerda">Preço do produto (R$): &nbsp;</div><input type="number" step="0.10" value="5.00" class="cadDireita" id="caixaCadastro2" name="preco" required> 
                    </div>
                    <div class="wrapCad">
                        <div id="cadEsquerda">Descrição do produto: &nbsp;</div><input type="text" class="cadDireita" id="caixaCadastro2" name="descricao" required> 
                    </div>
                    <div class="wrapCad">
                        <div id="cadEsquerda">Total de produtos no tamanho 16: &nbsp;</div><input type="number" step="1" value="0" class="cadDireita" id="caixaCadastro2" name="p" required> 
                    </div>
                    <div class="wrapCad">
                        <div id="cadEsquerda">Total de produtos no tamanho 18: &nbsp;</div><input type="number" step="1" value="0" class="cadDireita" id="caixaCadastro2" name="m" required> 
                    </div>
                    <div class="wrapCad">
                        <div id="cadEsquerda">Total de produtos no tamanho 20: &nbsp;</div><input type="number" step="1" value="0" class="cadDireita" id="caixaCadastro2" name="g" required> 
                    </div>
                    <div id="inputImagem">
                        <input type="file" name="arquivoInput" id="arquivo" accept="image/*" required>
                        <label for="arquivo" id="lblArq"><img src="../../fotos/file.png" alt="Icone">&nbsp;Adicionar imagem</label>
                        <img src="" alt="Upload" id="imagemUp">
                    </div>
                    <input type="hidden" name="img" id="hidImg" value="">
                    <br>
                    <input type="submit" value="Cadastrar produto!" id="botCadProd" name="subCad">
                </div>
            </form>
            
            <br>
         <div class="rodape" id="menuRodape" class="menuRodape">
             <a href="../index.php" class="inativo">Menu Adm</a>
             <a href="../analise/index.php" class="inativo">Análise</a>
             <a href="../cadastroproduto/index.php" class="ativo">Cadastro de Produto</a>
             <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
             <a href="../fluxo/" class="inativo">Fluxo</a>
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