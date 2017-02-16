<img src="./transferobject_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Transfer Object Pattern là gì?
 *
 * The Transfer Object pattern is used when we want to pass data with multiple attributes in one shot from client to server.
 * Transfer object is also known as Value Object.
 * Transfer Object is a simple POJO class having getter/setter methods and is serializable so that it can be transferred over the network.
 * It do not have any behavior. Server Side business class normally fetches data from the database and fills the POJO and send it to the client or pass it by value.
 * For client, transfer object is read-only. Client can create its own transfer object and pass it to server to update values in database in one shot.
 * Following are the entities of this type of design pattern.
 *
 * Business Object - Business Service which fills the Transfer Object with data.
 * Transfer Object -Simple POJO, having methods to set/get attributes only.
 * Client - Client either requests or sends the Transfer Object to Business Object.
 */
/*Step 1

Create Transfer Object.

StudentVO.java*/

class StudentVO
{
  private $name;
  private $rollNo;

  function StudentVO($name, $rollNo)
  {
    $this->name = $name;
    $this->rollNo = $rollNo;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getRollNo()
  {
    return $this->rollNo;
  }

  public function setRollNo($rollNo)
  {
    $this->rollNo = $rollNo;
  }
}

/*Step 2

Create Business Object.

StudentBO.java*/

class StudentBO
{

  //list is working as a database
  public $students = array();

  public function StudentBO()
  {
    $this->students = array();
    $student1 = new StudentVO("Robert", 0);
    $student2 = new StudentVO("John", 1);
    $this->students[] = $student1;
    $this->students[] = $student2;
  }

  public function deleteStudent($student)
  {
    $this->students->remove($student->getRollNo());
    echo("Student: Roll No " . $student->getRollNo() . ", deleted from database");
  }

  //retrive list of students from the database
  public function getAllStudents()
  {
    return $this->students;
  }

  public function getStudent($rollNo)
  {
    return $this->students[$rollNo];
  }

  public function updateStudent($student)
  {
    $this->students[$student->getRollNo()]->setName($student->getName());
    echo("Student: Roll No " . $student->getRollNo() . ", updated in the database");
  }
}


/*Step 3

Use the StudentBO to demonstrate Transfer Object Design Pattern.

TransferObjectPatternDemo.java*/

class TransferObjectPatternDemo
{
  public static function main($args)
  {
    $studentBusinessObject = new StudentBO();

    //pr$all students
    foreach ($studentBusinessObject->getAllStudents() as $student) {
      echo("Student: [RollNo : " . $student->getRollNo() . ", Name : " . $student->getName() . " ]");
    }

    //update student
    $student = $studentBusinessObject->getAllStudents()[0];
    $student->setName("Michael");
    $studentBusinessObject->updateStudent($student);

    //get the student
    $studentBusinessObject->getStudent(0);
    echo("Student: [RollNo : " . $student->getRollNo() . ", Name : " . $student->getName() . " ]");
  }
}

TransferObjectPatternDemo::main(null);