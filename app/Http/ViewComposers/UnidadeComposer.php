<?php

namespace CodeBase\Http\ViewComposers;

use CodeBase\Repositories\Unidade\UnidadeRepositoryEloquent;
use Illuminate\View\View;

class UnidadeComposer
{
    /**
     * The user repository implementation.
     *
     * @var CasaRepository
     */
    protected $unidades;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UnidadeRepositoryEloquent $unidades)
    {
        // Dependencies automatically resolved by service container...
        $this->unidades = $unidades;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listUnidades', $this->unidades->lists('nome', 'id'));
    }
}