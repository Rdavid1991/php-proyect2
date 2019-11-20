<?php

class Save_Data
{
    function save($file, $post)
    {
        $dir = '../upload/';

        if (!is_dir($dir)){
            mkdir($dir,0777,true);
        }

        $info = new SplFileInfo($file['imagen']['name']);

        $fileExt =  $info->getExtension() ;

        $fileName = $this->change_name_img().'.'.$fileExt;
        
        move_uploaded_file($file['imagen']['tmp_name'], $dir . $fileName);
    }

    function change_name_img(){
        $arr_str = str_split("abcdefghijklmnopqrstuvwxyz123456789");
        $new_name = '';

        for ($i=0; $i < 8 ; $i++) { 
            $new_name = $new_name . $arr_str[rand(0,sizeof($arr_str)-1)] ;
        }

        if (is_file('../upload/'.$new_name)){
            $this->change_name_img();
        }
        return $new_name;
    }
}
