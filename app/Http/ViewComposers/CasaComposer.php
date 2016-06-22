<?php

namespace CodeBase\Http\ViewComposers;

use Illuminate\View\View;
use CodeBase\Repositories\Casa\CasaRepositoryEloquent;

class CasaComposer
{
    /**
     * The user repository implementation.
     *
     * @var CasaRepository
     */
    protected $casas;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(CasaRepositoryEloquent $casas)
    {
        // Dependencies automatically resolved by service container...
        $this->casas = $casas;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listCasas', $this->casas->lists('nome', 'id'));
    }
}