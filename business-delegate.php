<img src="./business_delegate_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Hướng dẫn Java Design Pattern - Business Delegate Pattern
 * Business Delegate Pattern là gì?
 *
 * Business Delegate Pattern được sử dụng để tách presentation tier và business tier.
 * Nó là cơ bản sử dụng để làm giảm chức năng tra cứu thông tin liên lạc hoặc điều khiển từ xa cho business tier đang cấp trong presentation tier. Trong business tier, bao gồm:
 *
 * - Client
 * - Business Delegate
 * - LookUp Service
 * - Business Service - Business Service interface.
 */
/*Step 1
Create BusinessService Interface.

BusinessService.java*/

interface BusinessService
{
  public function doProcessing();
}

/*Step 2
Create Concreate Service Classes.

EJBService.java*/

class EJBService implements BusinessService
{

  public function doProcessing()
  {
    echo("Processing task by invoking EJB Service");
  }
}

//JMSService.java
class JMSService implements BusinessService
{


  public function doProcessing()
  {
    echo("Processing task by invoking JMS Service");
  }
}

/*Step 3
Create Business Lookup Service.

BusinessLookUp.java*/

class BusinessLookUp
{
  public function getBusinessService($serviceType)
  {
    if (strcasecmp ( $serviceType , "EJB" )) {
      return new EJBService();
    } else {
      return new JMSService();
    }
  }
}

/*Step 4
Create Business Delegate.

BusinessDelegate.java*/

class BusinessDelegate
{
  private $lookupService;
  private $businessService;
  private $serviceType;

  public function __construct()
  {
    $this->lookupService = new BusinessLookUp();
  }

  public function setServiceType($serviceType)
  {
    $this->serviceType = $serviceType;
  }

  public function doTask()
  {
    $this->businessService = $this->lookupService->getBusinessService($this->serviceType);
    $this->businessService->doProcessing();
  }
}

/*Step 5book.
Create Client.

Student.java*/

class Client
{

  public $businessService;

  public function Client($businessService)
  {
    $this->businessService = $businessService;
  }

  public function doTask()
  {
    $this->businessService->doTask();
  }
}

/*Step 6
Use BusinessDelegate and Client classes to demonstrate Business Delegate pattern.

BusinessDelegatePatternDemo.java*/

class BusinessDelegatePatternDemo
{

  public static function main($args)
  {

    $businessDelegate = new BusinessDelegate();
    $businessDelegate->setServiceType("EJB");

    $client = new Client($businessDelegate);
    $client->doTask();

    $businessDelegate->setServiceType("JMS");
    $client->doTask();
  }
}