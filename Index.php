<?php
//conexão com Banco
require_once "conexaoBD.php";

//Menssagem
require_once "menssagens.php";

//echo "Projeto de Faculdade !!";

if(isset($_SESSION['id_usuario'])){
    if($_SESSION['logado'] = TRUE and $_SESSION['id_usuario'] !== NULL){ 
       header("location:IndexLogado.php");
    }
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
        //echo "Redirecionando Para Enquete Simples!";
        header("location:criacaoEnqueteSimples.php");
}


//filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
require_once "paginacaoPesq.php";

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">

        <!--Import Google Icon Font-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <!-- css -->
        <link rel="stylesheet" href="src/css/index.css">
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
                            <div class="input-field light-blue darken-4">
                                <input id="search" class="light-blue darken-4   white-text" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa" required>
                                <label class="label-icon" for="search"><i class="material-icons ">search</i></label>
                                <i class="material-icons" id="iconPesq">close</i>    
                            </div>
                        </form>
                        <!-- <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                            <input id="search" class="light-blue darken-4   white-text" value="<?php echo $pesquisa; ?>" type="search" name="pesquisa" required>
                        </form> -->
                    </li>
                    <li class="logIcon" id="contenier_IconUser">
                        <a href="#loginUser" id="linkLogin" class="modal-trigger">
                            <img class="iconUser" src="src/img/user-circle.png" alt="icon user">
                        </a>
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
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons" id="iconPesqM">close</i>    
                        </div>
                    </form>
                </li>
            </ul>
        </nav>
        </div>
    </div>

        <div class="row">
            <div class="col s12 m6 push-m3">


                <h2>FEED</h2>    
                <div id="selectFiltro">
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

                                    <span  class="card-title"><h4 id="styleTlite"><?php echo $dados['titulo']; ?></h4></span>

                                        <p><h5><?php echo $dados['descricao'];?></h5></p>
                                    </div>
                                    
                                    <div class="card-action">
                                    <hr id="hrCard">
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
                            
                        <li class="waves-effect"><a href="Index.php?pagina=<?php echo $paginaAnterio; echo $pesquisar;?>"><i class="material-icons">chevron_left</i></a></li>
                        
                        <?php }?>

                        <?php for($i = 1; $i < $totalPagina + 1; $i++){ $estilo = ""; if($i == $pagina ){ $estilo = "active";}?>
                                
                        <li class="<?php echo $estilo?>"><a href="Index.php?pagina=<?php echo $i; echo$pesquisar?>"><?php echo $i?></a></li>
                        
                        <?php } ?>
                        
                        <?php if($paginaSeguinte <= $totalPagina){ ?>

                        <li class="waves-effect "><a href="Index.php?pagina=<?php echo $paginaSeguinte; echo $pesquisar;?>"><i class="material-icons">chevron_right</i></a></li>

                        <?php }?>
                        
                    </ul>
                </div>      
            </div>
        </div>
        <div id="loginUser" class="modal card">
            <form action="Authentication/authentUser.php" class="form-loginUser"  method="POST">
                <h3 class="center">Login</h3>
                <div class="modal-content">           
                    <div class="input-field">
                        <i class="material-icons prefix">assignment_ind</i>
                            <input type="hidden" name="local" value="<?php echo $_SERVER['PHP_SELF']?>" >
                            <input type="text" name="usuario" autofocus class="validate">
                        <label for="icon_prefix">Usuario</label>
                    </div>                      
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                            <input type="password" name="senha" class="validate">
                        <label for="icon_prefix">Senha</label>
                    </div>
                </div>
                <div class="modal-footer center" id="btn-loginUser">
                    <button class="btn green " type="submit" name="btn-entrar">Entrar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn red " type="reset" name="limpar">Limpar</button>
                </div>

                <div class="modal-footer center" id="btn-loginUser">
                    <a class="btn light-blue darken-4" id="btn-iconNewUser" href="Authentication/cadNewUser.php"><img class="iconNewUser" src="src/img/user-plus.png" alt="Cadastrar Novo Usuario">Novo Cadastro</a>
                </div>
            </form>    
        </div>  
        
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            const elemsModal = document.querySelectorAll(".modal");
            const instancesModal = M.Modal.init(elemsModal,{

            });
            document.addEventListener('DOMContentLoaded', function() {

                let drop = document.querySelector(".dropdown-trigger1");
                let intancesDrop = M.Dropdown.init(drop);
            });
        </script>
    </body>
</html>