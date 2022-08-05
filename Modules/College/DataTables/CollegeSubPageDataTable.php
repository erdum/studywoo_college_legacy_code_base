<?php

namespace Modules\College\DataTables;

use Carbon\Carbon;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeSubpage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollegeSubPageDataTable extends DataTable
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
                return view('dataTable.subpage.action')->with('college_subpage', $row)->with("type", "college-subpage");
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CollegeSubpage $model)
    {
        return $model->newQuery()->where("college_id", $this->id)->with("seo:seoable_id,id,meta_keyword,meta_title,meta_description")->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('collegeSubpage-table')
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

            Column::make('title'),
            // Column::make('slug'),
            Column::make('type'),

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
        return 'College_subpage' . date('YmdHis');
    }
}
