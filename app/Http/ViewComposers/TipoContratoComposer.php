<?php

namespace CodeBase\Http\ViewComposers;

use CodeBase\Enum\TipoContrato;
use Illuminate\View\View;

class TipoContratoComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listTipoContrato', TipoContrato::getConstants());
    }
}