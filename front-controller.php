<img src="./frontcontroller_pattern_uml_diagram.jpg" alt="">
<?php
/**
 * Front Controller Pattern là gì?
 *
 * The front controller design pattern is used to provide a centralized request handling mechanism so that all requests will be handled by a single handler.
 * ( Front controller sử dụng để cung cấp một cơ chế yêu cầu xử lý tập trung vì vậy tất cả yêu cầu sẽ được xử lý bởi một bộ xử lý đơn  )
 * This handler can do the authentication/ authorization/ logging or tracking of request and then pass the requests to corresponding handlers.
 * ( Handler này có thể làm chứng thực / giấy phép / đăng nhập hoặc theo dõi các yêu cầu và sau đó vượt qua các yêu cầu để xử lý tương ứng. )
 * Following are the entities of this type of design pattern.
 * ( Sau đây là các thực thể của kiểu mẫu thiết kế. )
 *
 * Front Controller - Single handler for all kind of request coming to the application (either web based/ desktop based).
 * ( Front Controller - xử lý đơn cho tất cả các loại yêu cầu đến các ứng dụng (hoặc dựa trên web / máy tính để bàn dựa). )
 * Dispatcher - Front Controller may use a dispatcher object which can dispatch the request to corresponding specific handler.
 * ( Dispatcher - Front Controller có thể sử dụng một đối tượng điều phối mà có thể gửi các yêu cầu tương ứng xử lý cụ thể. )
 * View - Views are the object for which the requests are made.
 * ( Xem - Lượt xem là đối tượng mà các yêu cầu được thực hiện. )
 */
/*Step 1
Create Views.

HomeView.java*/

class HomeView
{
  public function show()
  {
    echo ("</br> Displaying Home Page");
  }
}

//StudentView.java
class StudentView
{
  public function show()
  {
    echo ("</br> Displaying Student Page");
  }
}

/*Step 2
Create Dispatcher.

Dispatcher.java*/

class Dispatcher
{
  private $studentView;
  private $homeView;

  public function Dispatcher()
  {
    $this->studentView = new StudentView();
    $this->homeView = new HomeView();
  }

  public function dispatch($request)
  {
    if (strcasecmp($request, "STUDENT") == 0) {
      $this->studentView->show();
    } else {
      $this->homeView->show();
    }
  }
}

/*Step 3
Create FrontController

Context.java*/

class FrontController
{

  private $dispatcher;

  public function FrontController()
  {
    $this->dispatcher = new Dispatcher();
  }

  private function isAuthenticUser()
  {
    echo ("</br> User is authenticated successfully.");
    return true;
  }


  private function trackRequest($request)
  {
    echo ("</br> Page requested: " . $request);
  }

  public function dispatchRequest($request)
  {
    //log each request
    $this->trackRequest($request);
    //authenticate the user
    if ($this->isAuthenticUser()) {
      $this->dispatcher->dispatch($request);
    }
  }
}

/*Step 4
Use the FrontController to demonstrate Front Controller Design Pattern.

FrontControllerPatternDemo.java*/

class FrontControllerPatternDemo
{
  public static function main($args)
  {
    $frontController = new FrontController();
    $frontController->dispatchRequest("HOME");
    $frontController->dispatchRequest("STUDENT");
  }
}

FrontControllerPatternDemo::main(null);