<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_HEIGHT = 'height';
    public const COLUMN_MASS = 'mass';
    public const COLUMN_HAIR_COLOR = 'hair_color';
    public const COLUMN_SKIN_COLOR = 'skin_color';
    public const COLUMN_EYE_COLOR = 'eye_color';
    public const COLUMN_BIRTH_YEAR = 'birth_year';
    public const COLUMN_GENDER = 'gender';
    public const COLUMN_PLANET_ID = 'planet_id';
    public const COLUMN_CREATE_DATE = 'created_at';
    public const COLUMN_UPDATE_DATE = 'updated_at';

    public $timestamps = true;

    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_HEIGHT,
        self::COLUMN_MASS,
        self::COLUMN_HAIR_COLOR,
        self::COLUMN_SKIN_COLOR,
        self::COLUMN_EYE_COLOR,
        self::COLUMN_BIRTH_YEAR,
        self::COLUMN_GENDER,
        self::COLUMN_PLANET_ID,
        'planet'

    ];

    protected $dates = [self::COLUMN_CREATE_DATE, self::COLUMN_UPDATE_DATE];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }
}
