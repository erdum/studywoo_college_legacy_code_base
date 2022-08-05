<?php

namespace Modules\College\DataTables;

use Modules\College\Entities\College;
use Modules\College\Entities\CollegeCourse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollegeCourseDataTable extends DataTable
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
                return view('dataTable.action')->with('college_course', $row)->with('modal_id', 'collegeCourse-modal');
            })
            ->addColumn('name', function ($row) {
                return $row->course->name;
            })

            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CollegeCourse $model)
    {
        return $model->newQuery()->where("college_id", $this->id)->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('collegeCourse-table')
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

            Column::make('name'),

            // Column::make('type'),
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
        return 'College_course' . date('YmdHis');
    }
}
