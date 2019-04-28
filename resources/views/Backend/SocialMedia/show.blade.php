@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                        <h2> Show Social Media</h2>
                </div>
                <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('socialMedia.index') }}"> Back</a>
                </div>
        </div>
</div>
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                        <strong>Title:</strong>
                        {{ $item->title }}
                </div>
                <div class="form-group">
                        <strong>Link:</strong>
                        {{ $item->link }}
                </div>
                <div class="form-group">
                        <strong>Icon:</strong>
                        {{ $item->icon }}
                </div>
        </div>
</div>
@endsection
