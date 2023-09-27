<?php
namespace App\Http\Helper;

class ResponseBuilder{
    public static function results($status = "", $info = "", $data = "") {
        return [
            "Susscessfully"=> $status,
            "Information"=> $info,
            "Data"=> $data
        ];
    }
}

?>