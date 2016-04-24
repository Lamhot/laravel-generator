@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit mahasiswa</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($mahasiswa, ['route' => ['mahasiswas.update', $mahasiswa->id], 'method' => 'patch']) !!}

            @include('mahasiswas.fields')

            {!! Form::close() !!}
        </div>
@endsection