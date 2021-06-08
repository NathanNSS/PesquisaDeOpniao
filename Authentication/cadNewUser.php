<?php
//session_start();
include_once('../conexaoBD.php');
require_once "../menssagens.php";
$redirect = "contExclusivo.php";

function limpar($inputs){
    global $linkBD;
    $var = mysqli_escape_string($linkBD,$inputs);
    $var = htmlspecialchars_decode($var);
    $var = str_replace("\\","",$var);
    $var = str_replace(";","",$var);
    return $var;
}

//INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`) VALUES (NULL, 'administrador2', 'admin2', MD5('12345'));

// verfica se alguem clicou no botão entrar -> Escape de caracteres especiais nos campos usuario e senha (evitando um possivel SQL injection)
if(isset($_POST['btn-entrar'])){
    $erros = array();
    $usuario = limpar($_POST['usuario']);
    $senha = limpar($_POST['senha']);
    
    // verifica se os campos usuario e senhas estão vazios -> faz uma busca do "usuario" digitado no login ao banco e grava o 
    //resultado na variavel $resultado
    if (!empty($usuario) or !empty($senha)){ 
        $sqlBuscaDeUsu = "SELECT usuario FROM usuario WHERE usuario = '$usuario'";
         $resultado = mysqli_query($linkBD,$sqlBuscaDeUsu);
            
            // utila a variavel $resultado em  mysqli_num_rows , mysqli_num_rows busca o numero de linhas resultante da busca ($sqlBuscaDeUsu)
            //if verifica se o resultante e maior (>) que 0, caso o valor seja menor ele passa por (else) retorna para o usuario "Este Usuario Não Existe!" 
            //caso contrario (seja maior que 0) prossegue para a proxima etapa --> A proxima etapa ira verificar o "$usuario" e a "$senha" no banco
            //e salva na variavel $resultado depois de ter passado pelo tratamento da função mysqli_query
        if(mysqli_num_rows($resultado) > 0){
            $senha = md5($senha);
            $sqlConsuDeUsuSenha = "SELECT * FROM usuario WHERE usuario ='$usuario' AND senha='$senha'";
            $resultado = mysqli_query($linkBD,$sqlConsuDeUsuSenha);

            // utila a variavel $resultado em  mysqli_num_rows , mysqli_num_rows busca o numero de linhas resultante da busca ($sqlConsuDeUsuSenha)
            //if verifica se o resultante e igual a 1 (a busca no banco foi para achar se existe algum usuario e senha que corresponde ao que o usuario digito)
            //caso o valor seja diferente de 1 ele passa por (else) retorna para o usuario "Senha Invalida!"
            //caso contrario prossegue para a proxima etapa --> libera o usuario para a pagina atraves do "header("location:$redirect");"
            if(mysqli_num_rows($resultado) == 1){
                $dados = mysqli_fetch_array($resultado);
				mysqli_close($linkBD);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id'];
                header("location:$redirect");
            }
            else{
                $erros[] = "<br>Senha Invalida!<br>";

            }

        }
        else{
            $erros[] = "<br>O Usuario $usuario Não Existe!<br>";
        }
    }
    else{
       $erros[] = "<br>Prencha os Campos para efetuar o Login!<br>";
    }
    foreach ($erros as $valores) {
        echo "<b><font color='#FF0000'>".$valores."</font></b><br>";
    } 
}

if(isset($_POST['btn-cadUser'])){
    $criarUsuario = limpar($_POST['c_usuario']);
    $criarEmail = limpar($_POST['c_email']);
    $criarSexo = limpar($_POST['sexo']);
    $criarDatNac = limpar($_POST['c_dataNac']);
    $criarSenha = md5(limpar($_POST['c_senha']));
    
    $sqlBuscaDeUsu = "SELECT id_user FROM usuario WHERE usuario = '$criarUsuario' AND senha = '$criarSenha'";

    $resultUser = mysqli_query($linkBD,$sqlBuscaDeUsu);
    if(!empty($criarUsuario) and !empty($criarEmail) and !empty($criarSenha)){
        if(!mysqli_num_rows($resultUser) >= 1){

            $sqlBuscaDeUsu = "SELECT email FROM usuario WHERE email = '$criarEmail'";

            $resultEmail = mysqli_query($linkBD,$sqlBuscaDeUsu);
            if(!mysqli_num_rows($resultEmail) >= 1){


                $sqlInsert = "INSERT INTO `usuario`(`enquetes_user`,`votos_user`,`usuario`, `email`, `sexo`, `data_nac`, `senha`) VALUE (NULL,NULL,'$criarUsuario', '$criarEmail', '$criarSexo',  '$criarDatNac', '$criarSenha')";
                if(mysqli_query($linkBD, $sqlInsert)){
                    $_SESSION['menssagem'] = "Usuairo &nbsp;"."<b>$criarUsuario</b>"."&nbsp; Foi Cadastrado Com Sucesso";
                    header("location: ../index.php");
                }
                else{
                    echo "Erro Ao Criar Conta";
                }
            }
            else{
                echo "Este E-Mail Ja Esta Sendo Usado";
            }    
        }
        else{
            echo "Ou Este Usuario ou Esta Senha Ja Existe";
        }
    }else{
        $_SESSION['menssagem'] = "Os campos &nbsp;<b>Usuario</b>,&nbsp; <b>Senha</b>&nbsp; e &nbsp;<b>E-mail</b>&nbsp; são Obrigatorios !!";
        header("location: cadNewUser.php");
    }
}

?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro</title>

        <link rel="stylesheet" href="../src/css/cadUser.css">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <Style>
            .input-field>label{
                color:#36373b   ;
            }
        </Style>
    </head>
    <body>
        <div>
            <div class="row">
                <div class="card z-depth-5 col push-l4 l4 pull-l4 push-s1 s10 pull-s1" id="card">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" class="form-cadUser"  method="POST">
                        <h3 class="center">Cadastro De Usuario</h3>
                        <div class="modal-content">
                            <div class="input-field">
                                <i class="material-icons prefix">account_box</i>
                                    <input id="icon_prefix" type="text" autofocus name="c_usuario" class="validate">
                                <label for="icon_prefix">Nome</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">email</i>
                                    <input id="icon_prefix" type="email" name="c_email" class="validate">
                                <label for="icon_prefix">E-Mail</label>
                            </div>
                            <fieldset>
                            <i class="material-icons prefix">wc</i>
                                <span>Sexo</span>
                            <p id="radio-btn" >
                                <label>
                                    <input class="with-gap" name="sexo" value="M" type="radio"  />
                                    <span>Masculino</span>
                                </label>
                                <label>
                            <input class="with-gap" name="sexo" value="F" type="radio"  />
                                    <span>Feminino</span>
                                </label>
                                <label>
                                    <input class="with-gap" name="sexo" value="N Inf" type="radio"  />
                                    <span>Prefiro não Informar</span>
                                </label>
                            </p>
                           </fieldset>

                            <div class="input-field" id="datNac">
                                <i class="material-icons prefix">date_range</i>
                                    <input id="icon_prefix" type="date" name="c_dataNac" class="validate">
                                <label for="icon_prefix">Data de Nascimento</label>
                            </div>            
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                    <input id="icon_prefix" type="password" name="c_senha" class="validate">
                                <label for="icon_prefix">Senha</label>
                            </div>

                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                    <input id="icon_prefix" type="password" name="c_senha" class="validate">
                                <label for="icon_prefix">Confirma Senha</label>
                            </div>
                            </div>
                        
                            <div class="card-action center" id="btn-cadUser">
                                <button class="btn green " type="submit" name="btn-cadUser">Cadastrar</button>&nbsp;&nbsp;&nbsp;
                                <button class="btn red" type="reset" name="limpar">Limpar</button>   
                            </div>
                        </div>  
                    </form>
                    
                </div>
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