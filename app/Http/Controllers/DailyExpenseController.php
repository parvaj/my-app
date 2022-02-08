<?php
/**
 * Author	    : Md. Parvaj Alam <parvajcse@gmail.com>
 * Date	Created : 07-02-2022
 * Date	Modified: 07-02-2022
 * Sprint       : 1
 * Work item    : Regular 
 * Description  : Add and update DailyExpense in real time changes in App. 
 */
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\DailyExpense;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyExpenseController extends Controller
{
    public function index() 
    { 
       try{
            $dailyExpense = DailyExpense::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $dailyExpense,
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
        $dailyExpense = new DailyExpense();
        $dailyExpense->expense_date     = $request->expense_date;
        $dailyExpense->expense_category_id =  $request->expense_category_id;
        $dailyExpense->amount =  $request->amount;
        $dailyExpense->note =  $request->note;
           
        // $dailyExpense->created_by         = $request->user_id;
        
        try { 
            $dailyExpense->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business DailyExpense created Successfully',
                'data'=> $dailyExpense
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

        if (DailyExpense::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $dailyExpense = DailyExpense::find($id);
            $dailyExpense->expense_date     = $request->expense_date;
            $dailyExpense->expense_category_id =  $request->expense_category_id;
            $dailyExpense->amount =  $request->amount;
            $dailyExpense->note =  $request->note;
            
            //dd($dailyExpense);
            // $dailyExpense->updated_by         = $request->user_id;
            // $dailyExpense->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                $dailyExpense->save();
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: DailyExpense updated Successfully',
                    'data'=> $dailyExpense,
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
                'msg' => 'DailyExpense Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (DailyExpense::where('id', $id)->exists()) {
                $dailyExpense = DailyExpense::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: DailyExpense updated Successfully',
                    'data'=> $dailyExpense,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'DailyExpense Not Found.'.' , Please try again.',
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
            if (DailyExpense::where('id', $id)->exists()) {
                $dailyExpense = DailyExpense::find($id);
                if($dailyExpense->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: DailyExpense deleted Successfully',
                        'data'=> $dailyExpense,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'DailyExpense Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'DailyExpense Not Found.'.' , Please try again.',
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

