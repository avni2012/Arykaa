<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Common {
    public static function logRecorder($folder = "logs", $file = "logsfile", $data)
    {
        $fullDir = storage_path() . '/logs/' . $folder;
        if (! file_exists($fullDir)) {
            mkdir(storage_path() . '/logs/' . $folder, 0777);
        }
        $file = fopen(storage_path() . "/logs/$folder/$file" ."-". date('Y-m-d') . ".txt", "a+");
        //dd($file);
        //fwrite($file, print_r("===================\n\n", true));
        fwrite($file, print_r($data, true));
        //fwrite($file, print_r("\n\n===================", true));
        fwrite($file, "\n\n");

        return;
    }

    public static function weekdays() {
        return ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    }
}