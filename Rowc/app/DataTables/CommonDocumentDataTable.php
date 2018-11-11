<?php

namespace App\DataTables;

use App\Models\CommonDocument;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CommonDocumentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'common_documents.datatables_actions')->editColumn('common_file', function ($data) {
            if(Auth::guard('admin')->user()->is_admin != 2) {
                return '<a target="_blank" class="label label-success" href="' . asset('uploads/document/common/' . $data->common_file) . '" style="padding:7px; font-size:14px;">Show Document</a>';
            }else{
                return '<a target="_blank" class="label label-success" href="' . asset('uploads/document/common/' . $data->common_file) . '" style="padding:7px; font-size:14px;">Download Document</a>';
            }

        }) ->rawColumns(['common_file','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CommonDocument $model)
    {
        if(Auth::guard('admin')->user()->is_admin != 2) {
            return $model->newQuery();
        }else{
            return $model->newQuery()->where('document_type','Coach ');
        }
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
                ->minifiedAjax()
                ->addAction(['width' => '80px'])
                ->parameters([
//                'dom'     => 'Bfrtip',
//                'order'   => [[0, 'desc']],
//                'buttons' => [
//                    'create',
//                    'export',
//                    'print',
//                    'reset',
//                    'reload',
//                ],
                ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if(Auth::guard('admin')->user()->is_admin != 2) {
            return [
                'title',
                'document_type',
                'common_file'
            ];
        }else{
            return [
                'title',
                'common_file'
            ];
        }
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'common_documentsdatatable_' . time();
    }
}