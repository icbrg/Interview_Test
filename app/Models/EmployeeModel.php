<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    public function getEmployeeList()
    {
        $employee = DB::table('employee')->get();
        return $employee;
    }

    public function getEmployeefromID($id)
    {
        $employee = DB::table('employee')->where('id',$id)->first();
        return $employee;
    }

    public function deleteEmployeefromID($id)
    {
        EmployeeModel::where('id',$id)->delete();
    }
}
