<?php

require_once 'Shape.php';

class Triangle extends Polygon {
    public function calculateArea() {
        return 0.5 * $this->width * $this->height;
    }
}

?>
