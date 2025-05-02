<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($user) {
                return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="' . route('users.destroy', $user->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d M Y') . '<br>' . $user->created_at->format('h:i A');
            })
            ->editColumn('role', function ($user) {
                if($user->role == 'admin'){
                    return '<span class="badge text-success border border-success">Admin</span>';
                }
                elseif($user->role == 'editor'){
                    return '<span class="badge text-info border border-info">Editor</span>';
                }
                else{
                    return '<span class="badge text-secondary border border-secondary">User</span>';
                }
            })

            ->rawColumns(['created_at', 'role', 'action'])
            ->setRowId('id');
    }

    

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->parameters([
                        // 'order' => [[0, 'asc']],
                        'dom' => '<"top mb-4 d-flex justify-content-between align-items-center"lf>rt<"bottom d-flex justify-content-between align-items-center mt-3"ip>',
                        'responsive' => true,
                        'autoWidth' => false,
                    ])
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('role'),
            Column::make('created_at'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(100)
                    ->addClass('text-end'),
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
