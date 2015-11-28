<?php

namespace estoque;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
   protected $table = 'produtos';
	public $timestamps = false;
	
	protected $fillable = array('nome',
	'descricao', 'valor', 'quantidade');//permite atribuição via mass-assignable nos atributos setados
	
	protected $guarded = ['id'];//não permirtir q o valor seja alterado - valor auto incremento no BD
}
