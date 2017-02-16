<img src="./visitor_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Hướng dẫn Java Design Pattern - Visitor Pattern
 * Visitor Pattern là gì?
 * Trong Visitor Pattern, chúng tôi sử dụng một lớp khách hàng (visitor class) có thể thay đổi thuật toán thực hiện của một lớp thành phần.
 * Bằng cách này, thuật toán thực hiện các yếu tố có thể thay đổi khi khách truy cập khác nhau.
 * Mô hình này thuộc loại mô hình hành vi (behavior pattern).
 * Theo mô hình, đối tượng phần tử có để chấp nhận các đối tượng khách truy cập để đối tượng khách xử lý các hoạt động trên các đối tượng phần tử.
 */
/*Step 1
Define an interface to represent element.

ComputerPart.java*/

interface ComputerPart
{
  public function accept($computerPartVisitor);
}

/*Step 2
Create concrete classes extending the above class.

Keyboard.java*/

class Keyboard implements ComputerPart
{


  public function accept($computerPartVisitor)
  {
    $computerPartVisitor->visit($this);
  }
}

//Monitor.java
class Monitor implements ComputerPart
{


  public function accept($computerPartVisitor)
  {
    $computerPartVisitor->visit($this);
  }
}

//Mouse.java
class Mouse implements ComputerPart
{


  public function accept($computerPartVisitor)
  {
    $computerPartVisitor->visit($this);
  }
}

//Computer.java
class Computer implements ComputerPart
{

  public $parts = array();

  public function Computer()
  {
    $this->parts = array(new Mouse(), new Keyboard(), new Monitor());
  }


  public function accept($computerPartVisitor)
  {
    for ($i = 0; $i < count($this->parts); i++) {
      $this->parts[i]->accept($computerPartVisitor);
    }
    $computerPartVisitor->visit($this);
  }
}


/*Step 3
Define an interface to represent visitor.

ComputerPartVisitor.java*/
public

interface ComputerPartVisitor
{
  public function visit(Computer $computer);

  public function visit(Mouse $mouse);

  public function visit(Keyboard $keyboard);

  public function visit(Monitor $monitor);
}

/*Step 4
Create concrete visitor implementing the above class.

ComputerPartDisplayVisitor.java*/

class ComputerPartDisplayVisitor implements ComputerPartVisitor
{


  public function visit(Computer $computer)
  {
    echo("Displaying Computer.");
  }

  public function visit(Mouse $mouse)
  {
    echo("Displaying Mouse.");
  }

  public function visit(Keyboard $keyboard)
  {
    echo("Displaying Keyboard.");
  }

  public function visit(Monitor $monitor)
  {
    echo("Displaying Monitor.");
  }
}

/*Step 5
Use the ComputerPartDisplayVisitor to display parts of Computer.

VisitorPatternDemo.java*/

class VisitorPatternDemo
{
  public static function main($args)
  {

    $computer = new Computer();
    $computer->accept(new ComputerPartDisplayVisitor());
  }
}

