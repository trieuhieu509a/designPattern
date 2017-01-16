<?php

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