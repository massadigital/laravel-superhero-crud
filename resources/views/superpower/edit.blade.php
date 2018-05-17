@extends('layouts.main')

@section('content')

@header()
    Super Powers - Edit
        @slot('extra')
	<a href="{{ route('superpower.index') }}" class="btn btn-info btn-sm">Index</a>
	    	<a href="{{ route('superpower.create') }}" class="btn btn-info btn-sm">Create</a>
	
    @endslot
    
@endheader

<div class="container">
        @include('layouts.partials._status')
        @include('layouts.partials._errors')


{!! Form::open(['route' => ['superpower.update',$model->super_power_id]]) !!}

        @include('superpower._form')


{!! Form::close() !!}
</div>
@endsection
