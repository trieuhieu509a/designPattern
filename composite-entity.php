<img src="./compositeentity_pattern_uml_diagram.jpg" alt="">
<?php
/**
 */
/*Step 1
Create Dependent Objects.

DependentObject1.java*/

class DependentObject1
{
  private $data;

  public function setData($data)
  {
    $this->data = $data;
  }

  public function getData()
  {
    return $this->data;
  }
}

//DependentObject2.java
class DependentObject2
{
  private $data;

  public function setData($data)
  {
    $this->data = $data;
  }

  public function getData()
  {
    return $this->data;
  }
}

/*Step 2
Create Coarse Grained Object.

CoarseGrainedObject.java*/

class CoarseGrainedObject
{
  public function CoarseGrainedObject()
  {
    $this->do1 = new DependentObject1();
    $this->do2 = new DependentObject2();
  }

  public function setData($data1, $data2)
  {
    $this->do1->setData($data1);
    $this->do2->setData($data2);
  }

  public function getData()
  {
    return [$this->do1->getData() , $this->do2->getData()];
  }
}

/*Step 3
Create Composite Entity.

CompositeEntity.java*/

class CompositeEntity
{
  private $cgo;

  public function CompositeEntity()
  {
    $this->cgo = new CoarseGrainedObject();
  }

  public function setData($data1, $data2)
  {
    $this->cgo->setData($data1, $data2);
  }

  public function getData()
  {
    return $this->cgo->getData();
  }
}


/*Step 4
Create Client class to use Composite Entity.

Client.java*/

class Client
{
  private $compositeEntity;

  public function Client()
  {
    $this->compositeEntity = new CompositeEntity();
  }

  public function printData()
  {
    for ($i = 0; $i < count($this->compositeEntity->getData()); $i++) {
      echo("<br/> Data: " . $this->compositeEntity->getData()[$i]);
    }
  }

  public function setData($data1, $data2)
  {
    $this->compositeEntity->setData($data1, $data2);
  }
}

/*Step 5
Use the Client to demonstrate Composite Entity design pattern usage.

CompositeEntityPatternDemo.java*/

class CompositeEntityPatternDemo
{
  public static function main($args)
  {
    $client = new Client();
    $client->setData("Test", "Data");
    $client->printData();
    $client->setData("Second Test", "Data1");
    $client->printData();
  }
}

CompositeEntityPatternDemo::main(null);
