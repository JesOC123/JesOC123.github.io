<!DOCTYPE html>
<html>
  
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <title>Upload File</title>
  
  
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    
    
    function openFileModal(){
				var modal = document.getElementById("FileModal");
				modal.style.display="block";
				
			}
    function closeFileModal(){
				var modal = document.getElementById("FileModal");
				modal.style.display = "none";
				
			}
      
    
      
    function logout(){
        
        if(document.cookie.indexOf('chris') != -1){
		      document.cookie = document.cookie.replace('chris', '');
      	}  
        window.location = "homepage.php";
      } 
    
  </script>
  
 </head>
  
  
  <body>
   
    <div class="logIn">
      <input type="button" class="btn logout" value="logout" id="logout" onclick="logout()" />
    </div>
    
    <div class="logo">
      <a href="homepage.php">
         <img src="images/logo9.jpg" style="width:160px;height:80px">
      </a>
     </div> 
    
    <center><h1>Choose a file to upload</h1></center>
    
    <div class="content">
      <div class="category">
      <div class="product3">
      <center><h3><b>Upload Personal Messages Reporting File</b></h3>
		
			<form action="uploadMsg.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">

    <button type="submit" name="submit">UPLOAD</button>
  </form><br />
        </center>
      </div>
      <div class="product3">
      <center><h3><b>Upload Personal Connections Reporting File</b></h3>
		
			<form action="uploadCon.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">

    <button type="submit" name="submit">UPLOAD</button>
  </form><br />
        </center>
      </div>
      
    </div>
      
      <div class="category">
        <div class="product3">
      <center><h3><b>Upload Across-Team Reporting File</b></h3>
		
			<form action="uploadTeam.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">

    <button type="submit" name="submit">UPLOAD</button>
  </form><br />
        
        </center>
        </div>
        <div class="product3">
      <center><h3><b>Upload Message Template</b></h3>
		
			<form action="uploadTmp.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">

    <button type="submit" name="submit">UPLOAD</button>
  </form><br />
        </center>
        </div>
      
      </div>
    
    <button type="button" class="btn upload" onclick="openFileModal()">Choose file to view</button>
     
    
    
    <div id = "FileModal" class="modal5">
      <div class="modal-header">
					<span class = "close" onclick = "closeFileModal()">&times;</span>
        <h2 style="color:white;margin-top:10px;">Choose a file to view.</h2>
				</div>
			<div class="modal5-content">
		<form id="fileForm" method="post" action="">
      <h3 style="color:white">Your Message Data</h3>
      
        <?php
          $dir="uploads/";
           if(is_dir($dir)){
             if($dh = opendir($dir)){
                 while(($file = readdir($dh)) !== false){
                 if(strpos($file, "Message") > -1){
        ?>
                   <p style="color:white">
                   <input type="radio" class="btn file" name="radio" value= "<?php echo $file;?>"><?php echo $file; ?> <br />
                    <p>     
           <?php }
                 }
            closedir($dh);
               }
          }
        
        ?>
      <h3 style="color:white">Your Connection Data</h3>
      
                      
        <?php
          $dir="uploads/";
           if(is_dir($dir)){
             if($dh = opendir($dir)){
                 while(($file = readdir($dh)) !== false){
                 if(strpos($file, "Connections") > -1){
        ?>
                   <p style="color:white">
                   <input type="radio" class="btn file" name="radio2" value= "<?php echo $file;?>"><?php echo $file; ?> <br />
                    <p>     
           <?php }
                 }
            closedir($dh);
               }
          }
        
        ?>
                      
      <input class="btn" type="submit" name="submit" value="submit">
        </form>
        
        
         </div>               
  </div>
        
      
      <?php
      
      if(isset($_POST['submit'])){
        if(isset($_POST['radio'])){
      
          $myfile = fopen("uploads/".$_POST['radio'], "r") or die("Unable.");
          
        
      
    $i=0;
    while(!feof($myfile)){
       $array[$i] = fgets($myfile);
       $i++;
    }
   /* foreach($array as $value){
      echo $value . "<br>";
    }*/
    
    $from = array();
    $to = array(); $date = array();
    $dateTime = array(); $subject = array(); $content = array(); $direction = array(); $folder = array();
    
    $titles = explode(',', $array[0]);
    $contentIndex = array_search('Content', $titles);
   // echo $contentIndex . "kkkkkkkkkkkk";
    for($i=0; $i<sizeof($array) - 1; $i++){
      
      $tmparray = array();
      $tmparray = explode(',', $array[$i]);
      $tmparrayBeforeContent = array_slice($tmparray, 0, $contentIndex + 1);
      $tmparrayAfterContent = array_slice($tmparray, -2);
      
      $content[$i] = array_slice($tmparray, $contentIndex, -2);
      $from[$i] = $tmparrayBeforeContent[0];
      $to[$i] = $tmparrayBeforeContent[1];
        
       //-----------------------------------------***************************************************----------------------------------------------------
       //-----------------------------------------***************************************************----------------------------------------------------    
        if(strpos($tmparrayBeforeContent[3], "PM") > -1){
          $tmparrayBeforeContent[3] = str_replace("PM", "", $tmparrayBeforeContent[3]);
          $hours = explode(':', $tmparrayBeforeContent[3]);
          if($hours[0] != 12){
            $hours[0] += 12;
          }
          if(isset($hours[1])){
          $dateTime[$i] = $tmparrayBeforeContent[2] . ' ' . $hours[0] . ':' . $hours[1];
          }
        }else{
          $tmparrayBeforeContent[3] = str_replace("AM", "", $tmparrayBeforeContent[3]);
          $hours = explode(':', $tmparrayBeforeContent[3]);
          if($hours[0] == 12){
            $hours[0] = 00;
          }
          if(isset($hours[1])){
          $dateTime[$i] = $tmparrayBeforeContent[2] . ' ' . $hours[0] . ':' . str_replace(' ', '', $hours[1]);
          }
        }
        
      if(isset($dateTime[$i])){
        $dt = explode(' ', $dateTime[$i]);
      }
     // print_r($dt);
      if(isset($dt[0])){
       $dt[0] = str_replace('"', '', $dt[0]);
       $d = explode('/', $dt[0]);
      }
      
      
      
      
        $dm = array();
      
      if(isset($d[0]) && isset($d[1]) && isset($d[2]) && isset($hours[1])){
        $dm[0] = 20 . $d[2];
        $dm[1] = $d[0];
        $dm[2] = $d[1];
      
     // print_r($dm);
      
      
        $hours[1] = str_replace('"', '', $hours[1]);
      
      
      $dte = $dm[0] . '-' . $dm[1] . '-' . $dm[2] . ' ';
      $dteTme = $dte . $hours[0] . ':' . str_replace(' ', '', $hours[1]);
      $date[$i] = $dte;
      
    
     // print_r($dteTme);
        
        $dateTime[$i] = strtotime($dteTme);
      }
      
      else{$dateTime[$i] = "";}
        
        $subject[$i] = $tmparrayBeforeContent[4];
      
        $direction[$i] = $tmparrayAfterContent[0];
        $folder[$i] = $tmparrayAfterContent[1];
        
        unset($dteTme);
        $dte='';
      }
     // print_r($date);
  // print_r($dateTime);
   // print_r($tmparrayBeforeContent);
   // print_r($tmparrayAfterContent);
    //  print_r($content);
    fclose($myfile);
        }
      
       //-----------------------------------------***************************************************----------------------------------------------------
       //-----------------------------------------***************************************************---------------------------------------------------- 
    
    $replies1 = 0;
    $replies2 = 0;
    $replies3 = 0;
    
    $tmp1Count = 0;
    $tmp2Count = 0;
    $tmp3Count = 0;
    
    $myfile1 = fopen("uploads/5b47740f8edff3.83675586.txt", "r") or die("Unable.");
    $i=0;
    while(!feof($myfile1)){
       $tmp1[$i] = fgets($myfile1);
       $i++;
    }
    
    fclose($myfile1);
    
    
    
 $myfile2 = fopen("uploads/5b477d942d8504.43114560.txt", "r") or die("Unable.");
    $i=0;
    while(!feof($myfile2)){
       $tmp2[$i] = fgets($myfile2);
       $i++;
    }
  /*  foreach($tmp2 as $value){
      echo $value . "<br>";
    }*/
    
     
    fclose($myfile2);
    
    $myfile3 = fopen("uploads/5b486e497aa3d1.15290590.txt", "r") or die("Unable.");
    $i=0;
    while(!feof($myfile3)){
       $tmp3[$i] = fgets($myfile3);
       $i++;
    }
   /* foreach($tmp3 as $value){
      echo $value . "<br>";
    }*/
    
   // print_r($myfile1);
     
    fclose($myfile3);
    
    
    //--------------------------------------------------TTTTTTTTTTTTTTTTTTTTTT-----------------------------------------------------------------
    
    
    
   /* foreach($tmp1 as $value){
      echo $value . "<br>";
    }*/
    
    $tmp1Words = array();
    
    $tmpArray1 = array();
    
    $tmpArray1 = explode(' ', $tmp1[0]);
    for($i = 0; $i < sizeof($tmpArray1); $i++){
      $tmp1Words[$i] = $tmpArray1[$i];
    }
    for($i = 1; $i < sizeof($tmp1); $i++){
      $tempArray = array();
      $tempArray = explode(' ', $tmp1[$i]);
      $k = 0;
      for($j = sizeof($tmpArray1); $j < sizeof($tmpArray1) + sizeof($tempArray); $j++){
        
        $tmp1Words[$j] = $tempArray[$k];
        $k++;
      }
      $tmpArray1 = array_merge($tmpArray1, $tempArray);
    }
    
    
    
    /*foreach($tmp2 as $value){
      echo $value . "<br>";
    }*/
    
    $tmp2Words = array();
    
    $tmpArray2 = array();
    
    $tmpArray2 = explode(' ', $tmp2[0]);
    for($i = 0; $i < sizeof($tmpArray2); $i++){
      $tmp2Words[$i] = $tmpArray2[$i];
    }
    for($i = 1; $i < sizeof($tmp2); $i++){
      $tempArray = array();
      $tempArray = explode(' ', $tmp2[$i]);
      $k = 0;
      for($j = sizeof($tmpArray2); $j < sizeof($tmpArray2) + sizeof($tempArray); $j++){
        
        $tmp2Words[$j] = $tempArray[$k];
        $k++;
      }
      $tmpArray2 = array_merge($tmpArray2, $tempArray);
    }
   // print_r($tmp1Words);
    
    
    /* foreach($tmp3 as $value){
      echo $value . "<br>";
    }*/
    
    $tmp3Words = array();
    
    $tmpArray3 = array();
    
    $tmpArray3 = explode(' ', $tmp3[0]);
    for($i = 0; $i < sizeof($tmpArray3); $i++){
      $tmp3Words[$i] = $tmpArray3[$i];
    }
    for($i = 1; $i < sizeof($tmp3); $i++){
      $tempArray = array();
      $tempArray = explode(' ', $tmp3[$i]);
      $k = 0;
      for($j = sizeof($tmpArray3); $j < sizeof($tmpArray3) + sizeof($tempArray); $j++){
        
        $tmp3Words[$j] = $tempArray[$k];
        $k++;
      }
      $tmpArray3 = array_merge($tmpArray3, $tempArray);
    }
    
    
    if(isset($_POST['radio2'])){
    for($i = 1; $i < sizeof($content); $i++){
      $tmpContent = array();
      $tmpContentWords = array();
      
      $tmpContent = $content[$i];
      
      $tmpContent1 = explode(' ', $tmpContent[1]);
      
      for($j = 0;$j < sizeof($tmpContent1); $j++){
        $tmpContentWords[$j] = $tmpContent1[$j];
      }
      
      if(is_array($tmpContent) && sizeof($tmpContent) > 2){
      for($j = 2; $j < sizeof($tmpContent); $j++){
        $tempArr = array();
        $tempArr = explode(' ', $tmpContent[$j]);
        $k = 0;
        for($n = sizeof($tmpContent1); $n < sizeof($tmpContent1) + sizeof($tempArr); $n++){
          $tmpContentWords[$n] = $tempArr[$k];
          $k++;
        }
        
        if(is_array($tmpContent1)){
          if(is_array($tempArr)){
           $tmpContent1 = array_merge($tmpContent1, $tempArr);
          }else{
           $tmpContent[sizeof($tmpContent)] = $tempArr;
          }
        }else{
          if(is_array($tempArr)){
            $tempArr[0] = $tmpContent1;
            for($k = 1; $k < sizeof($tempArr) + 1; $k++){
              $tempArr[$k] = $tempArr[$k + 1];
            }
          }
        }
        
      }
      }
      
      
      $countTmp1 = 0; $countTmp2 = 0; $countTmp3 = 0;
      $position1 = -1; $position2 = -1; $position3 = -1;
      
      for($m = 0; $m < sizeof($tmp1Words); $m++){
        if(is_array($tmpContentWords)){
          $n = 0;
          for($n = 0; $n < sizeof($tmpContentWords); $n++){
            if($tmpContentWords[$n] == $tmp1Words[$m] && $n > $position1){
              $countTmp1++;
              $position1 = $n;
              break;
            }
          }
        } 
      }
      
      for($m = 0; $m < sizeof($tmp2Words); $m++){
        if(is_array($tmpContentWords)){
          $n = 0;
          for($n = 0; $n < sizeof($tmpContentWords); $n++){
            if($tmpContentWords[$n] == $tmp2Words[$m] && $n > $position2){
              $countTmp2++;
              $position2 = $n;
              break;
            }
          }
        }
      }
      
      for($m = 0; $m < sizeof($tmp3Words); $m++){
        if(is_array($tmpContentWords)){
          $n = 0;
          for($n = 0; $n < sizeof($tmpContentWords); $n++){
            if($tmpContentWords[$n] == $tmp3Words[$m] && $n > $position3){
              $countTmp3++;
              $position3 = $n;
              break;
            }
          }
        } 
      }
      
      
      
      if($countTmp1 >= 0.5 * sizeof($tmp1Words)){
          $tmp1Count += 1;
          $name = $to[$i];
          for($z = 0; $z < sizeof($to); $z++){
            if($from[$z] == $name || $to[$z] == $name){
              $replies1 += 1;
            }
            }
          }
      
      if($countTmp2 >= 0.5 * sizeof($tmp2Words)){
          $tmp2Count += 1;
          $name = $to[$i];
          for($z = 0; $z < sizeof($to); $z++){
            if($from[$z] == $name || $to[$z] == $name){
              $replies2 += 1;
            }
            }
        }
      
      if($countTmp3 >= 0.5 * sizeof($tmp3Words)){
          $tmp3Count += 1;
           $name = $to[$i];
          for($z = 0; $z < sizeof($to); $z++){
            if($from[$z] == $name || $to[$z] == $name){
              $replies3 += 1;
            }
            }
        }
      
     // print_r($tmpContentWords);
    //  echo "Count is 1: " . $countTmp1; 
     // echo "Count is 2: " . $countTmp2;
     // echo "Count is 3: " . $countTmp3;
    }
    }
    
  /*  echo "Size of tmp1 is: " . sizeof($tmp1Words);
    echo "Number of first template is: " . $tmp1Count;
    
    echo "Size of tmp2 is: " . sizeof($tmp2Words);
    echo "Number of second template is: " . $tmp2Count;
      
     echo "Size of tmp3 is: " . sizeof($tmp3Words);
    echo "Number of third template is: " . $tmp3Count;
    
    echo "Replies of one: " . $replies1;*/
    
    if($tmp1Count != 0){
     $avgReplies1 = $replies1 / $tmp1Count;
    }else{
      $avgReplies1 = 0;
    }
    
   // echo "Average one replies: " . $avgReplies1;
    
     
   // echo "Replies of two: " . $replies2;
    
    if($tmp2Count != 0){
     $avgReplies2 = $replies2 / $tmp2Count;
    }else{
      $avgReplies2 = 0;
    }
    
  //  echo "Average two replies: " . $avgReplies2;
    
   //  echo "Replies of three: " . $replies3;
    
    if($tmp3Count != 0){
     $avgReplies3 = $replies3 / $tmp3Count;
    }else{
      $avgReplies3 = 0;
    }
    
   // echo "Average three replies: " . $avgReplies3;
    
    $templatesArray = array();
    $templatesArray[0] = 'Number of Templates Sent';
    $templatesArray[1] = $tmp1Count;
    $templatesArray[2] = $tmp2Count;
    $templatesArray[3] = $tmp3Count;
    
    $titles = ['Name', 'A', 'B', 'C'];
    $avgReplies = array();
    $avgReplies[0] = 'Average Replies Generated';
    $avgReplies[1] = $avgReplies1;
    $avgReplies[2] = $avgReplies2;
    $avgReplies[3] = $avgReplies3;
    
    
    
    
   // print_r($tmp1Words);
   // echo "\n\n";
    //print_r($content[5]);
    
    $jan=0; $feb=0; $mar=0; $apr=0; $may=0; $jun=0; $jul=0; $aug=0; $sep=0; $oct=0; $nov=0; $dec=0; 
    $now = strtotime("-1 year");
    
    
    
    $lastYear = array();
      
   if(isset($dateTime)){
    for($i=0; $i < sizeof($dateTime); $i++){
      
      if($dateTime[$i] > $now){
        $split = explode('-', $date[$i]);
        if($split[1] == 1){
          $jan += 1;
        }if($split[1] == 2){
          $feb += 1;
        }if($split[1] == 3){
          $mar += 1;
        }if($split[1] == 4){
          $apr += 1;
        }if($split[1] == 5){
          $may += 1;
        }if($split[1] == 6){
          $jun += 1;
        }if($split[1] == 7){
          $jul += 1;
        }if($split[1] == 8){
          $aug += 1;
        }if($split[1] == 9){
          $sep += 1;
        }if($split[1] == 10){
          $oct += 1;
        }if($split[1] == 11){
          $nov += 1;
        }if($split[1] == 12){
          $dec += 1;
        }
      }
     
    }
   }
    
    $months = ['month', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
    $monthsMessages = array('Messages Sent', $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);
   // echo $jul;
    
    //----------------------------------------------------*************************-----------------------------------------------------------------
   
      if(isset($_POST['radio2'])){
      $myfile = fopen("uploads/".$_POST['radio2'], "r") or die("Unable.");
    $i=0;
    while(!feof($myfile)){
       $array5[$i] = fgets($myfile);
       $i++;
    }
   /* foreach($array as $value){
      echo $value . "<br>";
    }*/
    
    $connectedOn = array(); $date = array();
    
    for($i=1; $i<sizeof($array5) - 1; $i++){
      
      $tmparray = array();
      $tmparray = explode(',', $array5[$i]);
      $hours = array();
      
            
        if(strpos($tmparray[6], "PM") > -1){
          $tmparray[6] = str_replace("PM", "", $tmparray[6]);
          $hours = explode(':', $tmparray[6]);
          if($hours[0] != 12){
            $hours[0] += 12;
          }
          if(isset($hours[1])){
           $connectedOn[$i] = $tmparray[5] . ' ' . $hours[0] . ':' . $hours[1];
          }
          else{$connectedOn[$i] = "";}
        }else{
          $tmparray[6] = str_replace("AM", "", $tmparray[6]);
          $hours = explode(':', $tmparray[6]);
          if($hours[0] == 12){
            $hours[0] = 00;
          }
          if(isset($hours[1])){
           $connectedOn[$i] = $tmparray[5] . ' ' . $hours[0] . ':' . str_replace(' ', '', $hours[1]);
          }
          else{$connectedOn[$i] = "";}
        }
        
      $dt = array();
      $dt = explode(' ', $connectedOn[$i]);
     // print_r($dt);
      
      
      
      $dt[0] = str_replace('"', '', $dt[0]);
      $d = array();
      $d = explode('/', $dt[0]);
      
      if(isset($d[0]) && isset($d[1]) && isset($d[2]) && isset($hours[1])){
      $dm = array();
      $dm[0] = 20 . $d[2];
      $dm[1] = $d[0];
      $dm[2] = $d[1];
     // print_r($dm);
      
      $hours[1] = str_replace('"', '', $hours[1]);
      
      $dte = $dm[0] . '-' . $dm[1] . '-' . $dm[2] . ' ';
      $dteTme = $dte . $hours[0] . ':' . str_replace(' ', '', $hours[1]);
      $date[$i] = $dte;
      
      
     // print_r($dteTme);
        
        $connectedOn[$i] = strtotime($dteTme);
      }else{
        $connectedOn[$i] = "";
      }
      
      
        
        unset($dteTme);
        $dte='';
      }
    
   // print_r($tmparray[6]);
     $jan=0; $feb=0; $mar=0; $apr=0; $may=0; $jun=0; $jul=0; $aug=0; $sep=0; $oct=0; $nov=0; $dec=0; 
    $now = strtotime("-1 year");
    
    
    
    $lastYear = array();
    for($i=1; $i < sizeof($connectedOn); $i++){
      
      if($connectedOn[$i] > $now){
        $split = explode('-', $date[$i]);
        if($split[1] == 1){
          $jan += 1;
        }if($split[1] == 2){
          $feb += 1;
        }if($split[1] == 3){
          $mar += 1;
        }if($split[1] == 4){
          $apr += 1;
        }if($split[1] == 5){
          $may += 1;
        }if($split[1] == 6){
          $jun += 1;
        }if($split[1] == 7){
          $jul += 1;
        }if($split[1] == 8){
          $aug += 1;
        }if($split[1] == 9){
          $sep += 1;
        }if($split[1] == 10){
          $oct += 1;
        }if($split[1] == 11){
          $nov += 1;
        }if($split[1] == 12){
          $dec += 1;
        }
      }
     
    }
    
    
    $monthsConnections = array('Connections Made', $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);
  // print_r($dateTime);
   // print_r($tmparrayBeforeContent);
   // print_r($tmparrayAfterContent);
    //  print_r($content);
    fclose($myfile);
     
    
    $chartArray = array($templatesArray, $avgReplies, $monthsMessages, $monthsConnections);
    $titleArray = array($titles, $titles, $months, $months);
    
     }
      }
   
  ?>
      <script>
        
      google.charts.load('current', {'packages':['corechart']});
         function drawChart(){
        
          
        <?php
           
          for($j=0; $j<sizeof($chartArray); $j++){
            $tmp = array(); $tmptTitle = array();
            $tmp = $chartArray[$j];
            $tmpTitle = $titleArray[$j];
        ?>
        
        var tempArray = <?php echo json_encode($tmp); ?>;
         for(var i = 0; i < tempArray.length; i++){
           if(isNaN(tempArray[i])){
             tempArray[i] = "'" + tempArray[i] + "'";
           }
         }
        
        var titleArray = <?php echo json_encode($tmpTitle); ?>
       
        var title1 = tempArray[0], title2 = titleArray[0];
        
        var dataArray = [[title2, title1]];
        
        for(var i = 1; i < tempArray.length; i++){
       dataArray.push([titleArray[i], parseFloat(tempArray[i])]);
     }  
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', titleArray[0]);
        data.addColumn('number', tempArray[0]);
        
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
  if(<?php echo $j; ?> == 0 || <?php echo $j; ?> == 1){
  var chart = new google.visualization.BarChart(container);}
  if(<?php echo $j; ?> == 2 || <?php echo $j; ?> == 3){
  var chart = new google.visualization.LineChart(container);}
  chart.draw(data, options);
        
      
      
      <?php 
        unset($tmp);
          }
      ?>
      
      }
        </script>
       
       
      
         
      <button id="btn" type="button" class="btn view"onclick="drawChart()">Generate Charts</button>
			

    
     <div class="category">
        
        <div class="product2" id="0"></div>
        <div class="product2" id="1"></div>
      </div>
    
      <div class="category">
        <div class="product2" id="2"></div>
        <div class="product2" id="3"></div>
      </div>
    
  </body>
</html>