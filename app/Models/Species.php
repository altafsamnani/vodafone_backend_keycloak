<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Species extends Model
{
    use SoftDeletes;

    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_CLASSIFICATION = 'classification';
    public const COLUMN_DESIGNATION = 'designation';
    public const COLUMN_AVG_HEIGHT = 'average_height';
    public const COLUMN_AVG_LIFESPAN = 'average_lifespan';
    public const COLUMN_EYECOLORS = 'eye_colors';
    public const COLUMN_HEIGHTCOLORS = 'hair_colors';
    public const COLUMN_SKINCOLORS= 'skin_colors';
    public const COLUMN_LANGUAGE = 'language';
    public const COLUMN_CREATE_DATE = 'created_at';
    public const COLUMN_UPDATE_DATE = 'updated_at';

    public $timestamps = true;

    protected $fillable = [
        self::COLUMN_ID,
        self::COLUMN_NAME,
        self::COLUMN_CLASSIFICATION,
        self::COLUMN_DESIGNATION,
        self::COLUMN_AVG_HEIGHT,
        self::COLUMN_AVG_LIFESPAN,
        self::COLUMN_EYECOLORS,
        self::COLUMN_HEIGHTCOLORS,
        self::COLUMN_SKINCOLORS,
        self::COLUMN_LANGUAGE
    ];

    protected $dates = [self::COLUMN_CREATE_DATE, self::COLUMN_UPDATE_DATE];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }
}
