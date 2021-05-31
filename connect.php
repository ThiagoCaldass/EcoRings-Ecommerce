<!DOCTYPE html>
<html lang="pt-br">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<meta charset="UTF-8">
</head>

<body>
	<?php
         //Conecta com o PostgreSQL
        $conecta = pg_connect("host=127.0.0.1 port=5432 dbname=2018_72a_Ecorings user=ecorings password=ecoringsanual");
        if (!$conecta)
        {
            echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
            exit;
        }
     ?>
</body>

</html>
