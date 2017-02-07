<img src="./decorator_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Decorator Pattern là gì?
 * Decorator pattern cho phép thêm chức năng mới cho một đối tượng hiện tại mà không làm thay đổi cấu trúc của nó.
 * Đây là loại design pattern thuộc mô hình cấu trúc (structural pattern) .
 * Mô hình này tạo ra một decorator class bao gồm các thuộc tính và phương thức của class ban đầu và cung cấp thêm chức năng lưu giữ các phương thức lớp chữ ký còn nguyên vẹn.
 */

/*Step 1
Create an interface.
*/

//Shape.java
interface Shape
{
  function draw();
}

/*Step 2
Create concrete classes implementing the same interface.*/

//Rectangle.java
class Rectangle implements Shape
{

  public function draw()
  {
    echo("Shape: Rectangle");
  }
}

//Circle.java
class Circle implements Shape
{

  public function draw()
  {
    echo("Shape: Circle");
  }
}

/*Step 3
Create abstract decorator class implementing the Shape interface.*/

//ShapeDecorator.java
abstract class ShapeDecorator implements Shape
{
  protected $decoratedShape;

  public function ShapeDecorator($decoratedShape)
  {
    $this->decoratedShape = $decoratedShape;
  }

  public function draw()
  {
    $this->decoratedShape->draw();
  }
}

/*Step 4
Create concrete decorator class extending the ShapeDecorator class.*/

//RedShapeDecorator.java
class RedShapeDecorator extends ShapeDecorator
{

  public function RedShapeDecorator($decoratedShape)
  {
    parent::__construct($decoratedShape);
  }

  public function draw()
  {
    $this->decoratedShape->draw();
    $this->setRedBorder($this->decoratedShape);
  }

  private function setRedBorder($decoratedShape)
  {
    echo("Border Color: Red");
  }
}


/*Step 5
Use the RedShapeDecorator to decorate Shape objects.*/

//DecoratorPatternDemo.java
class DecoratorPatternDemo
{
  public static function main($args = null)
  {

    $circle = new Circle();
    $redCircle = new RedShapeDecorator(new Circle());
    $redRectangle = new RedShapeDecorator(new Rectangle());

    echo("Circle with normal border");
    $circle->draw();

    echo("\nCircle of red border");
    $redCircle->draw();

    echo("\nRectangle of red border");
    $redRectangle->draw();
  }
}

$demo = new DecoratorPatternDemo();
$demo->main();