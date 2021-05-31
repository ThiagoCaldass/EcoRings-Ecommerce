var contSenha;

$(document).ready(function (e) {
    contSenha = false;
    $('#telefone').mask('(00) 0000-0000');
    $('#celular').mask('(00) 00000-0000');
    $('#cep').mask('00000-000');
});

$('#botMostraSenha').on('click', function () {
    mostraSenha();
});
function mostraSenha()
{
    contSenha = !contSenha;
    if(contSenha)
    {
        $('#caixaSenha').attr('type', 'text');
    }
    else
    {
        $('#caixaSenha').attr('type', 'password');
    }
}

function parseCep()
{
    var cep = $('#cep').val();
    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
        if (!("erro" in dados)) {
            $('#erroCep').text('');
            $("#rua").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            let estado = dados.uf;
            let estadCerto= estado.trim();
            $("#uf").val(estadCerto);
        }
        else {
            $('#erroCep').text('❌ CEP não encontrado!!!');
            $("#rua").val('');
            $("#bairro").val('');
            $("#cidade").val('');
            $("#uf").val('');
        }
    });
}

$('#cep').keypress(event=>
{
    return event.charCode >= 48 && event.charCode <= 57;
});
$('#telefone').keypress(event=>
{
    return event.charCode >= 48 && event.charCode <= 57;
});

$('#cep').focusout(parseCep);