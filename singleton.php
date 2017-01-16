<?php

    /**
     * final to nobody else can extend it
     */
    final class Database{
        static $instance = null;

        /**
         * Private ctor so nobody else can instance it
         */
        private function __construct()
        {

        }

        public static function getInstance(){

            if (!isset(Database::$instance)) {
                echo 123;
                Database::$instance = new Database;
            }
            return Database::$instance;
        }

    }

//class Foobar extends Database {};

/*$fact = Foobar::getInstance();
$fact2 = Database::getInstance();
var_dump($fact == $fact2);*/

?>