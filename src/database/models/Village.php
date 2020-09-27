<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Riipandi\Areanesia\Traits\VillageTrait;

/**
 * Village Model.
 */
class Village extends Model
{
    use VillageTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'areanesia_villages';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'district_id',
    ];

    /**
     * Village belongs to District.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
