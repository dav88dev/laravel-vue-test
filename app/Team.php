<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relation to App\Player
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany('App\Player');
    }


    /**
     * Delete related rows
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($team) {
            $team->players()->delete();

        });
    }
}
