@extends('layouts.main')

@section('content')
@header(['type' => 'danger'])
    Persons - Create
            @slot('extra')
	<a href="{{ route('person.index') }}" class="btn btn-info btn-sm">Index</a>
    @endslot
    
@endheader

<div class="container">

        @include('layouts.partials._status')

        @include('layouts.partials._errors')


{!! Form::open(['route' => ['person.store']]) !!}

        @include('person._form')


{!! Form::close() !!}
</div>
@endsection
