<img src="./iterator_pattern_uml_diagram.jpg" alt="">
<?php
/*Iterator Pattern là gì?
Iterator Pattern rất thường được sử dụng trong môi trường lập trình Java và .Net. Mô hình này được sử dụng để có được một cách để truy cập các phần tử của một đối tượng bộ sưu tập theo cách tuần tự mà không cần phải biết đại diện cơ bản của nó.

Mẫu Iterator thuộc thể loại mô hình hành vi (behavioral pattern).*/

/*Step 1
Create interfaces.

Iterator.java*/

interface Iterator1
{
  public function hasNext();

  public function next();
}

//Container.java
interface Container
{
  public function getIterator();
}

/*Step 2
Create concrete class implementing the Container interface. This class has inner class NameIterator implementing the Iterator interface.

NameRepository.java*/

class NameRepository implements Container
{
  public $names = array("Robert", "John", "Julie", "Lora");

  public function getIterator()
  {
    return new NameIterator();
  }
}

class NameIterator implements Iterator1
{

  public $index;

  public function hasNext()
  {

    if ($this->index < count($this->names)) {
      return true;
    }
    return false;
  }

  public function next()
  {
    if ($this->hasNext()) {
      return $this->names[$this->index++];
    }
    return null;
  }
}

/*Step 3
Use the NameRepository to get iterator and print names.

IteratorPatternDemo.java*/

class IteratorPatternDemo
{

  public static function main($args)
  {
    $namesRepository = new NameRepository();

    for ($iter = $namesRepository->getIterator(); $iter . hasNext();) {
      $name = $iter->next();
      echo("Name : " + name);
    }
  }
}
