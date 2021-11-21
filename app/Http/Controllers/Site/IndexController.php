<?php namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\BaseController;

class IndexController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('site.index', [
            'indexPage' => true
        ]);
    }

    public function notFound()
    {
        return view('errors.404');
    }
}
