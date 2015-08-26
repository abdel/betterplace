<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'opinions';

    /**
     * All fields that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
    	'project_id', 
    	'donated_amount_in_cents',
    	'score',
    	'author',
    	'message',
        'donated_at'
    ];
}
