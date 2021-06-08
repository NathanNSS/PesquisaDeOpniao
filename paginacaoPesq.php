<?php 

$pagina = limpar(isset($_GET['pagina'])) ? $_GET['pagina']:1;
$ord = "DESC";

if(isset($_GET['pesquisa'])){
    $pesquisa = limpar($_GET['pesquisa']);
    $pesq = " WHERE titulo or descricao LIKE '%$pesquisa%' ";
    $pesquisar = "&pesquisa=$pesquisa";
    $urlParam = "?pesquisa=$pesquisa&";
}
else{
    $pesquisa = "";
    $pesq = "";
    $pesquisar = "";
    $urlParam = "?";
}

if(isset($_GET['filter']) && $_GET['filter'] == 'Antig'){
    $filtro = limpar($_GET['filter']);
    $ord = "ASC";
    $pesquisar = $pesquisar."&filter=Antig";
}
else if(isset($_GET['filter'])){
    $ord = "DESC";
    $pesquisar = $pesquisar."&filter=Recent";
}

switch (isset($_GET['logout'])) {
    case 'True':
        unset ($_SESSION['logado']);
        unset ($_SESSION['id_usuario']);
        $_SESSION['menssagem'] = "Até Mais &nbsp;<b>".$infUser['usuario']."</b>&nbsp; &#128515;";
        header("location:Index.php");
        break;
}



$sqlListagemBD = "SELECT titulo, descricao FROM enquete_simples_caracteres $pesq ";

$resultado = mysqli_query($linkBD, $sqlListagemBD);

$totalDados = mysqli_num_rows($resultado); 

$itemPagina = 6;

$totalPagina = ceil($totalDados/$itemPagina);

$inicio = ($itemPagina*$pagina)-$itemPagina;

$sqlListPagina = "SELECT titulo, descricao, data_criacao, Cod_Enquete_Simples_Caracteres FROM enquete_simples_caracteres $pesq ORDER BY data_criacao $ord limit $inicio, $itemPagina";

$resultadoPagina = mysqli_query($linkBD,$sqlListPagina);

$PP = mysqli_num_rows($resultadoPagina);

$paginaSeguinte = $pagina + 1;
$paginaAnterio = $pagina - 1;


?>