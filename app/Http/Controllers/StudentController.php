<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::orderBy('name', 'asc')->get();

        return view('student.student', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.student-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Trim white spaces from name and subject_name before validating
        $request->merge([
            'name' => trim($request->name),
            'subject_name' => trim($request->subject_name),
        ]);

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|max:50',
            'subject_name' => 'required',
            'marks' => 'required|numeric',
        ]);

        // Check if a record with the same name and subject exists
        $student = Student::where('name', $request->name)
            ->where('subject_name', $request->subject_name)
            ->first();

        if ($student) {
            // If the student record exists, update the marks
            $student->marks = $request->marks;
            $student->save();

            Alert::success('Success', 'Student already exist so marks have been updated!');
        } else {
            // If no matching record is found, create a new student record
            Student::create($request->all());

            Alert::success('Success', 'Student has been created!');
        }

        return redirect('/student');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        // echo"<pre>";print_r($student); die;
        return view('student.student-edit', [
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Trim white spaces from name and subject_name before validating
        $request->merge([
            'name' => trim($request->name),
            'subject_name' => trim($request->subject_name),
        ]);
        
        $validated = $request->validate([
            'name' => 'required|max:100|unique:students,name,' . $id . ',id',
            'subject_name' => 'required',
            'marks' => 'required',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);

        Alert::info('Success', 'Student has been updated !');
        return redirect('/student');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deletedstudent = Student::findOrFail($id);

            $deletedstudent->delete();

            Alert::error('Success', 'Student has been deleted !');
            return redirect('/student');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Student already used !');
            return redirect('/student');
        }
    }
}
