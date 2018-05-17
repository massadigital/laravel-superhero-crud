@extends('layouts.main')

@section('content')

@header()
    Persons - Edit
        @slot('extra')
	<a href="{{ route('person.index') }}" class="btn btn-info btn-sm">Index</a>
	    	<a href="{{ route('person.create') }}" class="btn btn-info btn-sm">Create</a>
	
    @endslot
    
@endheader

<div class="container">
        @include('layouts.partials._status')
        @include('layouts.partials._errors')


{!! Form::open(['route' => ['person.update',$model->person_id]]) !!}

        @include('person._form')


{!! Form::close() !!}
</div>
@endsection
