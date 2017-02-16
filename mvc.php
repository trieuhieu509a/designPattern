<img src="./mvc_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Hướng dẫn Java Design Pattern - MVC Pattern
 * MVC Pattern là gì?
 *
 * MVC Pattern là viết tắt của Model-View-Controller. Mô hình này được sử dụng để thể hiện thành phần ứng dụng riêng biệt.
 *
 * Model - Model đại diện cho một đối tượng hoặc JAVA POJO mang dữ liệu. Nó cũng có thể có logic để cập nhật bộ điều khiển nếu thay đổi dữ liệu của nó.
 * View - View đại diện cho thành phần dữ liệu.
 * Controller - Điều khiển hoạt động trên cả hai Model & View. Nó kiểm soát các luồng dữ liệu vào mô hình đối tượng và cập nhật xem bất cứ khi nào thay đổi dữ liệu.
 */
/*Step 1
Create Model.

Student.java*/

class Student
{
  private $rollNo;
  private $name;

  public function getRollNo()
  {
    return $this->rollNo;
  }

  public function setRollNo($rollNo)
  {
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
}

/*Step 2
Create View.

StudentView.java*/

class StudentView
{
  public function printStudentDetails($studentName, $studentRollNo)
  {
    echo("Student: ");
    echo("Name: " . $studentName);
    echo("Roll No: " . $studentRollNo);
  }
}

/*Step 3
Create Controller.

StudentController.java*/

class StudentController
{
  private $model;
  private $view;

  public function StudentController($model, $view)
  {
    $this->model = $model;
    $this->view = $view;
  }

  public function setStudentName($name)
  {
    $this->model->setName($name);
  }

  public function getStudentName()
  {
    return $this->model->getName();
  }

  public function setStudentRollNo($rollNo)
  {
    $this->model->setRollNo($rollNo);
  }

  public function getStudentRollNo()
  {
    return $this->model->getRollNo();
  }

  public function updateView()
  {
    $this->view->printStudentDetails($this->model->getName(), $this->model->getRollNo());
  }
}

/*Step 4
Use the StudentController methods to demonstrate MVC design pattern usage.

MVCPatternDemo.java*/

class MVCPatternDemo
{
  public static function main($args)
  {

    //fetch student record based on his roll no from the database
    $model = self::retriveStudentFromDatabase();

    //Create a view : to write student details on console
    $view = new StudentView();

    $controller = new StudentController($model, $view);

    $controller->updateView();

    //update model data
    $controller->setStudentName("John");

    $controller->updateView();
  }

  private static function retriveStudentFromDatabase()
  {
    $student = new Student();
    $student->setName("Robert");
    $student->setRollNo("10");
    return $student;
  }
}

MVCPatternDemo::main(null);