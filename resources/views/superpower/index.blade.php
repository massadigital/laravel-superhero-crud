@extends('layouts.main')


@section('content')

@header()
    Super Powers - Index
    @slot('extra')
    	<a href="{{ route('superpower.create') }}" class="btn btn-info btn-sm">Create</a>
    @endslot
@endheader
<div class="container">
	{!!$grid->render()!!}
</div>
@endsection
