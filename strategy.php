<img src="./strategy_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Hướng dẫn Java Design Pattern - Strategy Pattern
 * Strategy Pattern là gì?
 * Trong Strategy Pattern, một hành vi của class hoặc thuật toán của nó có thể thay đổi thời gian chạy. Đây là loại mẫu thiết kế thuộc mô hình hành vi (behavior pattern).
 * Trong Strategy Pattern, chúng tôi tạo các đối tượng đại diện cho các chiến lược khác nhau và một context object mà hành vi thay đổi theo đối tượng chiến lược của mình.
 * Các strategy object thay đổi thuật toán thực hiện của context object.
 */
/*Step 1
Create an interface.

Strategy.java*/

interface Strategy
{
  public function doOperation($num1, $num2);
}


/*Step 2
Create concrete classes implementing the same interface.

OperationAdd.java*/

class OperationAdd implements Strategy
{

  public function doOperation($num1, $num2)
  {
    return $num1 + $num2;
  }
}

//OperationSubstract.java
class OperationSubstract implements Strategy
{

  public function doOperation($num1, $num2)
  {
    return $num1 - $num2;
  }
}

//OperationMultiply.java
class OperationMultiply implements Strategy
{
  public function doOperation($num1, $num2)
  {
    return $num1 * $num2;
  }
}

/*Step 3
Create Context Class.

Context.java*/

class Context
{
  private $strategy;


  public function Context($strategy)
  {
    $this->strategy = $strategy;
  }


  public function executeStrategy($num1, $num2)
  {
    return $this->strategy->doOperation($num1, $num2);
  }
}

/*Step 4
Use the Context to see change in behaviour when it changes its Strategy.

StatePatternDemo.java*/

class StrategyPatternDemo
{
  public static function main($args)
  {
    $context = new Context(new OperationAdd());
    echo("10 + 5 = " . $context->executeStrategy(10, 5));


    $context = new Context(new OperationSubstract());
    echo("10 - 5 = " . $context->executeStrategy(10, 5));


    $context = new Context(new OperationMultiply());
    echo("10 * 5 = " . $context->executeStrategy(10, 5));
  }
}

StrategyPatternDemo::main(null);