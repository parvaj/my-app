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
use App\Models\BusinessType;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BusinessTypeController extends Controller
{
    public function index() 
    { 
       try{
            $category = BusinessType::orderBy('title')->get();
            $response = [
                'status' => 'Success',
                'data' => $category,
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
        $bType = new BusinessType();
        $bType->title         = $request->title;
        $bType->details       = $request->details;
        // $bType->created_by         = $request->user_id;
        
        try { 
            $bType->save();
            $response = [
                'status' => 'Success',
                'msg' => 'Success: Business category created Successfully',
                'data'=> $bType
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

        if (BusinessType::where('id', $id)->exists()) {
            $validator = Validator::make($request->all(), [ 
                'title'   => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors(),'code' => 401]);            
            }
            // if (!User::where('id', $request->user_id)->exists()) {
            //     return response()->json(['error'=>'Invalid user access','code' => 401]);
            // }
            $category = BusinessType::find($id);
            $category->title            = $request->title;
            $category->details          =  $request->details;
            
            //dd($category);
            // $category->updated_by         = $request->user_id;
            // $category->updated_at         = Carbon::now()->toDateTimeString();
           
            try {
                // $category->update([
                //     'title' => $request->title,
                //     'details' => $request->details,
                // ]);
                //dd('yeeeess');
                $category->save();
                
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: Category updated Successfully',
                    'data'=> $category,
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
                'msg' => 'Category Not Found.'.' , Please try again.',
                'code' => 204
            ];
        }   
        return response()->json($response);
    }
    
    public function edit( Request $request, $id ) 
    { 
        try {
            if (BusinessType::where('id', $id)->exists()) {
                $category = BusinessType::find($id);
                $response = [
                    'status' => 'Success',
                    'msg' => 'Success: Category updated Successfully',
                    'data'=> $category,
                    'code' => 200
                ]; 
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'Category Not Found.'.' , Please try again.',
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
            if (BusinessType::where('id', $id)->exists()) {
                $category = BusinessType::find($id);
                if($category->delete()){
                    $response = [
                        'status' => 'Success',
                        'msg' => 'Success: Category deleted Successfully',
                        'data'=> $category,
                        'code' => 200
                    ]; 
                }else{
                    $response = [
                        'status' => 'Failure',
                        'msg' => 'Category Not Deleted.'.' , Please try again.',
                        'code' => 204
                    ];
                }
                
            }else
            {
                $response = [
                    'status' => 'Not Found',
                    'msg' => 'Category Not Found.'.' , Please try again.',
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

