##Sneeze##

Sneeze is a simple php router. 

It uses 5.4+ features such as [closure object binding](http://www.php.net/manual/en/closure.bindto.php) and [short array syntax](http://php.net/manual/en/migration54.new-features.php).

####Installation####

Use [Composer](http://getcomposer.org/)

####Example####

Instantiate Sneeze application:

    $app = new \Sneeze\Sneeze;
    
Define an HTTP GET route:
    
    $app->get('/hello/:name', function($name) {
      echo "hello $name";
    });
    
Run it:

    $app->run();

####More####

You can also define PUT, POST and DELETE HTTP routes. Since modern browsers don't support PUT and DELETE, you can fake it by doing a POST request and adding a "_METHOD" parameter like so:

    <form action="/put/route/1" method="post">
        <input type="hidden" name="_METHOD" value="PUT"/>
        <!-- other stuff -->
    </form>

Inside routes, you have access to $this->request, which is an associative array of the usual request variables including 'get', 'post', 'uri', 'method', 'body', etc.
