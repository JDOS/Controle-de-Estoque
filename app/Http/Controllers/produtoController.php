<?php namespace estoque\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Request;
use estoque\Produto;
use estoque\Http\Requests\ProdutosRequest;


/*

Classe controle de Produtos

	+lista()
	+Mostra()
	+Novo()
	+Adiciona()
	+Remove()
	+Edita()
	+Altera()

*/

class ProdutoController extends Controller {

	public function __construct()
	{
		$this->middleware('auth',
		['only' => ['adiciona', 'remove']]);
	}

	public function lista(){
		
		//$produtos = DB::select('select * from produtos');
		
		$produtos = Produto::all();//Eloquent - usando modelo produto
		
		if (view()->exists('produto.listagem')){
		
			return view('produto.listagem')->with('produtos', $produtos);
		}
	}
	public function mostra($id){
	
		//$id= Request::route('id');
		
		//$resposta = DB::select('select * from produtos where id = ?',[$id]);
		
		
		//if(empty($resposta)) {
			//return "Esse produto não existe";
		//}
		
		//return view('produto.detalhes')->with('p', $resposta[0]);
		
		$produto = Produto::find($id);
		
		if(empty($produto)) {
			return "Esse produto não existe";
		}
		
		return view('produto.detalhes')->with('p', $produto);
		
	}
	
	public function novo(){
		return view('produto.formulario');
	}
	
	public function adiciona(ProdutosRequest $request){
		/*
		$nome = Request::input('nome');
		$descricao = Request::input('descricao');
		$valor = Request::input('valor');
		$quantidade = Request::input('quantidade');
		*/
		
		//DB::insert('insert into produtos
		//(nome, quantidade, valor, descricao) values (?,?,?,?)',
		//array($nome, $quantidade, $valor, $descricao));
		
		/*
		DB::table('produtos')->insert(
			['nome' => $nome,
			'valor' => $valor,
			'descricao' => $descricao,
			'quantidade' => $quantidade
			]
		);
		*/
		
		//return implode( ', ', array($nome, $descricao, $valor, $quantidade));
		
		//return view('produto.adicionado')->with('nome', $nome);
		
		//$params = Request::all();
		//$produto = new Produto($params);
		//$produto->save();
		
		//Produto::create(Request::all());
		
		Produto::create($request->all());
		return redirect()
			->action('ProdutoController@lista')
			->withInput(Request::only('nome'));
	
	}

	public function remove($id){
		$produto = Produto::find($id);
		$produto->delete();
		
		return redirect()
			->action('ProdutoController@lista');
		
	}	
	
	public function edita($id){
		
		$produto = Produto::find($id);
		
		return view('produto.edita')->with('p', $produto);
		
	}
	
	public function altera(){
		
		$id=Request::input('id');
		$produto = Produto::find($id);
		
		if(empty($produto)) {
			return "Esse produto não existe";
		}
		
		
		$produto->nome = Request::input('nome');
		$produto->descricao = Request::input('descricao');
		$produto->valor = Request::input('valor');
		$produto->quantidade = Request::input('quantidade');
		
		$produto->save();
		
		return redirect()
			->action('ProdutoController@lista');
	}
}	


?>