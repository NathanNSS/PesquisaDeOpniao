<?php
//conexão com Banco
require_once "conexaoBD.php";
function limpar($inputs){
    global $linkBD;
    $var = mysqli_escape_string($linkBD,$inputs);
    $var = htmlspecialchars_decode($var);
    $var = str_replace("\\","",$var);
    $var = str_replace(";","",$var);
    return $var;
}
//Menssagem
require_once "menssagens.php";
$id = $_SESSION['id_usuario'];

//Paginação conf com Pesquisas
require_once "paginacaoPesq.php";


$status = $_SESSION['logado'];


//Pegando o id do usuario que fez o login e buscando no banco
$sqlBuscUser = "SELECT * FROM usuario WHERE id_user = '$id'";
$resultado = mysqli_query($linkBD, $sqlBuscUser);
$dados = mysqli_fetch_array($resultado);


// verificação de Autorização 
if(!isset($_SESSION['logado']) || (!$status == true)){
    header("location:index.php");
    $_SESSION['menssagem'] = "Acesso Negado";
    mysqli_close($linkBD);
}
else{
    $status = "logado";
   
}




// Sai da sessão ao clicar no botão
if(isset($_POST['Sair'])){
    session_unset();
    session_destroy();
    mysqli_close($linkBD);
    //$_SESSION['menssagem'] = "Thau ".$dados['nome']." :)";
    header('Location: index.php');
    
}


function formataData($data){
    $array1 = explode(" ",$data);
    $array2 = $array1[0];
    $array2 = explode("-",$array2);
    $novaData = $array2[2]."/".$array2[1]."/".$array2[0];
    return $novaData;
} 

function formataSexo($data){
    $sexo = $data;
    switch ($data) {
        case 'M':
            $sexo = "Masculino";
            break;
        case 'F':
            $sexo = "Feminio";
            break;
        case 'N Inf':
            $sexo = "Não Informado";
            break;
    }
    return $sexo;
}

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Crud</title>
    </head>
    <body>
        <div class="right">
            <form  action="<?php echo $_SERVER['PHP_SELF']?>" class="login-form"  method="POST">


                <button type="submit" class="btn red z-depth-5" name="Sair"><i class="material-icons">exit_to_app</i></button>
            
            </form>
        </div>
        <div class="row">
            <div class=" col s12 m6 push-m3">
                <div class="row nav-wrapper">
                    <div class="col l12 m6 push-m3">
                        <h2 class="col l12 ">Usuarios
                        <form class="col l6  right " action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                                    <div class="input-field">
                                        <input id="search" class="" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa">
                                        <label class="label-icon " for="search"><i class="material-icons ">search</i></label>
                                        <i class="material-icons ">close</i>    
                                    </div>  
                                </form>                    
                        </h2>
                    </div>
                </div>
                <!-- Tabela Usuario -->
                <table class="striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>E-Mail</th>
                            <th>Sexo</th>
                            <th>Data de Nascimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqlListagemBD = "SELECT * FROM usuario WHERE id_User != $id ORDER BY `usuario`.`id_user` DESC";
                            $resultado = mysqli_query($linkBD, $sqlListagemBD);
                            if(mysqli_num_rows($resultadoPagina) > 0){


                            while ($dados = mysqli_fetch_array($resultado)) {
                            
                        ?>
                        <tr>
                            <td><?php echo $dados['id_user']; ?></td>
                            <td><?php echo $dados['usuario']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo formataSexo($dados['sexo']); ?></td>
                            <td><?php echo formataData($dados['data_nac']); ?></td>
                            <td><a href="php_acoes/editar.php?id=<?php echo $dados['id'];?>" data-target="modal_Edit_Cliente" class="btn-floating orange modal-trigger z-depth-2"><i class="material-icons">edit</i></a></td>
                            <td><a href="php_acoes/delete.php?id=<?php echo $dados['id'];?>" data-target="modal_Excl_Cliente" class="btn-floating red modal-trigger z-depth-2"><i class="material-icons">delete</i></a></td>
                            <!-- <td><a href="php_acoes/receID.php?id=</?php echo $dados['id'];?>" data-target="modal_Excl_Cliente" class="btn-floating red modal-trigger "><i class="material-icons">delete</i></a></td> -->
                        </tr>
                        <tr>
                            <td>
                        <?php 
                            }
                            }
                            else{$_SESSION['menssagem'] = "Sem Dados No Banco :(";}
                            
                            
                        ?>
                    </tbody>
                </table>
                <div class="row nav-wrapper">
                    <div class="col l12 m6 push-m3">
                        <h2 class="col l12 ">Enquetes
                        <form class="col l6  right " action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                                    <div class="input-field">
                                        <input id="search" class="" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa">
                                        <label class="label-icon " for="search"><i class="material-icons ">search</i></label>
                                        <i class="material-icons ">close</i>    
                                    </div>  
                                </form>                    
                        </h2>
                    </div>
                </div>
                <!-- Tabela Enquete -->
                <table class="striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>E-Mail</th>
                            <th>Sexo</th>
                            <th>Data de Nascimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sqlListagemBD = "SELECT * FROM usuario WHERE id_User != $id ORDER BY `usuario`.`id_user` DESC";
                            $resultado = mysqli_query($linkBD, $sqlListagemBD);
                            if(mysqli_num_rows($resultadoPagina) > 0){


                            while ($dados = mysqli_fetch_array($resultado)) {
                            
                        ?>
                        <tr>
                            <td><?php echo $dados['id_user']; ?></td>
                            <td><?php echo $dados['usuario']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo formataSexo($dados['sexo']); ?></td>
                            <td><?php echo formataData($dados['data_nac']); ?></td>
                            <td><a href="php_acoes/editar.php?id=<?php echo $dados['id'];?>" data-target="modal_Edit_Cliente" class="btn-floating orange modal-trigger z-depth-2"><i class="material-icons">edit</i></a></td>
                            <td><a href="php_acoes/delete.php?id=<?php echo $dados['id'];?>" data-target="modal_Excl_Cliente" class="btn-floating red modal-trigger z-depth-2"><i class="material-icons">delete</i></a></td>
                            <!-- <td><a href="php_acoes/receID.php?id=</?php echo $dados['id'];?>" data-target="modal_Excl_Cliente" class="btn-floating red modal-trigger "><i class="material-icons">delete</i></a></td> -->
                        </tr>
                        <tr>
                            <td>
                        <?php 
                            }
                            }
                            else{$_SESSION['menssagem'] = "Sem Dados No Banco :(";}
                            
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            const elemsModal = document.querySelectorAll(".modal");
            const instancesModal = M.Modal.init(elemsModal,{


            });
        </script>
    </body>
</html>