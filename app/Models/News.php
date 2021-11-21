<?php namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use LaravelLocalization;

class News extends Model
{
    use ModelTrait;

    protected $table = 'news';

    protected $modelName = __CLASS__;

    protected $guarded = [];

    protected $lang = null;

    /**
     * News constructor.
     * @param array $attributes
     */
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

    /**
     * @return BelongsTo
     */
    public function rubric(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Rubrics::class, 'rubric_id', 'id');
    }

    /**
     * @param string $type
     * @return HasMany
     */
    public function media($type = 'image'): HasMany
    {
        return $this->hasMany(\App\Models\Media::class, 'news_id')->where('type', $type);
    }

    /**
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(\App\Models\Media::class, 'news_id')->where('type', 'video');
    }

    /**
     * @return HasOne
     */
    public function cover(): HasOne
    {
        return $this->hasOne(\App\Models\Media::class, 'news_id')
            ->where('type', 'image')
            ->orderBy('main', 'desc')
            ->orderBy('sind', 'desc');
    }

    /**
     * @return BelongsToMany
     */
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Sections::class, 'sections_news', 'news_id', 'section_id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_user', 'id');
    }

    /**
     * @param $value
     * @param null $lang
     * @return mixed
     */
    public function getGoodAttribute($value, $lang = null)
    {
        $good = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'good_' . $good}) ? $this->{'good_' . $good} : $this->good_ru;
    }

    /**
     * @param $value
     * @param null $lang
     * @return mixed|null
     */
    public function getTitleAttribute($value, $lang = null)
    {
        $title = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'title_' . $title}) ? $this->{'title_' . $title} : null;
    }

    /**
     * @param $value
     * @param null $lang
     * @return mixed|null
     */
    public function getAdditionallyAttribute($value, $lang = null)
    {
        $additionally = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'additionally_' . $additionally}) ? $this->{'additionally_' . $additionally} : null;
    }

    /**
     * @param $value
     * @param null $lang
     * @return mixed
     */
    public function getShortAttribute($value, $lang = null)
    {
        $short = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'short_' . $short}) ? $this->{'short_' . $short} : $this->short_ru;
    }

    /**
     * @param $value
     * @param null $lang
     * @return mixed
     */
    public function getFullAttribute($value, $lang = null)
    {
        $full = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'full_' . $full}) ? $this->{'full_' . $full} : $this->full_ru;
    }

    /**
     * @param $value
     * @param null $lang
     * @return string
     */
    public function getUrlAttribute($value, $lang = null)
    {
        $section = $this->section;

        return '/' . $section->type . '/' . $section->alias . '/' . $this->id;
    }
}
