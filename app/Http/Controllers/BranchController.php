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
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BranchController extends Controller
{
    public function index() 
    { 
       try{
            $branch = Branch::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $branch,
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

    public function getAllbusinessLists() 
    { 
        $businessList = BusinessList::orderBy('title')->get();
        $response = [
            'status' => 'Success',
            'data' => $businessList,
            'code' => 200
        ];
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
        $branch = new Branch();
        $branch->title         = $request->title;
        $branch->details       = $request->details;
        $branch->business_type_id     = $request->business_type_id;
        
        // $branch->created_by         = $request->user_id;
        
        try { 
            $branch->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business branch created Successfully',
                'data'=> $branch
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

        if (Branch::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $branch = Branch::find($id);
            $branch->title            = $request->title;
            $branch->details          =  $request->details;
            $branch->business_type_id =  $request->business_type_id;
            
            //dd($branch);
            // $branch->updated_by         = $request->user_id;
            // $branch->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                $branch->save();
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: branch updated Successfully',
                    'data'=> $branch,
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
                'msg' => 'branch Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (Branch::where('id', $id)->exists()) {
                $branch = Branch::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: branch updated Successfully',
                    'data'=> $branch,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'branch Not Found.'.' , Please try again.',
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
            if (Branch::where('id', $id)->exists()) {
                $branch = Branch::find($id);
                if($branch->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: branch deleted Successfully',
                        'data'=> $branch,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'branch Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'branch Not Found.'.' , Please try again.',
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

