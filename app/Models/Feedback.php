<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

/**
 * @method static find($id)
 * @property mixed|string lang
 * @property mixed name
 * @property mixed message
 * @property mixed|string|null ip
 * @property mixed id
 * @property mixed phone
 * @property mixed organization
 */
class Feedback extends Model
{
    use ModelTrait;

    /**
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * @var string
     */
    protected $modelName = __CLASS__;

    /**
     * @var array
     */
    protected $guarded = [];

}
