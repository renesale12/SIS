<?php

namespace App\Http\Controllers\Service;

use Illuminate\Support\Facades\DB;
use App\Models\Subject;

class SubjectServiceController
{
    public function getAllSubjects()
    {
        return DB::table('subjects')->get();
    }

    public function getSubjectById($id)
    {
        return DB::table('subjects')->where('id', $id)->first();
    }

    public function createSubject($data)
    {
        return DB::table('subjects')->insert($data);
    }

    public function updateSubject($id, $data)
    {
        return DB::table('subjects')->where('id', $id)->update($data);
    }

    public function deleteSubject($id)
    {
        return DB::table('subjects')->where('id', $id)->delete();
    }
}
