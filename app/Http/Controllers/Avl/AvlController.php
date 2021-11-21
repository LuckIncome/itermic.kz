<?php namespace App\Http\Controllers\Avl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SectionsTrait;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AvlController extends Controller
{
    use SectionsTrait;

    public $user = null;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            View::share('structures', SectionsTrait::tree(0, []));

            return $next($request);
        });
    }
}
