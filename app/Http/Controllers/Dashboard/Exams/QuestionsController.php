<?php

namespace App\Http\Controllers\Dashboard\Exams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;


class QuestionsController extends Controller
{

    public function examQuestions($exam_id)
    {
        $exam = Exam::findOrfail($exam_id);
        return view('dashboard.exams.questions.exam_questions', ['exam' => $exam]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($exam_id)
    {
        $exam = Exam::findOrfail($exam_id);
        return view('dashboard.exams.questions.create', ['exam' => $exam]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {

        $r->validate([
            'exam_id' => ['required'],
            'question_desc' => ['required'],
            'grade' => ['required'],
            'right_answer' => ['required']
        ]);
        $exam = Exam::findOrfail($r->exam_id);
        $question = new ExamQuestion;
        $question->exam_id = $r->exam_id;

        $question->question_desc = $r->question_desc;
        $question->grade = $r->grade;
        $question->detailed_answer = $r->detailed_answer;

        if($r->hasFile('question_image')) {
            $question->addMedia($r->file('question_image'))->toMediaCollection('questions_question_image');
        }

        if($r->hasFile('answer_image')) {
            $question->addMedia($r->file('answer_image'))->toMediaCollection('questions_answer_image');
        }

        $question->save();

        $ExamQuestionAnswer = new ExamQuestionAnswer;
        $ExamQuestionAnswer->exam_question_id = $question->id;
        $ExamQuestionAnswer->correct = 1;
        $ExamQuestionAnswer->desc = $r->right_answer;
        if($r->hasFile('right_answer_image')) {
            $question->addMedia($r->file('right_answer_image'))->toMediaCollection('right_answer_image');
        }
        $ExamQuestionAnswer->save();
        //return dd($r->wrong_answers);
        foreach ($r->wrong_answers as $answer) {

            if ($answer != null) {
                $ExamQuestionAnswer = new ExamQuestionAnswer;
                $ExamQuestionAnswer->exam_question_id = $question->id;
                $ExamQuestionAnswer->correct = 0;
                $ExamQuestionAnswer->desc = $answer["'name'"];
                if($r->hasFile($answer["'image'"])) {
                    $question->addMedia($r->file($answer["'image'"]))->toMediaCollection('wrong_answer_image');
                }
                $ExamQuestionAnswer->save();
            }

        }


        // if ($exam->total_grade != null) {
        //     $exam->total_grade =  $exam->total_grade + $r->grade;
        //     $exam->save();
        // } else {
        //     $exam->total_grade =  $r->grade;
        //     $exam->save();
        // }


        return redirect()->route('dashboard.questions.examQuestions', ['exam_id' => $exam->id ])->with('success', 'تم اضافة السؤال بناجح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = ExamQuestion::findOrfail($id);
        $question->wrong_answers = json_decode($question->wrong_answers);
        return view('dashboard.exams.questions.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $r->validate([
            'question_desc' => ['required'],
            'grade' => ['required'],
            'right_answer' => ['required']
        ]);


        $question = ExamQuestion::findOrfail($id);
        $olde_grade = $question->grade;



        if($r->hasFile('question_image')) {
            $question->clearMediaCollection('questions_question_image');
            $question->addMedia($r->file('question_image'))->toMediaCollection('questions_question_image');
        }

        if($r->hasFile('answer_image')) {
            $question->clearMediaCollection('questions_answer_image');
            $question->addMedia($r->file('answer_image'))->toMediaCollection('questions_answer_image');
        }

        $question->question_desc = $r->question_desc;
        $question->grade = $r->grade;
        $question->detailed_answer = $r->detailed_answer;
        $question->save();

        $ExamQuestionAnswer = ExamQuestionAnswer::findOrfail($question->right_answer->id);
        $ExamQuestionAnswer->desc = $r->right_answer;
        $ExamQuestionAnswer->save();


        foreach ($question->wrong_answers as $answer) {
            if ($answer != null) {
                $ExamQuestionAnswer = ExamQuestionAnswer::find($answer->id);
                if ($ExamQuestionAnswer != null) {
                    $ExamQuestionAnswer->desc = $r->wrong_answers[$answer->id];
                    $ExamQuestionAnswer->save();
                } else {
                    $ExamQuestionAnswer = new ExamQuestionAnswer;
                    $ExamQuestionAnswer->exam_question_id = $question->id;
                    $ExamQuestionAnswer->type = 0;
                    $ExamQuestionAnswer->desc = $answer;
                    $ExamQuestionAnswer->save();
                }


            } else {
                $ExamQuestionAnswer = ExamQuestionAnswer::findOrfail($answer->id);
                $ExamQuestionAnswer->delete();
            }


        }

        // $exam = Exam::findOrfail($question->exam_id);
        // $exam->total_grade =  $exam->total_grade - $olde_grade + $r->grade;
        // $exam->save();


        return redirect()->route('dashboard.questions.examQuestions', ['exam_id' => $exam->id ])->with('success', 'تم تعديل السؤال بناجح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = ExamQuestion::findOrfail($id);
        // $exam = Exam::findOrfail($question->exam_id);
        // $exam->total_grade =  $exam->total_grade - $question->grade;
        // $exam->save();
        $question->clearMediaCollection('questions_question_image');
        $question->clearMediaCollection('questions_answer_image');
        $question->delete();
        return redirect()->back()->with('success', 'تم حذف السؤال بناجح');
    }
}
