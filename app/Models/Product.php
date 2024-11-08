<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const ID               = 'id';
    const CODE             = 'code';
    const STATUS           = 'status';
    const IMPORTED_T       = 'imported_t';
    const URL              = 'url';
    const CREATOR          = 'creator';
    const CREATED_T        = 'created_t';
    const LAST_MODIFIED_T  = 'last_modified_t';
    const PRODUCT_NAME     = 'product_name';
    const QUANTITY         = 'quantity';
    const BRANDS           = 'brands';
    const CATEGORIES       = 'categories';
    const LABELS           = 'labels';
    const CITIES           = 'cities';
    const PURCHASE_PLACES  = 'purchase_places';
    const STORES           = 'stores';
    const INGREDIENTS_TEXT = 'ingredients_text';
    const TRACES           = 'traces';
    const SERVING_SIZE     = 'serving_size';
    const SERVING_QUANTITY = 'serving_quantity';
    const NUTRISCORE_SCORE = 'nutriscore_score';
    const NUTRISCORE_GRADE = 'nutriscore_grade';
    const MAIN_CATEGORY    = 'main_category';
    const IMAGE_URL        = 'image_url';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::CODE,
        self::STATUS,
        self::IMPORTED_T,
        self::URL,
        self::CREATOR,
        self::CREATED_T,
        self::LAST_MODIFIED_T,
        self::PRODUCT_NAME,
        self::QUANTITY,
        self::BRANDS,
        self::CATEGORIES,
        self::LABELS,
        self::CITIES,
        self::PURCHASE_PLACES,
        self::STORES,
        self::INGREDIENTS_TEXT,
        self::TRACES,
        self::SERVING_SIZE,
        self::SERVING_QUANTITY,
        self::NUTRISCORE_SCORE,
        self::NUTRISCORE_GRADE,
        self::MAIN_CATEGORY,
        self::IMAGE_URL,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::CODE             => 'string',
            self::STATUS           => ProductStatus::class,
            self::IMPORTED_T       => 'datetime',
            self::URL              => 'string',
            self::CREATOR          => 'string',
            self::CREATED_T        => 'integer',
            self::LAST_MODIFIED_T  => 'integer',
            self::PRODUCT_NAME     => 'string',
            self::QUANTITY         => 'string',
            self::BRANDS           => 'string',
            self::CATEGORIES       => 'string',
            self::LABELS           => 'string',
            self::CITIES           => 'string',
            self::PURCHASE_PLACES  => 'string',
            self::STORES           => 'string',
            self::INGREDIENTS_TEXT => 'string',
            self::TRACES           => 'string',
            self::SERVING_SIZE     => 'string',
            self::SERVING_QUANTITY => 'string',
            self::NUTRISCORE_SCORE => 'integer',
            self::NUTRISCORE_GRADE => 'string',
            self::MAIN_CATEGORY    => 'string',
            self::IMAGE_URL        => 'string',
        ];
    }
}
