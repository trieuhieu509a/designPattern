<?php

    /*
     * Composite là một mẫu thiết kế thuộc nhóm cấu trúc, cho phép thực hiện các tương tác với tất cả đối tượng trong mẫu tương tự nhau.
     */

    interface Equipment {
        public function getResistance();

        public function getName();

    }

    class Fan implements Equipment {

        private static $FAN_RESISTANCE = 20;
        private static $FAN_NAME = "The fan";


        public function getResistance() {
            return static::$FAN_RESISTANCE;
        }

        public function getName() {
            return static::$FAN_NAME;
        }
    }

    class Light implements Equipment {

        private static $LIGHT_RESISTANCE = 10;
        private static $LIGHT_NAME = "The light";

        public function getResistance() {
            return static::$LIGHT_RESISTANCE;
        }

        public function getName() {
            return static::$LIGHT_NAME;
        }
    }

    abstract class Circuit implements Equipment {

        protected $equipments = array();

        public function addEquipment($equipment) {
            if ($equipment != null) {
                $this->equipments[] = $equipment;
            }
        }
    }

    class ParallelCircuit extends Circuit {

        private static $CIRCUIT_NAME = "Parallel Circuit";

        public function getResistance() {
            $temp = 0;
            foreach ($this->equipments as $e){
                $temp += 1.0 / $e->getResistance();
            }
            return 1.0 / $temp;
        }

        public function getName() {
            return static::$CIRCUIT_NAME;
        }
    }

    class SerialCircuit extends Circuit {

        private static $CIRCUIT_NAME = "Serial Circuit";

        public function getResistance() {
            $temp = 0;
            foreach ($this->equipments as $e){
                $temp += $e->getResistance();
            }
            return $temp;
        }

        public function getName() {
            return static::$CIRCUIT_NAME;
        }
    }

    /*
    * /---light--------fan-----------/ ------fan------ -light---fan---
    */
        $rootCircuit = new SerialCircuit();
        $rootCircuit->addEquipment(new Light());


        $childCircuit = new ParallelCircuit();
        $childCircuit->addEquipment(new Fan());
        $childCircuit->addEquipment(new Fan());


        $childOfChildCircuit = new SerialCircuit();
        $childOfChildCircuit->addEquipment(new Light());
        $childOfChildCircuit->addEquipment(new Fan());


        $childCircuit->addEquipment($childOfChildCircuit);
        $rootCircuit->addEquipment($childCircuit);


        echo ("Total resistance = " + $rootCircuit->getResistance());
?>