<?php

namespace CodeBase\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer(
            ['pages.contratos.forms.filter', 'pages.contratos.forms.form'], 'CodeBase\Http\ViewComposers\CasaComposer'
        );
        view()->composer(
            ['pages.contratos.forms.filter', 'pages.contratos.forms.form'], 'CodeBase\Http\ViewComposers\UnidadeComposer'
        );
        view()->composer(
            ['pages.contratos.forms.filter'], 'CodeBase\Http\ViewComposers\StatusComposer'
        );
        view()->composer(
            ['pages.contratos.forms.filter', 'pages.contratos.forms.form', 'home'], 'CodeBase\Http\ViewComposers\EmpresaComposer'
        );

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
