<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLogin extends Model
{
    use HasFactory, Uuids;
    protected $fillable = [
        'browser',
        'platform',
        'v_platform',
        'username',
    ];
}
