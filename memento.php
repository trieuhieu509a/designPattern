<img src="./memento_pattern_uml_diagram.jpg" alt="">
<?php
/*
 * Memento Pattern là gì?
  Memento Pattern được sử dụng để làm giảm khi muốn khôi phục lại trạng thái của một đối tượng vào một trạng thái trước đó.
  Memento Pattern thuộc thể loại mô hình hành vi (behavioral pattern).
 */

/*Step 1
Create Memento class.

Memento.java*/

class Memento
{
  private $state;

  public function Memento($state)
  {
    $this->state = $state;
  }

  public function getState()
  {
    return $this->state;
  }
}

/*Step 2
Create Originator class

Originator.java*/

class Originator
{
  private $state;

  public function setState($state)
  {
    $this->state = $state;
  }

  public function getState()
  {
    return $this->state;
  }

  public function saveStateToMemento()
  {
    return new Memento($this->state);
  }

  public function getStateFromMemento($Memento)
  {
    $this->state = $Memento->getState();
  }
}

/*Step 3
Create CareTaker class

CareTaker.java*/

class CareTaker
{
  private $mementoList = array();

  public function add($state)
  {
    $this->mementoList[] = $state;
  }

  public function get($index)
  {
    return $this->mementoList[$index];
  }
}


/*Step 4
Use CareTaker and Originator objects.

MementoPatternDemo.java*/

class MementoPatternDemo
{
  public static function main($args)
  {
    $originator = new Originator();
    $careTaker = new CareTaker();
    $originator->setState("State #1");
    $originator->setState("State #2");
    $careTaker->add($originator->saveStateToMemento());
    $originator->setState("State #3");
    $careTaker->add($originator->saveStateToMemento());
    $originator->setState("State #4");

    echo("<br/> Current State: " . $originator->getState());
    $originator->getStateFromMemento($careTaker->get(0));
    echo("<br/> First saved State: " . $originator->getState());
    $originator->getStateFromMemento($careTaker->get(1));
    echo("<br/> Second saved State: " . $originator->getState());
  }
}
MementoPatternDemo::main(null);