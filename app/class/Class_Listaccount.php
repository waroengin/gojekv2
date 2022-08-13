<?php
class Class_Listaccount{
    public $other, $Class_Gojek, $menu,$Class_Menulist;

    function __construct(){
        $this->other = new Class_Other;
        $this->Class_Gojek = new Class_Gojek;
        $this->menu = new Class_Menu;
        $this->Class_Menulist = new Class_Menulist;
       
    }

    function listaccount(){
        $list = $this->list();
        $pilihlist = $this->pilihlist($list);
        back:
        $menulist = $this->menulist($pilihlist);
        switch ($menulist) {
            case '1':
                $this->Class_Menulist->voucherlist($pilihlist);
                break;
            default:
                goto back;
                break;
        }
    }

    function list(){
        $akun = file_get_contents('akun.txt','r');

        $explode = array_filter(explode("\n", $akun));
        
        for ($i=0; $i < count($explode) ; $i++) { 
            $akunexplode[] = explode('|',$explode[$i]);
        }
        $this->menu->listaccount($akunexplode);
        
        return $akunexplode;
    }

    function pilihlist($list){
        $pilih =  $this->menu->pilihlist();
        $terpilih = $list[$pilih - 1];

        return $terpilih;
    }

    function menulist($pilihlist){
        $menulist = $this->menu->menulist($pilihlist);
        return $menulist;
    }

    
}
?>