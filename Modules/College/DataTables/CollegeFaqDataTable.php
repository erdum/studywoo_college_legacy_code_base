<?php

namespace Modules\College\DataTables;

use Carbon\Carbon;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeFaq;
use Modules\College\Entities\CollegeSubpage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollegeFaqDataTable extends DataTable
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
                return view('dataTable.faq.action')->with('college_faq', $row)->with('modal_id', 'collegeFaq-modal');
            })
            ->addColumn('question', function ($row) {
                return $row->faq->question;
            })
            ->addColumn('answer', function ($row) {
                return $row->faq->answer;
            })

            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CollegeFaq $model)
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
            ->setTableId('collegeFaq-table')
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

            Column::make('question'),

            Column::make('answer'),
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
        return 'College_faq' . date('YmdHis');
    }
}
