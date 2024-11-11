<?php

for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}
 
echo "<br>"; 

for ($i = 3; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo $j . " ";
    }
    echo "<br>";
}
 
echo "<br>"; 


$array = ['A', 'B', 'C', 'D', 'E', 'F'];
$index = 0;
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= 4 - $i; $j++) {
        echo $array[$index++] . " ";
    }
    echo "<br>";
}


?>
