<h2><?php __('GALLERY_NEW_IMAGE')?></h2>
<br>

<?php
echo Form::open(array(
    "class" => "form-horizontal",
    "enctype" => "multipart/form-data"));
?>

<fieldset>
    <div class="form-group">
        <?php echo Form::label(__('GALLERY_FILE_NAME'), 'file', array('class' => 'control-label')); ?>
        <?php echo Form::file('filename') ?>
    </div>
    <div class="form-group">
        <?php echo Form::label(__('GALLERY_FILE_DESCRIPTION'), 'description', array('class' => 'control-label')); ?>

        <?php echo Form::textarea('description', Input::post('description', isset($imagegallery) ? $imagegallery->description : ''), array(
            'class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder' => __('PH_FORM_DESCRIPTION'))); ?>
    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::submit('submit', __('NAV_SAVE'), array('class' => 'btn btn-primary',
            'data-loading-text' => 'Loading... ',
            'title'=>__('GALLERY_SAVE_IMAGE')));
        ?>		</div>
</fieldset>
<?php echo Form::close(); ?>

<p><?php echo Html::anchor('imagegallery', __('NAV_BACK')); ?></p>
