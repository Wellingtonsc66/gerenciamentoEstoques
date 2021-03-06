<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Estoque\EstoqueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::group(['prefix'=>'dashboard', 'namespace'=>'office', 'middleware'=>'auth'], function (){
    Route::get('/', function () {
        $produtos = (new \App\Models\Produto())->all()->toArray();
        return view('dashboard', compact('produtos'));
    })->name('dashboard');

    Route::match(['get', 'post'],'/estoque/adicionar', [EstoqueController::class, 'adicionar'])->name('estoque.adicionar');
    Route::match(['get', 'post'],'/estoque/baixar', [EstoqueController::class, 'baixar'])->name('estoque.baixar');
    Route::get('/estoque/relatorio', [EstoqueController::class, 'relatorio'])->name('estoque.relatorio');
});

require __DIR__.'/auth.php';
