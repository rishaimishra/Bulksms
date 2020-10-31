<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $value = 1;
        return new User([
            'name'=>$row[0],
            'email'=>$row[1],
            'password'=>Hash::make('password'),
            'phone'=>$row[2],
            'guest'=>$value,
        ]);
    }

    public function rules(): array
    {
        return [
            '1'=> ['email','unique:users,email'],

        ];
    }
}
