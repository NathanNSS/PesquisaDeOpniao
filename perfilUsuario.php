<?php
//conexão com Banco
require_once "conexaoBD.php";

//Menssagem
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
    if($_SESSION['logado'] = TRUE and $_SESSION['id_usuario'] !== NULL){
        $codUser = $_SESSION['id_usuario'];
        if($codUser == '212121'){
            $_SESSION['menssagem'] = "Painel de Controle";
            header("location: admin.php");
        }
        $sqlBuscaEnqueteDoUsuario = "SELECT titulo, data_criacao, Cod_Enquete_Simples_Caracteres FROM enquete_simples_caracteres WHERE id_user = $codUser ORDER BY `enquete_simples_caracteres`.`data_criacao` DESC";

        $sqlBuscaVotosDoUsuario = "SELECT cod_enquete, titulo, voto_user, quant_votos, data_voto FROM votos_usuario WHERE id_user = $codUser ORDER BY `votos_usuario`.`data_voto` DESC";

        $sqlBuscaDadosUsuario = "SELECT * FROM usuario WHERE id_user = $codUser";

        $resultPerfilUsuario = mysqli_query($linkBD, $sqlBuscaDadosUsuario);
        $resultEnqueteDoUsuario = mysqli_query($linkBD, $sqlBuscaEnqueteDoUsuario);
        $resultVotosDoUsuario = mysqli_query($linkBD, $sqlBuscaVotosDoUsuario);

        $totalDadosEnqueteDoUsuario = mysqli_num_rows($resultEnqueteDoUsuario);
        $totalDadosVotosDoUsuario = mysqli_num_rows($resultVotosDoUsuario);

        $dadosUsuario = mysqli_fetch_array($resultPerfilUsuario);

        
        $sexo = $dadosUsuario['sexo'];

        switch ($sexo) {
            case 'M':
                $sexoM = "checked";
                $sexoF = "";
                $sexoNinf = "";
                break;
            case 'F':
                $sexoM = "";
                $sexoF = "checked";
                $sexoNinf = "";
                break;
            case 'N Inf':
                $sexoM = "";
                $sexoF = "";
                $sexoNinf = "checked";
                break;
        }
       
    }
}else{
    $_SESSION['menssagem'] = "Faça o Login Para Acessar esta Pagina";
    header("location:Index.php");
}

if(isset($_POST['btn-editar'])){
    $criarUsuario = limpar($_POST['usuario']);
    $criarEmail = limpar($_POST['email']);
    $criarSexo = limpar($_POST['sexo']);
    $criarDatNac = limpar($_POST['dataNac']);
    $criarSenha = limpar($_POST['senha']);
    
    $sqlBuscaDeUsuSenha = "SELECT senha FROM usuario WHERE id_user = '$codUser' ";

    $resultUserSenha = mysqli_query($linkBD,$sqlBuscaDeUsuSenha);
    $verfSenha = mysqli_fetch_array($resultUserSenha);

    $sqlBuscaDeUsu = "SELECT id_user, senha FROM usuario WHERE usuario = '$criarUsuario' AND senha = '$criarSenha' AND id_user != '$codUser' ";
    $resultUser = mysqli_query($linkBD,$sqlBuscaDeUsu);
    
    if(!empty($criarUsuario) and !empty($criarEmail) and !empty($criarSenha)){ 
        
        if(!mysqli_num_rows($resultUser) >= 1){
            $s = $verfSenha['senha'];

            if($s == $criarSenha){
                $defSenha =  $criarSenha;
            }elseif($s !== $criarSenha){
                $defSenha = md5($criarSenha);
            }else{
                header("location: index.php");
            }
           
            $sqlBuscaDeUsu = "SELECT email FROM usuario WHERE email = '$criarEmail' AND id_user != '$codUser'";

            $resultEmail = mysqli_query($linkBD,$sqlBuscaDeUsu);
            if(!mysqli_num_rows($resultEmail) >= 1){
                $sqlInsert = "UPDATE usuario SET usuario = '$criarUsuario', email = '$criarEmail', sexo = '$criarSexo', senha = '$defSenha', data_nac = '$criarDatNac'  WHERE  id_user = '$codUser' ";
                
                if(mysqli_query($linkBD, $sqlInsert)){
                    $_SESSION['menssagem'] = "Usuairo &nbsp;"."<b>$criarUsuario</b>"."&nbsp; Foi Editado Com Sucesso";
                    header("location: perfilUsuario.php");
                }
                else{
                    $_SESSION['menssagem'] = "Ocorreu um Erro ao Editar os Dados da sua Conta";
                    header("location: perfilUsuario.php");
                }
            }
            else{
                $_SESSION['menssagem'] = "Este E-Mail Ja Esta Sendo Usado";
                header("location: perfilUsuario.php");
            }    
        }
        else{
            $_SESSION['menssagem'] = "Ou Este Usuario ou Esta Senha Ja Existe";
            header("location: perfilUsuario.php");
        }
    }else{
        $_SESSION['menssagem'] = "Os campos &nbsp;<b>Usuario</b>,&nbsp; <b>Senha</b>&nbsp; e &nbsp;<b>E-mail</b>&nbsp; são Obrigatorios !!";
        header("location: perfilUsuario.php");
    }
}

function formataData($data){
    $array1 = explode(" ",$data);
    $array2 = $array1[0];
    $array3 = $array1[1];
    $array2 = explode("-",$array2);
    $array3 = explode(":",$array3);
    $novaData = $array2[2]."/".$array2[1]."/".$array2[0]." ".$array3[0].":".$array3[1];
    return $novaData;
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
        <link rel="stylesheet" href="src/css/cadUser.css">
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
                        <form action="IndexLogado.php" method="GET">
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
                        
                        <a href="#!" id="linkLogin" class="dropdown-trigger1" data-target="dropdownLogout">
                            <img class="iconUser" src="src/img/user-circle.png" alt="icon user">
                            <span><?php echo $dadosUsuario['usuario'];?></span>
                        </a>

                        <ul id="dropdownLogout" class="dropdown-content">
                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?logout=True">Logout<i class="material-icons" id="iconLogout">exit_to_app</i></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="perfilUsuario.php" id="linkLogin" class="modal-trigger">Perfil</a>
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
                    <form action="IndexLogado.php" method="GET">
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
            <div class="col s12 m6 push-m3" id="PerfilUsuario">

                <div class="card lighten-5">
                    <div class="card-content">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                            <input name="usuario" type="text" value="<?php echo $dadosUsuario['usuario']?>" class="input-infoUser" placeholder="Usuario">
                            <input name="email" type="email" value="<?php echo $dadosUsuario['email']?>" class="input-infoUser" placeholder="E-Mail">
                            <input name="senha" type="password" value="<?php echo $dadosUsuario['senha']?>" class="input-infoUser" placeholder="Senha">
                            <input name="dataNac" type="date" value="<?php echo $dadosUsuario['data_nac']?>" class="input-infoUser" placeholder="00/00/0000">
                            <fieldset>
                            <i class="material-icons prefix">wc</i>
                                <span>Sexo</span>
                            <p id="radio-btn" >
                                <label>
                                    <input class="with-gap" name="sexo" <?php echo $sexoM?> value="M" type="radio"  />
                                    <span>Masculino</span>
                                </label>
                                <label>
                            <input class="with-gap" name="sexo" <?php echo $sexoF?> value="F" type="radio"  />
                                    <span>Feminino</span>
                                </label>
                                <label>
                                    <input class="with-gap" name="sexo" <?php echo $sexoNinf?> value="N Inf" type="radio"  />
                                    <span>Prefiro não Informar</span>
                                </label>
                            </p>
                            </fieldset>
                            <!-- <input name="sexo" type="text" value="" class="input-infoUser" placeholder="Sexo"> -->
                            <button name="btn-editar" type="submit" class="btn waves-effect waves-light">
                                Editar
                                <i class="material-icons left">create</i>
                            </button>
                        </form>
                    </div>
                </div> 

                <div class="card ">
                    <br>
                    <h5 class="center"><b>Minhas Enquetes</b></h5>
                    <div class="card-content white-text">
                        <table id="tabUserMinhasEnq" class="responsive-table striped">
                            <thead>
                                <tr class="highlight">
                                    <th>Titulo da Enquete</th>
                                    <th class="centered" title="Data da Criação da Enquete">Data de Criação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                if($totalDadosEnqueteDoUsuario >= 1){

                                while ($dados = mysqli_fetch_array($resultEnqueteDoUsuario)) {
                                
                                ?>
                            
                                <tr>
                                    <td>
                                       <?php echo $dados['titulo'] ?>
                                    </td>
                                    <td>
                                       <?php if(empty($dados['data_criacao'])){
                                          echo 'Sem dados <i class="material-icons left">sentiment_dissatisfied</i>';
                                       }else{
                                           echo formataData($dados['data_criacao']);
                                       } 
                                       ?>
                                    </td>
                                    <td>
                                        <a class="waves-effect waves-light light-blue darken-4 btn" target="_blank"
                                        href="votacao.php?chave=<?php echo $dados['Cod_Enquete_Simples_Caracteres'];?>"><i class="material-icons left">reply</i>Acessar
                                        </a>
                                       
                                    </td>


                                    <!-- <td><a href="pagTeste.php?chave=<?php echo $dados['Cod_Enquete_Simples_Caracteres'];?>" ><i class="material-icons">arrow_forward</i></a></td> -->
                                </tr>
                                <?php 
                                    }
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div> 

                <div class="card ">
                    <br>
                    <h5 class="center"><b>Participações em Emquetes</b></h5>
                    <div class="card-content white-text">
                        <table id="tabUserParticipacaoEnq" class="responsive-table striped centered">
                            <thead>
                                <tr class="highlight">
                                    <th>Titulo da Enquete</th>
                                    <th>Opção Votada</th>
                                    <th >Quantidade de Votos</th>
                                    <th title="Data Do Ultimo Voto Realizado">Data do Voto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                if($totalDadosVotosDoUsuario >= 1){

                                while ($dadosVotos = mysqli_fetch_array($resultVotosDoUsuario)) {
                                
                                ?>
                            
                                <tr>
                                    <td>
                                       <?php echo $dadosVotos['titulo'] ?>
                                    </td>
                                    <td>
                                       <?php echo $dadosVotos['voto_user'] ?>
                                    </td>
                                    <td>
                                       <?php echo $dadosVotos['quant_votos'] ?>
                                    </td>
                                    <td>
                                       <?php if(empty($dadosVotos['data_voto'])){
                                          echo 'Sem dados <i class="material-icons left">sentiment_dissatisfied</i>';
                                       }else{
                                           echo formataData($dadosVotos['data_voto']);
                                       } 
                                       ?>
                                    </td>
                                    <td>
                                        <a class="waves-effect waves-light light-blue darken-4 btn" target="_blank"
                                        href="votacao.php?chave=<?php echo $dadosVotos['cod_enquete'];?>"><i class="material-icons left">reply</i>Acessar
                                        </a>
                                       
                                    </td>

                                </tr>
                                <?php 
                                    }
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div> 

            


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
                let elems = document.querySelectorAll('.sidenav');
                let instances = M.Sidenav.init(elems);
               
                let drop = document.querySelectorAll(".dropdown-trigger1");
                let intancesDrop = M.Dropdown.init(drop);
            });
        </script>
    </body>
</html>