<img src="./filter_pattern_uml_diagram.jpg" alt="">
<?php
/*Filter/Criteria Pattern là gì?
  Filter Pattern hay Criteria Pattern là một Pattern cho phép các nhà phát triển để lọc một tập các đối tượng,
  sử dụng các tiêu chí khác nhau, móc nối chúng thông qua các hoạt động hợp lý.
  Đây là loại design pattern thuộc mô hình cấu trúc (structural pattern) như mô hình này được kết hợp nhiều tiêu chí để có được tiêu chuẩn duy nhất.
*/

/*
 * Step 1
 * Create a class on which criteria is to be applied.
*/

//Person.java
class Person
{

  private $name;
  private $gender;
  private $maritalStatus;

  public function Person($name, $gender, $maritalStatus)
  {
    $this->name = $name;
    $this->gender = $gender;
    $this->maritalStatus = $maritalStatus;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getGender()
  {
    return $this->gender;
  }

  public function getMaritalStatus()
  {
    return $this->maritalStatus;
  }
}

/*
 * Step 2
 * Create an interface for Criteria.
 * */

//Criteria.java
interface Criteria
{
  public function meetCriteria($persons);
}

/*
 * Step 3
 * Create concrete classes implementing the Criteria interface.
 * */

//CriteriaMale.java
class CriteriaMale implements Criteria
{

  public function meetCriteria($persons)
  {
    $malePersons = array();
    foreach ($persons as $person) {
      if (strcasecmp($person->getGender(), "MALE") == 0) {
        $malePersons[] =($person);
      }
    }
    return $malePersons;
  }
}

//CriteriaFemale.java
class CriteriaFemale implements Criteria
{

  public function meetCriteria($persons)
  {
    $femalePersons = array();
    foreach ($persons as $person) {
      if (strcasecmp($person->getGender(), "FEMALE") == 0) {
        $femalePersons[] = ($person);
      }
    }
    return $femalePersons;
  }
}

//CriteriaSingle.java
class CriteriaSingle implements Criteria
{
  public function meetCriteria($persons)
  {
    $singlePersons = array();
    foreach ($persons as $person) {
      if (strcasecmp($person->getGender(), "SINGLE") == 0) {
        $singlePersons[] = ($person);
      }
    }
    return $singlePersons;
  }
}

//AndCriteria.java
class AndCriteria implements Criteria
{

  private $criteria;
  private $otherCriteria;

  public function AndCriteria($criteria, $otherCriteria)
  {
    $this->criteria = $criteria;
    $this->otherCriteria = $otherCriteria;
  }

  public function meetCriteria($persons)
  {
    $firstCriteriaPersons = $this->criteria->meetCriteria($persons);
    return $this->otherCriteria->meetCriteria($firstCriteriaPersons);
  }
}

//OrCriteria.java
class OrCriteria implements Criteria
{

  private $criteria;
  private $otherCriteria;


  public function OrCriteria($criteria, $otherCriteria)
  {
    $this->criteria = $criteria;
    $this->otherCriteria = $otherCriteria;
  }

  public function meetCriteria($persons)
  {
    $firstCriteriaItems = $this->criteria->meetCriteria($persons);
    $otherCriteriaItems = $this->otherCriteria->meetCriteria($persons);

    foreach ($otherCriteriaItems as $person) {
      if (!$this->criteria->meetCriteria($person)) {
        $firstCriteriaItems[] = ($person);
      }
    }
    return $firstCriteriaItems;
  }
}

/*Step4
  Use different Criteria and their combination to filter out persons.
*/

//CriteriaPatternDemo.java

$persons = array();

$persons[] = (new Person("Robert", "Male", "Single"));
$persons[] = (new Person("John", "Male", "Married"));
$persons[] = (new Person("Laura", "Female", "Married"));
$persons[] = (new Person("Diana", "Female", "Single"));
$persons[] = (new Person("Mike", "Male", "Single"));
$persons[] = (new Person("Bobby", "Male", "Single"));

$male = new CriteriaMale();
$female = new CriteriaFemale();
$single = new CriteriaSingle();
$singleMale = new AndCriteria($single, $male);
$singleOrFemale = new OrCriteria($single, $female);

echo("<br/> Males: ");
($male->meetCriteria($persons));

echo("<br/> Females: ");
($female->meetCriteria($persons));

echo("<br/> Single Males: ");
($singleMale->meetCriteria($persons));

echo("<br/> Single Or Females: ");
($singleOrFemale->meetCriteria($persons));

foreach ($persons as $person) {
  echo("<br/> Person : [ Name : " . $person->getName() . ", Gender : " . $person->getGender() . ", Marital Status : " . $person->getMaritalStatus() . " ]");
}