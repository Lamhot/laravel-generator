@extends('layouts.app')

@section('content')
    @include('mahasiswas.show_fields')

    <div class="form-group">
           <a href="{!! route('mahasiswas.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
