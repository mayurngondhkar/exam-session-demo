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

$router->group(['prefix' => 'api/v1/exams'], function () use ($router) {
    $router->get('',  ['uses' => 'API\ExamController@index']);
    $router->get('{examCode}',  ['uses' => 'API\ExamController@show']);
    $router->post('',  ['uses' => 'API\ExamController@store']);
    $router->put('{examCode}',  ['uses' => 'API\ExamController@update']);
    $router->delete('{examCode}',  ['uses' => 'API\ExamController@destroy']);
});
