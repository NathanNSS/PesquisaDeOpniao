<?php
//conexão com Banco
require_once "conexaoBD.php";

//Menssagem
require_once "menssagens.php";


$sqlTotal = "SELECT SUM(IFNULL(Item1,0) + IFNULL(Item2,0) + IFNULL(Item3,0) + IFNULL(Item4,0) + IFNULL(Item5,0) + IFNULL(Item6,0) + IFNULL(Item7,0) + IFNULL(Item8,0) + IFNULL(Item9,0) + IFNULL(Item10,0) ) AS total FROM enquete_simples_num  WHERE Cod_Enquete_Simples_Num = 614807";

$resultadoTotal = mysqli_query($linkBD, $sqlTotal);
//var_dump($linhas); 
if(mysqli_num_rows($resultadoTotal) > 0){
    $total = mysqli_fetch_array($resultadoTotal);
    echo $total['total'];
    print_r($total['total']);
    while($linhas = mysqli_fetch_array($resultadoTotal)){
        print_r($linhas);
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
        
        
        <!-- *** -->
        <title>Projeto</title>
    </head>
    <body class="">
                <h1>Select do HTML</h1>
                <div class="input-field" id="selectFiltro">   
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
                        <select name="filtro">
                            <option value="">Selecione</option>
                            <option value="DESC">Mais Recente</option>
                            <option value="ASC">Mais Antigo</option>
                        </select>
                        
                    </form>
                </div>
                <h2>Select do Materialize</h2>
                <div class="input-field col s12">
                    <select>
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                    <label>Materialize Select</label>
                </div>
                <br><br>
                <ul id="dropdown2" class="dropdown-content">
                    <li><a href="#!">one</a></li>
                    <li><a href="#!">two</a></li>
                    <li><a href="#!">three</a></li>
                </ul>
                <a class="btn dropdown-trigger1" href="#!" data-target="dropdown2">Dropdown<i class="material-icons right">arrow_drop_down</i></a>
                            

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