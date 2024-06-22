@extends('layouts.dashboard.head')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Department</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{ route('admin.dashboard.sections.edit', $section->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Department Name</label>
                        <input class="form-control" type="text" name="name" value="{{ $section->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="4" class="form-control" name="description">{{ $section->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="display-block">Department Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_active" value="1"
                                <?= $section->status == '1' ? 'checked' : ' ' ?>>
                            <label class="form-check-label" for="product_active">
                                Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_inactive"
                                value="0" <?= $section->status == '0' ? 'checked' : ' ' ?>>
                            <label class="form-check-label" for="product_inactive">
                                Inactive
                            </label>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Save Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
