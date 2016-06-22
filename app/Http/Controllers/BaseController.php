<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 27/04/2016
 * Time: 14:22
 */

namespace CodeBase\Http\Controllers;

use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use Breadcrumbs;

class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

}