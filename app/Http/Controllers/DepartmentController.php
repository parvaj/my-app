<?php
/**
 * Author	    : Md. Parvaj Alam <parvajcse@gmail.com>
 * Date	Created : 27-01-2022
 * Date	Modified: 27-01-2022
 * Sprint       : 1
 * Work item    : Regular 
 * Description  : Add and update departments in real time changes in App. 
 */
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentController extends Controller
{
    public function index() 
    { 
       try{
            $department = Department::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $department,
                'code' => 200
            ];
       }catch (\Exception $ex) {
            $response = [
                'status' => 'Failed',
                'msg' =>  (env('APP_ENV') != 'production')?$ex->getMessage():'Server error' . ' , Please try again.',
                'errdetailed' => (env('APP_ENV') != 'production')? $ex:'',
                'code' => 400
            ];
       }
        
        return response()->json($response);
    } 
   
    
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'title'  => 'required',
        ]); // 'user_id'       => 'required'

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors(),'code' => 401]);            
        }
        // if (!User::where('id', $request->user_id)->exists()) {
        //     return response()->json(['error'=>'Invalid user access','code' => 401]);
        // }
        $department = new Department();
        $department->title         = $request->title;
        $department->details       = $request->details;
        $department->branch_id       = $request->branch_id;
        
        // $department->created_by         = $request->user_id;
        
        try { 
            $department->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business department created Successfully',
                'data'=> $department
            ]; 
        } catch (\Exception $ex) {
            $response = [
                'status' => 'Failed',
                'msg' =>  (env('APP_ENV') != 'production')?$ex->getMessage():'Server error' . ' , Please try again.',
                'errdetailed' => (env('APP_ENV') != 'production')? $ex:'',
                'code' => 400
            ];
        }
        return response()->json($response);
    }

    public function update(Request $request, $id) {

        if (Department::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $department = Department::find($id);
            $department->title            = $request->title;
            $department->details          =  $request->details;
            
            //dd($department);
            // $department->updated_by         = $request->user_id;
            // $department->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                // $department->update([
                //     'title' => $request->title,
                //     'details' => $request->details,
                // ]);
                //dd('yeeeess');
                $department->save();
                
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: department updated Successfully',
                    'data'=> $department,
                    'code' => 200
                ]; 
              
            } catch (\Exception $ex) {
                $response =[
                    'status' => 'Failed',
                    'msg' =>  (env('APP_ENV') != 'production')?'error':'Server error' . ' , Please try again.',
                    'errdetailed' => (env('APP_ENV') != 'production')? $ex:$ex,
                    'code' => 400
                ];
            }
            
        } 
        else
        {
            $response = [
                'status' => 'Not Found',
                'msg' => 'department Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (Department::where('id', $id)->exists()) {
                $department = Department::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: department updated Successfully',
                    'data'=> $department,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'department Not Found.'.' , Please try again.',
                    'code' => 204
                ];
            }
        } catch (\Exception $ex) {
            $response = [
                'status' => 'Failed',
                'msg' =>  (env('APP_ENV') != 'production')?$ex->getMessage():'Server error' . ' , Please try again.',
                'errdetailed' => (env('APP_ENV') != 'production')? $ex:'',
                'code' => 400
            ];
        }
        return response()->json($response);  
    } 

    public function destroy( Request $request, $id ) 
    { 
        try {
            if (Department::where('id', $id)->exists()) {
                $department = Department::find($id);
                if($department->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: department deleted Successfully',
                        'data'=> $department,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'department Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'department Not Found.'.' , Please try again.',
                    'code' => 204
                ];
            }
        } catch (\Exception $ex) {
            $response = [
                'status' => 'Failed',
                'msg' =>  (env('APP_ENV') != 'production')?$ex->getMessage():'Server error' . ' , Please try again.',
                'errdetailed' => (env('APP_ENV') != 'production')? $ex:'',
                'code' => 400
            ];
        }
        return response()->json($response);  
    } 
}

