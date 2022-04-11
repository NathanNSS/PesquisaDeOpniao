<?php
session_start();
require_once "conexaoBD.php";


function limpar($inputs){
    global $linkBD;
    $var = mysqli_escape_string($linkBD,$inputs);
    $var = htmlspecialchars_decode($var);
    $var = str_replace("\\","",$var);
    $var = str_replace("","",$var);
    return $var;
}


if(isset($_POST["btn-votar"])){
    $title = limpar($_POST["title"]);
    $result = limpar($_POST["simp"]);
    $chave = limpar($_POST["chave"]);
    if(!empty($result)){
        function sepera_id($result){
            $array1 = explode("-",$result);
            $array2 = end($array1);
            return $array2;
        }
        function sepera_nome($result){
            $array1 = explode("-",$result);
            $array2 = $array1[0];
            return $array2;
        }
        $valorID = sepera_id($result);
        $valorNome = sepera_nome($result);

        switch ($valorID) {
            case 1:
                $resultID = "Item1";
                break;
            case 2:
                $resultID = "Item2";
                break;
            case 3:
                $resultID = "Item3";
                break;
            case 4:
                $resultID = "Item4";
                break;
            case 5:
                $resultID = "Item5";
                break;
            case 6:
                $resultID = "Item6";
                break;
            case 7:
                $resultID = "Item7";
                break;
            case 8:
                $resultID = "Item8";
                break;
            case 9:
                $resultID = "Item9";
                break;
            case 10:
                $resultID = "Item10";
                break;
        }

        $sqlAdicao = "UPDATE enquete_simples_num SET $resultID = IFNULL($resultID,0)+1 WHERE Cod_Enquete_Simples_Num = '$chave'";

        $sqlTotal = "SELECT SUM(Item1, Item2, Item3, Item4, Item5, Item6, Item7, Item8, Item9, Item10) AS total FROM enquete_simples_num  WHERE Cod_Enquete_Simples_Num = '$chave'";

        
        
        $_SESSION['exibO'] = "block";
        $_SESSION['exibG'] = "none";
      
        setcookie($chave,$chave, time() + 3600*24*7);
        if(mysqli_query($linkBD,$sqlAdicao)){
            
            if(isset($_SESSION['id_usuario'])){
                $idUser = limpar($_SESSION['id_usuario']);
                $buscaVotacao = "SELECT * FROM votos_usuario WHERE cod_enquete = '$chave' and id_user = '$idUser' and voto_user = '$valorNome'";
                $buscaRows = mysqli_query($linkBD, $buscaVotacao);
                
                date_default_timezone_set('America/Sao_Paulo');
                $data = date('Y-m-d H:i:s');
                if(mysqli_num_rows($buscaRows) >= 1){
                    

                    $sqlVoto = "UPDATE votos_usuario SET data_voto = '$data', quant_votos = quant_votos+1 WHERE cod_enquete = '$chave' and voto_user = '$valorNome' and id_user = '$idUser' ";
    
                    mysqli_query($linkBD, $sqlVoto);
    
                }elseif(mysqli_num_rows($buscaRows) == 0){
    
                    $sqlVoto = "INSERT INTO `votos_usuario`(`id_user`, `cod_enquete`, `titulo`, `voto_user`, `quant_votos`, `data_voto`) VALUE ('$idUser', '$chave', '$title', '$valorNome','1','$data')";
    
                    mysqli_query($linkBD, $sqlVoto);
                }
             }

            mysqli_close($linkBD);
            $_SESSION['menssagem'] = "Voto Contabilizado Em &nbsp;"."<b>$valorNome</b>";
            header("location: votacao.php?chave=$chave");
        }
        else{
            mysqli_close($linkBD);
            $_SESSION['menssagem'] = "<b>Ocorreu um Erro Em Seu Voto</b>";
            header("location: index.php");
        }
    }
    else{
        mysqli_close($linkBD);
        $_SESSION['menssagem'] = "<b>Selecione Um Item Antes De Votar !</b>";
        header("location: votacao.php?chave=$chave");
    }
    

}
else{
    mysqli_close($linkBD);
    $_SESSION['menssagem'] = "<b>Acesso Negado</b>";
    header("location: index.php");
}

?>
