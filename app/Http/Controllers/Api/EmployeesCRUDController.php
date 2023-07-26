<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesCRUDController extends Controller
{
    //
    public function index(){
        $employees = Employees::all();
        if($employees->count() > 0) {

            return response()->json([
                'status' => 200,
                'employees' => $employees
            ], 200);
        }
        else {

            return response()->json([
                'status' => 404,
                'message' => 'Not Found'
            ], 404);
        }

    }

    //
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'address' => 'required|string|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        else {
            $employees = Employees::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            if($employees) {
                return response()->json([
                    'status' => 200,
                    'message' => "Employee Created Successfully!"
                ], 200);
            }
            else {
    
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 404);
            }
        }
    }

    //
    public function getByID($id) {
        $employees = Employees::find($id);
        if($employees){
            return response()->json([
                'status' => 200,
                'message' => $employees
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => "The data not found!"
            ], 404);
        }
    }

    //
    public function edit($id) {
        $employees = Employees::find($id);
        if($employees){
            return response()->json([
                'status' => 200,
                'message' => $employees
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => "The data not found!"
            ], 404);
        }
    }

    //
    public function update(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'address' => 'required|string|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        else {

            $employees = Employees::find($id);

            if($employees) {

                $employees -> update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Employee Updated Successfully!"
                ], 200);
            }
            else {
    
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    //
    public function delete($id) {
        $employees = Employees::find($id);
        if($employees) {
            $employees -> delete();
            return response()->json([
                'status' => 200,
                'message' => "Employee Deleted Successfully!"
            ], 200);
        }
        else {
            return response() -> json([
                'status' => 404,
                    'message' => 'Something went wrong'
            ], 404);
        }
    }
}
