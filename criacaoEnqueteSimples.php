<?php 
//session_start();
require_once "conexaoBD.php";
require_once "menssagens.php";


function limpar($inputs){
    global $linkBD;
    $var = mysqli_escape_string($linkBD,$inputs);
    $var = htmlspecialchars_decode($var);
    $var = str_replace("\\","",$var);
    $var = str_replace(";","",$var);
    return $var;
}

if(isset($_SESSION['id_usuario'])){
    if($_SESSION['logado'] = true && $_SESSION['id_usuario'] !== NULL){

        $id_user = limpar($_SESSION['id_usuario']);
        $logado = "";
        $descPriv = "Somente Você Poderá Ver o Resultado !";
        header("location:criacaoEnqueteLogado.php");
    }else{
        $logado = "disabled";
        $descPriv = "<s>Somente Você Poderá Ver o Resultado !</S> <br> <b>Faça o Login Para Ativar este Recurso</b>";
        $id_user = NULL;
    }
}else{
    $logado = "disabled";
    $descPriv = "<s>Somente Você Poderá Ver o Resultado !</S> <br> <b>Faça o Login Para Ativar este Recurso</b>";
    $id_user = NULL;
}


if((!empty($_SESSION['gera'])) && ($_SESSION['gera'] == $_SESSION['gera2'])){
    if(isset($_POST['btn-criar'])){
        if($_POST['enquete'] == "s"){

        }else {
            header("location:Index.php");
        }
    }
}else{
    $_SESSION['menssagem'] = "Acesso Negado !";
    header("location: index.php");
}

function identNull($var){
    if($var == NULL ){
        echo NULL;
    }else{
        echo $id_user;
    }
}
if(isset($_POST["btnEnviar"])){
    if(!empty($_POST['chave']) and ($_POST['titulo']) and ($_POST['descricao']) and ($_POST['item1'])){
        $idChave = limpar($_POST["chave"]);
        $unico = limpar($_POST['unico']); 
        $privateResult = limpar($_POST['privateResult']); 
        $titulo = limpar($_POST["titulo"]);
        $descricao = limpar($_POST["descricao"]);
        $item1 = limpar($_POST["item1"]);
        $item2 = limpar($_POST["item2"]);
        $item3 = limpar($_POST["item3"]);
        $item4 = limpar($_POST["item4"]);
        $item5 = limpar($_POST["item5"]);
        $item6 = limpar($_POST["item6"]);
        $item7 = limpar($_POST["item7"]);
        $item8 = limpar($_POST["item8"]);
        $item9 = limpar($_POST["item9"]);
        $item10 = limpar($_POST["item10"]);

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        if($id_user !== NULL){
            $sqlInset = "INSERT INTO `enquete_simples_caracteres`(`Cod_Enquete_Simples_Caracteres`, `unico`, `private`, `id_user`, `titulo`, `data_criacao`, `descricao`, `item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `item9`, `item10`) 
            VALUES ('$idChave',  '$unico', '$privateResult', '$id_user', '$titulo', '$data' , '$descricao', '$item1', '$item2', '$item3', '$item4', '$item5', '$item6', '$item7', '$item8', '$item9', '$item10')"; 

            $sqlInset2 = "INSERT INTO `enquete_simples_num`(`Cod_Enquete_Simples_Num`, `id_user`) VALUES ('$idChave', '$id_user')";
            
            /////$sqlInsetUser = "INSERT INTO `usuario`(`enquetes_user`) VALUES ('$idChave', NULL)";
        }else{

            $sqlInset = "INSERT INTO `enquete_simples_caracteres`(`Cod_Enquete_Simples_Caracteres`, `unico`, `private`, `id_user`, `titulo`,`data_criacao`, `descricao`, `item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `item9`, `item10`) 
            VALUES ('$idChave',  '$unico', '$privateResult', NULL, '$titulo','$data', '$descricao', '$item1', '$item2', '$item3', '$item4', '$item5', '$item6', '$item7', '$item8', '$item9', '$item10')"; 

            $sqlInset2 = "INSERT INTO `enquete_simples_num`(`Cod_Enquete_Simples_Num`, `id_user`) VALUES ('$idChave', NULL)";
        }
        echo $sqlInset;
        echo "<br> ----- SQL Num ----- <br>"; 
        echo $sqlInset2; 
        if(mysqli_query($linkBD,$sqlInset)){
            mysqli_query($linkBD,$sqlInset2);
         
            $_SESSION['menssagem'] = "Enquete &nbsp;<b>$titulo</b>&nbsp; foi Criada<br>";
            mysqli_close($linkBD);
            header("location: votacao.php?chave=$idChave");
        }
        else{
            $_SESSION['menssagem'] = "Erro Ao Criar a Enquete &nbsp;<b>$titulo</b>&nbsp;<br>";
            mysqli_query($linkBD,$sqlInset);
            mysqli_close($linkBD);
            var_dump($id_user);
            var_dump($sqlInset);
            var_dump($sqlInset2);
            return;
            // header("location: index.php");
        }
    }
    else{
        $_SESSION['menssagem'] = "Prencha Os Campos da Enquete Antes de Enviar";
        mysqli_close($linkBD);
        header("location: criacaoEnqueteSimples.php");
        return;
    }        
}
require_once "paginacaoPesq.php";
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- CSS da NAV-->
        <link rel="stylesheet" href="src/css/Index.css">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Projeto</title>
        <style>
        s{
            color:red;
        }
        </style>
    </head>
    <body>
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
                        <form action="Index.php" method="GET">
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
                    <form action="Index.php" method="GET">
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
            <div class=" col s12 m6 push-m3">
            <h2>Enquete Simples</h2>
    
      

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <blockquote class="col l5 z-depth-2">
                Apos a Criação, Copie a Url Para Poder Compartilhar a Enquete Mais Facilmente
            </blockquote>
                <div class="input-field col s12">
                        <input id="icon_prefix" type="hidden" value="<?php echo $_SESSION['gera']?>" name="chave">
                </div>
                <div class="col s12">
                    <div class="col s3">
                        <h5><i class="small material-icons">vpn_key</i>
                        <?php echo $_SESSION["gera"]?></h5>
                    </div>
                    <div class="input-field col s3">
                        <label class="tooltipped" data-tooltip="Somente Um Voto Por Usuario !">
                            <input type="checkbox" name="unico" />
                            <span class="black-text">Voto Unico</span>
                        </label>
                    </div>
                    <div class="input-field col s3">
                        <label class="tooltipped" data-tooltip="<?php echo $descPriv ?>">
                            <input type="checkbox" name="privateResult" <?php echo $logado ?>/>
                            <span class="black-text">Resultado Privado</span>
                        </label>
                    </div>
                    
                    <div class="input-field col s3">
                        <i class="material-icons prefix">title</i>
                        <input type="text" id="titulo" name="titulo" data-length="50" maxlength="50" class="validate">
                        <label for="icon_prefix">Titulo Para a Enquete</label>
                    </div>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">message</i>
                    <textarea id="descricao" data-length="150" name="descricao" class="materialize-textarea validate" maxlength="200"></textarea>
                    <label for="descricao">Descrição Da Enquete</label>
                </div>

                <div class="col s12">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">looks_one</i>
                        <input id="icon_prefix" type="text" name="item1" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 1</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <i class="material-icons prefix">looks_two</i>
                        <input id="icon_prefix" type="text" name="item2" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 2</label>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">looks_3</i>
                        <input id="icon_prefix" type="text" name="item3" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 3</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <i class="material-icons prefix">looks_4</i>
                        <input id="icon_prefix" type="text" name="item4" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 4</label>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">looks_5</i>
                        <input id="icon_prefix" type="text" name="item5" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 5</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <i class="material-icons prefix">looks_6</i>
                        <input id="icon_prefix" type="text" name="item6" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 6</label>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">filter_7</i>
                        <input id="icon_prefix" type="text" name="item7" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 7</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <i class="material-icons prefix">filter_8</i>
                        <input id="icon_prefix" type="text" name="item8" maxlength="20" class="validate">
                        <label for="icon_prefix">Item 8</label>
                    </div>
                </div>

                <div class="col s12">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">filter_9</i>
                        <input id="icon_prefix" type="text" name="item9" data-length="20" class="validate">
                        <label for="icon_prefix">Item 9</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <i class="material-icons prefix">timer_10</i>
                        <input id="icon_prefix" type="text" name="item10" data-length="20" class="validate">
                        <label for="icon_prefix">Item 10</label>
                    </div>
                </div>
               
                <div class="col s12">
                    <input class="btn green" type="submit" name="btnEnviar" value="Enviar">
                    <input class="btn red" type="reset" name="btnLimpar" value="Limpar">
                </div>
            </form> 
               
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

            const elemsTooltip = document.querySelectorAll(".tooltipped");
            const instancesTooltip = M.Tooltip.init(elemsTooltip,{
                //html:":)",
                position:"top"
            });


        </script>
    </body>
</html>





