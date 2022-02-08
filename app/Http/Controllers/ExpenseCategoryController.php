<?php
/**
 * Author	    : Md. Parvaj Alam <parvajcse@gmail.com>
 * Date	Created : 07-02-2022
 * Date	Modified: 07-02-2022
 * Sprint       : 1
 * Work item    : Regular 
 * Description  : Add and update ExpenseCategory in real time changes in App. 
 */
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpenseCategoryController extends Controller
{
    public function index() 
    { 
       try{
            $expenseCategory = ExpenseCategory::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $expenseCategory,
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
        $expenseCategory = new ExpenseCategory();
        $expenseCategory->title     = $request->title;
        $expenseCategory->details =  $request->details;
        $expenseCategory->comment =  $request->comment;
           
        // $expenseCategory->created_by         = $request->user_id;
        
        try { 
            $expenseCategory->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business ExpenseCategory created Successfully',
                'data'=> $expenseCategory
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

        if (ExpenseCategory::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $expenseCategory = ExpenseCategory::find($id);
            $expenseCategory->title     = $request->title;
            $expenseCategory->details =  $request->details;
            
            //dd($expenseCategory);
            // $expenseCategory->updated_by         = $request->user_id;
            // $expenseCategory->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                $expenseCategory->save();
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: ExpenseCategory updated Successfully',
                    'data'=> $expenseCategory,
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
                'msg' => 'ExpenseCategory Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (ExpenseCategory::where('id', $id)->exists()) {
                $expenseCategory = ExpenseCategory::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: ExpenseCategory updated Successfully',
                    'data'=> $expenseCategory,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'ExpenseCategory Not Found.'.' , Please try again.',
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
            if (ExpenseCategory::where('id', $id)->exists()) {
                $expenseCategory = ExpenseCategory::find($id);
                if($expenseCategory->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: ExpenseCategory deleted Successfully',
                        'data'=> $expenseCategory,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'ExpenseCategory Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'ExpenseCategory Not Found.'.' , Please try again.',
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

