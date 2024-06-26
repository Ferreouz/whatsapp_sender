<?php

namespace App\Models;

use App\Models\Link;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ScopedBy([UserScope::class])]
class Contact extends Model
{
    use HasFactory;
    
    /**
     * Scope a query to only include records of certain number
     */
    public function scopeOfNumber(Builder $query, int $number_id): void
    {
        $query->where('number_id', $number_id);
    }
    
    public function contacts(): BelongsToMany {
        return $this->belongsToMany(ContactList::class, 'contact_contact_lists', 'contact_id', 'contact_list_id');
    }

    public function links(): HasMany {
        return $this->hasMany(Link::class);
    }

}
