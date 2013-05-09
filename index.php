<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require "src/Sneeze.php";

$app = new Sneeze;


$app->get('/hello/:id/whatever/:whatever_id', function() {
	print_r($this->request);
});

$app->post("/post/:id", function() {
	echo $this->params['id'];
});

$app->put('/put/:id', function() {
	print_r($this->request);
});

$app->delete('/d', function() {
	echo 'd';
});


$app->run();