@extends('dashboard.layouts.main')

@section('title')
    Edit page
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="post" action="{{ url('dashboard/pages/edit/' . $page->id) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Title</label>
                            <input page="text" class="form-control" name="title" value="{{
                                old('title') ? old('title') : $page->title }}" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input page="text" class="form-control" name="slug" value="{{
                                old('slug') ? old('slug') : $page->slug }}" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" id="" cols="30" rows="10" placeholder="content">{{
                                old('content') ? old('content') : $page->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input page="checkbox" class="checkbox" name="active" value="1" {{
                                    (old('active') ? (old('active') === '1' ? 'checked' : '') :
                                    ($page->active ? 'checked' : '')) }}>
                                Active
                            </label>
                        </div>
                        <button page="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/pages') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection