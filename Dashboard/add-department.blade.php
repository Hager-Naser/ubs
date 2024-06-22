@extends('layouts.dashboard.head')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Department</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ route('admin.dashboard.sections.store') }}">
                @csrf
                {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                <div class="form-group">
                    <label>Department Name</label>
                    <input class="form-control" type="text" name="name">
                    @error("name")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea cols="30" rows="4" class="form-control" name="description"></textarea>
                    @error("description")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="display-block">Department Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="product_active" value="1" checked>
                        <label class="form-check-label" for="product_active">
                        Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0">
                        <label class="form-check-label" for="product_inactive">
                        Inactive
                        </label>
                    </div>
                    @error("status")
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Create Department</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endsection
