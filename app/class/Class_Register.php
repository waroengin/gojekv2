<?php
class Class_Register{
    public $other, $gojek, $menu;

    function __construct(){
        $this->other = new Class_Other;
        $this->gojek = new Class_Gojek;
        $this->menu = new Class_Menu;
    }

    function register(){
        $uniqeid = $this->uniqeid();
        $number = $this->number();
    
        if(!empty($number)){
            $otp = $this->otp($number);
            $verify = $this->verify($otp,$number);
            if(!empty($verify)){
                $goid = $this->goid($verify);
                $customer = $this->customer($goid);
                if(empty($customer)){
                    $no =  str_replace('+62', '', $number['phone']);
                    $login = new Class_Login();
                    $login = $this->login->login($no);
                    $goid = $this->login->loginverify($login['data']['otp_token']);
                    $customer = $this->customer($goid);
                } 
                
                $pin = $this->pin($goid);
                $pinverify = $this->pinverify($goid, $pin);
                $this->claimvoucher($goid);
                $this->listvoucher($goid);
                $this->saveaccount($number['phone']."|".$uniqeid."|".$goid['access_token']);
            }
        }
    }

    function uniqeid($uniqeid = ''){
        $uniqeid =  strtoupper($this->other::guidv4());
        $this->gojek::$guidv4 = $uniqeid;
        $this->menu->uniqeid($uniqeid);
        return $uniqeid;
    }

    function number(){
        $no = $this->menu->number();
        $register = $this->gojek->register($no);

        if($register['success'] == '1'){
            return array_merge($register,array('phone' => $no));
        }else{
            $error = $this->menu->errors($register);
            if($error == 'y'){
                $this->register();
            }
        }
    }

    function otp($number){
        return $this->menu->otp($number);
    }

    function verify($otp,$number){
        $verify = $this->gojek->verify($otp, $number['data']['otp_token']);

        if($verify['success'] == '1'){
            return $verify;
        }else{
            $this->menu->verify($verify);
        }
    }

    function goid($verify){
        $goid = $this->gojek->goid($verify);
        $this->menu->goid($goid);
        return $goid;
    }

    function pin($goid){
        $pin = $this->menu->pin();
        $setpin = $this->gojek->pin($pin,$goid['access_token']);
        //print_r($setpin);
        $this->menu->setpin($setpin);  
        return $pin;
    }

    function pinverify($goid,$pin){
        $otppin = $this->menu->pinverify();
        $pinverify = $this->gojek->pinverify($pin,$goid['access_token'],$otppin);
        if($pinverify['success'] == 1){
            $this->menu->successpin();
        }
    }

    function claimvoucher($goid){
        $this->menu->claimvoucher();
        $claimvoucher = $this->gojek->claim_voucher($goid['access_token'],"gojekINAJA");
        if(empty($claimvoucher['errors'])){
            $this->other::color("green", "[•] ".$claimvoucher['data']['title']."\n");
        }else{
            $this->other::color("red", "[!] ".$claimvoucher['errors']['0']['message']."\n");
        }
    }

    function listvoucher($goid){
        $this->menu->listvoucher();
        $voucher = $this->gojek->voucher($goid['access_token']);
        if(!empty($voucher['voucher_stats']['total_vouchers'])){
            $no = 1;
            for ($i=0; $i < count($voucher["data"]) ; $i++) { 
                $this->other::color("green", "[".$no++."] ".$voucher["data"][$i]['sponsor_name']." | ".$voucher["data"][$i]['title']." | Exp. ".$voucher["data"][$i]['expiry_date']."\n");
            }
        }else{
            $this->other::color("red", "[!] Maaf voucher anda kosong.\n");
        }       
    }

    function customer($goid){
        $customer = $this->gojek->customer($goid['access_token']);
        if(empty($customer['errors'])){
            $this->menu->customer($customer);
            return $customer;
        }else{
            $this->other::color("red", "------------------------------\n");
            $this->other::color("red", "[!] Maaf anda harus login ulang.\n");
        }
    }

    function saveaccount($akun){
        $saveacc = $this->menu->saveaccount();
        if($saveacc == 'y'){
            file_put_contents('akun.txt', $akun.PHP_EOL, FILE_APPEND);
        }
        $load = new Index();
        $load->main();
    }
}


?>