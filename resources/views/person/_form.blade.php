 {!! Form::hidden('model_id', $model->person_id) !!}
 {!! Form::hidden('request_id',  uniqid("Person_")) !!}
 
<div class="row">
	<div class="col-xs-8">
		<div class="form-group">{!! Form::label('person_name', 'Name') !!} 
		{!!	Form::text('person_name', $model->person_name, ['class' =>'form-control']) !!}</div>
		
			<div class="form-group">{!! Form::label('person_short_bio',
			'Info') !!} {!!
			Form::textarea('person_short_bio',
			$model->person_short_bio, ['class' => 'form-control','rows'=>3]) !!}</div>
	<div class="form-group">		
			{!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
			</div>
			
	</div>
	<div class="col-xs-4">
	<div id="drop-area" class="dropzone"></div>
		@if(count($model->images))
		<div class="row">
			@foreach ($model->images as $image)
			<div class="col-xs-6 text-center">
				<div class="thumbnail image-thumbnail">
		    		<img src="{{ asset($image->image_url) }}" />
	    		</div>
	    		<a class="btn-image-delete" href="{{ route('image.delete',['id'=>$image->image_id]) }}">Remove</a>
	    	</div>
			@endforeach
		</div>
		@endif
	</div>
</div>
@section("js")
<script>
var uploadUrl = '{{ route('image.store') }}';
$(function() {
	var imageDropZone = new Dropzone("div#drop-area", {url:uploadUrl,addRemoveLinks:true,params:{request_id: $('input[name="request_id"]').val()}});
	imageDropZone.on("sending", function(file,xhr,formData) {
		xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
	});
	$('.btn-image-delete').on('click', function(event){
		event.preventDefault();
		var $this = $(this);
		$.ajax({
			url : $this.attr('href'),
			method:'post',
		}).done(function() {
		    $this.parent().remove();
		  })
		  .fail(function() {
		    alert( "error" );
		  });
			
		return false;
	});
});
</script>
@endsection
