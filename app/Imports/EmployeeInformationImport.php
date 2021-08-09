<?php

namespace App\Imports;

use App\EmployeeInformation;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeInformationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeInformation([
            'emp_id'     => $row[0],
            'name'     => $row[1],
            'department'    => $row[2],
            'designation'    => $row[3],
            'contact'    => $row[4]
        ]);
    }
}
