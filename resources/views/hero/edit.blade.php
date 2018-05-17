@extends('layouts.main')

@section('content')

@header(['type' => 'danger'])
    Super Heroes - Edit
        @slot('extra')
	<a href="{{ route('hero.index') }}" class="btn btn-info btn-sm">Index</a>
	    	<a href="{{ route('hero.create') }}" class="btn btn-info btn-sm">Create</a>
	
    @endslot
    
@endheader

<div class="container">
        @include('layouts.partials._status')
        @include('layouts.partials._errors')


{!! Form::open(['route' => ['hero.update',$model->hero_id]]) !!}

        @include('hero._form')


{!! Form::close() !!}
</div>
@endsection
