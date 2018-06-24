<?php

namespace App\DataTables%subfolder%;

use App\Models\%model%;
use Form;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class %model%DataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $records = new EloquentDataTable($this->query());
        return $records
            // ->eloquent($this->query())
            ->addColumn('action', function ($record) {
                return view('back._base.data-table_actions', [
                    'model_name' => '%model_name_url%',
                    'id' => $record->id,
                ]);
            })
            ->rawColumns(['action'])

            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $roles = %model%::query();

        return $this->applyScopes($roles);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa-fw fas fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'slug' => ['name' => 'slug', 'data' => 'slug'],
            'name' => ['name' => 'name', 'data' => 'name'],
            'title' => ['name' => 'title', 'data' => 'title'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return '%model_name_url%';
    }
}
