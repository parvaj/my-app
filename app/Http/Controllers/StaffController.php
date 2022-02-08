<?php
/**
 * Author	    : Md. Parvaj Alam <parvajcse@gmail.com>
 * Date	Created : 27-01-2022
 * Date	Modified: 27-01-2022
 * Sprint       : 1
 * Work item    : Regular 
 * Description  : Add and update businessLists in real time changes in App. 
 */
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function index() 
    { 
       try{
            $staff = Staff::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $staff,
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
            'first_name'  => 'required',
        ]); // 'user_id'       => 'required'

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors(),'code' => 401]);            
        }
        // if (!User::where('id', $request->user_id)->exists()) {
        //     return response()->json(['error'=>'Invalid user access','code' => 401]);
        // }
        $staff = new Staff();
        $staff->first_name     = $request->first_name;
        $staff->last_name =  $request->last_name;
        $staff->department_id =  $request->department_id;
        $staff->nid =  $request->nid;
        $staff->acc_no =  $request->acc_no;
        $staff->salary =  $request->salary;
        $staff->branch_id =  $request->branch_id;
        $staff->birth_date =  $request->birth_date;
        $staff->joining_date =  $request->joining_date;
        $staff->position_id =  $request->position_id;
        
            
        // $staff->created_by         = $request->user_id;
        
        try { 
            $staff->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business Staff created Successfully',
                'data'=> $staff
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

        if (Staff::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $staff = Staff::find($id);
            $staff->first_name     = $request->first_name;
            $staff->last_name =  $request->last_name;
            $staff->department_id =  $request->department_id;
            $staff->nid =  $request->nid;
            $staff->acc_no =  $request->acc_no;
            $staff->salary =  $request->salary;
            $staff->branch_id =  $request->branch_id;
            $staff->birth_date =  $request->birth_date;
            $staff->joining_date =  $request->joining_date;
            $staff->position_id =  $request->position_id;   
            
            //dd($staff);
            // $staff->updated_by         = $request->user_id;
            // $staff->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                $staff->save();
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: Staff updated Successfully',
                    'data'=> $staff,
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
                'msg' => 'Staff Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (Staff::where('id', $id)->exists()) {
                $staff = Staff::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: Staff updated Successfully',
                    'data'=> $staff,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'Staff Not Found.'.' , Please try again.',
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
            if (Staff::where('id', $id)->exists()) {
                $staff = Staff::find($id);
                if($staff->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: Staff deleted Successfully',
                        'data'=> $staff,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'Staff Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'Staff Not Found.'.' , Please try again.',
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

