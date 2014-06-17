<h2><?php __('GALLERY_EDIT_DESCRIPTION')?></h2>
<br>


<?php
echo Form::open(array(
    "class" => "form-horizontal",
    "enctype" => "multipart/form-data"));
?>

<fieldset>
    <div class="form-group">
        <?php echo Form::label(__('GALLERY_FILE_NAME'), 'file', array('class' => 'control-label')); ?>

        <?php
        echo Form::input('file', Input::post('file', isset($imagegallery) ? $imagegallery->file : ''), array(
            'class' => 'col-md-4 form-control',
            'placeholder' => 'file',
            'disabled' => 'true'
          ));
        ?>

    </div>
    <div class="form-group">
        <?php echo Form::label(__('GALLERY_FILE_DESCRIPTION'), 'description', array('class' => 'control-label')); ?>

        <?php
        echo Form::textarea('description', Input::post('description', isset($imagegallery) ? $imagegallery->description : ''), array(
            'class' => 'col-md-8 form-control',
            'rows' => 8,
            'placeholder' => 'Description'));
        ?>
    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
<?php echo Form::submit('submit', __('NAV_SAVE'), array('class' => 'btn btn-primary')); ?>		</div>
</fieldset>
<?php echo Form::close(); ?>





<p>|
<?php echo Html::anchor('imagegallery', __('NAV_BACK')); ?></p>
