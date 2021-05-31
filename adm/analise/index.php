<!DOCTYPE html>
<?php
    include "../../connect.php";
    session_start();
    $sqlString = 'SELECT * FROM public.produtos ORDER BY vendidos DESC';
    $res = pg_query($conecta, $sqlString);
    $retorno = pg_fetch_assoc($res);
    $cont = 0;
    $maisVendidosValores=array();
    $maisVendidosNomes=array();
    $maisVendidosPreco = array();
    do
    {
        if($cont >= 4)
        {
            break;
        }
        else
        {
            $maisVendidosNomes[$cont] = $retorno['nome'];
            $maisVendidosValores[$cont] = $retorno['vendidos'];
            $maisVendidosPreco[$cont] = $retorno['preco'];
            $cont++;
        }
    }
    while($retorno = pg_fetch_assoc($res));
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
    <title>Analise</title>
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
                            <h1>      Análise      </h1>
                </div>
            
            </div>

                      <div id="menuInicial" class="menuInit">
                            <a href="../index.php" class="inativo">Menu Adm</a>
                            <a href="../analise/index.php" class="ativo">Análise</a>
                            <a href="../cadastroproduto/index.php" class="inativo">Cadastro de Produto</a>
                            <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
                            <a href="../fluxo/" class="inativo">Fluxo</a>
                        </div>
    
    <div class="analiseCont">
        PRODUTOS MAIS VENDIDOS <br>
        <div class="grafico">
            <canvas id="maisVendidosGrafico"></canvas>
        </div>
    </div>
    
      <div class="rodape" id="menuRodape" class="menuRodape">
          <a href="../index.php" class="inativo">Menu Adm</a>
          <a href="../analise/index.php" class="ativo">Análise</a>
          <a href="../cadastroproduto/index.php" class="inativo">Cadastro de Produto</a>
          <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
          <a href="../fluxo/" class="inativo">Fluxo</a>
             <br><br>
            Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
            <br><br>
            <a href="#top" class="inativoRodape">Voltar ao topo</a>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
            <script src="../../app.js"></script>
            
         </div>
    <script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="../../app.js"></script>
    <script>
        var maisVendidosLabels = ['<?php echo $maisVendidosNomes[0] ?>', '<?php echo $maisVendidosNomes[1] ?>', '<?php echo $maisVendidosNomes[2] ?>', 
                                  '<?php echo $maisVendidosNomes[3] ?>'];
        var maisVendidosData = [<?php echo $maisVendidosValores[0] ?>, <?php echo $maisVendidosValores[1] ?>, <?php echo $maisVendidosValores[2] ?>,
                               <?php echo $maisVendidosValores[3] ?>];
        var maisVendidosPreco = [<?php echo $maisVendidosPreco[0] ?>, <?php echo $maisVendidosPreco[1] ?>, <?php echo $maisVendidosPreco[2] ?>, <?php echo                              $maisVendidosPreco[3] ?>];
        const ctxmaisVendidosGrafico = document.getElementById("maisVendidosGrafico").getContext('2d');
        var maisVendidosGrafico = new Chart(ctxmaisVendidosGrafico, {
            type: 'bar',
            data: {
                labels: maisVendidosLabels,
                datasets: [{
                    label: 'Vendas',
                    data: maisVendidosData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 93, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgb(255, 86, 86)'
                    ],
                    borderWidth: 1
                }, 
                {
                    label: 'Preço',
                    data: maisVendidosPreco,
                    backgroundColor: [
                        'rgba(0, 0, 0, 0)',
                        'rgba(0, 0, 0, 0)',
                        'rgba(0, 0, 0, 0)',
                        'rgba(0, 0, 0, 0)'
                    ],
                    borderColor: [
                        'rgba(56, 94, 196,1)'
                    ],
                    // Changes this dataset to become a line
                    type: 'line'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
       </div>
    </center>
</body>
</html>