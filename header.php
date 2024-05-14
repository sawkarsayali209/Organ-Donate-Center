<!doctype>
    <html> 
<head><!-- comment -->

    <style>
header{
        background-color:white;
    color:black;
    text-align:center;
padding: 20px;    

    
}
.priority {
	color:black; 
	border: 2px ;
	border-radius: 10px; 
	border-width:10px; 
	margin: 30px;
	background-color:white;
	opacity: 0.85;
	filter: alpha(opacity=85); 
      	box-shadow: 10px 10px 5px ;
        	}


nav{
    display:block;
    position:relative;
    width:100%;
    align-items:center;
	color:black;
	box-shadow: 10px 10px 10px black;
	border-radius: 15px 50px; 

}

nav ul{
    list-style-type:none;
    margin:0;
    padding:0;
    background-color:black;
    text-align:center; 

}
body
{
    text-align: center;
    background:white;
      font-family: "Lato", sans-serif;

}


li{
    list-style-type:none;
    display:inline-block;
    font-size:25px;
    
    
}
nav ul li a{
    text-decoration:none;
    color:white;
    padding:10px 20px;
    display:inline-block;
    

}
nav ul li a:hover{
    background:pink;
}
a.logo img{
height:150px;
width:auto;
margin:20px;
justify-items: start;
}


    .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropbtn {
            padding: 16px 50px; 
            font-size: 25px; /* Adjust font size */
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
            top: 100%;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
            
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<body>
    <header>
        <a href='index.php'  class='logo' ><img src='image/img13.jpeg' size="50px" align="left"></a>
        
        <h1> Welcome to Organ Donation System</h1>
          <h2 class="title"><font face="Brush Script MT"  size = 13px>Organ Donation Center</font></h2>

                                              
<div  class="priority" justify="center">

		<p>Your contributions can save many lives. From the wise words of Mother Teresa, <br>&quot;It's not how much we give but how much love we put into giving.&quot; <br> Sign up as a donor or recipient today!</p>

               </div>
              <div class="dropdown" style="position: fixed; top: 10px; right: 10px;">
                  <button class="dropbtn">Register</button>
        <div class="dropdown-content">
            <ul><li>
            <a href="add_donor.php"> Donor</a>
            <a href="add_patient.php"> Patient</a>

        </div>
    </div>
</body>



    <nav>   <ul>    <a href="index.php"> </a>
        
                <li> <a href="index.php">Home</a><!-- comment --></li>
                <li><a href="display_donorinfo.php" >Donor</a><!-- comment --></li>
                <li> <a href="display-patientinfo.php">patient</a></li><!-- comment -->
                <li><a href="displaytransplants.php">Transplants</a></li><!-- comment -->
                                <li><a href="displayhospitaldetails.php">Hospital</a><!-- comment --></li><!-- comment -->

                <li><a href="login.php">Login</a><!-- comment --></li></ul><!-- comment -->

        </nav><!-- comment -->   

</body>
s    </html>