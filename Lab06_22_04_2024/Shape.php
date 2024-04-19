<?php

interface Shape {
    public function calculateArea();
}

abstract class Polygon implements Shape {
    protected $width;
    protected $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    abstract public function calculateArea();
}

?>
