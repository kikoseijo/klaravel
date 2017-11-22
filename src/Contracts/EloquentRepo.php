<?php

namespace Ksoft\Klaravel\Contracts;

interface EloquentRepo
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
     * @param string $column
     * @param string|array $value
     * @param number|null $paginate
     * @return Collection|Pagination
     */
    public function findWhereLike($column, $value, $paginate = 0);

    /**
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
     * @param $id
     * @param array $properties
     * @return void
     */
    public function update($id, array $properties);


    public function delete($id);
}
