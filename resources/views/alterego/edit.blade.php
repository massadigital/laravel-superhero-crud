@extends('layouts.main')

@section('content')

@header()
    Alter Egos - Edit
        @slot('extra')
	<a href="{{ route('alterego.index') }}" class="btn btn-info btn-sm">Index</a>
	    	{{-- <a href="{{ route('alterego.create') }}" class="btn btn-info btn-sm">Create</a> --}}
	
    @endslot
    
@endheader

<div class="container">
        @include('layouts.partials._status')
        @include('layouts.partials._errors')


{!! Form::open(['route' => ['alterego.update',$model->alter_ego_id]]) !!}

        @include('alterego._form')


{!! Form::close() !!}
</div>
@endsection
