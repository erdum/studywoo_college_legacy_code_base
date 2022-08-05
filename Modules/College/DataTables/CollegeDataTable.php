<?php

namespace Modules\College\DataTables;

use Carbon\Carbon;
use Modules\College\Entities\City;
use Modules\College\Entities\College;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollegeDataTable extends DataTable
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
            // ->addColumn('location', function ($row) {
            //     return $row->collegeDetail->city->name . ',' . $row->collegeDetail->state->name;
            // })
            ->addColumn('action', function ($row) {
                // dd($row);
                return view('dataTable.college.action')->with('college', $row)->with("type", "college-model");
            })
            ->addColumn('address', function ($row) {
                // return view('dataTable.image')->with('logo', $row->collegeDetail->logo);
                $htm =  $row->city->name . "," . $row->state->name;
                return $htm;
            })
            // ->addColumn('city', function ($row) {
            //     // return view('dataTable.image')->with('logo', $row->collegeDetail->logo);
            //     return $row->city->name;
            // })
            ->addColumn('other', function ($row) {
                $htm = "";
                // if (hasPermission('Add Subpage')) {
                    $htm .=   "<div style='display:flex;flex-wrap: wrap;align-items: center;'> <a href='" . route('admin.college.subpage.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs'>Subpage</a>";
                // }
                $htm .=
                     '<br/>' . "<a href='" . route('admin.college.course.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs m-1'>Course</a>"
                    . "<br/>" . "<a href='" . route('admin.college.image.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs m-1'>Image</a>"
                    . "<br/>" . "<a href='" . route('admin.college.video.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs m-1'>Video</a>"
                    . "<br/>" . "<a href='" . route('admin.college.faq.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs m-1'> FAQ</a>
                    </div>";

                return $htm;
            })
            // ->addColumn('subpage', function ($row) {
            //     return "<a href='" . route('admin.college.subpage.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs'>List</a>";
            // })
            // ->addColumn('image', function ($row) {
            //     return "<a href='" . route('admin.college.image.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs'>List</a>";
            // })
            // ->addColumn('video', function ($row) {
            //     return "<a href='" . route('admin.college.video.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs'>List</a>";
            // })

            // ->addColumn('faq', function ($row) {
            //     return "<a href='" . route('admin.college.faq.list', ['college' => $row->id]) . "' class='btn btn-primary btn-xs'> List</a>";
            // })

            ->rawColumns(['action', 'other']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(College $model)
    {
        $model = $model->newQuery()->with("seo:seoable_id,id,meta_keyword,meta_title,meta_description")->orderBy('id', 'desc');

        if (request()->state)
            $model->where("state_id", request()->state);
        if (request()->city)
            $model->where("city_id", request()->city);
        if (request()->type)
            $model->whereHas("collegeType", function ($q) {
                $q->where("college_type_id", request()->type);
            });
        if (request()->stream)
            $model->with("stream")
                ->whereHas("stream", function ($q) {
                    $q->where("stream_id", request()->stream);
                });

        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('college-table')
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
                ->width(10),

            Column::make('name')
                ->width(10),
            Column::make('address')
                ->width(5),
            // Column::make('city')
            //     ->width(5)
            //     ->addClass('text-center'),
            // Column::make('location')
            // ->width(10)
            // ->addClass('text-center'),
            Column::make('other')
                ->exportable(false)
                ->printable(false)
                ->addClass("w-200")
                ->width(200),
            // Column::make('subpage')
            //     ->width(10)
            //     ->addClass('text-center'),
            // Column::make('image')
            //     ->width(10)
            //     ->addClass('text-center'),
            // Column::make('video')
            //     ->width(10)
            //     ->addClass('text-center'),
            // Column::make('faq')
            //     ->width(10)
            //     ->addClass('text-center'),

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
        return 'College' . date('YmdHis');
    }
}
