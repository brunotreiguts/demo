<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset class="editor">
		<div class="form-group">
			<?php echo Form::label( __('FAQ_QUESTION'), 'Question', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('question', Input::post('question', isset($faq) ? $faq->question : ''), array(
                                    'class' => 'col-md-8 form-control', 
                                    'rows' => 8)); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label( __('FAQ_ANSWER'), 'Answer', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('answer', Input::post('answer', isset($faq) ? $faq->answer : ''), array(
                                    'class' => 'col-md-8 form-control', 
                                    'rows' => 8,)); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', __('NAV_SAVE'), array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>