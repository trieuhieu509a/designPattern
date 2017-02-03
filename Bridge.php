<img src="./bridge_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Bridge được sử dụng khi chúng ta cần phải tách riêng các thành phần trừu tượng từ việc thực hiện để cả hai có thể khác nhau một cách độc lập.
 * Đây là loại design pattern đi kèm theo mô hình cấu trúc (structural pattern) như mô hình này tách riêng lớp thực hiện và lớp trừu tượng bằng cách cung cấp một cấu trúc cầu nối giữa chúng.
 *
 * Mô hình này bao gồm một giao diện hoạt động như một cầu nối mà làm cho các chức năng của các lớp cụ thể độc lập từ các lớp giao diện người thực hiện.
 * Cả hai loại lớp có thể được thay đổi cấu trúc mà không ảnh hưởng lẫn nhau.
 */
/*
 * Step 1
 * Create bridge implementer interface.
 */

interface DrawAPI
{
  public function drawCircle($radius, $x, $y);
}

/*
 * Step 2
 *Create concrete bridge implementer classes implementing the DrawAPI interface.
 */

//RedCircle.java
class RedCircle implements DrawAPI
{
  public function drawCircle($radius, $x, $y)
  {
    echo("<br/> Drawing Circle[ color: red, radius: " . $radius . ", x: " . $x . ", " . $y . "]");
  }
}

//GreenCircle.java
class GreenCircle implements DrawAPI
{
  public function drawCircle($radius, $x, $y)
  {
    echo("<br/> Drawing Circle[ color: green, radius: " . $radius . ", x: " . $x . ", " . $y . "]");
  }
}

/*Step 3
  Create an abstract class Shape using the DrawAPI interface.
*/

//Shape.java
abstract class Shape
{
  protected $drawAPI;

  protected function Shape($drawAPI)
  {
    $this->drawAPI = $drawAPI;
  }

  public function draw()
  {
  }
}

/*Step 4
  Create concrete class implementing the Shape interface.
*/

//Circle.java
class Circle extends Shape
{
  private $x, $y, $radius;

  public function Circle($x, $y, $radius, $drawAPI)
  {
    self::Shape($drawAPI);
    $this->x = $x;
    $this->y = $y;
    $this->radius = $radius;
  }

  public function draw()
  {
    $this->drawAPI->drawCircle($this->radius, $this->x, $this->y);
  }
}

/*Step 5
Use the Shape and DrawAPI classes to draw different colored circles.*/

$redCircle = new Circle(100, 100, 10, new RedCircle());
$greenCircle = new Circle(100, 100, 10, new GreenCircle());

$redCircle->draw();
$greenCircle->draw();