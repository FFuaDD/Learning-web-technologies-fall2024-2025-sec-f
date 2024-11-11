<?php


function  area($length=10,$width=5)
{
    return $length * $width;
}
echo "The area is     : ";
echo area();
echo"<br>";
function perimeter($length=10,$width=5)
{

    return 2*($length+$width);
}
echo "The Perimeter is:" ;
echo perimeter();





?>