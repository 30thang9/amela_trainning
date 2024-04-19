<?php

require_once 'Shape.php';

class Rectangle extends Polygon {
    public function calculateArea() {
        return $this->width * $this->height;
    }
}

?>
