@extends('layouts.main')


@section('content')

@header()
    Alter Egos - Index
    @slot('extra')
    	{{-- <a href="{{ route('alterego.create') }}" class="btn btn-info btn-sm">Create</a> --}}
    @endslot
@endheader
<div class="container">
	{!!$grid->render()!!}
</div>
@endsection
