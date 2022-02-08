<?php
/**
 * Author	    : Md. Parvaj Alam <parvajcse@gmail.com>
 * Date	Created : 22-01-2022
 * Date	Modified: 22-01-2022
 * Sprint       : 1
 * Work item    : Regular 
 * Description  : Add and update Branches in real time changes in App. 
 */
namespace App\Http\Controllers;
use App\Models\Branch;
use App\Http\Requests\BranchRequest;
use App\Repositories\BranchRepository;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Response;

class BranchController extends Controller
{
    public $branchRepository;
    public $responseRepository;

    public function __construct(BranchRepository $branchRepository, ResponseRepository $rp)
    {
        // $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->branchRepository = $branchRepository;
        $this->responseRepository = $rp;
    }

    public function index()
    {
        try {
            $data = $this->branchRepository->getAll();
            return $this->responseRepository->ResponseSuccess($data, 'Branch List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
   
   
    public function getAllBranches() 
    { 
        $branchlist = Branch::orderBy('title')->get();
        $response = [
            'status' => 'Success',
            'data' => $branchlist,
            'code' => 200
        ];
        return response()->json($response);
    } 

    public function store(BranchRequest $request)
    {
        try {
            $data = $request->all();
            $branch = $this->branchRepository->create($data);
            return $this->responseRepository->ResponseSuccess($branch, 'New Branch Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseRepository->ResponseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }    

    public function edit( Request $request, $id ) 
    { 
        $branch = Branch::find($id);
        $branch->title = $request->title;
        $branch->details = $request->details;
        $branch->address = $request->address;
        $branch->save();
        return response()->json($branch);
    } 

    public function destroy($id)
    {
        try {
            $produtData =  $this->branchRepository->getByID($id);
            $deleted = $this->branchRepository->delete($id);
            if(!$deleted)
                return $this->responseRepository->ResponseError(null, 'Product Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseRepository->ResponseSuccess($produtData, 'Product Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseRepository->ResponseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
