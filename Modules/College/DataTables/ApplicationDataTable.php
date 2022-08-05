<?php

namespace Modules\College\DataTables;
use Carbon\Carbon;
use Modules\Customer\Entities\CustomerApplication;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ApplicationDataTable extends DataTable
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

            ->addColumn('College Name', function ($row) {

                return $row->college->name;
            })
            ->addColumn('Customer Name', function ($row) {

                return $row->full_name ;
            })
            ->addColumn('Email', function ($row) {

                return $row->email ;
            })
            ->addColumn('Contact', function ($row) {

                return $row->mobile_number ;
            })
            ->addColumn('Address', function ($row) {

                return $row->city ;
            })
            ->addColumn('Course Name', function ($row) {

                return $row->course->name;
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CustomerApplication $model)
    {
        return $model->newQuery()->orderBy('id','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('application-table')
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

            Column::make('Customer Name'),
            Column::make('Email'),
            Column::make('Contact'),
            Column::make('Address'),

            Column::make('College Name'),

            Column::make('Course Name'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Applications' . date('YmdHis');
    }
}
