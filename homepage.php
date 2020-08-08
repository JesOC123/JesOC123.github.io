<!DOCTYPE html>
<html>
  
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <title>Homepage</title>
  
  
  <script>
    
    //login set max attempt 3
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
      //redirect to appropriate pages
			function openModal(){
        if(document.cookie.indexOf('chris') != -1){
		      window.location = "personalDash.php";
      	}else if(document.cookie.indexOf('wayne') != -1){
		      window.location = "acrossTeamDash.php";
      	}    
        else{
				var modal = document.getElementById("imageModal");
				modal.style.display="block";
        }
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

<body class="homepage">
  
  <ul class = "navbar">
    <li><button type="button" class="btn login" onclick="openModal()">Login</button></li>
    <li><a href="browse.php">Browse</a></li>
  </ul>
  </div>
  <div class="triangle1"></div>
  <div class="triangle"></div>
  <div class="triangle"></div>
  <div class="getStarted">Get Started</div>
   <div class="logo">
     <img src="images/logo9.jpg" style="width:200px;height:100px">
  </div>
  <div class="homeChart" id="barchart">
   
    <div class="homeParagraph"><center><strong>Cut the guess work out today.</strong><br /><br /><p style="font-size:18px"> Upload your company or personal <br />LinkedIn data to learn best practises <br /> for your professional profile activity.</p></center></div>
  
 <div id="piechart"></div>
    
    
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
  </div>  
    
    

</script>

  
</body>

</html>