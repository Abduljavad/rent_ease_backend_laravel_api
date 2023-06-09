<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Property.
 *
 * @package namespace App\Entities;
 */
class Property extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'desc' => 'json',
        'images' => 'json',
        'thumbnail' => 'json'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
