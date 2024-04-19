<?php

require_once 'Rectangle.php';
require_once 'Triangle.php';

$rectangle = new Rectangle(5, 10);
echo "Diện tích hình chữ nhật: " . $rectangle->calculateArea() . "<br>";

$triangle = new Triangle(5, 10);
echo "Diện tích hình tam giác: " . $triangle->calculateArea() . "<br>";

?>
