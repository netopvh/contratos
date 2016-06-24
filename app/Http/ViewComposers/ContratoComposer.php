<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 24/06/2016
 * Time: 14:08
 */

namespace CodeBase\Http\ViewComposers;

use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use Illuminate\View\View;

class ContratoComposer
{

    /**
     * Implementação do contrato repository
     *
     * @var ContratoRepositoryEloquent
     */
    protected $contratos;

    /**
     * Cria um novo Contrato Compose.
     *
     * @param  ContratoRepositoryEloquent  $contratos
     * @return void
     */
    public function __construct(ContratoRepositoryEloquent $contratos)
    {
        $this->contratos = $contratos;
    }

    /**
     * Faz um bind dos dados para a view
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
       $view->with('allContratos', $this->contratos->with('empresa')->all());
    }

}