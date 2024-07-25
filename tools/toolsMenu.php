<?php

const FILES_EXTENSIONS = ['.html', '.php'];

function extension($string):void {


    if (is_array(FILES_EXTENSIONS)) {
        foreach (FILES_EXTENSIONS as $key) {
            $file_name = $string . $key;


            if (file_exists($file_name)) {
                include_once $file_name;
            }
        }
    }
}