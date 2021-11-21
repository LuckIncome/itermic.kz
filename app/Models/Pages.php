<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelLocalization;

class Pages extends Model
{
    use ModelTrait;

    protected $table = 'pages';

    protected $modelName = __CLASS__;

    protected $lang = null;

    /**
     * Pages constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->lang = LaravelLocalization::getCurrentLocale();
    }

    public function getTextAttribute($value, $lang = null)
    {
        $text = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'description_' . $text}) ? $this->{'description_' . $text} : null;
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(\App\Models\PagesMedia::class, 'page_id', 'id');
    }
}
