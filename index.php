<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require "src/Sneeze/Sneeze.php";


$app = new Sneeze\Sneeze;

$app->get('/hello/:name', function($name) {
      echo 'hello ' . $name;
});

$app->get('/', function() {
    echo "<pre>";
    print_r($this->request);
    echo "</pre>";
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
