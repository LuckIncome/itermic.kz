<?php namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Menu as MenuTrait;
use App\Models\{Settings, Langs, Areas};
use LaravelLocalization;
use Auth;
use Cache;
use View;

class BaseController extends Controller
{
    use MenuTrait;

    public $lang = null;

    public $domain = null;

    public function __construct(Request $request)
    {
        $this->lang = LaravelLocalization::getCurrentLocale();

        $this->lang = (in_array($this->lang, array_keys(LaravelLocalization::getSupportedLocales()))) ? LaravelLocalization::getCurrentLocale() : 'ru';

        View::share('structures', MenuTrait::get());
        View::share('settings', $this->getGlobalSettings($this->lang));
        View::share('langs', Langs::where('good', 1)->orderBy('created_at', 'ASC')->get());

        \Cookie::queue(\Cookie::make('token', \Hash::make($request->ip() . time()), 60 * 24));
    }

    public function restructArrayNames($array = [], $deleteKey = '')
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            $newArray[str_replace($deleteKey, '', $key)] = $value;
        }
        return $newArray;
    }
}
