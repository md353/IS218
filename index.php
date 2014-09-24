<?php
//this is how you instantiate an object 
  $obj = new another;
//this is how you assign a value to a public property
  $obj->name = 'steve';
//this is how you call a public method
  $obj->printHelloWorld();
//this is how you print the contents of an array or object
  print_r($obj);
//this is how you define a class
  class example {
//this is how you define a public property    
    public $name;

//this is the magic method constructor
    public function __construct() {
      echo 'Hello world... ' . $this->name;
    }
//this is creating a public method
    public function printHelloWorld() {
      echo 'Hello world... ' . $this->name . "\n";
    }
    protected function someFunction() {}

    private function someOtherFunction() {}
   }

   class another extends example {}



?>
