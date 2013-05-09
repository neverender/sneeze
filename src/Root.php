<?php

require_once 'Request.php';

class Root
{
	public $params = [];
	public $callback;

    public function parse($route_string)
    {
    	$this->request = new Request;

        $route_parts = explode("/", $route_string);
        array_shift($route_parts);

        $url_parts = explode("/", $this->request->uri);
        array_shift($url_parts);

        foreach ($route_parts as $key => $value) {
        	if($value[0] === ':' && isset($url_parts[$key])) {
        		$this->params[substr($value, 1)] = $url_parts[$key];
        		$url_parts[$key] = $value;
        	}
        }

       	if($url_parts == $route_parts) {

       		return true;
       	
       	} else {
       	
       		return false;
       	}
    }

    public function get($route_string, $callback)
    {
    	if($this->parse($route_string) == true && $this->request->method == "GET") {
    		$this->callback = $callback->bindTo($this);
	    }

    }

    public function post($route_string, $callback)
    {
    	if($this->parse($route_string) == true && $this->request->method == "POST") {
			$this->callback = $callback->bindTo($this);
	    }

    }


    public function put($route_string, $callback)
    {
    	if($this->parse($route_string) == true && $this->request_method == "PUT") {
			$this->callback = $callback->bindTo($this);
	    }

    }


    public function delete($route_string, $callback)
    {
    	if($this->parse($route_string) == true && $this->request->method == "DELETE") {
    		$this->callback = $callback->bindTo($this);
	    }

    }

    public function run() 
    {
    	$boundClosure = $this->callback;
    	
    	if(isset($boundClosure)) {

	    	$boundClosure();

		} else {

			http_response_code(404);

		}
    }
}