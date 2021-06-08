<?php
//conexão com Banco
require_once "conexaoBD.php";

//Menssagem
require_once "menssagens.php";

// echo "Projeto de Faculdade !!";

if(isset($_SESSION['id_usuario'])){
    if($_SESSION['logado'] = TRUE and $_SESSION['id_usuario'] !== NULL){
        echo $_SESSION['logado'];
        echo $idUser = $_SESSION['id_usuario'];

        $sqlUser = "SELECT usuario, email FROM usuario WHERE id_user = '$idUser'";
        $User = mysqli_query($linkBD, $sqlUser);
        $infUser = mysqli_fetch_array($User);
        echo " ---- Nome:".$infUser['usuario'];
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
        echo "Redirecionando Para Enquete Simples!";
        header("location:criacaoEnqueteSimples.php");
}
echo $_SESSION['logado'] = false;

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
        <link rel="stylesheet" href="src/css/teste.css">
        <!-- *** -->
        <title>Projeto</title>
     </head>
    <body class="grey lighten-2">
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
                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="#!">one</a></li>
                    <li><a href="#!">two</a></li>
                    <li class="divider"></li>
                    <li><a href="#!">three</a></li>
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
        <?php
            function escrLogado(){
                echo "logado";
            }
            function escrDeslogado(){
                echo "deslogado";
            }
            $_SESSION['logado']?escrLogado():escrDeslogado();
        ?>
          
            <h1>Deslogado</h1>


            <div id="loginUser" class="modal card">
            <form action="Authentication/authentUser.php" class="form-loginUser"  method="POST">
                <h3 class="center">Login</h3>
                <div class="modal-content">           
                    <div class="input-field">
                        <i class="material-icons prefix">assignment_ind</i>
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
                let elems = document.querySelectorAll('.sidenav');
                let instances = M.Sidenav.init(elems);
               
                let drop = document.querySelector(".dropdown-trigger1");
                let intancesDrop = M.Dropdown.init(drop);
            });
            
        </script>
    </body>
</html>