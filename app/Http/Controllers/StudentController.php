<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(5);
        return view('welcome', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        return redirect()->route('welcome')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('welcome')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $output = [];
        $students = Student::where('name', 'like', '%' .$request->search. '%')
            ->orWhere('email', 'like', '%' .$request->search. '%')
            ->orWhere('mobile', 'like', '%' .$request->search. '%')
            ->get();

            foreach ($students as $student) {
                $output= '<tr>
                    <td> '.$student->name.' </td>
                    <td> '.$student->branch.' </td>
                    <td> '.$student->mobile.' </td>
                    <td> '.$student->email.' </td>
                    <td> '.$student->address.' </td>
                    <td> '.'<a href="'.route('student.edit', $student->id).'">Edit</a>'.' </td>
                </tr>';
            }
            return response($output);
    }

}
