<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function jobs(){
        return $this->hasMany(SpaceJob::class, 'space_id', 'id');
    }
}
