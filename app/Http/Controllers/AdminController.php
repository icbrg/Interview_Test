<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;

class AdminController extends Controller
{
    public function EmployeeListPage()
    {
        # code...
    }

    public function CreateEmployeePage()
    {
        $data['prename'] = ['นาย','นาง','นางสาว'];
        return view('addemployee',$data);
    }

    public function addEmployee(Request $request)
    {
        $employee_tel = json_encode($request->input('employee-tel'));

        $employeemodel = new EmployeeModel;
        $employeemodel->prename = $request->input('employee-prename');
        $employeemodel->firstname = $request->input('employee-name');
        $employeemodel->surname = $request->input('employee-surname');
        $employeemodel->telephone_number = $employee_tel;
        $employeemodel->start_worktime = $request->input('employee-starttime');
        $employeemodel->end_worktime = $request->input('employee-endtime');

        $employeemodel->save();

        return redirect()->route('employeelist');
    }
}
