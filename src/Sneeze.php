<?php

namespace Sneeze;

class Sneeze
{
    public $params = [];
    private $callback = null;

    public function __construct()
    {
        $this->request = [
            'uri' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD'],
            'body' => file_get_contents('php://input'),
            'time' => $_SERVER['REQUEST_TIME'],
            'time_float' => $_SERVER['REQUEST_TIME_FLOAT'],
            'get' => $_GET,
            'post' => $_POST
        ];
    }

    public function parse($route_string)
    {
        $route_parts = explode("/", $route_string);
        array_shift($route_parts);

        $url_parts = explode("/", $this->request['uri']);
        array_shift($url_parts);

        foreach ($route_parts as $key => $value) {
            if ($value && $value[0] === ':' && isset($url_parts[$key])) {
                $this->params[substr($value, 1)] = $url_parts[$key];
                $url_parts[$key] = $value;
            }
        }

        return $url_parts === $route_parts ? true : false;
    }

    public function get($route_string, $callback)
    {
        if ($this->parse($route_string) == true && $this->request['method'] == "GET") {
            $this->callback = $callback->bindTo($this);
        }

    }

    public function post($route_string, $callback)
    {
        if ($this->parse($route_string) == true && $this->request['method'] == "POST") {
            $this->callback = $callback->bindTo($this);
        }
    }

    public function put($route_string, $callback)
    {
        if ($this->parse($route_string) == true && $this->request['method'] == "PUT") {
            $this->callback = $callback->bindTo($this);
        }
    }

    public function delete($route_string, $callback)
    {
        if ($this->parse($route_string) == true && $this->request['method'] == "DELETE") {
            $this->callback = $callback->bindTo($this);
        }
    }

    public function run() 
    {
        $boundClosure = $this->callback;

        if (isset($boundClosure)) {
            $boundClosure();
        } else {
            echo "404";
            http_response_code(404);
        }
    }
}
