<img src="./servicelocator_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Service Locator Pattern là gì?
 *
 * The service locator design pattern is used when we want to locate various services using JNDI lookup.
 * Considering high cost of looking up JNDI for a service, Service Locator pattern makes use of caching technique.
 * For the first time a service is required, Service Locator looks up in JNDI and caches the service object.
 * Further lookup or same service via Service Locator is done in its cache which improves the performance of application to great extent.
 * Following are the entities of this type of design pattern.
 *
 * Service - Actual Service which will process the request. Reference of such service is to be looked upon in JNDI server.
 * Context / Initial Context -JNDI Context, carries the reference to service used for lookup purpose.
 * Service Locator - Service Locator is a single point of contact to get services by JNDI lookup, caching the services.
 * Cache - Cache to store references of services to reuse them
 * Client - Client is the object who invokes the services via ServiceLocator.
 */
/*Step 1

Create Service interface.

Service.java*/

interface Service
{
  public function getName();

  public function execute();
}

/*Step 2

Create concrete services.

Service1.java*/

class Service1 implements Service
{
  public function execute()
  {
    echo("Executing Service1");
  }


  public function getName()
  {
    return "Service1";
  }
}

//Service2.java
class Service2 implements Service
{
  public function execute()
  {
    echo("Executing Service2");
  }


  public function getName()
  {
    return "Service2";
  }
}

/*Step 3

Create InitialContext for JNDI lookup

InitialContext.java*/

class InitialContext
{
  public function lookup($jndiName)
  {
    if (strcasecmp($jndiName, "SERVICE1") == 0) {
      echo("<br/> Looking up and creating a new Service1 object");
      return new Service1();
    } else if (strcasecmp($jndiName, "SERVICE2") == 0) {
      echo("<br/> Looking up and creating a new Service2 object");
      return new Service2();
    }
    return null;
  }
}

/*Step 4

Create Cache

Cache.java*/

class Cache
{

  private $services;

  public function Cache()
  {
    $this->services = array();
  }

  public function getService($serviceName)
  {
    foreach ($this->services as $service) {
      if (strcasecmp($service->getName(), $serviceName) == 0) {
        echo("<br/> Returning cached  " . $serviceName . " object");
        return $service;
      }
    }
    return null;
  }

  public function addService($newService)
  {
    $exists = false;
    foreach ($this->services as $service) {
      if (strcasecmp($service->getName(), $newService->getName()) == 0) {
        $exists = true;
      }
    }
    if (!$exists) {
      $this->services[] = $newService;
    }
  }
}

/*Step 5

Create Service Locator

ServiceLocator.java*/

class ServiceLocator
{
  private static $cache;

  public static function getService($jndiName)
  {
    if (!self::$cache) {
      self::$cache = new Cache();
    }

    $service = self::$cache->getService($jndiName);

    if ($service != null) {
      return $service;
    }

    $context = new InitialContext();
    $service1 = $context->lookup($jndiName);
    self::$cache->addService($service1);
    return $service1;
  }
}

/*Step 6

Use the ServiceLocator to demonstrate Service Locator Design Pattern.

ServiceLocatorPatternDemo.java*/

class ServiceLocatorPatternDemo
{
  public static function main($args)
  {
    $service = ServiceLocator::getService("Service1");
    $service->execute();
    $service = ServiceLocator::getService("Service2");
    $service->execute();
    $service = ServiceLocator::getService("Service1");
    $service->execute();
    $service = ServiceLocator::getService("Service2");
    $service->execute();
  }
}
ServiceLocatorPatternDemo::main(null);