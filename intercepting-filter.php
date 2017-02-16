<img src="./interpreter_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Intercepting Filter Pattern là gì?
 *
 * The intercepting filter design pattern is used when we want to do some pre-processing / post-processing with request or response of the application.
 * ( intercepting filter suwr dujng khi muốn xử lý request/respone trước/sau 1 process )
 * Filters are defined and applied on the request before passing the request to actual target application.
 * ( Filters xác định và áp dụng cho request trước khi phân tích request thực sự tới ứng dụng )
 * Filters can do the authentication/ authorization/ logging or tracking of request and then pass the requests to corresponding (tương ứng) handlers.
 * Following are the entities of this type of design pattern.
 *
 * Filter - Filter which will perform certain task prior or after execution of request by request handler.
 * Filter Chain - Filter Chain carries multiple filters and help to execute them in defined order on target.
 * Target - Target object is the request handler
 * Filter Manager - Filter Manager manages the filters and Filter Chain.
 * Client - Client is the object who sends request to the Target object.
 */
/*Step 1
Create Filter interface.

Filter.java*/

interface Filter
{
  public function execute($request);
}

/*Step 2
Create concrete filters.

AuthenticationFilter.java*/

class AuthenticationFilter implements Filter
{
  public function execute($request)
  {
    echo("<br/> Authenticating request: " . $request);
  }
}

//DebugFilter.java
class DebugFilter implements Filter
{
  public function execute($request)
  {
    echo("<br/> request log: " . $request);
  }
}

/*Step 3
Create Target

Target.java*/

class Target
{
  public function execute($request)
  {
    echo("<br/> Executing request: " . $request);
  }
}

/*Step 4
Create Filter Chain

FilterChain.java*/

class FilterChain
{
  private $filters = array();
  private $target;

  public function addFilter($filter)
  {
    $this->filters[] = $filter;
  }

  public function execute($request)
  {
    foreach ($this->filters as $filter) {
      $filter->execute($request);
    }
    $this->target->execute($request);
  }

  public function setTarget($target)
  {
    $this->target = $target;
  }
}

/*Step 5
Create Filter Manager

FilterManager.java*/

class FilterManager
{
  public $filterChain;

  public function FilterManager($target)
  {
    $this->filterChain = new FilterChain();
    $this->filterChain->setTarget($target);
  }

  public function setFilter($filter)
  {
    $this->filterChain->addFilter($filter);
  }

  public function filterRequest($request)
  {
    $this->filterChain->execute($request);
  }
}

/*Step 6
Create Client

Client.java*/

class Client
{
  public $filterManager;

  public function setFilterManager($filterManager)
  {
    $this->filterManager = $filterManager;
  }

  public function sendRequest($request)
  {
    $this->filterManager->filterRequest($request);
  }
}

/*Step 7
Use the Client to demonstrate Intercepting Filter Design Pattern.

FrontControllerPatternDemo.java*/

class InterceptingFilterDemo
{
  public static function main($args)
  {
    $filterManager = new FilterManager(new Target());
    $filterManager->setFilter(new AuthenticationFilter());
    $filterManager->setFilter(new DebugFilter());

    $client = new Client();
    $client->setFilterManager($filterManager);
    $client->sendRequest("HOME");
  }
}

InterceptingFilterDemo::main(null);