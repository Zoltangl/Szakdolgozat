<?php

class StringHelper {

    public static function safe_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    
      public static function checkName($firstusername, $msg) {
        if(empty($nev)) {
            $msg .= "A névben csak space karakterek nem lehetnek. ";
        }
        if (!preg_match("/^[a-záéíóöőúüűÁÉÍÓÖŐÚÜŰA-Z-']*$/", $nev)) {
            $msg .= "A névben csak betűk lehetnek. ";
        }
        if (mb_strlen($nev) > 10) {
            $msg .= "A névben maximum 10 karakter lehet. ";
        }
        elseif (mb_strlen($nev) < 2) {
            $msg .= "A névben minimum 2 karakternek kell lennie. ";
        }
        return $msg;
    }
}

?>