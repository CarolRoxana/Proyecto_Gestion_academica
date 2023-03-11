<?php

namespace App\Repositories;

use App\Interfaces\ExamRuleInterface;
use App\Models\ExamRule;

class ExamRuleRepository implements ExamRuleInterface {
    public function create($request) {
        try {
            ExamRule::create($request);
        } catch (\Exception $e) {
            throw new \Exception('No se pudo crear exam rule. '.$e->getMessage());
        }
    }

    public function update($request) {
        try {
            ExamRule::where('id', $request->exam_rule_id)->update([
                'total_marks'   => $request->total_marks,
                'pass_marks'    => $request->pass_marks,
                'marks_distribution_note'   => $request->marks_distribution_note
            ]);
        } catch (\Exception $e) {
            throw new \Exception('No se pudo actualizar exam rule. '.$e->getMessage());
        }
    }

    public function getAll($session_id, $exam_id) {
        return ExamRule::where('session_id', $session_id)
                        ->where('exam_id', $exam_id)
                        ->get();
    }

    public function getById($exam_rule_id) {
        return ExamRule::where('id', $exam_rule_id)
                        ->first();
    }
}
