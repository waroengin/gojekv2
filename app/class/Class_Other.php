<?php
class Class_Other{
    static function color($color = "default" , $text = ""){
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );  
        echo "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }

    static function guidv4($data = null) {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    static function clearscreen(){
        if (DIRECTORY_SEPARATOR === '/') {
            system('clear');
        }
        
        if (DIRECTORY_SEPARATOR === '\\') {
            system('cls');
        }
    }
}
?>