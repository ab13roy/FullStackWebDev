<?php

namespace App\DataTables;

use App\Admin;
use App\Models\RoleManagement;
use App\Models\SubAdmin;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use DB;
class SubAdminDataTable extends DataTable
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


       return   $dataTable->addColumn('action', 'sub_admins.datatables_actions')
                        ->editColumn('status', function ($data) {
                            if($data->status == "Active"){
                                return '<span id="active_'.$data->id.'"><a  class="label label-success" onclick="activeStatus('.$data->id.',1);" style="padding:7px; font-size:14px;">Active</a></span>';
                            }else{
                                return '<span id="active_'.$data->id.'"><a  class="label label-danger" onclick="activeStatus('.$data->id.',0);" style="padding:7px; font-size:14px;">In-Active</a></span>';
                            }
                           })
                            ->setRowId(function ($data) {
                                return 'is_deleted_'.$data->id;
                            })

                           ->rawColumns(['status','action','rownum']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubAdmin $model)
    {
        $start = 1;
        DB::statement(DB::raw('set @rownum=0'));
        return $model->newQuery()->where('is_admin',1)->select('*', DB::raw('@rownum  := @rownum  + 1 AS rownum'));
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
        return [
            'Serial No' => ['name' => 'rownum', 'data' => 'rownum','searchable'=>false],
            'name',
            'email',
            'status' => ['name' => 'status', 'data' => 'status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'sub_adminsdatatable_' . time();
    }
}