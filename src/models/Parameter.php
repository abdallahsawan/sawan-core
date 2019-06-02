<?php

namespace Sawan\Core\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Parameter extends Model
{
    protected $fillable = ['code', 'name','value'];
    protected $with = ['creator', 'last_modifier'];

    public function __construct()
    {
        parent::__construct();
        $this->entity_type = strtoupper(class_basename($this));
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->creator = Auth::id();
            $model->last_modifier = Auth::id();
        });

        static::updating(function ($model) {
            $model->last_modifier = Auth::id();
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }
    public function last_modifier()
    {
        return $this->belongsTo(User::class, 'last_modifier');
    }
}
