<?php

/*
Có một số trường hợp khi hệ thống phải sử dụng một vài chức năng và một vài trường hợp nó không sử dụng.
Giả sử bạn phải thực hiện một class mà nó phải ghi log vào môt file hoặc console.
Nhưng điều này chỉ là một tính năng bổ sung và các dữ liệu được ghi phụ thuộc vào cách cấu hình ghi log của bạn.
Nếu có những trường hợp khi một vài module không cần phải ghi lại log thì bạn phải thực hiện việc kiểm tra xem những module này có cần phải thực hiện log hay không trong một khối IF để kiểm tra trong file cấu hình. Như vậy, việc triển khai này không phải là một giải pháp hay. Và Null Object Design Pattern ra đời từ đây.
Null Object Design Pattern là gì?
Nó cung cấp một null object để thay thế cho trường hợp một instance bị NULL.
Thay vì sử dụng một lệnh IF để check một null value, Null Object sẽ phản ánh một mối liên hệ không phải thực hiện - không làm gì cả.
 */

class Service
{
  /**
   * @var LoggerInterface
   */
  private $logger;

  /**
   * @param LoggerInterface $logger
   */
  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  /**
   * do something ...
   */
  public function doSomething()
  {
    // notice here that you don't have to check if the logger is set with eg. is_null(), instead just use it
    $this->logger->log('We are in ' . __METHOD__);
  }
}

/**
 * Key feature: NullLogger must inherit from this interface like any other loggers
 */
interface LoggerInterface
{
  public function log($str);
}

class PrintLogger implements LoggerInterface
{
  public function log($str)
  {
    echo $str;
  }
}

class NullLogger implements LoggerInterface
{
  public function log($str)
  {
    // do nothing
  }
}


$service = new Service(new NullLogger());
$service->doSomething();


$service = new Service(new PrintLogger());
$service->doSomething();

?>