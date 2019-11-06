<!-- example of class construction in php  -->

<?php 

    class Car {
        
        // available to everything
        public $wheels = 4;
        // available to this class and descendants
        protected $motor = 1;
        // available only to this class
        private $chassis = 1;
        // class level 
        static $test = "I am not related to instances";

        function MoveWheels() {
            $this->wheels = 3;
        }
    }

    $mazda = new Car();
    echo $mazda->wheels;
    $mazda->MoveWheels();
    echo $mazda->wheels;
    // Accessing static property
    echo Car::$test;

    class Suv extends Car {
        var $doors = 5;

        function __construct() {
            $this->wheels = 10;
        }
    }

    $boeing = new Suv();
    echo $boeing->doors;
    echo $boeing->chassis;
?>