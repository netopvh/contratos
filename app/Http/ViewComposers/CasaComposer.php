<?php

namespace CodeBase\Http\ViewComposers;

use Illuminate\View\View;
use CodeBase\Repositories\Casa\CasaRepositoryEloquent;

class CasaComposer
{
    /**
     * Implementação da casa repository
     *
     * @var CasaRepositoryEloquent
     */
    protected $casas;

    /**
     * Cria um novo Casa Compose.
     *
     * @param  CasaRepositoryEloquent  $casas
     * @return void
     */
    public function __construct(CasaRepositoryEloquent $casas)
    {
        // Dependencies automatically resolved by service container...
        $this->casas = $casas;
    }

    /**
     * Faz um bind dos dados para a view
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listCasas', $this->casas->lists('nome', 'id'));
    }
}