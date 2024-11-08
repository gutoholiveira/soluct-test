<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryImport extends Model
{
    const FILE   = 'file';
    const ERRORS = 'errors';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::FILE,
        self::ERRORS,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::FILE   => 'string',
            self::ERRORS => 'string',
        ];
    }
}
