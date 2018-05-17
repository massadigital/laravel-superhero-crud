@extends('layouts.main')


@section('content')

@header()
    Persons - Index
    @slot('extra')
    	<a href="{{ route('person.create') }}" class="btn btn-info btn-sm">Create</a>
    @endslot
@endheader
<div class="container">
	{!!$grid->render()!!}
</div>
@endsection
