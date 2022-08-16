<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;


class LandingPageController extends Controller
{
    public function LandingPage()
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

            //Check Telephone Number Digits and add space to make Format and Add / after last digit in each Telephone Number 
            foreach ($employee_data[$key]['all_phonenumber'] as $key2 => $value) {
                if (strlen($value) == 10) {
                    $employee_data[$key]['all_phonenumber'][$key2] = substr($value, 0, 3) . " " . substr($value, 3, 3) . " " . substr($value, 6, 4).' / ';
                } elseif (strlen($value) == 9) {
                    $employee_data[$key]['all_phonenumber'][$key2] = substr($value, 0, 1) . " " . substr($value, 1, 4) . " " . substr($value, 5, 4).' / ';
                }
            }

            $employee_data[$key]['new_starttime'] = $new_starttime;
            $employee_data[$key]['new_endtime'] = $new_endtime;
        }

        //remove / at last Telephone Number in each Employee Telephone Number
        foreach ($employee_data as $key => $value) {

            $employee_data[$key]['all_phonenumber'] = implode('',$employee_data[$key]['all_phonenumber']);
            $phonelength = strlen($employee_data[$key]['all_phonenumber']);
            $employee_data[$key]['all_phonenumber'] = substr($employee_data[$key]['all_phonenumber'],0,$phonelength-2);
        }

        return view('landingpage')
            ->with('employee_data', $employee_data);
    }
}
