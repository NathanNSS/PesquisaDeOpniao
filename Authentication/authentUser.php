<?php
session_start();
include_once('../conexaoBD.php');
$redirect = "../index.php";

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
    $local = limpar($_POST['local']);
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
                $_SESSION['id_usuario'] = $dados['id_user'];
                $_SESSION['menssagem'] = "Bem vindo &nbsp;"."<b>$usuario</b>";
                header("location: ../IndexLogado.php");
            }
            else{
                $_SESSION['menssagem'] = "Senha Invalida!";
                header("location:$local");

            }

        }
        else{
            $_SESSION['menssagem'] = "O Usuario $usuario Não Existe!";
            header("location:$local");
        }
    }
    else{
       $_SESSION['menssagem'] = "Prencha os Campos para efetuar o Login!";
       header("location:$local");
    }
    foreach ($erros as $valores) {
        echo "<b><font color='#FF0000'>".$valores."</font></b><br>";
    } 
}

?>