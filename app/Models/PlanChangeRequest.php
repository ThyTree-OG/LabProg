<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanChangeRequest extends Model
{
    protected $fillable = ['user_id', 'old_plan_id', 'new_plan_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function oldPlan()
    {
        return $this->belongsTo(Plan::class, 'old_plan_id');
    }

    public function newPlan()
    {
        return $this->belongsTo(Plan::class, 'new_plan_id');
    }
}

