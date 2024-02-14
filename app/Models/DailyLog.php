<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $table = 'daily_logs';
	protected $guarded = [];
	public $incrementing = false;
	protected $casts = [
        'log_at' => 'datetime:Y-m-d H:i:s',
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',];
}
