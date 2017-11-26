<?php

namespace Ksoft\Klaravel\Contracts;

interface EloquentRepoContract
{
    /**
     * @return array
     */
    public function all();

    /**
     * Finds a record by its primary key
     * @param $id
     * @return record
     */
    public function find($id);

    /**
     * @param $column
     * @param $value
     * @return array
     */
    public function findWhere($column, $value);

    /**
     * @param $column
     * @param $value
     * @return record
     */
    public function findWhereFirst($column, $value);

    /**
     * 
     * @param string $column
     * @param string|array $value
     * @param number|null $paginate
     * @return Collection|Pagination
     */
    public function findWhereLike($column, $value, $paginate = 0);

    /**
     * Returns laravel paginated object with records
     *
     * @param $perPage
     * @return array
     */
    public function paginate($perPage = 10);

    /**
     * @param array $properties
     * @return record
     */
    public function create(array $properties);

    /**
     * Updates a record.
     *
     * @param $id
     * @param array $properties
     * @return void
     */
    public function update($id, array $properties);

    /**
     * Delete record of provided id.
     *
     * @param $id
     */
    public function delete($id);
}
