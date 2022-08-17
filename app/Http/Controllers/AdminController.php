<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function EmployeeListPage()
    {
        $employeemodel = new EmployeeModel;
        $employee_data = $employeemodel->getEmployeeList();
        $employee_data = json_decode($employee_data, true);




        foreach ($employee_data as $key => $value) {
            //Delete Seconds digit in start_worktime
            $starttime = $value['start_worktime'];
            $new_starttime = strtotime($starttime);
            $new_starttime = date("G:i", $new_starttime);

            //Delete Seconds digit in start_oldtime
            $endtime = $value['end_worktime'];
            $new_endtime = strtotime($endtime);
            $new_endtime = date("G:i", $new_endtime);

            $employee_data[$key]['all_phonenumber'] = json_decode($value['telephone_number']);
            foreach ($employee_data[$key]['all_phonenumber'] as $key2 => $value) {
                if (strlen($value) == 10) {
                    $employee_data[$key]['all_phonenumber'][$key2] = substr($value,0,3)." ".substr($value,3,3)." ".substr($value,6,4);
                }
                elseif (strlen($value) == 9) {
                    $employee_data[$key]['all_phonenumber'][$key2] = substr($value,0,1)." ".substr($value,1,4)." ".substr($value,5,4);
                }
            }

            $employee_data[$key]['new_starttime'] = $new_starttime;
            $employee_data[$key]['new_endtime'] = $new_endtime;
        }

        return view('employeelist')
            ->with('list',1)
            ->with('employee', $employee_data);
    }

    public function CreateEmployeePage()
    {
        $data['prename'] = ['นาย', 'นาง', 'นางสาว'];
        return view('addemployee', $data);
    }

    public function addEmployee(Request $request)
    {
        $employeemodel = new EmployeeModel;
        $data = $employeemodel->getEmployeefromID($request->input('employee_id'));
        $employee_tel = json_encode($request->input('employee-tel'));

        $validated = $request->validate([
            'employee-name' => 'required',
            'employee-surname' => 'required',
            'employee-starttime' => 'required',
            'employee-endtime' => 'required',
        ]);

        if(isset($data))
        {
            $form_data = [
                'prename' => $request->input('employee-prename'),
                'firstname' => $request->input('employee-name'),
                'surname' => $request->input('employee-surname'),
                'telephone_number' => $employee_tel,
                'start_worktime' => $request->input('employee-starttime'),
                'end_worktime' => $request->input('employee-endtime'),
            ];
    
            $customer_upsert_result = EmployeeModel::updateOrCreate(
                ['id' => $data->id],
                $form_data
            );
        }
        else
        {
            $employeemodel->prename = $request->input('employee-prename');
            $employeemodel->firstname = $request->input('employee-name');
            $employeemodel->surname = $request->input('employee-surname');
            $employeemodel->telephone_number = $employee_tel;
            $employeemodel->start_worktime = $request->input('employee-starttime');
            $employeemodel->end_worktime = $request->input('employee-endtime');
    
            $employeemodel->save();
        }

        return redirect()->route('employeelist');
    }

    public function editEmployee($id)
    {
        $employeemodel = new EmployeeModel;
        $data = $employeemodel->getEmployeefromID($id);
        $employee_data = json_decode(json_encode($data), true);
        $telephone = json_decode($employee_data['telephone_number']);
        $prename = ['นาย', 'นาง', 'นางสาว'];

        return view('addemployee')
            ->with('telephone_data', $telephone)
            ->with('prename', $prename)
            ->with('employee_data', $employee_data);
    }

    public function delteEmployee($id)
    {
        $employeemodel = new EmployeeModel;
        $employee_data = $employeemodel->deleteEmployeefromID($id);

        return redirect()->route('employeelist');
    }
}
