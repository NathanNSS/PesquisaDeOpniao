<?php
require_once "conexaoBD.php";
require_once "menssagens.php";

function limpar($inputs){
    global $linkBD;
    $var = mysqli_escape_string($linkBD,$inputs);
    $var = htmlspecialchars_decode($var);
    $var = str_replace("\\","",$var);
    $var = str_replace(";"," ",$var);
    if(empty($var)){
      $var = "none";
    }
    return $var;
}
if(isset($_POST['btn-criar'])){
  $_SESSION["gera2"] = $_SESSION["gera"] = rand(100000,999999);
  echo "Redirecionando Para Enquete Simples!";
  header("location:criacaoEnqueteSimples.php");
}  
  
  
if(isset($_GET['chave'])){
    $chave = limpar($_GET['chave']);

    $sqlSelect = "SELECT * FROM enquete_simples_caracteres where Cod_Enquete_Simples_Caracteres = '$chave'";
    
    $resultado = mysqli_query($linkBD, $sqlSelect);
    if(mysqli_num_rows($resultado) >= 1){
        $dados = mysqli_fetch_array($resultado);

        if(!empty($dados['titulo']) and ($dados['descricao']) and ($dados['item1'])){
            
            $id_user = limpar($dados["id_user"]);
            $private = limpar($dados["private"]);
            $unico = limpar($dados["unico"]);
            $titulo = limpar($dados["titulo"]);
            $descricao = limpar($dados["descricao"]);
            $item1 = limpar($dados["item1"]);
            $item2 = limpar($dados["item2"]);
            $item3 = limpar($dados["item3"]);
            $item4 = limpar($dados["item4"]);
            $item5 = limpar($dados["item5"]);
            $item6 = limpar($dados["item6"]);
            $item7 = limpar($dados["item7"]);
            $item8 = limpar($dados["item8"]);
            $item9 = limpar($dados["item9"]);
            $item10 = limpar($dados["item10"]);
          
          if($unico == "on"){
            
          }
            
        }
        else{
            mysqli_close($linkBD);
            $_SESSION['menssagem'] = "Esta Enquete se encontra vazia ";
            header("location: index.php");
        }
    }
    else{
        mysqli_close($linkBD);
        $_SESSION['menssagem'] = "Não existe esta enquete !!";
        header("location: index.php");
    }
}

// var_dump($unico);
if(isset($_SESSION['exibG']) AND ($_SESSION['exibG'] == "none" AND $_SESSION['exibO'] == "block")){

  switch($unico){
    case "on":
      if((!isset($_COOKIE[$chave]))){
        $exibO = "block";
        $exibG = "none";
      }else{
        $exibO = "none";
        $exibG = "block";
      }
    break;
    case "none":
      if((!isset($_COOKIE[$chave]))){
        $exibO = "block";
        $exibG = "none";
      }else{
        $exibO = "block";
        $exibG = "block";
      }
    break;
  }
}
else{
  if((!isset($_COOKIE['chave'])) or $unico != "on"){
    $exibO = "block";
    $exibG = "none";
  }else{
    $exibO = "none";
    $exibG = "block";
  }
}

//Busca se o Usuario ja votor na Tabela
if(isset($_SESSION['id_usuario'])){

  $buscaVotacao = "SELECT * FROM votos_usuario WHERE cod_enquete = '$chave' and id_user = '$id_user' and titulo = '$titulo'";
  $buscaRows = mysqli_query($linkBD, $buscaVotacao);                
  $RowsBusca = mysqli_num_rows($buscaRows);

  //mysqli_close($linkBD);

}

//Controla as Enquete Privadas

if((isset($_SESSION['id_usuario'])) AND $private == "on" AND $id_user == $_SESSION['id_usuario'] AND $RowsBusca >= 1){
  $exibG = "block";
}
elseif(!isset($_SESSION['id_usuario']) OR $id_user !== $_SESSION['id_usuario']){
  if($private == "on"){
    $exibG = "none";
    $exibGraphPrivate = FALSE;
  }
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
        
        <title>Projeto</title>


        <?php 
          require_once "graficos.php";
          $sqlTotal = "SELECT SUM(IFNULL(Item1,0) + IFNULL(Item2,0) + IFNULL(Item3,0) + IFNULL(Item4,0) + IFNULL(Item5,0) + IFNULL(Item6,0) + IFNULL(Item7,0) + IFNULL(Item8,0) + IFNULL(Item9,0) + IFNULL(Item10,0) ) AS total FROM enquete_simples_num  WHERE Cod_Enquete_Simples_Num = '$chave'";
        
          $resultadoTotal = mysqli_query($linkBD, $sqlTotal);
          $total = mysqli_fetch_array($resultadoTotal);
          $total = $total['total'];
        ?>

    </head>
    <body>

    <!-- Menu De Navegação -->
    <div class="navbar-fixed">
        <div class="row">
            <nav class="light-blue darken-4">
                <div class="nav-wrapper container">
                    <a href="Index.php" class="brand-logo">Pesquisa de Opinão ?¿</a>
                    <ul>
                        <li class="right"><a class="waves-effect waves-light modal-trigger" id="createEnquete" href="#criacao">Criar Enquete</a></li>
                        
                        <li class="right bottom">
                            <form action="index.php" method="GET">
                                <div class="input-field light-blue darken-4">
                                    <input id="search" class="light-blue darken-4   white-text"  type="search" name="pesquisa" required>
                                    <label class="label-icon" for="search"><i class="material-icons ">search</i></label>
                                    <i class="material-icons">close</i>    
                                </div>
                            </form>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </div>
    </div>

        <div class="row container">
          <div class="col s12 m12 l12">
                <h3 style="display:<?php echo $exibO ?>;"><?php echo $titulo;?></h3><br>
                <h5 style="display:<?php echo $exibO ?>;"><?php echo $descricao?></h5><br>
            <div class="col s12 m6 l6">
              <?php
                  if($exibO == "none"){
                    require_once "votoUnic.php";
                  }
                  
              ?>
              <form style="display:<?php echo $exibO ?>;" method="POST" action="proceVoto.php">
                  <input type="hidden" name="chave" value="<?php echo $chave?>" ><br><br>
                  <label>
                    <input class="with-gap" value="<?php echo $titulo?>" name="title" type="hidden"  />
                    <input class="with-gap" value="<?php echo $item1?>-1" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item1?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item2?>;">
                    <input class="with-gap" value="<?php echo $item2?>-2" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item2?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item3?>;">
                    <input class="with-gap" value="<?php echo $item3?>-3" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item3?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item4?>;">
                    <input class="with-gap" value="<?php echo $item4?>-4" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item4?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item5?>;">
                    <input class="with-gap" value="<?php echo $item5?>-5" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item5?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item6?>;">
                    <input class="with-gap" value="<?php echo $item6?>-6" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item6?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item7?>;">
                    <input class="with-gap" value="<?php echo $item7?>-7" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item7?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item8?>;">
                    <input class="with-gap" value="<?php echo $item8?>-8" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item8?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item9?>;">
                    <input class="with-gap" value="<?php echo $item9?>-9" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item9?></span>
                  </label><br><br>
                  <label style="display:<?php echo $item10?>;">
                    <input class="with-gap" value="<?php echo $item10?>-10" name="simp" type="radio"  />
                    <span class="black-text"><?php echo $item10?></span>
                  </label><br><br>

                  <input type="submit" value="Votar" name="btn-votar" class="btn">
              </form>
            </div>    
            <div class="col s12 m6 l6">
              
              <div  id="piechart" style="display:<?php echo $exibG?>; width: 100%; height: 300px;"></div>
              <div  id="top_x_div" style="display:<?php echo $exibG?>;width: 100%; height: 250px;"></div>
              

              
              <?php
              

              if(isset($exibGraphPrivate)){

                switch($exibGraphPrivate){
                  case FALSE:
                    require_once "privateGraph.php";
                    break;
                }
              }
              ?>          
              <div class="col s12 m4 l4" style="display:<?php echo $exibG?>">
                <div  class="white z-depth-2">
                  <div class="card z-depth-0">
                      <div class="card-content black-text">

                      <span  class="card-title"><h5 id="total"><?php echo "Votos ".$total; ?></h5></span>
                      </div>
                    </div>
                  </div>
                </div>
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
        <div  id="top_x_div" style="width: 100%; height: 250px;"></div>
        <div class="result"></div>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            var numero = document.getElementById('total');
            var min = 1;
            var max = <?php echo $total; ?>;
            var duracao = 900;

            for (var i = min; i <= max; i++) {
              setTimeout(function(nr) {
                numero.innerHTML = `Votos ${nr}`;
              }, i * duracao / max, i);
            }
            const elemsModal = document.querySelectorAll(".modal");
            const instancesModal = M.Modal.init(elemsModal,{

            });
        </script>
    </body>
</html>