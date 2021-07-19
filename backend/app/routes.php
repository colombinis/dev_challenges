<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (Slim\App $app) {
    $app->get('/info', function (Request $request, Response $response, array $args) {
        $response->getBody()->write(phpinfo());
        return $response->withHeader('Content-Type', 'application/json');
    });


    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write(json_encode(['msg' => "Hola desde php"]));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/issue/{number}', function (Request $request, Response $response, array $args) {
        // Issue is voting
        // {
        // "status": "voting", 
        // "members": [
        //         {"name": "florencia", "status": "voted"}, 
        //         {"name": "kut", "status": "waiting"}, 
        //         {"name": "lucho", "status": "passed"}
        //     ]
        // }

        // Issue is reveal
        // {
        //     "status": "reveal", 
        //     "members": [
        //         {"name": "florencia", "status": "voted", "value": 20}, 
        //         {"name": "kut", "status": "voted", "value": 20}, 
        //         {"name": "lucho", "status": "passed"}
        //     ],
        //    "avg": 20
        // }

        //modelos
        //---------
        // ISSUE
        //  -id
        //  -nro
        //  -status

        // USERS
        //  -id
        //  -name

        // ISSUES_USERS
        //  -id_issue
        //  -id_user
        //  -voto
        //  -status


        //Obtener los datos  issue especifico
        //verificar el estado del issue
        // si estado es voting -> 1er json    
        // si estado es reveal -> 2do json    

        $number = $args['number'];
        $response->getBody()->write(json_encode(['issue' => $number]));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/issue/{number}/join', function (Request $request, Response $response, array $args) {
        // POST /issue/{:issue}/join - Used to join {:issue}.
        // If issue not exists generate a new one.
        // Must receive a payload with the intended name. ie: {"name": "florencia"}
        // Feel free to use a session or token to keep identified the user in subsequent requests.

        $number = $args['number'];
        $response->getBody()->write(json_encode(['issue' => $number]));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/issue/{number}/vote', function (Request $request, Response $response, array $args) {
        // POST /issue/{:issue}/vote - Used to vote {:issue}. Must receive a payload with the vote value.
        // Reject votes when status of {:issue} is not voting.
        // Reject votes if user not joined {:issue}.
        // Reject votes if user already voted or passed.

        $number = $args['number'];
        $response->getBody()->write(json_encode(['issue' => $number]));
        return $response->withHeader('Content-Type', 'application/json');
    });

};
