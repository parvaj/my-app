<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Interfaces\CrudInterface;
use App\Models\Branch;
// use Illuminate\Support\Facades\Auth;

class BranchRepository implements CrudInterface{

    /**
     * Get All Branches
     *
     * @return collections Array of Branch Collection
     */
    public function getAll(){
        return Branch::all();
    }

    /**
     * Get Paginated Data
     *
     * @param int $pageNo
     * @return collections Array of Items Collection
     */
    public function getPaginatedData($perPage){
        $perPage = isset($perPage) ? $perPage : 12;
        return Branch::orderBy('id', 'desc')
        ->paginate($perPage);
    }

    /**
     * Get Searchable Data with Pagination
     *
     * @param int $pageNo
     * @return collections Array of Collection
     */
    public function searchItems($keyword, $perPage){
        $perPage = isset($perPage) ? $perPage : 10;
        return Branch::where('title', 'like', '%'.$keyword.'%')
        ->orWhere('details', 'like', '%'.$keyword.'%')
        ->orderBy('id', 'desc')
        ->paginate($perPage);
    }
    
    /**
     * Create New Branch
     *
     * @param array $data
     * @return object Product Object
     */
    public function create(array $data){
        $titleShort = Str::slug(substr($data['title'], 0, 20));
       // $user = Auth::guard()->user();
       // $data['user_id'] =  $user->id;       

        $branch = Branch::create($data);
        return $branch;
    }

    /**
     * Delete Product
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete($id){
        $branch = Branch::find($id);
        if (is_null($branch))
            return false;
        $branch->delete($branch);
        return true;
    }

    /**
     * Get Branch Details By ID
     *
     * @param int $id
     * @return void
     */
    public function getByID($id){
        return Branch::find($id);
    }

    /**
     * Update Branch By ID
     *
     * @param int $id
     * @param array $data
     * @return object Updated Branch Object
     */
    public function update($id, array $data){
        $branch = Branch::find($id);
        $branch->update($data);
        return $this->getByID($branch->id);
    }
}
