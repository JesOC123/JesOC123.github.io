<!DOCTYPE html>
<html lang="en-US">
  
  <head>
    
    <link rel="stylesheet" type="text/css" href="style.css">
    
  <?php
    //currently this webpage only opens the file specified below - if another file wishes to be viewed the name of the file must be entered into fopen() - to overcome this, the personalDashboard page code will be replicated
    $myfile = fopen("uploads/5b310c16821718.26332912.csv", "r") or die("Unable.");
    $i=0;
    while(!feof($myfile)){
       $array[$i] = fgets($myfile);
       $i++;
    }
   
    //set arrays to the different rows in the file 
    $salesRep = array();
    $SSI = array(); $daysActive = array(); $savedLeads = array();
    $accountsSaved = array(); $searchesPerformed = array(); $profilesViewed = array();
    $inMailMessagesSent = array(); $messagesSent = array(); $uniqueConnections = array();
    
    $k = sizeof(explode(',', $array[1]));
    
    
    //separate at comma to retrieve array values
    for($i=0; $i<sizeof($array) - 1; $i++){
      $tmpArray = array();
      $tmpArray = explode(',',$array[$i]);
      $salesRep[$i] = $tmpArray[0];
      $SSI[$i] = $tmpArray[1];
      $daysActive[$i] = $tmpArray[2];
      $savedLeads[$i] = $tmpArray[3];
      $accountsSaved[$i] = $tmpArray[4];
      $searchesPerformed[$i] = $tmpArray[5];
      $profilesViewed[$i] = $tmpArray[6];
      $inMailMessagesSent[$i] = $tmpArray[7];
      $messagesSent[$i] = $tmpArray[8];
      $uniqueConnections[$i] = $tmpArray[9];
      unset($tmpArray);
    }
    //set the metrics array as the different metrics arrays 
     $metricsArray = array($SSI, $daysActive, $savedLeads, $accountsSaved, $searchesPerformed, $profilesViewed, $inMailMessagesSent, $messagesSent,
                    $uniqueConnections);
    
    //set a data array to be inputted to drawChart() below
    $data = array($salesRep, $accountsSaved);
     
    

    
    fclose($myfile);
  ?>
    
     <script>
      function logout(){
        
        if(document.cookie.indexOf('wayne') != -1){
		      document.cookie = document.cookie.replace('wayne', '');
      	}  
        window.location = "homepage.php";
      }  
    </script>
    
    
  </head>
  <body>
    
   
    <div class="logIn">
      <input type="button" value="logout" id="logout" onclick="logout()" />
    </div>
    
    <div class="logo">
      <a href="homepage.php">
         <img src="images/logo9.jpg" style="width:160px;height:80px">
      </a>
     </div> 
    
    
    <div class="content">
      
      
      <center><h1><b>Welcome<script>if(document.cookie.indexOf('wayne') != -1){document.write(', Wayne')}</script></b></h1>
      
      <div class="category">
    
    <div id='barchart'></div>
    <div class="product" id="0"></div>
    <div class="product" id="1"></div>
        
      </div><div class="category">
    <div class="product" id="2"></div>
        
      
    <div class="product" id="3"></div>
      
      </div><div class="category">
    <div class="product" id="4"></div>
    <div class="product" id="5"></div>
      </div><div class="category">
    <div class="product" id="6"></div>
    <div class="product" id="7"></div>
      </div><div class="category">
    <div class="product" id="8"></div>
      </div>
    </div>
      
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
      var repArray = <?php echo json_encode($salesRep); ?>;
       for(var i = 0; i < repArray.length; i++){
      if(isNaN(repArray[i])){
        repArray[i] = "'" + repArray[i] + "'";
      }
    }
    </script>
    
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
   
      
      
   function drawChart(){
   // alert(parseFloat(met[2]));
     
    // document.getElementById('barchart').innerHTML = 'hello';
    // document.getElementById(chartId).innerHTML = 'hello';
     
     
     
     <?php 
        for($j=0; $j<sizeof($metricsArray); $j++){
          $tmp = array();
          $tmp = $metricsArray[$j];
      ?>
     
     var metArray = <?php echo json_encode($tmp); ?>;
    for(var i = 0; i < metArray.length; i++){
      if(isNaN(metArray[i])){
        metArray[i] = "'" + metArray[i] + "'";
      }
    }
     
     var title1 = repArray[0], title2 = metArray[0];
     
     var dataArray = [[title1, title2]];
     
     for(var i = 1; i < repArray.length; i++){
       dataArray.push([repArray[i], parseFloat(metArray[i])]);
     }     
    
    // for(var i = 0; i < dataArray.length; i++){
       
      
   //  }    
     
     
     
 var data = new google.visualization.DataTable();
 data.addColumn('string', repArray[0]);
 data.addColumn('number', metArray[0]);
 for(var i = 1; i < dataArray.length; i++){
    var row = dataArray[i];
    data.addRow(row);
 }

 var options = { colors:['#4D5656'],
    chartArea: {
      left: 40,
      width: '100%'
    },
    legend: {
      position: 'top'
    },
    width: '100%'
  };
     
     var container = document.getElementById(<?php echo $j ?>);
  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.BarChart(container);
  chart.draw(data, options);
     
<?php 
        unset($tmp); 
        }
      ?>
   
   }
      
      
    </script>
    
    
    
       
    
    
    
     
    <script type="text/javascript">
    
    
    
       // alert(metArray + repArray);
       
      
      
    
       </script>
      
     
  

  
  </body>
</html>