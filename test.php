<?php

$text = "class A1 {a : a {}, b:b{}} class B2{c:c{}; d:d{}}";

$regexp = "/(?>(class.*\{.*\}.*))|(?R|&)/U";

$regexp = 
"/(?:".
  "(?>(class.*\{.*\}).*)".
  ")|(?R)*".
"/";

$matches = array();
preg_match_all($regexp, $text, $matches);
print_r($matches);
?>
