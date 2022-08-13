<?php
class Class_Login{

    public $other, $gojek, $menu,$register;

    function __construct(){
        $this->other = new Class_Other;
        $this->gojek = new Class_Gojek;
        $this->menu = new Class_Menu;
        $this->register = new Class_Register;
       
    }
    function loginaccount(){
        $uniqeid = $this->register->uniqeid();
        $number = $this->number();
        $no =  str_replace('+62', '', $number);
        $login =$this->login($no);
        if(!empty($login)){
            $goid = $this->loginverify($login['data']['otp_token']);
            $customer = $this->register->customer($goid);
            $this->register->saveaccount($number."|".$uniqeid."|".$goid['access_token']);
        }else{
            $menu = $this->menu->backmainmenu();
            if($menu == 'y'){
                $this->login();
            } 
        }
    }

    function number(){
        $no = $this->menu->number();
        return  $no;
    }

    function login($no = ''){
        $loginrequest = $this->gojek->loginrequest($no);
        //print_r($loginrequest);
        if(!empty($loginrequest['errors'])){
            $this->other::color("red", "[!] ".$loginrequest['errors'][0]['message']."\n");
        }else{
            return $loginrequest;
        }
    }

    function loginverify($otptoken){
        $otp = $this->menu->pinverify();
        $token = $this->gojek->logingoid($otptoken,$otp);
        //print_r($token);
        return $token;
    }
}
?>