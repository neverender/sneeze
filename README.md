##Sneeze##

Sneeze is a simple php router. 

It uses 5.4+ features such as [closure object binding](http://www.php.net/manual/en/closure.bindto.php) and [short array syntax](http://php.net/manual/en/migration54.new-features.php).

####Example####

Instantiate Sneeze application:

    $app = new \Sneeze\Sneeze;
    
Define an HTTP GET route:
    
    $app->get('/hello/:name', function($name) {
      echo "hello $name";
    });
    
Run it:

    $app->run();
