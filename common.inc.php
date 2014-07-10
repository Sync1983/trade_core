<?php

$file_list = scandir(__DIR__."/_include");
if($file_list) {
  foreach ($file_list as $file) {
    if(fnmatch("*.php", $file)) {
      include_once(__DIR__.'/_include/'.$file);
    }
  }
}

include_once(__DIR__.'/setup.override.php');
include_once(__DIR__.'/src/trade_core.php');
