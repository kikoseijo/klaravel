<?php

namespace Ksoft\Klaravel\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Ksoft\Klaravel\Contracts\EloquentRepoContract as Contract;

abstract class EloquentRepo implements Contract
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     *  @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * This are the only mandatary function you have to implement,
     * Return your model class here.
     *
     * {@inheritdoc}
     */
    abstract protected function model();

    /**
     * @param $request
     */
    abstract protected function withRelationships($request);

    /**
     * [__construct ::]
     */
    public function __construct(Request $request)
    {
        $this->model   = app($this->model());
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $record = $this->model->find($id);

        if (!$record) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->model->getModel()),
                $id
            );
        }

        return $record;
    }

    /**
     * {@inheritdoc}
     */
    public function findWhere($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function findWhereFirst($column, $value)
    {
        $record = $this->model->where($column, $value)->first();

        if (!$record) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->model->getModel())
            );
        }

        return $record;
    }

    /**
     * {@inheritdoc}
     */
    public function findWhereLike($column, $value)
    {
        $query = $this->model;
        if (is_array($column)) {
            $i = 0;
            foreach ($column as $columnItem) {
                if ($i == 0) {
                    $query->where($column, 'like', $value);
                } else {
                    $query->orWhere($column, 'like', $value);
                }
                $i++;
            }
        } else {
            $query->where($column, 'like', $value);
        }
        return $this->paginateIf($query->get());
    }

    /**
     * {@inheritdoc}
     */
    public function paginateIf($records)
    {
        $per_page = $this->request->input('take') > 0 ? $this->request->input('take') : 0;

        if ($per_page > 0) {

            $page   = $this->request->input('page') > 0 ? $this->request->input('page') : 1;
            $offset = ($page * $per_page) - $per_page;

            return new LengthAwarePaginator(
                array_slice($records->toArray(), $offset, $per_page, true),
                count($records),
                $per_page,
                $page,
                ['path' => $this->request->url(), 'query' => $this->request->query()]
            );
        } else {

            return $records;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $properties)
    {
        return $this->model->create($properties);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $properties)
    {
        $record = $this->find($id);
        $record->update($properties);
        return $record;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
