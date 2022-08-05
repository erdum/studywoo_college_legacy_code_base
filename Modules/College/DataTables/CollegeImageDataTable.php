<?php

namespace Modules\College\DataTables;
use Carbon\Carbon;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\City;
use Modules\College\Entities\CollegeImage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollegeImageDataTable extends DataTable
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
            ->addColumn('action', function($row){
                return view('dataTable.image.action')->with('college_image',$row)->with('modal_id','image_modal');
            })
            ->addColumn('image', function($row){
                // return $row->image->path . '/' . $row->image->filename;
                $url= asset($row->image->path . '/' . $row->image->filename);
                return '<img src="'.$url.'" border="0" width="200"  class="img-rounded" align="center" />';
            })

            ->rawColumns(['action','image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\State $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CollegeImage $model)
    {
        return $model->newQuery()->where("college_id", $this->id)->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('affiliated-table')
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

            Column::make('image'),

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
        return 'Image' . date('YmdHis');
    }
}
