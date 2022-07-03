<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Student;
use Response;

class StudentController extends Controller
{
    public function index(){
        return view('index');
    }

    public function loadtable(){
        $students = student::all();
        return response()->json([
            'students'=> $students,
        ]);
    }


    public function store(Request $req){
        if($req->ajax()){
            $student = new student;
            $student->name = $req->input('name');
            $student->email = $req->input('email');
            $student->phone = $req->input('contact');
            $student->cource = $req->input('cource');
            $student->save();
            // $student = Student::create([
            //     'name' => $req->input('name'),
            // ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Student Added Successfully',
            ]);
        }
       
    }

    public function edit($id){
        $student =  Student::find($id);
        // dd($student);
        if($student){
            return response()->json([
                'status' => 200,
                'message' => $student,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Student Doesnt Exist',
            ]);
        }
       
    }

    public function update(Request $req){
        if($req->ajax()){
            $student = Student::where('id',$req->input('id'))
            ->update([
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'phone' => $req->input('contact'),
                'cource' => $req->input('cource'),
            ]);
            return Response()->json([
                'status' => 200,
                'message' => 'Student Updated Successfully',
            ]);
        }
    }

    public function delete(Request $req){
        if($req->ajax()){
            $student = Student::destroy($req->id);
            return Response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully',
            ]);
        }
    }
}
