<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          [ 'Item1', 'Item2', 'Item3', 'Item4', 'Item5', 'Item6'],
          [  165,      938,         522,             998,           450,      614.6],
         
        ]);

        var options = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          // hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script> -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      <?php

      $sqlListagemBD = "SELECT * FROM	enquete_simples_num WHERE Cod_Enquete_Simples_Num = '$chave'";
      $resultado = mysqli_query($linkBD, $sqlListagemBD);
      
      if(mysqli_num_rows($resultado) > 0){
      while ($dados = mysqli_fetch_array($resultado)) {
      ?>

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['<?php echo $item1 ?>',<?php echo $dados['Item1'] ?>  ],
          ['<?php echo $item2 ?>',<?php echo $dados['Item2'] ?>  ],
          ['<?php echo $item3 ?>',<?php echo $dados['Item3'] ?>  ],
          ['<?php echo $item4 ?>',<?php echo $dados['Item4'] ?>  ],
          ['<?php echo $item5 ?>',<?php echo $dados['Item5'] ?>  ],
          ['<?php echo $item6 ?>',<?php echo $dados['Item6'] ?>  ],
          ['<?php echo $item7 ?>',<?php echo $dados['Item7'] ?>  ],
          ['<?php echo $item8 ?>',<?php echo $dados['Item8'] ?>  ],
          ['<?php echo $item9 ?>',<?php echo $dados['Item9'] ?>  ],
          ['<?php echo $item10 ?>',<?php echo $dados['Item10'] ?>  ],
         
        ]);

        var options = {
          title: '<?php echo $titulo ?>'
        };
        <?php
        }
        }
        ?>
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <!-- <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year','Quant Item'],
          ['Item1', 44],
          ['Item2', 42],
          ['Item3', 22],
          ['Item4', 21]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script> -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      // SELECT SUM(IFNULL(Item1,0) + IFNULL(Item2,0) + IFNULL(Item3,0) + IFNULL(Item4,0) + IFNULL(Item5,0) + IFNULL(Item6,0) + IFNULL(Item7,0) + IFNULL(Item8,0) + IFNULL(Item9,0) + IFNULL(Item10,0) ) AS total FROM enquete_simples_num  WHERE Cod_Enquete_Simples_Num = 614807;

      <?php
        $sqlListagemBD = "SELECT * FROM	enquete_simples_num WHERE Cod_Enquete_Simples_Num = '$chave'";
        
        $resultadoBusca = mysqli_query($linkBD, $sqlListagemBD);
        
        if(mysqli_num_rows($resultadoBusca) > 0){
          while ($dados = mysqli_fetch_array($resultadoBusca )) {
            
      ?>

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Porcentagem'],
          ['<?php echo $item1 ?>',<?php echo $dados['Item1'] ?>  ],
          ['<?php echo $item2 ?>',<?php echo $dados['Item2'] ?>  ],
          ['<?php echo $item3 ?>',<?php echo $dados['Item3'] ?>  ],
          ['<?php echo $item4 ?>',<?php echo $dados['Item4'] ?>  ],
          ['<?php echo $item5 ?>',<?php echo $dados['Item5'] ?>  ],
          ['<?php echo $item6 ?>',<?php echo $dados['Item6'] ?>  ],
          ['<?php echo $item7 ?>',<?php echo $dados['Item7'] ?>  ],
          ['<?php echo $item8 ?>',<?php echo $dados['Item8'] ?>  ],
          ['<?php echo $item9 ?>',<?php echo $dados['Item9'] ?>  ],
          ['<?php echo $item10 ?>',<?php echo $dados['Item10'] ?>  ],
         
        ]);
        

        var options = {
          title: '',
          width: "100%",
          legend: { position: 'none' },
          chart: { title: '',
                   //subtitle: ' by percentage' 
                   },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: ''} // Top x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };
        <?php
        } 
        }
        ?>
        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>