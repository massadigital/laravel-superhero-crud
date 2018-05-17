@extends('layouts.main')

@section('content')
@header(['type' => 'danger'])
    Alter Egos - Create
            @slot('extra')
	<a href="{{ route('alterego.index') }}" class="btn btn-info btn-sm">Index</a>
    @endslot
    
@endheader

<div class="container">

        @include('layouts.partials._status')

        @include('layouts.partials._errors')


{!! Form::open(['route' => ['alterego.store']]) !!}

        @include('alterego._form')


{!! Form::close() !!}
</div>
@endsection
