<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelLocalization;

class Configuration extends Model
{
    use ModelTrait;

    protected $table = 'configurations';

    protected $modelName = __CLASS__;

    protected $casts = [
        'config' => 'array',
        'sidebar' => 'array'
    ];

    protected $guarded = [];

    protected $lang = null;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->lang = LaravelLocalization::getCurrentLocale();
    }

    /**
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sections::class, 'section_id', 'id');
    }

    public function getTitleAttribute($value, $lang = null)
    {
        $title = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'title_' . $title}) ? $this->{'title_' . $title} : $this->title_ru;
    }

    public function getKeywordsAttribute($value, $lang = null)
    {
        $keywords = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'keywords_' . $keywords}) ? $this->{'keywords_' . $keywords} : $this->keywords_ru;
    }

    public function getDescriptionAttribute($value, $lang = null)
    {
        $description = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'description_' . $description}) ? $this->{'description_' . $description} : $this->description_ru;
    }

}
