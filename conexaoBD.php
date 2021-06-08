<?php
$host = "localhost";
$user = "root";
$pass = "2738";
$db = "pesquisa_de_opniao";
$linkBD =  mysqli_connect($host,$user,$pass,$db);
mysqli_set_charset($linkBD,"utf8");
if (!$linkBD) {
    die("Falha Na Conexão: " . mysqli_connect_error());
}
    $_SESSION['statusBD'] = "Conectado Com Sucesso!". mysqli_connect_error();

?>