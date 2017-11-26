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
     * @return Illuminate\Support\Collection |
     *          Illuminate\Pagination\LengthAwarePaginator
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
     * @return Illuminate\Support\Collection
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function findWhereLike($column, $value);

    /**
     * Returns paginated object with records if $request->limit > 0
     *
     * @param Illuminate\Support\Collection $records
     * @return Illuminate\Support\Collection
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateIf($records);

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
     * @return Model
     */
    public function update($id, array $properties);

    /**
     * Delete record of provided id.
     *
     * @param $id
     */
    public function delete($id);
}
