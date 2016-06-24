<?php

namespace CodeBase\Http\ViewComposers;

use CodeBase\Repositories\Empresa\EmpresaRepositoryEloquent;
use Illuminate\View\View;

class EmpresaComposer
{
    /**
     * The user repository implementation.
     *
     * @var CasaRepository
     */
    protected $empresas;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(EmpresaRepositoryEloquent $empresas)
    {
        // Dependencies automatically resolved by service container...
        $this->empresas = $empresas;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listEmpresas', $this->empresas->getEmpresasList());
        $view->with('allEmpresas', $this->empresas->all());
    }
}