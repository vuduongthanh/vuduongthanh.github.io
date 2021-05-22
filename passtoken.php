<?php
error_reporting(0);
include_once "clas/deviceClass.php";
  $token = $_POST['token1'];
  $md = $_POST['md1'];
  $mdm = $_POST['mdm1'];
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
        #check{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
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
    <p style="text-align: center"><h1 ><b> OFF TOKEN </b></h1><br> </p>

<center><div id="loader"></div></center>
<form id="form">
    <label>App Token &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="text" name="appToken" value="<?php echo $token; ?>" id="appToken" placeholder="App Token" class="validate"><br>
    <span id="appToken_error" class="error"></span>
    <br>
	<br>
    <label>X-Apple-I-MD &nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="text" name="md" value="<?php echo  $md; ?>" id="md" placeholder="X-Apple-I-MD" class="validate"><br>
    <span id="md_error" class="error"></span>
    <br>
	<br>
    <label>X-Apple-I-MD-M &nbsp</label><input type="text" name="mdm" value="<?php echo  $mdm; ?>" id="mdm" placeholder="X-Apple-I-MD-M" class="validate">
    <br>
    <span id="mdm_error" class="error"></span>
    <br>
    <input type="button" id="check" value="CHECK">
    <input type="reset" id="clear" value="CLEAR" onclick="document.theForm.reset();return false;">
    <br>
   <div id="result"></div>
</form>


</script>
<script>
    $(document).ready(function(){
        $(document).on('click', '#check', function () {
            auth();
        })
        $(document).on('click', '.remove', function(){
          var apptoken = $(this).attr('data-apptoken');
          var md = $(this).attr('data-md');
          var mdm = $(this).attr('data-mdm');
          var id = $(this).attr('data-id');

          $.ajax({
              url: 'ajax/index.php',
              data: {apptoken:apptoken, md: md, id:id, mdm:mdm},
              type: 'POST',
              beforeSend: function() {
                  addLoader();
              },
              success: function(response) {
                  removeLoader();
                 auth();
              }
          })
      })
    })
    function auth(){

        var data = JSON.stringify($("form").serializeArray());
        var isTrue = startValidation();
        if(isTrue){
            $.ajax({
                url: 'ajax/index.php',
                type: 'POST',
                data: {
                    auth: data
                },
                // dataType: "json",
                beforeSend: function() {
                    addLoader();
                },
                success: function(response) {
                    removeLoader();
                    $('#result').html(response)
                }

            })
        }
    }
</script>


</body>
</html>