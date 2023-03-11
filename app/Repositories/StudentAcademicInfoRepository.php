<?php

namespace App\Repositories;

use App\Models\StudentAcademicInfo;

class StudentAcademicInfoRepository {
    public function store($request, $student_id) {
        try {
            StudentAcademicInfo::create([
                'student_id'        => $student_id,
                'board_reg_no'      => $request['board_reg_no'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('No se pudo crear Student academic information. '.$e->getMessage());
        }
    }
}
