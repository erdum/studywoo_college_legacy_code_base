<?php

namespace Modules\College\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Modules\Admin\Entities\Admin;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('dataTable.user.action')->with('row', $row)->with('modal_id', 'user-modal');
            })
            ->addColumn('permissions', function ($row) {
                $htm = "<ul class='inline' style='max-height:100px; overflow:auto'><li>";
                $htm .= str_replace(",", "</li><li>", ucwords(str_replace('-', " ",str_replace('"', "",str_replace("]", "", (str_replace("[", "", $row->permissions)))))));

                return $htm .= "</li></ul>";
               
            })
            ->addColumn('first_name', function ($row) {
                return ($row->adminDetail->first_name);
            })

            ->addColumn('last_name', function ($row) {
                return ($row->adminDetail->last_name);
            })
            ->rawColumns(['action', 'permissions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {

        return $model->newQuery()->join('admin_details', 'admin_details.admin_id', '=', 'admins.id')->select("admins.id", "email", "permissions")->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
        // ->buttons(
        //     Button::make('create'),
        //     Button::make('export'),
        //     Button::make('print'),
        //     Button::make('reset'),
        //     Button::make('reload')
        // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::computed('ID')
                ->exportable(false)
                ->printable(false)
                ->width(20)
                ->addClass('text-center'),
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('email'),
            // Column::make('status'),
            Column::make('permissions'),
            //Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(125)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User' . date('YmdHis');
    }
}
