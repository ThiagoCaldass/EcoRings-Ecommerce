<?php
    include "../../connect.php";
    session_start();
    
    if(isset($_POST['sair']))
    {
        session_destroy();
        header("Location: ../../minhaconta/");
    }
    
    $data = date('Y-m-d');
                            
    $sqlFluxo = "DELETE FROM fluxocaixa";
    $queryFluxo = pg_query($conecta, $sqlFluxo);
    
    $sqlLanc = "SELECT * FROM public.lancamento";
    $queryLanc = pg_query($conecta, $sqlLanc);
    $assocLanc = pg_fetch_assoc($queryLanc);
    
    $primeiro = true;

    do
    {
        $sqlSel = "SELECT * FROM public.fluxocaixa WHERE id_fluxocaixa = $idUlt";
        $querySel = pg_query($conecta, $sqlSel);
        $fluxo = pg_fetch_array($querySel);
        
        $sqlIns = "INSERT INTO public.fluxocaixa()";
        
        $primeiro = false;
    } while($assocLanc = pg_fetch_assoc($queryLanc));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Fluxo de caixa</title>
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
                            <h1>   Fluxo de Caixa   </h1>
                        </div>
            </div>
                      <div id="menuInicial" class="menuInit">
                            <a href="#" class="inativo">Menu Adm</a>
                            <a href="../analise/index.php" class="inativo">Análise</a>
                            <a href="../cadastroproduto/index.php" class="ativo">Cadastro de Produto</a>
                            <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
                            <a href="../fluxo/" class="ativo">Fluxo</a>
                        </div>
            
            
            <form action="" method="post">
                Início do período de pesquisa: <input type="date" name="in" id=""><br>
                Fim do período de pesquisa:<input type="date" name="fim" id=""> <br>
                <input type="submit" value="Pesquisar" name="subPesq">
            </form>
            <div id="relatorio">
                <h1><img src="../../imagens/icone.png" alt="Icone" srcset="" width="50px" style="padding-top: 8px;">&nbsp;&nbsp;Empresa: EcoRings</h1>
                <table id="tabelaFluxo">
                    <tr><td><b>Dia</b></td><td><b>Descrição</b></td><td><b>Saldo Anterior</b></td><td><b>Entrada</b></td><td><b>Saída</b></td><td><b>Saldo atual</b></td></tr>
                    <?php
                        if(isset($_POST['subPesq']))
                        {
                            $in = $_POST['in'];
                            $fim = $_POST['fim'];
                            $sql = "SELECT * FROM public.fluxocaixa WHERE dia >= '$in' AND dia <= '$fim' ORDER BY id_fluxocaixa ASC";
                            $query = pg_query($conecta, $sql);
                            $fetch = pg_fetch_assoc($query);
                            $idUlt = 0;
                            do
                            {
                                echo "<tr><td><b>".$fetch['dia']."</b></td><td><b>".$fetch['descricao']."</b></td><td><b>".$fetch['saldoant']."</b></td><td><b>".$fetch['entrada']."</b></td><td><b>".$fetch['saida']."</b></td><td><b>".$fetch['saldoatual']."</b></td></tr>";
                            } while($fetch = pg_fetch_assoc($query));
                            
                            $sql = 'SELECT SUM(saldoant) FROM public.fluxocaixa';
                            $query = pg_query($conecta, $sql);
                            $fetch = pg_fetch_array($query);
                            $ant = $fetch['sum'];

                            $sql = 'SELECT SUM(entrada) FROM public.fluxocaixa';
                            $query = pg_query($conecta, $sql);
                            $fetch = pg_fetch_array($query);
                            $entra = $fetch['sum'];
                            
                            $sql = 'SELECT SUM(saida) FROM public.fluxocaixa';
                            $query = pg_query($conecta, $sql);
                            $fetch = pg_fetch_array($query);
                            $sai = $fetch['sum'];

                            $sql = 'SELECT SUM(saldoatual) FROM public.fluxocaixa';
                            $query = pg_query($conecta, $sql);
                            $fetch = pg_fetch_array($query);
                            $atu = $fetch['sum'];
                            echo "<tr><td style='border: none !important;' colspan='2'></td><td><b>".$ant."</b></td><td><b>".$entra."</b></td><td><b>".$sai."</b></td><td><b>".$atu."</b></td></tr>";
                        }
                    ?>
                </table>
            </div>
            <button id="botPdf" style="cursor: pointer;">Gerar PDf</button>
            <?php
                if(isset($_POST['baixaPdf']))
                {
                    $html = $_POST['texto'];
                    require_once '../../vendor/autoload.php';
                    $mpdf = new \Mpdf\Mpdf();
                    $mpdf->WriteHTML($html);
                    $mpdf->Output();
                }
            ?>
            <form action="" method="post" id="form">
                <input type="hidden" name="texto" id="texto">
                <input type="submit" value="Baixar PDF" id="baixaPdf" name="baixaPdf">
            </form>
            <br>
        <div class="rodape" id="menuRodape" class="menuRodape">
            <a href="#" class="inativo">Menu Adm</a>
            <a href="../analise/index.php" class="inativo">Análise</a>
            <a href="../cadastroproduto/index.php" class="ativo">Cadastro de Produto</a>
            <a href="../pesquisa/index.php" class="inativo">Pesquisa de Clientes</a>
            <a href="../fluxo/" class="ativo">Fluxo</a>
             <br><br>
            Beatriz Garcia, 02 // Gabriel Botelho, 11 // Maiara Moreira, 23 // Marco Toledo, 24 // Thiago Caldas, 34
            <br><br>
            <a href="#top" class="inativoRodape">Voltar ao topo</a>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         </div>
            <script src="../../app.js"></script>
            <script src="fluxo.js"></script>
        </div>
    </center>
</body>
</html>