<?php
//conexão com Banco
require_once "conexaoBD.php";

//Menssagem
require_once "menssagens.php";

//echo "Projeto de Faculdade !!";

if(isset($_SESSION['id_usuario'])){
    if($_SESSION['logado'] = TRUE and $_SESSION['id_usuario'] !== NULL){
        $idUser = $_SESSION['id_usuario'];       
        $sqlUser = "SELECT usuario, email FROM usuario WHERE id_user = '$idUser'";
        $User = mysqli_query($linkBD, $sqlUser);
        $infUser = mysqli_fetch_array($User);
    }else{
        header("location:Index.php");

    }
}else{
    header("location:Index.php");

}

function limpar($inputs){
    global $linkBD;
    $var = mysqli_escape_string($linkBD,$inputs);
    $var = htmlspecialchars_decode($var);
    $var = str_replace("\\","",$var);
    $var = str_replace(";","",$var);
    return $var;
}

if(isset($_POST['btn-criar'])){
        $_SESSION["gera2"] = $_SESSION["gera"] = rand(100000,999999);
        echo "Redirecionando Para Enquete Simples!";
        header("location:criacaoEnqueteSimples.php");
}


//filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
require_once "paginacaoPesq.php";


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
        
        <!-- css -->
        <link rel="stylesheet" href="src/css/indexLogado.css">
        <!-- *** -->
        <title>Projeto</title>
    </head>
    <body class="grey lighten-2">
    <!-- Menu De Navegação -->
    <div class="navbar-fixed">
        <div class="row">
        <nav class="light-blue darken-4" id="navBar">
            <div class="nav-wrapper">
                <a href="Index.php" id="logo" class="brand-logo">Pesquisa de Opinão ?¿</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="waves-effect waves-light modal-trigger right" id="createEnquete" href="#criacao">Criar Enquete</a>

                <ul class="right hide-on-med-and-down" id="itemNav">

                    <li id="camPesq">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                            <div class="input-field light-blue darken-4" id="containerSearch">
                                <input id="search" class="light-blue darken-4 white-text" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa" required>
                                <label class="label-icon" for="search"><i class="material-icons ">search</i></label>
                                <i class="material-icons" id="iconPesq">close</i>    
                            </div>
                        </form>
                        <!-- <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                            <input id="search" class="light-blue darken-4   white-text" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa" required>
                        </form> -->
                    </li>
                    <li class="logIcon" id="contenier_IconUser">

                        <a href="#!" id="linkLogin" class="dropdown-trigger1" data-target="dropdownLogout">
                            <img class="iconUser" src="src/img/user-circle.png" alt="icon user">
                            <span><?php echo $infUser['usuario'];?></span>
                        </a>

                        <ul id="dropdownLogout" class="dropdown-content">
                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?logout=True">Logout<i class="material-icons" id="iconLogout">exit_to_app</i></a></li>
                        </ul>

                    </li>
                    <li>
                        <a href="perfilUsuario.php" id="linkLogin" class="modal-trigger">Perfil</a>
                    </li>

                </ul>
            </div>
            <ul class="sidenav light-blue darken-4" id="mobile-demo">
                <a href="#loginUser">
                    <img class="iconUser" title="Login" src="src/img/user-circle.png" alt="icon user">
                </a>
                <li>
                </li>
                <li>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                        <div class="input-field light-blue darken-4">
                            <input id="searchM" class="light-blue darken-4 white-text" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa" required>
                            <label class="label-icon" for="searchM"><i class="material-icons">search</i></label>
                            <i class="material-icons" id="iconPesqM">close</i>    
                        </div>
                    </form>
                </li>
                <li>
                    <a href="perfilUsuario.php" id="linkLogin" class="modal-trigger">Perfil</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>


        <div class="row">
            <div class="col s12 m6 push-m3">
                
                <div id="selectFiltro">
                    <h2>FEED</h2>    
                    <div class="input-field" id="selectFiltro">   
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                        <ul id="dropdown2" class="dropdown-content">
                            <li><a href="<?php echo $_SERVER['PHP_SELF'];echo $urlParam;?>filter=Recent">Mais Recente</a></li>
                            <li><a href="<?php echo $_SERVER['PHP_SELF'];echo $urlParam;?>filter=Antig">Mais Antigo</a></li>
                        </ul>
                    </form>
                </div>
                <a class="btn dropdown-trigger1 right" href="#!" data-target="dropdown2">Filtro<i class="material-icons right">import_export</i></a>
                <br><br><br>
                </div>
                
                <!-- TAbela Cliente -->
                <table class="">
                    <thead>
                        <tr> </tr>
                    </thead>
                    <tbody>
                        <?php 
                            
                            if($totalDados > 0){

                            while ($dados = mysqli_fetch_array($resultadoPagina)) {
                            
                        ?>
                       
                        <tr class="white z-depth-2">
                            <td>
                                <div class="card z-depth-0">
                                    <div class="card-content black-text">

                                    <span class="card-title"><?php echo "<h4>".$dados['titulo']."</h4>"; ?></span>

                                        <p><h5><?php echo $dados['descricao'];?></h5></p>
                                    </div>
                                    
                                    <div class="card-action">
                                    <hr>
                                    <div class="footerCard">
                                        <span id="data"><?php echo formataData($dados['data_criacao']); ?></span>
                                        <a class="waves-effect waves-light light-blue darken-4 btn-large" 
                                            href="votacao.php?chave=<?php echo $dados['Cod_Enquete_Simples_Caracteres'];?>"><i class="material-icons left">send</i>Votar</a>
                                    </div>
                                    </div>
                                </div>
                            </td>


                            <!-- <td><a href="pagTeste.php?chave=<?php echo $dados['Cod_Enquete_Simples_Caracteres'];?>" ><i class="material-icons">arrow_forward</i></a></td> -->
                        </tr>
                        
                        <tr class="espaco">
                            <th class="bb"></th>
                        </tr>
                        <?php 
                            }
                            }
                            else{$_SESSION['menssagem'] = "Sem Dados No Banco :(";}
                            function formataData($data){
                                $arrayDataHora = explode(" ",$data);
                                $arrayData = $arrayDataHora[0];
                                $arrayData = explode("-",$arrayData);
                                $arrayHora = $arrayDataHora[1];
                                $arrayHora = explode(":",$arrayHora);
                                $novaData = $arrayData[2]."/".$arrayData[1]."/".$arrayData[0]." ".$arrayHora[0].":".$arrayHora[1];
                                return $novaData;
                            } 
                            
                        ?>
                    </tbody>
                </table>
                <br>
                

                <!-- Criação de Enquete -->
                <div class="col push-l3 pull-3 l6">
                    <div id="criacao" style="width:40%;" class="modal">
                        <div class="modal-content">
                        <h4>Tem Certeza que Deseja Criar Uma Enquete ?</h4>             
                        <form method="POST" class="center" action="<?php echo $_SERVER['PHP_SELF']?>">
                            <br><br>
                            <input class="btn light-blue darken-4" type="submit" value="Criar" name="btn-criar"class="btn">
                        </form>
                        </div>
                    </div>
                </div> 
                <div class="center">    
                    <ul class="pagination">
                        <?php if($paginaAnterio != 0){ ?>
                            
                        <li class="waves-effect"><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.$paginaAnterio.$pesquisar;?>"><i class="material-icons">chevron_left</i></a></li>
                        
                        <?php }?>

                        <?php for($i = 1; $i < $totalPagina + 1; $i++){ $estilo = ""; if($i == $pagina ){ $estilo = "active";}?>
                                
                        <li class="<?php echo $estilo?>"><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.$i.$pesquisar;?>"><?php echo $i?></a></li>
                        
                        <?php } ?>
                        
                        <?php if($paginaSeguinte <= $totalPagina){ ?>

                        <li class="waves-effect "><a href="<?php echo $_SERVER['PHP_SELF'].'?pagina='.$paginaSeguinte.$pesquisar;?>"><i class="material-icons">chevron_right</i></a></li>

                        <?php }?>
                        
                    </ul>
                </div>      
            </div>
        </div>
        
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let elems = document.querySelectorAll('.sidenav');
                let instances = M.Sidenav.init(elems);
               
                let drop = document.querySelectorAll(".dropdown-trigger1");
                let intancesDrop = M.Dropdown.init(drop);
                
                // let drop = document.querySelector(".dropdown-triggerLogout");
                // let intancesDrop = M.Dropdown.init(drop);
                
            });
            const elemsModal = document.querySelectorAll(".modal");
            const instancesModal = M.Modal.init(elemsModal,{

            });
        </script>
    </body>
</html>