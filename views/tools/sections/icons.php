<?php

$icon = fopen(ASSETS_PATH."fa-icons.txt",'r');
while(!feof($icon)){
    $cls = trim(str_replace([',','.'], ' ',fgets($icon)));
    $cls = explode(' ',$cls)[0];
    echo '<div class="ico"><i class="fa '. $cls . '"></i><p>'. $cls . '</p></div>';
}