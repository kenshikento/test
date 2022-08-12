<?php

namespace App\Models;

use App\Models\Certificate;
use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory,SoftDeletes;

    public const PROPERTY = 'Property';

    public const PROPERTYTYPE = ['Resident', 'Block'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organisation',
        'property_type',
        'parent_property_id',
        'uprn',
        'address',
        'town',    
        'postcode',
        'live',            
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'live' => 'boolean',
    ];

    public function scopeParentProperty(Builder $query) : Builder 
    {
        return $query->whereNotNull('parent_property_id');
    }

    /**
     * Relationship between property and notes
     * @return HasMany
     */
    public function notes() : HasMany
    {	
    	return $this->hasMany(Note::class, 'model_id')->where('model_type', SELF::PROPERTY);
    }

    public function certificate() : HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Property::class, 'parent_property_id')->with('parent');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Property::class, 'parent_property_id')->with('children');
    }
}
