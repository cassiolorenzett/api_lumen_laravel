<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "API AGENDA. \n<br> ROTAS\n<br>
            \n<br>  -> VISUALIZAR UMA AGENDA AGENDA (GET) -> http://localhost:8000/api/agenda/{id}
            \n<br>  -> VISUALIZAR TODAS AS AGENDAS (GET) -> http://localhost:8000/api/agendaall
            \n<br>  -> FILTRA AGENDAS POR DATAS COM PARAMETROS: EX: datade:13/08/2019&dataate:13/09/2019 (GET) -> http://localhost:8000/api/agenda?datade=13/08/2019&dataate=13/09/2019
            \n<br>  -> CRIAR AGENDA(POST) -> http://localhost:8000/api/agenda
            \n<br>  -> EXCLUIR AGENDA(DELETE) -> http://localhost:8000/api/agenda
            \n<br>  -> ATUALIZAR UMA AGENDA(PUT) -> http://localhost:8000/api/agenda/{id}";
});


$router->group(['prefix'=>'api'], function() use($router){
    
    $router->get('/agenda/{id}', 'AgendaController@show');
    $router->get('/agenda', 'AgendaController@showfilter');
    $router->get('/agendaall', 'AgendaController@showall');
    $router->post('/agenda', 'AgendaController@create');
    $router->delete('/agenda/{id}', 'AgendaController@deleta');
    $router->put('/agenda/{id}', 'AgendaController@update');
    
});