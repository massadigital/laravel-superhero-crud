 {!! Form::hidden('model_id', $model->hero_id) !!}
 {!! Form::hidden('request_id',  uniqid("Hero_")) !!}
 
<div class="row">
	<div class="col-xs-8">
		<div class="form-group">{!! Form::label('hero_name', 'Name') !!} 
		{!!	Form::text('hero_name', $model->hero_name, ['class' =>'form-control']) !!}</div>
		<div class="form-group">
		{!! Form::label('hero_powers[]', 'Super Powers') !!} <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#super-power-form">
  <span class="glyphicon glyphicon-plus"></span>
</button>

		{!!	Form::select('hero_powers[]', \App\SuperPower::all()->mapWithKeys(function($item){ return [$item->super_power_id=>$item->super_power_name];}),$model->SuperPowers()->allRelatedIds(), ['class' =>'selectpicker form-control','multiple'=>true, 'data-live-search'=>'true']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('hero_persons[]', 'Know Alter Egos') !!} <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#person-form">
  <span class="glyphicon glyphicon-plus"></span>
</button>

		{!!	Form::select('hero_persons[]', \App\Person::all()->mapWithKeys(function($item){ return [$item->person_id=>$item->person_name];}),$model->Persons()->allRelatedIds(), ['class' =>'selectpicker form-control','multiple'=>true, 'data-live-search'=>'true']) !!}
		</div>

		<div class="form-group">{!! Form::label('hero_catch_phrase', 'Catch	Phrase') !!}
			{!! Form::text('hero_catch_phrase',	$model->hero_catch_phrase, ['class' => 'form-control']) !!}</div>

		<div class="form-group">{!! Form::label('hero_origin_description',
			'Origin description') !!} {!!
			Form::textarea('hero_origin_description',
			$model->hero_origin_description, ['class' => 'form-control','rows'=>3]) !!}</div>
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
	$(document).on('click','.add-super-power',function(){
		$('<option selected>'+$('#super_power').val()+'</option>').appendTo($('[name="hero_powers[]"]'));
		$('[name="hero_powers[]"]').selectpicker('refresh');
		$('#super_power').val('');
		
	});
	$(document).on('click','.add-person',function(){
		$('<option selected>'+$('#person').val()+'</option>').appendTo($('[name="hero_persons[]"]'));
		$('[name="hero_persons[]"]').selectpicker('refresh');
		$('#person').val('');
		
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
@section("footer")

<div class="modal fade" tabindex="-1" role="dialog" id="super-power-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Super Power</h4>
      </div>
      <div class="modal-body">
        		<div class="form-group">
        			<input type="text" name="super_power" class="form-control" id="super_power" maxlength="256">
        		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-super-power" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="person-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Alter Ego</h4>
      </div>
      <div class="modal-body">
        		<div class="form-group">
        			<input type="text" name="person" class="form-control" id="person" maxlength="256">
        		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-person" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


