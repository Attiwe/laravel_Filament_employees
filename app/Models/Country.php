<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name','state_id'];

    public function states():HasMany {
        return $this->hasMany(State::class);
       }
    
       public function employees():HasMany{
           return $this->hasMany(Employee::class);
       }
}
