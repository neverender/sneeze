<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require "src/Root.php";

$app = new Root;


$app->get('/hello/:id/whatever/:whatever_id', function() {
	echo $this->params['id'];
});

$app->post("/post/:id", function() {
	echo $this->params['id'];
});

$app->put('/put/:id', function() {
	echo $this->params['id'];
});

$app->delete('/d', function() {
	echo 'd';
});