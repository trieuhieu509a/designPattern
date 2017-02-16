<img src="./interpreter_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Interpreter Pattern là gì? (Thông dịch viên)
 * Interpreter pattern cung cấp một cách để đánh giá ngữ pháp ngôn ngữ hoặc biểu thức.
 * Đây là loại hình thuộc mẫu hành vi (behavioral pattern).
 * Mô hình này liên quan đến việc thực hiện một expression interface để giải thích một bối cảnh cụ thể.
 * Mô hình này được sử dụng trong SQL phân tích cú pháp, cơ chế xử lý biểu tượng...
 */
/*Step 1
Create an expression interface.

Expression.java*/

interface Expression
{
  public function interpret($context);
}


/*Step 2
Create concrete classes implementing the above interface.

TerminalExpression.java*/

class TerminalExpression implements Expression
{

  private $data;

  public function TerminalExpression($data)
  {
    $this->data = $data;
  }


  public function interpret($context)
  {
    if (strpos($context, $this->data) !== false) {
      return true;
    }
    return false;
  }
}

//OrExpression.java
class OrExpression implements Expression
{

  private $expr1 = null;
  private $expr2 = null;

  public function OrExpression($expr1, $expr2)
  {
    $this->expr1 = $expr1;
    $this->expr2 = $expr2;
  }


  public function interpret($context)
  {
    return $this->expr1->interpret($context) || $this->expr2->interpret($context);
  }
}

//AndExpression.java
class AndExpression implements Expression
{

  private $expr1 = null;
  private $expr2 = null;


  public function AndExpression($expr1, $expr2)
  {
    $this->expr1 = $expr1;
    $this->expr2 = $expr2;
  }


  public function interpret($context)
  {
    return $this->expr1->interpret($context) && $this->expr2->interpret($context);
  }
}

/*Step 3
InterpreterPatternDemo uses Expression class to create rules and then parse them.

InterpreterPatternDemo.java*/

class InterpreterPatternDemo
{

  //Rule: Robert and John are male
  public static function getMaleExpression()
  {
    $robert = new TerminalExpression("Robert");
    $john = new TerminalExpression("John");
    return new OrExpression($robert, $john);
  }

  //Rule: Julie is a married women
  public static function getMarriedWomanExpression()
  {
    $julie = new TerminalExpression("Julie");
    $married = new TerminalExpression("Married");
    return new AndExpression($julie, $married);
  }

  public static function main($args)
  {
    $isMale = self::getMaleExpression();
    $isMarriedWoman = self::getMarriedWomanExpression();

    echo "John is male? " . $isMale->interpret("John");
    echo "Julie is a married women? " . $isMarriedWoman->interpret("Married Julie");
  }
}

InterpreterPatternDemo::main(null);