<?php declare(strict_types=1);

namespace App\Models;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

/**
 * @method static where(string $string, mixed|null $section_id)
 */
class Sections extends Model
{
    use ModelTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sections';

    protected $modelName = __CLASS__;

    protected $guarded = [];

    protected $lang = null;

    /**
     * Sections constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->lang = LaravelLocalization::getCurrentLocale();
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(\App\Models\Sections::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(\App\Models\Sections::class, 'id', 'parent_id');
    }

    /**
     * @return HasOne
     */
    public function current_template(): HasOne
    {
        return $this->hasOne(\App\Models\Templates::class, 'id', 'template');
    }

    /**
     * @return HasMany
     */
    public function templates(): HasMany
    {
        return $this->hasMany(\App\Models\Templates::class, 'template', 'type');
    }

    /**
     * @return HasMany
     */
    public function rubrics(): HasMany
    {
        return $this->hasMany(\App\Models\Rubrics::class, 'section_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function page(): HasOne
    {
        return $this->hasOne(\App\Models\Pages::class, 'section_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function configuration(): HasOne
    {
        return $this->hasOne(\App\Models\Configuration::class, 'section_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(\App\Models\News::class, 'section_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(\App\Models\Links::class, 'section_id', 'id');
    }

    /**
     * @param $value
     * @param null $lang
     * @return mixed|null
     */
    public function getNameAttribute($value, $lang = null)
    {
        $name = (!is_null($lang)) ? $lang : $this->lang;

        return ($this->{'name_' . $name}) ? $this->{'name_' . $name} : null;
    }

    /**
     * @param $value
     * @param null $lang
     * @return string
     */
    public function getPathAttribute($value, $lang = null): string
    {
        return '/' . $this->type . '/' . $this->alias;
    }
}
