##Sneeze##

Sneeze is a php 5.4 microframework that is just for fun.


####Basic Example####

    $app = new Sneeze\Sneeze;
    
    $app->get('/', function() {
      echo 'hello, world!';
    });
    
    $app->run();
    
####Other Examples####
    
    $app = new Sneeze\Sneeze;
    
    $app->post('/comments', function() {
        //posting a comment or something
    });
    
    $app->put('/posts/edit/:id', function() {
        //do something with $this->params['id']
    });
    
    $app->run();
