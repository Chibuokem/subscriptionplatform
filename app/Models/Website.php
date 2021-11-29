<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;

class Website extends Model
{
    use HasFactory;

    /**Website subscribers
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscribers(){
        return $this->hasMany(Subscription::class);
    }
}
