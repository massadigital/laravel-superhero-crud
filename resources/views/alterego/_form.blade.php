 {!! Form::hidden('model_id', $model->alter_ego_id) !!}
 {!! Form::hidden('request_id',  uniqid("Person_")) !!}
 
<div class="row">
	<div class="col-xs-8">
	<div class="form-group">{!! Form::label('', 'Hero') !!} 
		<div class="form-control">{{ $model->hero->hero_name}}</div>
		</div>
		<div class="form-group">{!! Form::label('', 'Person') !!} 
		<div class="form-control">{{ $model->person->person_name}}</div>
		</div>
				<div class="form-group">{!! Form::label('alter_ego_info',
			'Info') !!} {!!
			Form::textarea('alter_ego_info',
			$model->alter_ego_info, ['class' => 'form-control','rows'=>3]) !!}</div>
		
	<div class="form-group">		
			{!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
			</div>
			
	</div>
	
</div>
