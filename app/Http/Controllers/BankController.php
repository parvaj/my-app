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
use App\Models\Bank;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BankController extends Controller
{
    public function index() 
    { 
       try{
            $bank = Bank::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $bank,
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
        $bank = new Bank();
        $bank->b_name     = $request->b_name;
        $bank->branch_name =  $request->branch_name;
        $bank->account_no =  $request->account_no;
        $bank->routing_no =  $request->routing_no;
        $bank->opening_balance =  $request->opening_balance;
        $bank->short_code =  $request->short_code;
            
        // $Bank->created_by         = $request->user_id;
        
        try { 
            $bank->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business Bank created Successfully',
                'data'=> $bank
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

        if (Bank::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $bank = Bank::find($id);
            $bank->b_name            = $request->b_name;
            $bank->branch_name          =  $request->branch_name;
            $bank->account_no =  $request->account_no;
            $bank->routing_no =  $request->routing_no;
            $bank->opening_balance =  $request->opening_balance;
            $bank->short_code =  $request->short_code;
            
            //dd($Bank);
            // $Bank->updated_by         = $request->user_id;
            // $Bank->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                $bank->save();
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: Bank updated Successfully',
                    'data'=> $bank,
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
                'msg' => 'Bank Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (Bank::where('id', $id)->exists()) {
                $bank = Bank::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: Bank updated Successfully',
                    'data'=> $bank,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'Bank Not Found.'.' , Please try again.',
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
            if (Bank::where('id', $id)->exists()) {
                $bank = Bank::find($id);
                if($bank->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: Bank deleted Successfully',
                        'data'=> $bank,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'Bank Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'Bank Not Found.'.' , Please try again.',
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

