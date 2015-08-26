<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * All fields that are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'external_id',
    	'city',
    	'country',
    	'title',
    	'description',
    	'tax_deductible',
    	'donations_prohibited',
    	'completed_at',
    	'open_amount_in_cents',
    	'positive_opinions_count',
    	'negative_opinions_count',
    	'donor_count',
    	'progress_percentage',
    	'incomplete_need_count',
    	'completed_need_count',
    ];
}
