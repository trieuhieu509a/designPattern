<img src="./dao_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Data Access Object Pattern là gì?
 *
 * Data Access Object Pattern or DAO pattern is used to separate low level data accessing API or operations from high level business services.
 * Following are the participants in Data Access Object Pattern.
 *
 * Data Access Object Interface : - This interface defines the standard operations to be performed on a model object(s). ( Interface này xác định toán tử tiêu chuẩn để thực hiện trong đối tượng model)
 * Data Access Object concrete class: -This class implements above interface. (Class này thi hành dưa trên interface ở trên)
 *                                     -This class is responsible to get data from a datasource which can be database / xml or any other storage mechanism. (Class này có trách nhiệm lấy data từ data source có thẻ lad database)
 * Model Object or Value Object - This object is simple POJO containing get/set methods to store data retrieved using DAO class. ( Đối tượng này là đối tượng Java thuần túy chứa get/set để lưu data nhận từ DAO )
 */
/*Step 1
Create Value Object.

Student.java*/

class Student
{
  private $name;
  private $rollNo;

  function Student($name, $rollNo)
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
Create Data Access Object Interface.

StudentDao.java*/

interface StudentDao
{
  public function getAllStudents();

  public function getStudent($rollNo);

  public function updateStudent($student);

  public function deleteStudent($student);
}

/*Step 3
Create concreate class implementing above interface.

StudentDaoImpl.java*/

class StudentDaoImpl implements StudentDao
{

  //list is working as a database
  public $students;

  public function StudentDaoImpl()
  {
    $this->students = array();
    $student1 = new Student("Robert", 0);
    $student2 = new Student("John", 1);
    $this->students[] = $student1;
    $this->students[] = $student2;
  }

  public function deleteStudent($student)
  {
    $this->students->remove($student->getRollNo());
    echo("<br/> Student: Roll No " . $student->getRollNo() . ", deleted from database");
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
    echo("<br/> Student: Roll No " . $student->getRollNo() . ", updated in the database");
  }
}

/*Step 4
Use the StudentDao to demonstrate Data Access Object pattern usage.

CompositeEntityPatternDemo.java*/

class DaoPatternDemo
{
  public static function main($args)
  {
    $studentDao = new StudentDaoImpl();

    //print all students
    foreach ($studentDao->getAllStudents() as $student) {
      echo("<br/> Student: [RollNo : " . $student->getRollNo() . ", Name : " . $student->getName() . " ]");
    }

    //update student
    $student = $studentDao->getAllStudents()[0];
    $student->setName("Michael");
    $studentDao->updateStudent($student);

    //get the student
    $studentDao->getStudent(0);
    echo("<br/> Student: [RollNo : " . $student->getRollNo() . ", Name : " . $student->getName() . " ]");
  }
}

DaoPatternDemo::main(null);