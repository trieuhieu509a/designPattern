<?php
/**
 * Hướng dẫn Java Design Pattern - State Pattern
 * State Pattern là gì?
 * Trong State Pattern, hành vi một class được thay đổi dựa trên trạng thái của nó. Đây là loại mẫu thiết kế thuộc mô hình hành vi (behavior pattern).
 *
 * Trong State pattern, chúng tôi tạo các đối tượng đại diện cho các state khác nhau và một đối tượng mà hành vi của đối tượng khác nhau như thay đổi trạng thái của nó.
 */
/*Step 1
Create an interface.

Image.java*/

interface State
{
  public function doAction($context);
}

/*Step 2
Create concrete classes implementing the same interface.

StartState.java*/

class StartState implements State
{

  public function doAction($context)
  {
    echo("Player is in start state");
    $context->setState($this);
  }

  public function toString()
  {
    return "Start State";
  }
}

//StopState.java

class StopState implements State
{

  public function doAction($context)
  {
    echo("Player is in stop state");
    $context->setState($this);
  }

  public function toString()
  {
    return "Stop State";
  }
}


/*Step 3
Create Context Class.

Context.java*/

class Context
{
  private $state;

  public function Context()
  {
    $this->state = null;
  }

  public function setState($state)
  {
    $this->state = $state;
  }

  public function getState()
  {
    return $this->state;
  }
}

/*Step 4
Use the Context to see change in behaviour when State changes.

StatePatternDemo.java*/

class StatePatternDemo
{
  public static function main($args)
  {
    $context = new Context();

    $startState = new StartState();
    $startState->doAction($context);

    echo $context->getState()->toString();

    $stopState = new StopState();
    $stopState->doAction($context);

    echo $context->getState()->toString();
  }
}

