<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

 

//Auth::routes();
Route::get('/conexao/{servico}','EntrarController@conexao');

Route::get('/registo','AuthController@registo')->name('registo')->middleware('logado');
Route::post('/registar','AuthController@registar')->name('registar')->middleware('logado');

Route::group([  'middleware' => 'logado' ],function(){
    Route::get('/registar','AuthController@registar')->name('registar')->middleware('logado');
    Route::get('/entrei','AuthController@entrei')->name('entrei')->middleware('logado');
    Route::get('/publicacao/conteudo', 'PublicacaoController@store')->name('publicacao.conteudo')->middleware('logar');




});






Route::get('/entrar','AuthController@entrar')->middleware('logado');
Route::post('/entrei','AuthController@entrei')->name('entrei')->middleware('logado');
Route::get('/sair','AuthController@sair')->name('sair')->middleware('logar');
Route::get('teste', 'JUDDIController@teste')->name('teste');

Route::get('publicacao/acederConteudo/{conteudo_id}','PublicacaoController@acederConteudo')->middleware('logar');

Route::get('publicacao/visualizarConteudo','PublicacaoController@visualizarConteudo');
Route::get('/', 'PublicacaoController@scrollPublicacoes')->middleware('logar');


/*Route::get('/', function () {
  
});*/
Route::get('/feed', function () {
    return view('feed/feed');
});
Route::get('/conhecidos', function () {
    return view('feed/conhecidos');
});
Route::get('/feed-amigos', function () {
    return view('feed/amigos');
});
Route::get('/mensagens', function () {
    return view('feed/mensagens');
});

Route::get('/perfil', function () {
    return view('perfil/perfil');
});

Route::get('/sobre', function () {
    return view('perfil/sobre');
});
Route::get('/albuns', function () {
    return view('perfil/albuns');
});
Route::get('/perfil-amigos', function () {
    return view('perfil/amigos');
});

Route::group(["prefix"=>"/feed"], function() use ($router){
   // Route::post('/conhecidos','AuthController@login');
    Route::post('/logout', 'AuthController@logout');

});

Route::get('/publicacao/form', function(){
    return view('feed/formPublicar');
})->name('publicacao.form');

Route::post('/publicacao/publicar', 'PublicacaoController@store')->name('publicacao.publicar')->middleware('logar');
Route::get('/publicacao/publicacoes', 'PublicacaoController@scrollPublicacoes')->name('publicacao.publicacoes')->middleware('logar');
Route::get('/publicacao/publicacoes/scroll', 'PublicacaoController@scrollPublicacoes')->name('publicacao.scroll')->middleware('logar');

Route::get('/publicacao/comentar', 'PublicacaoController@comentar')->name('publicacao.comentar')->middleware('logar');


Route::get('/publicacao/comentar/editar/{id}', 'PublicacaoController@procurarComentario')->name('publicacao.comentar.editar')->middleware('logar');


Route::get('/publicacao/comentar/editado', 'PublicacaoController@editarComentario')->name('publicacao.comentario.editado')->middleware('logar');

Route::get('/publicacao/comentarios', 'PublicacaoController@comentariosPublicacao')->name('publicacao.comentarios')->middleware('logar');

Route::get('/publicacao/eliminar/{id}', 'PublicacaoController@destroy')->name('publicacao.eliminar')->middleware('logar');


Route::get('/publicacao/comentar/responder', 'PublicacaoController@comentar')->name('publicacao.comentario.responder')->middleware('logar');


Route::get('/publicacao/comentarios/respostas', 'PublicacaoController@respostas')->name('publicacao.comentario.respostas')->middleware('logar');

Route::get('/publicacao/permissao', 'PublicacaoController@alterarPermissao')->name('publicacao.alterarPermissao')->middleware('logar');


Route::get('/publicacao/pontuacao', 'PublicacaoController@pontuacao')->name('publicacao.pontuacao')->middleware('logar');


Route::post('/publicacao/conteudo', 'PublicacaoController@store')->name('publicacao.conteudo')->middleware('logar');

Route::get('/publicacao/conteudo/visualizar', 'PublicacaoController@visualizarConteudo')->name('publicacao.conteudo.visualizar')->middleware('logar');




Route::get('/publicacao/verificarConteudo', 'PublicacaoController@verificarConteudo')->name('publicacao.verificarConteudo')->middleware('logar');



Route::post('/pagamento/depositar','PagamentoController@depositar')->name('pagamentos.depositar')->middleware('logar');
Route::get('/pagamento/deposito','PagamentoController@deposito')->name('pagamentos.deposito')->middleware('logar');


Route::get('/pagamento/pagar','PagamentoController@pagar')->name('pagamentos.pagar')->middleware('logar');
Route::get('/pagamento/efectuar/{conteudo}/{vendedor}','PagamentoController@create')->name('pagamentos.efectuar')->middleware('logar');


Route::get('/pagamentos','PagamentoController@pagamentos')->name('pagamentos');
Route::get('/pagamento/visualizar','PagamentoController@visualizarPagamento')->name('pagamento.visualizar');

Route::get('/pagamento/donativo','PagamentoController@donativo')->name('pagamento.donativo');
Route::post('/pagamento/doar','PagamentoController@doar')->name('pagamento.doar');

Route::get('/pagamento/donativosEfectuados','PagamentoController@visualizarMeusDonativosEfectuados')->name('pagamento.donativosEfectuados');

Route::get('/pagamento/donativosRecebidos','PagamentoController@visualizarMeusDonativosRecebidos')->name('pagamento.donativosRecebidos');








Route::get('/perfil/visualizarPerfil/{id}','ContaController@visualizarDados')->name('perfil.visualizar');
Route::post('/perfil/alterar','ContaController@alterarPerfil')->name('perfil.alterar');
Route::post('/perfil/alterarConta','ContaController@alterarConta')->name('perfil.alterarConta');

Route::get('/perfil/alterarPermissao','ContaController@alterarPermissao')->name('perfil.alterarPermissao');

Route::get('/conta/eliminarConta','ContaController@eliminarConta')->name('conta.eliminar');

Route::get('/feed/pesquisar','ContaController@pesquisar')->name('feed.pesquisar');

Route::get('/conta/amizade','ContaController@amizade')->name('conta.amizade');

Route::get('/conta/cancelarPedidoAmizade','ContaController@cancelarPedido')->name('conta.cancelarPedidoAmizade');

Route::get('/conta/aceitarPedidoAmizade','ContaController@aceitarPedido')->name('conta.aceitarPedidoAmizade');

Route::get('/conta/pedidosEnviados','ContaController@pedidosEnviados')->name('conta.pedidosEnviados');
Route::get('/conta/pedidosRecebidos','ContaController@pedidosRecebidos')->name('conta.pedidosRecebidos');
Route::get('/conta/amigos/{id}','ContaController@amigos')->name('conta.amigos');
Route::get('/conta/mensagens','ContaController@mensagens')->name('conta.mensagens');
Route::get('/conta/amigoMensagens','ContaController@amigoMensagens')->name('conta.amigoMensagens');
Route::get('/conta/enviarMensagens','ContaController@enviarMensagens')->name('conta.enviarMensagens');
Route::get('/conta/amigosLogados','ContaController@logados')->name('conta.logados');

