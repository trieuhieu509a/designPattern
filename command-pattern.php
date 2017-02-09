<img src="./command_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Command Pattern là gì?
 * Command pattern là một mẫu thiết kế hướng dữ liệu và thuộc thể loại mô hình hành vi (behavioral pattern).
 * Một yêu cầu được đóng gói trong một đối tượng là chỉ huy và truyền cho Invoker đối tượng.
 * Đối tượng Invoker sẽ cho các đối tượng thích hợp có thể xử lý lệnh và chuyển lệnh cho các đối tượng tương ứng và đối tượng thực thi lệnh.
 */
/*Step 1
Create a command interface.

Order.java*/

interface Order
{
  function execute();
}

/*Step 2
Create a request class.

Stock.java*/

class Stock
{

  private $name = "ABC";
  private $quantity = 10;

  public function buy()
  {
    echo("Stock [ Name: " . $this->name . ", Quantity: " . $this->quantity . " ] bought");
  }

  public function sell()
  {
    echo("Stock [ Name: " . $this->name . ",  Quantity: " . $this->quantity . " ] sold");
  }
}


/*Step 3
Create concrete classes implementing the Order interface.

BuyStock.java*/

class BuyStock implements Order
{
  private $abcStock;

  public function BuyStock($abcStock)
  {
    $this->abcStock = $abcStock;
  }

  public function execute()
  {
    $this->abcStock->buy();
  }
}

//SellStock.java

class SellStock implements Order
{
  private $abcStock;

  public function SellStock($abcStock)
  {
    $this->abcStock = $abcStock;
  }

  public function execute()
  {
    $this->abcStock->sell();
  }
}

/*Step 4
Create command invoker class.

Broker.java*/

class Broker
{
  private $orderList = [];

  public function takeOrder($order)
  {
    $this->orderList[] = $order;
  }

  public function placeOrders()
  {
    foreach ($this->orderList as $order) {
      $order->execute();
    }
    unset($this->orderList);
  }
}


/*Step 5
Use the Broker class to take and execute commands.

CommandPatternDemo.java*/

class CommandPatternDemo
{
  public static function main($args)
  {
    $abcStock = new Stock();

    $buyStockOrder = new BuyStock($abcStock);
    $sellStockOrder = new SellStock($abcStock);

    $broker = new Broker();
    $broker->takeOrder($buyStockOrder);
    $broker->takeOrder($sellStockOrder);
    $broker->placeOrders();
  }
}

CommandPatternDemo::main(null);