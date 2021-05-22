<?php
error_reporting(0);
include_once "class/deviceClass.php";

    $basic = empty($_POST['basic']) ? null : $_POST['basic'];
    $mdm = empty($_POST['mdm']) ? null : $_POST['mdm'];
    $md = empty($_POST['md']) ? null : $_POST['md'];
   $token = empty($_POST['appToken']) ? null : $_POST['appToken'];
    $allstring = empty($_POST['allstring']) ? null : $_POST['allstring'];
    $allstring2 = empty($_POST['allstring2']) ? null : $_POST['allstring2'];
?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/common.js" type="application/javascript"></script>
    <link href="css/common.css" rel="stylesheet">
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>iCloud OFF ：+84932209990</title>
	<!-- Add icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .error{
            color:red;
        }
        input[type='text']{
            width:60%;
            padding:10px;
        }
        #check2{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 9px 13px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
		 #passcode{
            background-color: yellow; /* Green */
            border: none;
            color: black;
            padding: 9px 13px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        #clear{
            background-color: red; /* Green */
            border: none;
            color: white;
            padding: 9px 13px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
		#btn {
			background-color: DodgerBlue;
			border: none;
			color: white;
			padding: 12px 16px;
			font-size: 16px;
			cursor: pointer;
		}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}

/* Navbar container */
.navbar {
  overflow: hidden;
  background-color: #333;
  font-family: Arial;
}

/* Links inside the navbar */
.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown button */
.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Add a red background color to navbar links on hover */
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}
</style>
</head>
<div class="navbar">
  <a href="index.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">More
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="proxy.php">Proxy </a>
      <a href="PasstokenMac.php">Token Mac</a>
      <a href="Passtokenwin.php">Token Win</a>
	  <a href="litetoken.php">FMI Lite</a>
	  <a href="proxytoken.php">Proxy Manual</a>
	  <a href="proxyraw.php">Proxy Raw</a>
	  <a href="passtoken.php">Token Manual</a>
	 </div>
  </div>
</div>

    </style>
</head>
<body style="background-color:#E085D1">

<p style="text-align: center"><h1 ><b> OFF TOKEN MacOS</b></h1><br> </p>
<center><div id="loader"></div></center>
<form method="post">

    <label>DATA-OFF-IT &nbsp&nbsp&nbsp&nbsp&nbsp  </label><input style="height:40px" type="text" value="<?= $allstring; ?>" name="allstring" placeholder="Copy All iTeam token---> Here" style="background-color:#fff;" class="validate"><br>
    <span id="appToken_error" class="error"></span>
   <br>
    <input type="submit" id="check2"  name="submit" value="CHECK IT" >&nbsp;
	<input type="reset" id="clear" value="CLEAR" onclick="document.theForm.reset();return false;">
    <br>
   <br>
</form>

</script>

 <br />
        <br />
        <div align="center" class="text-center">
        <?php
     $submit = empty($_POST['submit1']) ? null : $_POST['submit1'];


  function string_between_two_string($str, $starting_word, $ending_word)
{
    $subtring_start = strpos($str, $starting_word);
    //Adding the strating index of the strating word to
	trim( $str, $char);
    //Adding the strating index of the strating word to
    //its length would give its ending index
    $subtring_start += strlen($starting_word);
    //Length of our required sub string
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    // Return the substring from the index substring_start of length size
    return substr($str, $subtring_start, $size);
	
}
     $str = base64_decode($allstring);


              // $FD=$_POST["allstring"];
             // echo    $FD=$_POST[$str];
             $tokenstart=strpos($str,'"Data" : ',0);
             $MDstart=strpos($str,'"X-Apple-I-MD" = ',0);
             $MDMstart=strpos($str,'"X-Apple-I-MD-M" = ',0);
             $dsidstart = strpos($str,'dsid:',0);

				
				$dsid = string_between_two_string($str,'dsid: ',' }');
				echo $dsid = trim($dsid);
				echo $basic1 = string_between_two_string($str, '"Data" : "','"', '", } @ { "X-Apple-I-MD" = "');
				//echo $mdm=substr($str,$MDMstart+20,80);
				$mdm = string_between_two_string($str,'"X-Apple-I-MD-M" = ',';') ;
				echo $mdm =trim($mdm,'" ') ;
				//echo $md=substr($str,$MDstart+18,40);
				$md = string_between_two_string($str,'"X-Apple-I-MD" = ','";') ;
				echo $md =trim($md,'" ') ;
          
             $basic = base64_encode($dsid. ":" .$basic1);

 //$basic1 = trim(string_between_two_string($str, '"Data" : "','"', '", } @ { "X-Apple-I-MD" = "'));
    //echo base64_decode($allstring);
 //echo $FC = trim(string_between_two_string($str, '"X-Apple-I-MD" = "', '", } @ { "X-Apple-I-MD" = "'));
    //echo base64_decode($allstring);

 // echo $basic= strstr($basic, '", } @ { "X-Apple-I-MD" = "', true);
          //$basic = base64_encode(trim("" . $dsid . ":" . $basic1));
 //echo  $dsid=  trim(getBetween($str, 'dsid:','}'));
   //$basic = base64_encode($dsid. ":" .$basic1);

  //$md=  trim(getBetween($str,'"X-Apple-I-MD" = "','";'));
  //$mdm=  trim(getBetween($str,'"X-Apple-I-MD-M" = "','";'));
           //echo $basew =  trim("" . $dsid . ":" . $basic);
         IF(is_null($basic))
         {
            echo  'CHECK ALL STRING';
         }
         else IF(is_null($md))
          {
           echo  'CHECK ALL STRING';
          }
            else IF(is_null($mdm))
           {
           echo  'CHECK ALL STRING';
          }
          else
         {
         // echo  'CLICK CHECK BUTTON';
         }
        ?>

 </div>

 <form method="post" id="form2" action="passtoken.php">
 <input type="hidden" name="token1" value="<?php echo $basic; ?>">
 <input type="hidden" name="md1" value="<?php echo $md; ?>">
 <input type="hidden" name="mdm1" value="<?php echo $mdm; ?>">
 <button type="submit" name="submit2" id="passcode" i class="fa fa-apple">&nbspGO TO OFF--->></button>
</form>
</body>
</html>