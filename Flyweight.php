<img src="./flyweight_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Hướng dẫn Java Design Pattern - Flyweight Pattern
 * Flyweight Pattern là gì?
 * Flyweight pattern được sử dụng chủ yếu để giảm số lượng của các đối tượng được tạo ra, để giảm bộ nhớ và tăng hiệu suất.
 * Đây là loại design pattern thuộc mô hình cấu trúc (structural pattern), mô hình này cung cấp nhiều cách để làm giảm tính đối tượng do đó cải thiện ứng dụng đòi hỏi cấu trúc các đối tượng.
 * Flyweight pattern cố gắng để tái sử dụng các đối tượng đã tồn tại loại tương tự bằng cách lưu trữ chúng và tạo ra đối tượng mới khi không có đối tượng phù hợp được tìm thấy.
 */
/*Step 1
Create an interface.
Shape.java*/


interface Shape
{
  function draw();
}


/*Step 2
Create concrete class implementing the same interface.
Circle.java*/

class Circle implements Shape
{
  private $color;
  private $x;
  private $y;
  private $radius;

  public function Circle($color)
  {
    $this->color = $color;
  }

  public function setX($x)
  {
    $this->x = $x;
  }

  public function setY($y)
  {
    $this->y = $y;
  }

  public function setRadius($radius)
  {
    $this->radius = $radius;
  }

  public function draw()
  {
    echo("<br/> Circle: Draw() [Color : " . $this->color . ", x : " . $this->x . ", y :" . $this->y . ", radius :" . $this->radius);
  }
}


/*Step 3
Create a Factory to generate object of concrete class based on given information.
ShapeFactory.java*/


class ShapeFactory
{
  private static $circleMap = array();

  public static function getCircle($color)
  {
    $circle = self::$circleMap[$color];
    if (empty($circle)) {
      $circle = new Circle($color);
      self::$circleMap[$color] = $circle;
      echo ("<br/ > Creating circle of color : " . $color);
    }
    return $circle;
  }
}

/*Step 4
Use the Factory to get object of concrete class by passing an information such as color.
FlyweightPatternDemo.java*/

class FlyweightPatternDemo
{
  static $colors = array("Red", "Green", "Blue", "White", "Black");

  public static function main($args = null)
  {
    for ($i = 0; $i < 20; ++$i) {
      $circle = ShapeFactory::getCircle(self::getRandomColor());
      $circle->setX(self::getRandomX());
      $circle->setY(self::getRandomY());
      $circle->setRadius(100);
      $circle->draw();
    }
  }

  static function getRandomColor()
  {
    return self::$colors[rand(0, count(self::$colors)-1)];
  }

  static function getRandomX()
  {
    return rand(1, 100);
  }

  private function getRandomY()
  {
    return rand(1, 100);
  }
}

FlyweightPatternDemo::main();