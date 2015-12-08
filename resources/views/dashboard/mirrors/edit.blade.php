@extends('dashboard.layouts.main')

@section('title')
    Edit mirror
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
                    <form role="form" method="post" action="{{ url('dashboard/mirrors/edit/' . $mirror->id) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') === $user->id ||
                                        $mirror->user_id === $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="episode_id" class="form-control">
                                @foreach ($episodes as $episode)
                                    <option value="{{ $episode->id }}" {{ old('episode_id') === $episode->id ||
                                        $mirror->episode_id === $episode->id ? 'selected' : '' }}>{{
                                        $episode->animeTitle . ' ' . $episode->number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="mirror_source_id" class="form-control">
                                @foreach ($mirrorSources as $mirrorSource)
                                    <option value="{{ $mirrorSource->id }}" {{
                                        old('mirror_source_id') === $mirrorSource->id ||
                                        $mirror->mirror_source_id === $mirrorSource->id ? 'selected' : ''
                                        }}>{{ $mirrorSource->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="language_id" class="form-control">
                                <option value="1" selected>English</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" class="form-control" name="url" value="{{
                                old('url') ? old('url') : $mirror->url }}" placeholder="URL">
                        </div>
                        <div class="form-group">
                            <select name="translation" class="form-control">
                                <option value="subbed" {{ old('translation') === 'subbed' ||
                                    $mirror->translation === 'subbed' ? 'selected' : '' }}>Subbed</option>
                                <option value="dubbed" {{ old('translation') === 'dubbed' ||
                                    $mirror->translation === 'dubbed' ? 'selected' : '' }}>Dubbed</option>
                                <option value="raw" {{ old('translation') === 'raw' ||
                                    $mirror->translation === 'raw' ? 'selected' : '' }}>Raw</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="quality" class="form-control">
                                <option value="SD" {{ old('quality') === 'SD' || $mirror->quality === 'SD' ?
                                    'selected' : '' }}>SD</option>
                                <option value="HD" {{ old('quality') === 'HD' || $mirror->quality === 'HD' ?
                                    'selected' : '' }}>HD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mobile Friendly:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="mobile_friendly" value="1" {{
                                    old('mobile_friendly') === '1' || $mirror->mobile_friendly === 1 ?
                                    'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="checkbox-inline">
                                <input type="checkbox" class="checkbox" name="active" value="1" {{
                                    old('active') === '1' || $mirror->active === 1 ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('dashboard/mirrors') }}" class="btn btn-default">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
