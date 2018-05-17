@extends('layouts.main')

@section('content')
@header()
    Super Powers - Create
            @slot('extra')
	<a href="{{ route('superpower.index') }}" class="btn btn-info btn-sm">Index</a>
    @endslot
    
@endheader

<div class="container">

        @include('layouts.partials._status')

        @include('layouts.partials._errors')


{!! Form::open(['route' => ['superpower.store']]) !!}

        @include('superpower._form')


{!! Form::close() !!}
</div>
@endsection
