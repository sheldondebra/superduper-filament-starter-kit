<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'name',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
