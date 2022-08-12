<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    public const CERTIFICATE = 'Certificate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stream_name',
        'property_id',
        'issue_date',
        'next_due_date',       
    ];    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    	'issue_date' => 'date',
        'next_due_date' => 'datetime',
    ];

    /**
     * Relationship between Certificate and notes
     * @return HasMany
     */
    public function notes() : HasMany
    {
    	return $this->hasMany(Note::class, 'model_id')->where('model_type', SELF::CERTIFICATE);
    }
}
