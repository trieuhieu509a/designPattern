<img src="./facade_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Facade pattern là gì?
 * Facade pattern ẩn sự phức tạp của hệ thống và cung cấp một interface cho client sử dụng để có thể truy cập vào hệ thống.
 * Đây là loại design pattern thuộc mô hình cấu trúc (structural pattern), pattern này cung cấp một interface để ẩn phức tạp của nó.
 * Mô hình này bao gồm một lớp duy nhất cung cấp các phương pháp đơn giản mà được yêu cầu bới client gọi đến các phương thức của class hiện có.
 */

/*Facade pattern là gì?

Facade pattern ẩn sự phức tạp của hệ thống và cung cấp một interface cho client sử dụng để có thể truy cập vào hệ thống.
Đây là loại design pattern thuộc mô hình cấu trúc (structural pattern), pattern này cung cấp một interface để ẩn phức tạp của nó.
Mô hình này bao gồm một lớp duy nhất cung cấp các phương pháp đơn giản mà được yêu cầu bới client gọi đến các phương thức của class hiện có.*/


/*Step 1
Create an interface.

Shape.java*/

interface Shape
{
  function draw();
}

/*Step 2
Create concrete classes implementing the same interface.

Rectangle.java*/

class Rectangle implements Shape
{

  public function draw()
  {
    echo("Rectangle::draw()");
  }
}

//Square.java
class Square implements Shape
{

  public function draw()
  {
    echo("Square::draw()");
  }
}

//Circle.java
class Circle implements Shape
{

  public function draw()
  {
    echo("Circle::draw()");
  }
}

/*Step 3
Create a facade class.
ShapeMaker.java*/

class ShapeMaker
{
  private $circle;
  private $rectangle;
  private $square;

  public function ShapeMaker()
  {
    $this->circle = new Circle();
    $this->rectangle = new Rectangle();
    $this->square = new Square();
  }

  public function drawCircle()
  {
    $this->circle->draw();
  }

  public function drawRectangle()
  {
    $this->rectangle->draw();
  }

  public function drawSquare()
  {
    $this->square->draw();
  }
}

/*Step 4

Use the facade to draw various types of shapes.

FacadePatternDemo.java*/

class FacadePatternDemo
{
  public static function main($args = null)
  {
    $shapeMaker = new ShapeMaker();

    $shapeMaker->drawCircle();
    $shapeMaker->drawRectangle();
    $shapeMaker->drawSquare();
  }
}

FacadePatternDemo::main();