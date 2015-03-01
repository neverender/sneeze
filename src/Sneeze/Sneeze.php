<?php

namespace Sneeze;

class Sneeze
{
    private $params = [];
    private $callback = null;

    private function process($route_string)
    {
        $route_parts = explode("/", $route_string);
        array_shift($route_parts);

        // ignore querystring
        $url_parts = explode("/", explode('?', $this->request['uri'])[0]);

        // remove first part if empty unless route is '/'
        if($url_parts[0] === "" && !empty($url_parts[1])) {
            array_shift($url_parts);
        }

        // ignore trailing slash
        if($url_parts[count($url_parts)-1] == null) {
            array_pop($url_parts);
        }

        foreach ($route_parts as $key => $value) {
            // if route part is :perameter
            if ($value && $value[0] === ':' && isset($url_parts[$key])) {
                // add to params array, minus ':'
                $this->params[substr($value, 1)] = $url_parts[$key];
                // swap parameter for actual value
                $url_parts[$key] = $value;
            }
        }


        return $url_parts === $route_parts;
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
        if(in_array($name, ['get', 'post', 'put', 'delete']) && $this->process($route) === true) {
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
            echo "Page Not Found";
            http_response_code(404);
        }
    }
}
