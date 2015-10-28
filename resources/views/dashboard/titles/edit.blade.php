@extends('dashboard.layouts.main')

@section('title')
    Edit title
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
                    <form role="form" method="post" action="{{ url('dashboard/titles/edit/' . $title->id) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" value="{{
                                old('title') ? old('title') : $title->title }}" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="language">Language</label>
                            <input type="text" class="form-control" name="language" value="{{
                                old('language') ? old('language') : $title->language }}" placeholder="Language">
                        </div>
                        <div class="form-group">
                            <select name="titleable_type" class="form-control" id="type">
                                @if (!isset($title->titleable_type))
                                    <option selected>Select type of alternative title</option>
                                    <option value="Anime">Anime</option>
                                    <option value="Manga">Manga</option>
                                @else
                                    <option value="Anime" {{
                                        old('titleable_type') === 'Anime' || $title->titleable_type === 'Anime' ?
                                        'selected' : '' }}>Anime</option>
                                    <option value="Manga" {{
                                        old('titleable_type') === 'Manga' || $title->titleable_type === 'Manga' ?
                                        'selected' : '' }}>Manga</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group selection {{
                            old('titleable_type') === 'Anime' || $title->titleable_type === 'Anime' ? '' : 'hidden' }}">
                            <select name="anime_id" class="form-control" id="anime_id">
                                <option selected>Select anime</option>
                                @foreach ($animes as $anime)
                                    <option value="{{ $anime->id }}" {{
                                        old('anime_id') === $anime->id || $title->titleable_id === $anime->id ?
                                        'selected' : '' }}>{{ $anime->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group selection {{
                            old('titleable_type') === 'Manga' || $title->titleable_type === 'Manga' ? '' : 'hidden' }}">
                            <select name="manga_id" class="form-control" id="manga_id">
                                <option selected>Select manga</option>
                                @foreach ($animes as $anime)
                                    <option value="{{ $anime->id }}" {{
                                        old('anime_id') === $anime->id || $title->titleable_id === $anime->id ?
                                        'selected' : '' }}>{{ $anime->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="active" value="1" {{
                                    (old('active') ? (old('active') === '1' ? 'checked' : '') :
                                    ($title->active ? 'checked' : '')) }}>
                                Active
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/titles') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(function () {
            jQuery('#type').on('change', function() {
                jQuery('#' + $(this).val().toLowerCase() + '_id').parent().removeClass('hidden').siblings('.selection').addClass('hidden');
            });
        });
    </script>
@endsection