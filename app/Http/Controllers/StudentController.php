<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('id','ASC')->get();
        return view('student',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudent(Request $request){
        // $request->validate(
        //     [
        //         'firstname' => 'required',
        //         'lastname' => 'required',
        //         'email' => 'required|email|unique:students,email',
        //         'phone' => 'required|regex:/(01)[0-9]{9}/',
        //     ],
        //     [
        //         'firstname.required' => 'Firstname is required',
        //         'lastname.required' => 'Lastname is required',
        //         'email.required' => 'Email is required',
        //         'email.email' => 'Email must be email',
        //         'email.unique' => 'Email must be unique',
        //         'phone.required' => 'Phone number must be required.'
        //     ]
        // );
        $student = new Student();
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->save();
        return response()->json($student);
    }


    public function getStudentById($id){
        $student = Student::find($id);

        return response()->json($student);
    } 
    public function updateStudent(Request $request){
        $student = Student::find($request->id);
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->save();

        return response()->json($student);

    }
    public function deleteStudent($id){
        $student = Student::find($id);
        $student->delete();
        return response()->json(['success' => 'Record has been deleted.']);
    }

    public function deleteCheckedStudents(Request $request){
        $ids = $request->ids;
        Student::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Students have been deleted!"]);
    }

    public function local($locale){
        App::setlocale($locale);
        return view('student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
