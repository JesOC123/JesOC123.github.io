<!DOCTYPE html>
<html>
  
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <title>Browse</title>
  
  
  <script>
    
      var attempt = 3;
function validate(e){
	
	var expire = new Date();
	expire.setTime(expire.getTime() + 1000 * 60 * 60);
	var cookie1 = "";
	//save details so that when the user returns to the login page they don't have to keep re-entering login details (tried and worked in firefox and I.E. when selected the password is stored)
	var username = document.getElementById("username").value;			//Get username inputted for the document
	var passsword = document.getElementById("password").value;			//And password
	if(username == "wayne" && passsword == "wayne"){			//if both are correct, then login is successful
		alert ("Login successful"); // redirect to the back office	
		cookie1 += "wayne";
		document.cookie = cookie1 + expire;
	}else if(username == "chris" && passsword == "chris"){
    alert ("Login successful"); // redirect to the back office	
		cookie1 += "chris";
		document.cookie = cookie1 + expire;
    e.preventDefault();
		window.location = "personalDash.php";	
		return;
  }
	else{
		attempt --; //decrements of one
		if(attempt > 0){
			alert("You have left: " +attempt+ " attempts left");
			e.preventDefault();
			return;
		}
		// after three attempts, taken to the homepage of the site
		if( attempt == 0){
			alert("Redirecting to homepage");
			e.preventDefault();
			window.location = "homepage.php";	
			return;
		}
	}

}
    
			function openModal(){
				var modal = document.getElementById("imageModal");
				modal.style.display="block";
				
			}
			
			function closeIm(){
				var modal = document.getElementById("imageModal");
				modal.style.display = "none";
				document.getElementById("enImg").innerHTML = "";
				
			}
    
    window.onload = function(){
    document.getElementById("loginForm").addEventListener("submit", function(e){
			validate(e);
		});
    }
</script>
</head>
  
   

<body class="browseContent">
  
  <div class="logo">
      <a href="homepage.php">
         <img src="images/logo9.jpg" style="width:160px;height:80px">
      </a>
     </div> 
  
  
  <ul class = "navbar">
    <li><button type="button" class="btn login" onclick="openModal()">Login</button></li>
  </ul>
 
    <div id = "imageModal" class="modal3">
      <div class="modal-header">
					<span class = "close" onclick = "closeIm()">&times;</span>
				</div>
			<div class="modal3-content">
		<form id="loginForm" method="post" action="acrossTeamDash.php">
			<input type="text" name="username" id="username" placeholder="Email"/>
			<input type="password" name="password" id="password" placeholder="Password"/>
			<input type="submit" value="Sign In" class="btn SignIn">
		
		</form>
			</div>
</div>
  <div class="content">
    
    <div class="video">
   <video width="500" height="300" controls>
     <source src="images/video.mp4">
  </video>
      
    </div>
    
    
      <center><h1>Boost your social selling with LinkingSales.</h1>
        <h4>In a few simple steps LinkingSales can provide you with the bridge in knowledge between your activity and results.</h4>
      <div class="category">
        <div class="title">
          Upload your personal LinkedIn metrics to improve your time management
        </div>
        <div class="title">
          Upload your team's LinkedIn KPIs to gain insights into how your team operates online
        </div>
      </div>
      <div class="category">
        <div class="product21"><center>
          <image src="images/Capture51.JPG" style="height: 100%; width: 100%; object-fit: contain" alt="chart"></image></center>
        </div>
      </div>
    
  </div>
    
  </body>
  <div class="homebar">
      
        <a href="contactUs.php">Contact Us</a>
        <a href="products.php">What We Offer</a>
       <a href="aboutUs.php">About Us</a>
    </div>

</script>

  
</body>

</html>