<?php

namespace Sneeze;

class Request
{
    public $uri;
    public $method;
    public $time;
    public $time_float;
    public $body;

    function __construct() 
    {
        $server = $_SERVER;

        $this->uri = $server['REQUEST_URI'];
        $this->method = $server['REQUEST_METHOD'];
        $this->body = file_get_contents('php://input');
        $this->time = $server['REQUEST_TIME'];
        $this->time_float = $server['REQUEST_TIME_FLOAT'];
	}
}
