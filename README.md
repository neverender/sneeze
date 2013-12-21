##Sneeze##

Sneeze is a php 5.4+ microframework that is just for fun. It uses [closure object binding](http://www.php.net/manual/en/closure.bindto.php) to get around having to use the _use_ keyword for routes.


####Basic Example####

    $app = new Sneeze\Sneeze;
    
    $app->get('/people/:name', function() {
      echo 'hello ' . $this->params['name'];
    });
    
    $app->run();
