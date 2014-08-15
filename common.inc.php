<?php

$file_list = scandir(__DIR__."/_include");
if($file_list) {
  foreach ($file_list as $file) {
    if(fnmatch("*.php", $file)) {
      include_once(__DIR__.'/_include/'.$file);
    }
  }
}

$file_list = scandir(__DIR__."/core");
if($file_list) {
  foreach ($file_list as $file) {
    if(fnmatch("*.php", $file)) {
      include_once(__DIR__.'/core/'.$file);
    }
  }
}

$file_list = scandir(__DIR__."/src");
if($file_list) {
  foreach ($file_list as $file) {
    if(fnmatch("*.php", $file)) {
      include_once(__DIR__.'/src/'.$file);
    }
  }
}

include_once(__DIR__.'/setup.override.php');