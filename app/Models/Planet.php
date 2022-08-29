<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planet extends Model
{
    use SoftDeletes;

    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_ORBITAL = 'orbital_period';
    public const COLUMN_ROTATION = 'rotation_period';
    public const COLUMN_DIAMETER = 'diameter';
    public const COLUMN_CLIMATE = 'climate';
    public const COLUMN_GRAVITY = 'gravity';
    public const COLUMN_TERRAIN = 'terrain';
    public const COLUMN_SURFACEWATER = 'surface_water';
    public const COLUMN_POPULATION = 'population';
    public const COLUMN_CREATE_DATE = 'created_at';
    public const COLUMN_UPDATE_DATE = 'updated_at';

    public $timestamps = true;

    protected $fillable = [
        self::COLUMN_ID,
        self::COLUMN_NAME,
        self::COLUMN_ORBITAL,
        self::COLUMN_ROTATION,
        self::COLUMN_DIAMETER,
        self::COLUMN_CLIMATE,
        self::COLUMN_GRAVITY,
        self::COLUMN_TERRAIN,
        self::COLUMN_SURFACEWATER,
        self::COLUMN_POPULATION
    ];

    protected $dates = [self::COLUMN_CREATE_DATE, self::COLUMN_UPDATE_DATE];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function people()
    {
        return $this->hasMany(Person::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function species()
    {
        return $this->hasMany(Species::class);
    }
}
