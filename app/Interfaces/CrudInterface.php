<?php
namespace App\Interfaces;

interface CrudInterface {
    /**
     * Get All Data
     *
     * @return array All Data
     */
    public function getAll();

    /**
     * Get Paginated Data
     *
     * @param int   Page No
     * @return array Paginated Data
     */
    public function getPaginatedData(int $perPage);

    /**
     * Create New Item
     *
     * @param array $data
     * @return object Created Items
     */
    public function create(array $data);

    /**
     * Delete Item By Id
     *
     * @param int $id
     * @return object Deleted Items
     */
    public function delete($id);

    /**
     * Get Item Details By ID
     *
     * @param int $id
     * @return object Get Product
     */
    public function getByID($id);

    /**
     * Update By Id and Data
     *
     * @param int $id
     * @param array $data
     * @return object Updated Information
     */
    public function update($id,array $data);
}