<img src="./builder_pattern_uml_diagram.jpg">
<?php
/*  Builder Pattern là gì?
    Builder Pattern xây dựng một đối tượng phức tạp bằng cách sử dụng các đối tượng đơn giản và sử dụng tiếp cận từng bước.
    Đây là loại design pattern thuộc creational pattern, mô hình này cung cấp một trong những cách tốt nhất để tạo ra một đối tượng.
    Một lớp Builder xây dựng các đối tượng bước cuối cùng bước. Đối tượng Builder độc lập với các đối tượng khác.
*/


/*
 * Step 1
Create an interface Item representing food item and packing.
 * */

//Item.java
interface Item
{
  public function name();

  public function packing();

  public function price();
}

//Packing.java

interface Packing
{
  public function pack();
}


/*
 * Step 2
Create concreate classes implementing the Packing interface.
 * */

class Wrapper implements Packing
{
  public function pack()
  {
    return " Wrapper";
  }
}

//Bottle.java
class Bottle implements Packing
{
  public function pack()
  {
    return " Bottle";
  }
}

/*Step 3
Create abstract classes implementing the item interface providing default functionalities.
 * */

//Burger.java
abstract class Burger implements Item
{


  public function packing()
  {
    return new Wrapper();
  }


  public function price()
  {
  }
}


//ColdDrink.java
abstract class ColdDrink implements Item
{


  public function packing()
  {
    return new Bottle();
  }

  public function price()
  {

  }
}


/*
 * Step 4
Create concrete classes extending Burger and ColdDrink classes
 * */

//VegBurger.java
class VegBurger extends Burger
{


  public function price()
  {
    return 25.0;
  }


  public function name()
  {
    return " Veg Burger";
  }
}

//ChickenBurger.java
class ChickenBurger extends Burger
{
  public function price()
  {
    return 50.5;
  }

  public function name()
  {
    return " Chicken Burger";
  }
}

//Coke.java
class Coke extends ColdDrink
{

  public function price()
  {
    return 30.0;
  }


  public function name()
  {
    return " Coke";
  }
}

//Pepsi.java
class Pepsi extends ColdDrink
{


  public function price()
  {
    return 35.0;
  }


  public function name()
  {
    return " Pepsi";
  }
}

/*
 * Step 5
Create a Meal class having Item objects defined above.
 * */

//Meal.java
class Meal
{
  private $items = [];

  public function addItem($item)
  {
    $this->items[] = ($item);
  }

  public function getCost()
  {
    $cost = 0.0;
    foreach ($this->items as $item) {
      $cost += $item->price();
    }
    return $cost;
  }

  public function showItems()
  {
    foreach ($this->items as $item) {
      echo("Item : " . $item->name());
      echo(", Packing : " . $item->packing()->pack());
      echo(", Price : " . $item->price());
    }
  }
}


/*
 * Step 6
  Create a MealBuilder class, the actual builder class responsible to create Meal objects.
 * */

class MealBuilder
{

  public function prepareVegMeal()
  {
    $meal = new Meal();
    $meal->addItem(new VegBurger());
    $meal->addItem(new Coke());
    return $meal;
  }

  public function prepareNonVegMeal()
  {
    $meal = new Meal();
    $meal->addItem(new ChickenBurger());
    $meal->addItem(new Pepsi());
    return $meal;
  }
}


/*Step 7
BuiderPatternDemo uses MealBuider to demonstrate builder pattern.
 * */

//BuilderPatternDemo.java

$mealBuilder = new MealBuilder();

$vegMeal = $mealBuilder->prepareVegMeal();
echo("<br/>Veg Meal ");
$vegMeal->showItems();
echo("<br/>Total Cost: " . $vegMeal->getCost());

$nonVegMeal = $mealBuilder->prepareNonVegMeal();
echo("<br/>Non-Veg Meal ");
$nonVegMeal->showItems();
echo("<br/>Total Cost: " . $nonVegMeal->getCost());


?>
