<?php
/*
 * Pattern Adapter là gì?
  Mẫu adapter chuyển đổi giao diện thành một giao diện khác mà phù hợp với yêu cầu. Giúp kết nối các lớp có giao diện không tương thích để làm việc với nhau
  Dùng nó trong trường hợp nào?
  Khi ta muốn chuyển đổi một lớp với một giao diện thành giao diện mà ta mong muốn.
  Xậy dựng, mở rộng các phương thức của lớp có sẵn phù hợp với yêu cầu.
  Tái sử dụng giao diện cũ. Giảm thiểu việc viết lại mã lệnh.
 * */
interface IShowName
{

    public function showName($name);
}

interface IShowListName
{
    public function showListName($listName);
}

class ShowMyName implements IShowName
{

    public function showName($name)
    {
        echo $name;
    }


    public function standardize($name)
    {
        $resuilt = trim($name);
        return $name;
    }
}

class ShowListNameAdapter implements IShowListName
{
    private $shownName;


    public function ShowListNameAdapter($shownName)
    {
        $this->shownName = $shownName;
    }


    public function showListName($listName)
    {
        foreach ($listName as $name) {
            $this->shownName->showName($name);
        }
    }
}


class TestAdapter
{
    public static function main()
    {
        $array = array();
        $array[] = " Teo ";
        $array[] = (" Ti ");
        $array[] = (" Ku ");

        $adapter = new ShowListNameAdapter(new ShowMyName());
        $adapter->showListName($array);
    }
}
TestAdapter::main();
?>