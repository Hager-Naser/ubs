@extends('layouts.dashboard.head')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-5 col-5">
                <h4 class="page-title">Departments</h4>
            </div>
            <div class="col-sm-7 col-7 text-right m-b-30">
                <a href="{{ route('admin.dashboard.sections.add') }}" class="btn btn-primary btn-rounded"><i
                        class="fa fa-plus"></i> Add Department</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Department Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <?php $i = 1;
                                $i++;
                                // {{-- {{ dd($section->name) }} --}}
                                ?>

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->description }}</td>
                                    @if ($section->status == 1)
                                        <td><span class="custom-badge status-green">Active</span></td>
                                    @else
                                        <td><span class="custom-badge status-green">InActive</span></td>
                                    @endif
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.dashboard.sections.indexEdit', $section) }}"><i
                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div id="delete_department" class="modal fade delete-modal" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('assets/img/sent.png') }}" alt="" width="50"
                                                    height="46">
                                                <h3>Are you sure want to delete this Department?</h3>
                                                <div class="m-t-20">
                                                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                    <form action="{{ route('admin.dashboard.sections.delete', $section) }}" method="POST" style="display:inline;">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $sections->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
