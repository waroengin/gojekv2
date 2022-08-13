<?php
class Class_Menu{
    public $other;
    function __construct(){
        $this->other = new Class_Other;
    }
    function head(){
        $this->other::clearscreen();
        $this->other::color("red", "==============================\n");
        $this->other::color("green", "            GOJEK           \n");
        $this->other::color("red", "==============================\n");
        $this->other::color("yellow", "BY : ASKME\n");
        $this->other::color("red", "==============================\n");
    }

    function mainmenu(){
        $this->other::color("green", "1. Register\n");
        $this->other::color("green", "2. Login\n");
        $this->other::color("green", "3. List Account\n\n");
        $this->other::color("blue", "Pilih\t\t: ");

        return trim(fgets(STDIN));
    }

    function pilihankosong(){
        $this->other::color("red", "------------------------------\n");
        $this->other::color("red", "[!] Pilih menu dengan benar.\n\n");
    }

    function uniqeid($uniqeid){
        $this->other::color("red", "------------------------------\n");
        $this->other::color("blue", "Uniqe ID\t: ".$uniqeid."\n");
    }

    function number(){
        $this->other::color("green", "[•] Format Number +628xxxxxxxxxx\n");
        $this->other::color("blue", "Number\t\t: ");

        return trim(fgets(STDIN));
    }

    function errors($error){
        for ($i=0; $i <count($error['errors']) ; $i++) { 
            $this->other::color("red", "[!] ".$error['errors'][$i]['message']."\n");
        }
        $this->other::color("blue", "Ulangi (y/n)\t: ");

        return trim(fgets(STDIN));
    }

    function otp($register){
        $this->other::color("green", "[•] ".$register['data']['message']."\n");
        $this->other::color("blue", "OTP\t\t: ");
        return trim(fgets(STDIN));
    }

    function verify($verify){
        for ($i=0; $i <count($verify['errors']) ; $i++) { 
            $this->other::color("red", "[!] ".$verify['errors'][$i]['message']."\n");
        }
    }

    function goid($goid){
        $this->other::color("green", "[•] access_token Bearer ".$goid['access_token']."\n");
    }

    function pin(){
        $this->other::color("green", "[•] Setting PIN\n");
        $this->other::color("blue", "PIN\t\t: ");
        return trim(fgets(STDIN));
    }

    function setpin($setpin){
        $this->other::color("green", "[•] ".$setpin['errors']['0']['message']."\n");
    }
    
    function pinverify(){
        $this->other::color("blue", "OTP\t\t: ");
        return trim(fgets(STDIN));
    }

    function successpin(){
        $this->other::color("green", "[•] Success setting PIN.\n");
    }

    function customer($customer){
        $this->other::color("red", "------------------------------\n");
        $this->other::color("yellow", "PROFILE\n");
        $this->other::color("red", "------------------------------\n");
        $this->other::color("blue", "Nama\t\t: ".$customer['customer']['name']."\n");
        $this->other::color("blue", "Email\t\t: ".$customer['customer']['email']."\n");
        $this->other::color("blue", "Phone\t\t: ".$customer['customer']['phone']."\n");
    }

    function claimvoucher(){
        $this->other::color("red", "------------------------------\n");
        $this->other::color("yellow", "CLAIM VOUCHER\n");
        $this->other::color("red", "------------------------------\n");
        $this->other::color("green", "[•] Claim voucher code 'GOJEKINAJA'.\n");
    }

    function listvoucher(){
        $this->other::color("red", "------------------------------\n");
        $this->other::color("yellow", "LIST VOUCHER\n");
        $this->other::color("red", "------------------------------\n");
    }

    function saveaccount(){
        $this->other::color("red", "------------------------------\n");
        $this->other::color("blue", "Save Account (y/n)\t: ");
        return trim(fgets(STDIN));
    }

    function listaccount($list){
        $this->other::clearscreen();
        $this->other::color("red", "------------------------------\n");
        $this->other::color("yellow", "LIST ACCOUNT\n");
        $this->other::color("red", "------------------------------\n");
        $no =1 ;
        for ($i=0; $i < count($list) ; $i++) { 
            $this->other::color("green", "[".$no++."] ".$list[$i]['0']."\n");
        }
    }

    function pilihlist(){
        $this->other::color("blue", "\nPilih\t\t: ");
        return trim(fgets(STDIN));
    }

    function backmainmenu(){
        $this->other::color("blue", "\nKembali (y/n)\t: ");
        return trim(fgets(STDIN));
    }

    function menulist($pilihlist){
        $this->other::clearscreen();
        $this->other::color("red", "------------------------------\n");
        $this->other::color("yellow", "LIST MENU | Phone ".$pilihlist[0]."\n");
        $this->other::color("red", "------------------------------\n");
        $this->other::color("green", "[1] Check Voucher.\n");
        $this->other::color("blue", "\nPilih\t\t: ");
        return trim(fgets(STDIN));
    }

}
?>