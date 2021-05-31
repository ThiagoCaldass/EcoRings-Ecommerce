var icon = document.getElementById('iconeMenu');
var selectOp = document.getElementById('selectMenuProduto');
const inpesquisa = document.getElementById('inPesquisa');
const txtPesquisa = document.getElementById('txtBuscaI');

selectOp.addEventListener('change', function (event)
{
    location.href='index.php?opcao='+$('select[id=selectMenuProduto]').val();
});

$('#txtBuscaI').keypress(event=>
    {
        if(event.charCode === 13)
        {
            $('#subPesq').click();
        }
    });