<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;
    protected  $table = 'employee';
    protected $fillable = [
        'prename',
        'firstname',
        'surname',
        'telephone_number',
        'start_worktime',
        'end_worktime',
        'created_at',
        'updated_at',
    ];
}
