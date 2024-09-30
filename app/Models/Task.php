<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['name', 'project_id', 'priority', 'completion_date', 'completion_time', 'status'];

    protected $appends = ['completion_date_time'];

    public function completionDateTime(): Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->completion_date.' '.$this->completion_time)->toDayDateTimeString();
        });
    }

    public function completionTime(): Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->format('H:i');
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
