<?php

    /*
    - Khi bạn muốn bảo vệ quyền truy xuất vào các chức năng (phương thức) của thực thể.
    - Bổ sung trước khi thực hiện phương thức của thực thể.
    - Tạo đối tượng với chức năng được nâng cao theo yêu cầu.
    */

    interface ReadFile {
        public function readFile();
    }

    class User implements ReadFile {
        private $name; // Tên của người dùng

        public function User($name) {
            $this->name = $name;
        }

        public function readFile() {
            // Phương thức đọc file return name + "readed";
            return $this->name . " readed";
        }
    }

    class UserProxy implements ReadFile {
        private $instance;
        private $name;


        public function UserProxy($name) {
            $this->name = $name;
        }


        public function readFile() {
            if ($this->name == "ok") {
                // nêu tên người dùng là ok thì mới thực hiện
                // phương thức của lớp User, không thì báo
                // lỗi! if(instance ==null){
                $this->instance = new User($this->name);
                return $this->instance->readFile();
            }
            return "You can't read file";
        }
    }


        $user1 = new UserProxy("ok");
        echo $user1->readFile();
        echo "<br/>";
        $user2 = new UserProxy("hello");
        echo $user2->readFile();
?>