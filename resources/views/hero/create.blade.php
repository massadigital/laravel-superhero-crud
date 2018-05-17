@extends('layouts.main')

@section('content')
@header(['type' => 'danger'])
    Super Heroes - Create
            @slot('extra')
	<a href="{{ route('hero.index') }}" class="btn btn-info btn-sm">Index</a>
    @endslot
    
@endheader

<div class="container">

        @include('layouts.partials._status')

        @include('layouts.partials._errors')


{!! Form::open(['route' => ['hero.store']]) !!}

        @include('hero._form')


{!! Form::close() !!}
</div>
@endsection
