<?php

namespace App\Repositories;

use App\Interfaces\SemesterInterface;
use App\Models\Semester;
use App\Models\SchoolSession;

class SemesterRepository implements SemesterInterface {
    public function create($request) {
        try {
            Semester::create($request);
        } catch (\Exception $e) {
            throw new \Exception('No se pudo crear School Semester. '.$e->getMessage());
        }
    }

    public function getAll($session_id)
    {
        return Semester::where('session_id', $session_id)->orderBy('id', 'desc')->get();
    }
}
