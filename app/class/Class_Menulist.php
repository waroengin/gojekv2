<?php

class Class_Menulist{
    public $other, $Class_Gojek, $menu;

    function __construct(){
        $this->other = new Class_Other;
        $this->Class_Gojek = new Class_Gojek;
        $this->menu = new Class_Menu;
    }
    
    function voucherlist($terpilih){
        $this->menu->listvoucher();
        $this->Class_Gojek::$guidv4 = $terpilih['1'];
        $voucher = $this->Class_Gojek->voucher($terpilih['2']);
        if(!empty($voucher['voucher_stats']['total_vouchers'])){
            $no = 1;
            for ($i=0; $i < count($voucher["data"]) ; $i++) { 
                $this->other::color("green", "[".$no++."] ".$voucher["data"][$i]['sponsor_name']." | ".$voucher["data"][$i]['title']." | Exp. ".$voucher["data"][$i]['expiry_date']."\n");
            }
        }else{
            $this->other::color("red", "[!] Maaf voucher anda kosong.\n");
        }       

        $menuutama = $this->menu->backmainmenu();
        if($menuutama == 'y'){
            $load = new Index();
            $load->main();
        } 
    }
}
?>