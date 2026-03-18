<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/register', function(){
    abort(403, 'Registro não permitido.');
})->name('register');

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index.home')->middleware('auth');   
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');   

//Rotas para os Perfis
Route::get('perfil', [App\Http\Controllers\UserController::class, 'perfil'])->name('admin.usuarios.perfil')->middleware('auth');
Route::post('perfil/update', [App\Http\Controllers\UserController::class, 'atualizar_perfil'])->name('admin.usuarios.atualizar_perfil')->middleware('auth');


//Rotas para ajustes
Route::get('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth','can:admin.ajustes.index');
Route::post('admin/ajustes/create', [App\Http\Controllers\AjusteController::class, 'store'])->name('admin.ajustes.create')->middleware('auth','can:admin.ajustes.create');

//Rotas para Roles
Route::get('admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth','can:admin.roles.index');
Route::get('admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth','can:admin.roles.create');
Route::post('admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth','can:admin.roles.store');
Route::get('admin/rol/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth','can:admin.roles.edit');
Route::get('admin/rol/{id}/permissoes', [App\Http\Controllers\RoleController::class, 'permissoes'])->name('admin.roles.permissoes')->middleware('auth','can:admin.roles.permissoes');
Route::post('admin/rol/{id}/update_permissoes', [App\Http\Controllers\RoleController::class, 'update_permissoes'])->name('admin.roles.update_permissoes')->middleware('auth','can:admin.roles.update_permissoes');
Route::put('admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth','can:admin.roles.update');
Route::delete('admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth','can:admin.roles.destroy');

//Rotas para Usuários
Route::get('admin/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.usuarios.index')->middleware('auth','can:admin.usuarios.index');
Route::get('admin/usuarios/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.usuarios.create')->middleware('auth','can:admin.usuarios.create');
Route::post('admin/usuarios/create', [App\Http\Controllers\UserController::class, 'store'])->name('admin.usuarios.store')->middleware('auth','can:admin.usuarios.store');
Route::post('admin/usuario/{id}/restaurar', [App\Http\Controllers\UserController::class, 'restore'])->name('admin.usuarios.restore')->middleware('auth','can:admin.usuarios.restore');
Route::get('admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.usuarios.show')->middleware('auth','can:admin.usuarios.show');
Route::get('admin/usuario/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth','can:admin.usuarios.edit');
Route::put('admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.usuarios.update')->middleware('auth','can:admin.usuarios.update');
Route::delete('admin/usuario/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth','can:admin.usuarios.destroy');

//Rotas para Espaços
Route::get('admin/espacos', [App\Http\Controllers\EspacoController::class, 'index'])->name('admin.espacos.index')->middleware('auth','can:admin.espacos.index');
Route::get('admin/espacos/create', [App\Http\Controllers\EspacoController::class, 'create'])->name('admin.espacos.create')->middleware('auth','can:admin.espacos.create');
Route::post('admin/espacos/create', [App\Http\Controllers\EspacoController::class, 'store'])->name('admin.espacos.store')->middleware('auth','can:admin.espacos.store');
Route::get('admin/espaco/{id}/edit', [App\Http\Controllers\EspacoController::class, 'edit'])->name('admin.espacos.edit')->middleware('auth','can:admin.espacos.edit');
Route::put('admin/espaco/{id}', [App\Http\Controllers\EspacoController::class, 'update'])->name('admin.espacos.update')->middleware('auth','can:admin.espacos.update');
Route::delete('admin/espaco/{id}', [App\Http\Controllers\EspacoController::class, 'destroy'])->name('admin.espacos.destroy')->middleware('auth','can:admin.espacos.destroy');

//Rotas para Tarifas
Route::get('admin/tarifas', [App\Http\Controllers\TarifaController::class, 'index'])->name('admin.tarifas.index')->middleware('auth','can:admin.tarifas.index');
Route::get('admin/tarifas/create', [App\Http\Controllers\TarifaController::class, 'create'])->name('admin.tarifas.create')->middleware('auth','can:admin.tarifas.create');
Route::post('admin/tarifas/create', [App\Http\Controllers\TarifaController::class, 'store'])->name('admin.tarifas.store')->middleware('auth','can:admin.tarifas.store');
Route::get('admin/tarifa/{id}/edit', [App\Http\Controllers\TarifaController::class, 'edit'])->name('admin.tarifas.edit')->middleware('auth','can:admin.tarifas.edit');
Route::put('admin/tarifa/{id}', [App\Http\Controllers\TarifaController::class, 'update'])->name('admin.tarifas.update')->middleware('auth','can:admin.tarifas.update');
Route::delete('admin/tarifa/{id}', [App\Http\Controllers\TarifaController::class, 'destroy'])->name('admin.tarifas.destroy')->middleware('auth','can:admin.tarifas.destroy');

//Rotas para Clientes
Route::get('admin/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth','can:admin.clientes.index');
Route::get('admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth','can:admin.clientes.create');
Route::post('admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth','can:admin.clientes.store');
Route::post('admin/cliente/{id}/restaurar', [App\Http\Controllers\ClienteController::class, 'restore'])->name('admin.clientes.restore')->middleware('auth','can:admin.clientes.restore');
Route::get('admin/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth','can:admin.clientes.show');
Route::get('admin/cliente/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth','can:admin.clientes.edit');
Route::put('admin/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth','can:admin.clientes.update');
Route::delete('admin/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth','can:admin.clientes.destroy');

//Rotas para Clientes - Veiculos
Route::get('admin/veiculos', [App\Http\Controllers\VeiculoController::class, 'index'])->name('admin.veiculos.index')->middleware('auth','can:admin.veiculos.index');
Route::post('admin/clientes/veiculos/create', [App\Http\Controllers\VeiculoController::class, 'store'])->name('admin.clientes.veiculos.store')->middleware('auth','can:admin.clientes.veiculos.store');
Route::put('admin/clientes/veiculo/{id}', [App\Http\Controllers\VeiculoController::class, 'update'])->name('admin.clientes.veiculos.update')->middleware('auth','can:admin.clientes.veiculos.update');
Route::delete('admin/clientes/veiculo/{id}', [App\Http\Controllers\VeiculoController::class, 'destroy'])->name('admin.clientes.veiculos.destroy')->middleware('auth','can:admin.clientes.veiculos.destroy');

//Rotas para tickets
Route::get('admin/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('admin.tickets.index')->middleware('auth','can:admin.tickets.index');
Route::get('admin/tickets/veiculo/{id}', [App\Http\Controllers\TicketController::class, 'buscar_veiculo'])->name('admin.tickets.buscar_veiculo')->middleware('auth','can:admin.tickets.buscar_veiculo');
Route::post('admin/tickets/create', [App\Http\Controllers\TicketController::class, 'store'])->name('admin.tickets.store')->middleware('auth','can:admin.tickets.store');
Route::get('admin/ticket/{id}/imprimir', [App\Http\Controllers\TicketController::class, 'imprimir_ticket'])->name('admin.tickets.imprimir_ticket')->middleware('auth','can:admin.tickets.imprimir_ticket');
Route::post('admin/ticket/atualizar_tarifa', [App\Http\Controllers\TicketController::class, 'atualizar_tarifa'])->name('admin.tickets.atualizar_tarifa')->middleware('auth','can:admin.tickets.atualizar_tarifa');
Route::get('admin/ticket/{id}/finalizar_ticket', [App\Http\Controllers\TicketController::class, 'finalizar_ticket'])->name('admin.tickets.finalizar_ticket')->middleware('auth','can:admin.tickets.finalizar_ticket');
Route::get('admin/ticket/{id}/calcular_valor', [App\Http\Controllers\TicketController::class, 'calcular_valor'])->name('admin.tickets.calcular_valor')->middleware('auth','can:admin.tickets.calcular_valor');
Route::delete('admin/ticket/{id}', [App\Http\Controllers\TicketController::class, 'destroy'])->name('admin.tickets.destroy')->middleware('auth');

//routas parra faturacao
Route::get('admin/factura/{id}', [App\Http\Controllers\FaturacaoController::class, 'imprimir_factura'])->name('admin.facturacao.imprimir_factura')->middleware('auth','can:admin.facturacao.imprimir_factura');

//Rotas para rlatorios
Route::get('admin/relatorios', [App\Http\Controllers\RelatorioController::class, 'index'])->name('admin.relatorios.index')->middleware('auth','can:admin.relatorios.index');
Route::get('admin/relatorios/semanal', [App\Http\Controllers\RelatorioController::class, 'relatorio_semanal'])->name('admin.relatorios.relatorio_semanal')->middleware('auth','can:admin.relatorio.relatorio_semanal');
Route::get('admin/relatorios/mensal', [App\Http\Controllers\RelatorioController::class, 'relatorio_mensal'])->name('admin.relatorios.relatorio_mensal')->middleware('auth','can:admin.relatorio.relatorio_mensal');
