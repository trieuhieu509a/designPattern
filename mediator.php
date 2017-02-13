<img src="./mediator_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Mediator Pattern là gì?
 * Mediator Pattern được sử dụng để giảm độ phức tạp liên lạc giữa nhiều đối tượng hoặc các lớp.
 * Mô hình này cung cấp một lớp trung gian xử lý tất cả các thông tin liên lạc giữa các lớp khác nhau và hỗ trợ dễ dàng bảo trì.
 * Mediator Pattern thuộc thể loại mô hình hành vi (behavioral pattern).
 */
/*Step 1
Create mediator class.

ChatRoom.java*/

class ChatRoom
{
  public static function showMessage($user, $message)
  {
    echo ( Date('Y-m-d H:i:s') . " [" . $user->getName() . "] : " . $message);
  }
}


/*Step 2
Create user class

User.java*/

class User
{
  private $name;

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }


  public function User($name)
  {
    $this->name = $name;
  }

  public function sendMessage($message)
  {
    ChatRoom::showMessage($this, $message);
  }
}

/*Step 3

Use the User object to show communications between them.

MediatorPatternDemo.java*/
class MediatorPatternDemo
{
  public static function main($args)
  {
    $robert = new User("Robert");
    $john = new User("John");

    $robert->sendMessage("Hi! John!");
    $john->sendMessage("Hello! Robert!");
  }
}
MediatorPatternDemo::main(null);