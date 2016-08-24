<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::get('/', 'HomeController@index')->name('home');

//Logs do Sistema
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');;

/*
 * Usuários do Sistema
 */
Route::group(['prefix' => 'users', 'namespace' => 'Access'], function(){

    //Rotas Normais
    Route::get('/import', ['as' => 'users.import', 'uses' => 'UserImportController@import']);
    Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
    Route::get('/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::put('/{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
});

/*
 * Perfis de usuário
 */
Route::group(['prefix' => 'roles', 'namespace' => 'Access'], function(){
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::get('new', 'RoleController@create')->name('roles.create');
    Route::post('/', 'RoleController@store')->name('roles.store');
    Route::get('/{id}', 'RoleController@edit')->name('roles.edit');
    Route::patch('/{id}', 'RoleController@update')->name('roles.update');
    Route::get('/{id}/permissions', 'RoleController@permissions')->name('roles.permissions');
    Route::post('/{id}/permissions', 'RoleController@storePermissions');
});

/*
 * Grupos de Permissões
 */
Route::group(['prefix' => 'groups', 'namespace' => 'Access'], function(){
    Route::get('/new', 'PermissionGroupController@create')->name('groups.create');
    Route::post('/', 'PermissionGroupController@store')->name('groups.store');
    Route::get('/{id}', 'PermissionGroupController@edit')->name('groups.edit');
    Route::patch('/{id}','PermissionGroupController@update')->name('groups.update');
    Route::delete('/{id}', 'PermissionGroupController@destroy')->name('groups.destroy');

});

/*
 * Permissões de Usuários
 */
Route::group(['prefix' => 'permissions', 'namespace' => 'Access'], function(){
    Route::get('/', 'PermissionController@index')->name('permissions.index');
    Route::post('/','PermissionController@store')->name('permissions.store');
    Route::get('/new', 'PermissionController@create')->name('permissions.create');
    Route::get('/{id}','PermissionController@edit')->name('permissions.edit');
    Route::patch('/{id}','PermissionController@update')->name('permissions.update');

});

/*
 * Ações relacionadas as Casas
 */
Route::group(['prefix' => 'casas', 'namespace' => 'Manager'], function(){
    Route::get('/', 'CasaController@index')->name('casas.index');
    Route::get('/new', 'CasaController@create')->name('casas.create');
    Route::post('/', 'CasaController@store')->name('casas.store');
    Route::get('/{id}','CasaController@edit')->name('casas.edit');
    Route::patch('/{id}','CasaController@update')->name('casas.update');
    Route::delete('/{id}', 'CasaController@destroy')->name('casas.destroy');
});

/*
 * Ações relacionadas as Unidades
 */
Route::group(['prefix' => 'unidades', 'namespace' => 'Manager'], function(){
    Route::get('/', 'UnidadeController@index')->name('unidades.index');
    Route::get('/new', 'UnidadeController@create')->name('unidades.create');
    Route::post('/','UnidadeController@store')->name('unidades.store');
    Route::get('/{id}', 'UnidadeController@edit')->name('unidades.edit');
    Route::patch('/{id}', 'UnidadeController@update')->name('unidades.update');
    Route::delete('/{id}','UnidadeController@destroy')->name('unidades.destroy');
});

/*
 * Ações relacionadas a Fornecedores
 */

Route::group(['prefix' => 'empresas', 'namespace' => 'Manager'], function(){
    Route::get('/', 'EmpresaController@index')->name('empresas.index');
    Route::get('/new', 'EmpresaController@create')->name('empresas.create');
    Route::post('/', 'EmpresaController@store')->name('empresas.store');
    Route::get('/{id}', 'EmpresaController@edit')->name('empresas.edit');
    Route::patch('/{id}', 'EmpresaController@update')->name('empresas.update');
    Route::delete('/{id}', 'EmpresaController@destroy')->name('empresas.destroy');
});


/*
 * Ações Relacionadas ao gerenciamento de Contratos
 */
Route::group(['prefix' => 'contratos', 'namespace' => 'Manager'], function(){
    Route::get('/', 'ContratoController@index')->name('contratos.index');
    Route::get('/lists', 'ContratoController@lists')->name('contratos.lists');
    Route::get('/new', 'ContratoController@create')->name('contratos.create');
    Route::post('/', 'ContratoController@store')->name('contratos.store');
    Route::get('/view/{id}', 'ContratoController@view')->name('contratos.view');
    Route::get('/edit/{id}', 'ContratoController@edit')->name('contratos.edit');
    Route::patch('/{id}', 'ContratoController@update')->name('contratos.update');
    Route::get('/status/{id}', 'ContratoController@getStatus')->name('contratos.status');
    Route::patch('/status/{id}','ContratoController@postStatus');
    Route::get('/aditivar', 'ContratoController@aditivarIndex')->name('contratos.aditivar.index');
    Route::get('/aditivar/search', 'ContratoController@contratoSearch')->name('contratos.aditivar.api');
    Route::post('/aditivar/store', 'ContratoAditivoController@store')->name('contratos.aditivar.store');
});

/*
 * Ações Relacionadas aos relatórios do Sistema
 */

Route::group(['prefix' => 'report', 'namespace' => 'Report'], function(){
    Route::get('/', 'RepContratoController@index')->name('report.index');
    Route::get('/date', 'RepContratoController@byData')->name('report.data');
    Route::post('/date', 'RepContratoController@searchData')->name('report.data.print');

});