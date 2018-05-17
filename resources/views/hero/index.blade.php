@extends('layouts.main')


@section('content')

@header()
    Super Heroes - Index
    @slot('extra')
    	<a href="{{ route('hero.create') }}" class="btn btn-info btn-sm">Create</a>
    @endslot
@endheader
<div class="container">
	{!! $grid->render() !!}
</div>
@endsection
@section('js')
<script>
$(function() {
	$(document).on('click','.btn-crud-remove',function(e){
		e.preventDefault();
		var $this = $(this);
		window.setTimeout(function(){
			if(confirm('confirma?')){
				$.ajax({
					url : $this.attr('href'),
					method:'post',
				}).done(function() {
					location.reload();
				  })
				  .fail(function() {
				    alert( "error" );
				  });
			}
		});
		return false;
	});
});
</script>
@endsection