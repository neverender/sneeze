##Sneeze##

Sneeze is a php 5.4 microframework that is just for fun.


####Basic Example####

    $app = new Sneeze;
    
    $app->get('/', function() {
      echo 'hello, world!';
    });
