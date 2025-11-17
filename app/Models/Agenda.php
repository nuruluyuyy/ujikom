<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Auto update status based on dates
    public function updateStatus()
    {
        $now = Carbon::now()->startOfDay();
        $start = Carbon::parse($this->start_date)->startOfDay();
        $end = Carbon::parse($this->end_date)->endOfDay();

        if ($now->lt($start)) {
            $this->status = 'upcoming';
        } elseif ($now->between($start, $end)) {
            $this->status = 'ongoing';
        } else {
            $this->status = 'completed';
        }

        $this->save();
    }

    // Scope for upcoming agendas
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
                    ->orderBy('start_date', 'asc');
    }

    // Scope for ongoing agendas
    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing')
                    ->orderBy('start_date', 'asc');
    }
}
