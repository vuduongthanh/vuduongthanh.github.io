<style>
    .remove {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 9px 13px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>
<?php


class deviceClass
{

    private $appToken;
    private $md;
    private $mdm;
    private $host;

    public function __construct($APPTOKEN, $MD, $MDM)
    {
        $this->appToken = $APPTOKEN;
        $this->md = $MD;
        $this->mdm = $MDM;
        $this->host = "fmipmobile.icloud.com";
    }

    // authenticate account
    public function authenticate(){

        $curl = curl_init("https://" . $this->host . "/fmipservice/device/initClient");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Proxy-Connection: keep-alive',
            'Accept-Language: en-us',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: FindMyiPhone/472.1 CFNetwork/711.1.16 Darwin/14.0.0',
            'X-Apple-Find-API-Ver: 3.0',
            'X-Client-UUID :0643129476E33B42318E7542EAAE1D86F00018DD',
            'Connection: keep-alive',
            'X-Apple-OAuth-Client-Type: firstPartyAuth',
            'X-Apple-AuthScheme: Forever',
            'Authorization: Basic '.$this->appToken,
             'X-Apple-I-MD: '.$this->md,
            'X-Apple-I-MD-M: '.$this->mdm,
            'X-Apple-Realm-Support: 1.0',
            'Accept: /'));

        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $home = curl_exec($curl);
        curl_close($curl);
        $code = $this->getValue('/1.1 (.*?)\r\nServer/', $home);

        return $code;
    }

    public function refreshClient()
    {
        $url = "https://" . $this->host . "/fmipservice/device/refreshClient";
        /*$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept-Language: en-us",
            "Content-Type: application/json; charset=utf-8",
            "User-Agent: FindMyiPhone/472.1 CFNetwork/711.1.16 Darwin/14.0.0",
            "X-Apple-Find-API-Ver: 3.0",
            "Connection: keep-alive",
            "X-Apple-AuthScheme: Forever",
            "Authorization: Basic " . $this->appToken,
            'X-Apple-I-MD-M: '.$this->mdm,
            'X-Apple-I-MD: '.$this->md,
            "X-Apple-Realm-Support: 1.0",
            "Accept: /"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);*/

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://" . $this->host . "/fmipservice/device/refreshClient",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Accept-Language: en-us",
                "Content-Type: application/json; charset=utf-8",
                "User-Agent: FindMyiPhone/472.1 CFNetwork/711.1.16 Darwin/14.0.0",
                "X-Apple-Find-API-Ver: 3.0",
                "Connection: keep-alive",
                "X-Apple-AuthScheme: Forever",
                "Authorization: Basic " . $this->appToken,
                'X-Apple-I-MD-M: '.$this->mdm,
                'X-Apple-I-MD: '.$this->md,
                "X-Apple-Realm-Support: 1.0",
                "Accept: /"
            )
        ));

        $value = curl_exec($ch);
        return $value;
    }

    //remove all device
    public function removeDeviceAll()
    {
        $value = $this->refreshClient();
        $authToken = $this->getValue('/authToken\":\"(.*?)\"/', $value);
        $prsId = $this->getValue('/prsId":(.*?),"/', $value);

        preg_match_all("/canWipeAfterLock(.*?)\"location\"/", $value, $lista);
        foreach( $lista[1] as $plm )
        {
            if( stristr($plm, "REM\":true") )
            {

                $id = $this->getValue('/id":"(.*?)"/', $plm);
                $deviceDisplayName = $this->getValue('/deviceDisplayName\":\"(.*?)\"/', $plm);
                $name = $this->getValue('/name":"(.*?)"/', $plm);

                $post = '{"clientContext":{"appVersion":"7.0"},"device":"' . $id.'"}';
				$url = "https://" . $this->host . "/fmipservice/device/remove";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( "X-Apple-Realm-Support  : 1.0",
				"Accept: /", "Authorization: Basic " . $this->appToken,
				'X-Apple-I-MD: '.$this->md,
				'X-Apple-I-MD-M: '.$this->mdm,
				"Proxy-Connection: keep-alive",
				"Accept-Language: en-us",
				"Content-Type: application/json; charset=utf-8",
				"X-Apple-Find-API-Ver: 3.0",
				"User-Agent: FindMyiPhone/472.1 CFNetwork/711.1.16 Darwin/14.0.0",
				"X-Inactive-Time: 52617",
				"X-Apple-AuthScheme: Forever",
				"Connection: keep-alive" ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_AUTOREFERER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                $del = curl_exec($ch);
                curl_close($ch);
                $rem = $this->removeDevice($id);
                var_dump($rem);
                file_put_contents('del.txt', $del."\n", FILE_APPEND);
				echo '<span class="label label-primary"><br>Model: '.$deviceDisplayName.'</span><br>';
                echo '<span class="label label-info">Device Name: '.$name.'</span><br>';
                echo '<span class="label label-success">Removed - FMI: OFF &#9989;</span><br />==========================================';
            
                //$msg = 'Model: '.$deviceDisplayName."\n";
                //$msg .= 'Device Name: '.$name."\n";
                //$msg .= "Removed - FMI: OFF\n========================\n";
            }
        }

        if ( count($lista[1]) < 1 )
        {
            echo 'NO DEVICES.';
            //$msg = 'NO DEVICES.';
        }

        //return $msg;
    }

    //remove single device
    public function removeDevice($id){
        $post = '{"clientContext":{"appVersion":"7.0"},"device":"' . $id.'"}';
        $url = "https://" . $this->host . "/fmipservice/device/remove";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( "X-Apple-Realm-Support  : 1.0",
            "Accept: /", "Authorization: Basic " . $this->appToken,
            'X-Apple-I-MD: '.$this->md,
            'X-Apple-I-MD-M: '.$this->mdm,
            "Proxy-Connection: keep-alive",
            "Accept-Language: en-us",
            "Content-Type: application/json; charset=utf-8",
            "X-Apple-Find-API-Ver: 3.0",
            "User-Agent: FindMyiPhone/472.1 CFNetwork/711.1.16 Darwin/14.0.0",
            "X-Inactive-Time: 52617",
            "X-Apple-AuthScheme: Forever",
            "Connection: keep-alive" ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $del = curl_exec($ch);
        curl_close($ch);
        print_r($del);
        return $del;
    }

    //get value from array
    private function getValue($name, $array){
        preg_match($name, $array, $name);
        return $name = $name[1];
    }

    //show online offline
    private function deviceStatus($deviceArr){

        $device = json_decode($deviceArr);
        $table = '<table><tr>';
        //image url
        $imageBaseUrl = $this->getValue('/imageBaseUrl":"(.*?)"/', $deviceArr);
        foreach ($device->content as $value){
            $id = $value->id;
            $authToken = $device->serverContext->authToken;
            $prsid = $device->serverContext->prsId;


            $button = "";
            $clean = '<b>MODE: </b><span style="color:green">CLEAN</span>';
            //device type
            $deviceClass = $value->deviceClass;
            //device model type
            $rawDeviceModel = $value->rawDeviceModel;
            //device name
            $name = $value->name;
            //device display name
            $deviceDisplayName = $value->deviceDisplayName;

            //check status
            $status = "<span style='color:red'>ONLINE</span> ";
            //offline
            if(!empty($value->features->REM))
            {
                $status = "<span style='color:green'>OFFLINE</span> ";
				$button ="<input type='button' class='remove' data-mdm='$this->mdm' data-apptoken='$this->appToken' data-md='$this->md' data-id='".$id."' value='Remove'>";
            }

            //lost mode
            if(isset($value->lostDevice) && !empty($value->lostDevice)){
//                echo "<pre>";print_r($value->lostDevice);
                $clean = '<b>MODE: </b><span style="color:red">LOST</span><br>
                          <b>OWNER NUMBER: </b><small>'.$value->lostDevice->ownerNbr.'</small><br>
                          <b>MESSAGE: </b><small>'. $value->lostDevice->text. '</small>';
            }

            $src = $imageBaseUrl.'/fmipmobile/deviceImages-4.0/'.$deviceClass.'/'.$rawDeviceModel.'/online-infobox.png';

            $table .= "<td>
                <b><img src='".$src."'></b><br>
                <b>STATUS : {$status}</b><br>
                <b>NAME : {$name}</b><br>
                <b>MODEL : {$deviceDisplayName}</b><br>
                <b>$clean</b><br><br>
            </td>";
        }
        $table .= '</tr></table>';
        return $table;
    }

    //start script
    public function start(){
        //authenticate
        $response = $this->authenticate();
        if($response == 200){
        //initialise
        $arr = $this->refreshClient();

        //get device status
        echo $this->deviceStatus($arr);

        }
        return $response;



    }


}

