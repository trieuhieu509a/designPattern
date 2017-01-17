<?php

    /*
     * Factory Method là một mẫu khác thuộc nhóm các mẫu thiết kế phục vụ mục đích khởi tạo (kỳ trước chúng ta có mẫu Abstract Factory cũng nằm trong nhóm này).
     * Điểm khác biệt cơ bản của 2 mẫu này đó là Abstract Factory dược dùng để tạo ra nhiều loại đối tượng thuộc cùng một nhóm,
     * còn Factory Method nhằm mục đích thay đổi việc khởi tạo đổi tượng một cách linh hoạt.
     */

    abstract class Pet {
        public function giveBirth(){}
        public function talk(){}
    }

    class Cat extends Pet{

        public function giveBirth() {
            return new Cat();
        }

        public function talk() {
             echo ("Mew Mew");
        }

    }

    class Dog extends Pet {

        public function giveBirth() {
            return new Dog();
        }

        public function talk() {
            echo ("Wolf Wolf");
        }

    }

    abstract class Me {

        public function getMyPet(){}

        public function introduceMyPet(){
            $myPet = $this->getMyPet();
            echo ("The parent pet talks:");
            $myPet->talk();
            echo ("It's giving birth !!!");
            $child = $myPet->giveBirth();
            echo ("The new born pet talks:");
            $child->talk();
        }
    }

    class MeWithACat extends Me{

        public function getMyPet() {
            return new Cat();
        }
    }

    class MeWithADog extends Me {

        public function getMyPet() {
            return new Dog();
        }
    }

    echo ("once upon a time !!!");
    $me = new MeWithACat();
    $me->introduceMyPet();
    echo ("At present");
    $me = new MeWithADog();
    $me->introduceMyPet();
?>