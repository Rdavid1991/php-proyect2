<?php

class Helpers {

    public function change_name_img()
    {
        $arr_str = str_split("abcdefghijklmnopqrstuvwxyz123456789");
        $new_name = '';

        for ($i = 0; $i < 8; $i++) {
            $new_name = $new_name . $arr_str[rand(0, sizeof($arr_str) - 1)];
        }

        if (is_file('../upload/' . $new_name)) {
            $this->change_name_img();
        }
        return $new_name;
    }

    public function delete_images($file){
        if (is_file('../upload/' . $file)) {
            unlink("../upload/".$file);
        }
    }
}