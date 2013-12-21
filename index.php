<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require "src/Sneeze.php";


$app = new Sneeze\Sneeze;

$app->get('/people/:name', function($name) {
      echo 'hello ' . $name;
});

$app->get('/', function() {
    print_r($this->request);
});

$app->post("/post/:id", function($id) {
    echo $id;
});

$app->put('/put/:id', function() {
    print_r($this->request);
});

$app->delete('/d', function() {
    echo 'd';
});

$app->run();