<?php

namespace Sneeze;

class Sneeze
{
    private $params = [];
    private $callback = null;

    private function parse($route_string)
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
            
            $url_parts[$key] = explode('?', $value)[0];
        }

        return $url_parts === $route_parts ? true : false;
    }

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

    public function __call($name, $arguments)
    {
        list($route, $callback) = $arguments;
        if(in_array($name, ['get', 'post', 'put', 'delete']) && $this->parse($route) === true) {
            if ($this->request['method'] == strtoupper($name) || isset($this->request['post']['_METHOD']) && $this->request['post']['_METHOD'] == strtoupper($name)) {
                $this->callback = $callback->bindTo($this);
            }
        }
    }

    public function run() 
    {
        if (isset($this->callback)) {
            call_user_func_array($this->callback, $this->params);
        } else {
            echo "404";
            http_response_code(404);
        }
    }
}