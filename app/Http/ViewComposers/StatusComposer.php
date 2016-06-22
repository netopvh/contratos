<?php

namespace CodeBase\Http\ViewComposers;

use CodeBase\Enum\Status;
use Illuminate\View\View;

class StatusComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listStatus', Status::getConstants());
    }
}