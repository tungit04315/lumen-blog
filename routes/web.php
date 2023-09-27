<?php

use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;

/** @var \Laravel\Lumen\Routing\Router $router */

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
    //return $router->app->version();
    // echo "Hello Lumen Laravel <br>";
    // try {
    //     $dbconnect = DB::connection('mysql')->getPdo();
    //     $dbname = DB::connection('mysql')->getDatabaseName();
    //     echo "Connected successfully to the database. Database name is: " . $dbname . "<br>";
    // } catch(Exception $e) {
    //     echo "Error in connecting to the database";
    // }

    // $model = \App\User::where('email', 'abc@gmail.com')->where('password', '123');

    // // Xuất câu lệnh SQL ra màn hình
    // $sql = $model->toSql();
    // echo $sql . "<br>";

    // // Thực thi truy vấn
    // $results = $model->get();
    // echo $results;

    Mail::to("tungit04315@gmail.com")->send(new MailNotify());
});

$router->post('/email', 'testController@store');

$router->post('/auth/login', 'ExampleController@postLogin');
$router->get('/auth', 'ExampleController@checkConnection');
$router->get('/test-controller', 'testController@index');
$router->get('/test-controller-list', 'testController@list');
$router->post('/order', 'testController@createOrder');
// CRUD USER
$router->post('/user', 'testController@createUser');
$router->put('/user/{id}', 'testController@updateUser');
$router->delete('/user/{id}', 'testController@deleteUser');
$router->get('/find/user', 'testController@findByUser');
// $router->group(['prefix' => 'api'], function () use ($router) {
//     $router->post('login', 'LumenAuthController@login');
//     $router->post('logout', 'LumenAuthController@logout');
//     $router->post('refresh', 'LumenAuthController@refresh');
//     $router->post('me', 'LumenAuthController@me');
// });