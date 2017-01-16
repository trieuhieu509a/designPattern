<?php

    /*
    Pattern Observer là gì ?
    Observer cho phép các đối tượng có thể lắng nghe và phản ứng khi có thông báo từ một đối tượng khác.
    Tức là khi một đối tượng gửi một thông báo, các đối tượng lắng nghe nó có thể phản ứng lại với thông báo đó.

    Sử dụng khi nào ?
    Khi bạn muốn các đối tượng liên lạc với nhau. Khi đối tượng này gửi 1 thông điệp thì các đối tượng đăng ký lắng nghe thông điệp sẽ phản ứng lại với thông điệp đó.
    Đối tượng gửi thông điệp sẽ không cần biết nó sẽ gửi cho ai và đối tượng nhận thông điệp sẽ không cần biết ai gửi thông điệp đó.
    */

    interface Observer {
        function update($message);    // phương thức phản ứng lại khi nhận được thông báo.
    }

    class Customer implements Observer {
    private $name;
    private $age;


    public function Customer($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function update($message) {
            echo $this->name . " " . $message . '<br/>';
        }
    }


    interface Subject {

        public function attachObserver($observer);// thêm đối tượng đăng ký lắng nghe thông báo.

        public function detachObserver($observer);// hủy đối tượng đăng ký lắng nghe thông báo

        public function notifyObserver();// thong bao đến tất cả các đối tượng đã đăng ký thông báo.

    }

    class Product implements Subject {
        private $obs = array();
        private $nameProduct;


        public function Product($nameProduct) {
            $this->nameProduct = $nameProduct;
        }

        public function attachObserver($observer) {
            $this->obs[] = $observer;
        }

        public function detachObserver($observer) {
            if(($key = array_search($observer, $this->obs)) !== false) {
                unset($this->obs[$key]);
            }
        }

        public function notifyObserver() {
            foreach ($this->obs as $ob) {
                $ob->update($this->nameProduct);
            }
        }
    }



        $cus1 = new Customer("Ti", 11);
        $cus2 = new Customer("Teo", 12);
        $product1 = new Product("Laptop");
        $product1->attachObserver($cus1);// cus1 dang ky phan ung khi có thông báo
                                                // từ product
        $product1->attachObserver($cus2);
        $product1->notifyObserver();// thông báo đến tất cả các Observer.
?>