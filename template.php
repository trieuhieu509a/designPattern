<img src="./template_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Hướng dẫn Java Design Pattern - Template Pattern
 * Template Pattern là gì?
 * Trong Template Pattern, một lớp trừu tượng cho thấy cách được định nghĩa (s) / mẫu (s) để thực hiện phương pháp của nó.
 * Lớp con của nó có thể ghi đè lên các phương pháp triển khai thực hiện theo cơ sở cần thiết, nhưng cách gọi là phải cùng một cách như được định nghĩa bởi một lớp trừu tượng.
 * Mô hình này đi kèm theo thể loại mô hình hành vi (behavior pattern).
 */
/*Step 1
Create an abstract class with a template method being final.

Game.java*/

abstract class Game
{
  abstract function initialize();

  abstract function startPlay();

  abstract function endPlay();

  //template method
  public final function play()
  {

    //initialize the game
    $this->initialize();

    //start game
    $this->startPlay();

    //end game
    $this->endPlay();
  }
}

/*Step 2
Create concrete classes extending the above class.

Cricket.java*/

class Cricket extends Game
{


  function endPlay()
  {
    echo("Cricket Game Finished!");
  }


  function initialize()
  {
    echo("Cricket Game Initialized! Start playing.");
  }


  function startPlay()
  {
    echo("Cricket Game Started. Enjoy the game!");
  }
}

//Football.java
class Football extends Game
{


  function endPlay()
  {
    echo("Football Game Finished!");
  }


  function initialize()
  {
    echo("Football Game Initialized! Start playing.");
  }


  function startPlay()
  {
    echo("Football Game Started. Enjoy the game!");
  }
}

/*Use the Game's template method play() to demonstrate a defined way of playing game.
TemplatePatternDemo.java

Step 3*/

class TemplatePatternDemo
{
  public static function main($args)
  {

    $game = new Cricket();
    $game->play();

    $game = new Football();
    $game->play();
  }
}