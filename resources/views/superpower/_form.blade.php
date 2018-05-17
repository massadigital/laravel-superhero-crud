 {!! Form::hidden('model_id', $model->super_power_id) !!}
 
<div class="row">
	<div class="col-xs-8">
		<div class="form-group">{!! Form::label('hero_name', 'Name') !!} 
		{!!	Form::text('super_power_name', $model->super_power_name, ['class' =>'form-control']) !!}</div>
		
			<div class="form-group">		
			{!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
			</div>
		
	</div>
</div>

