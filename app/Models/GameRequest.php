<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameRequest extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_request';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_id', 'player_initiator_id', 'player_opponent_id',
        'game_flavor_id', 'game_level_id', 'shuffled_cards'];


    public function initiator()
    {
        return $this->hasOne('App\Models\Player', 'id','player_initiator_id');
    }

    public function opponent()
    {
        return $this->hasOne('App\Models\Player', 'id','player_opponent_id' );
    }

    public function gameFlavor() {
        return $this->hasOne('App\Models\GameFlavor', 'id', 'game_flavor_id');
    }

    public function gameMovements(): HasMany {
        return $this->hasMany('App\Models\GameMovement', 'game_request_id', 'id');
    }
}
