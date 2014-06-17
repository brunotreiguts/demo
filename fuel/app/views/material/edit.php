<h2>Editing <span class='muted'>Material</span></h2>
<br>

<?php
echo Form::open(array(
    "class" => "form-horizontal",
    "enctype" => "multipart/form-data"));
?>

<fieldset>
     <div class="form-group">
        <?php
        echo Form::label(__('EMPLOYEE_KEEP_AVATAR'), 'upload');
        echo Form::radio('upload', '1', true, array(
            'class' => 'keep-avatar-btn',
            'id'=>'radio1'));
        ?> <br/>  <?php
        echo Form::label(__('EMPLOYEE_UPLOAD_NEW_AVATAR'), 'upload');
        echo Form::radio('upload', '2', array(
            'class' => 'upload-avatar-btn',
            'id'=>'radio2'
            ));
        ?>
    </div>
    <div class="form-group " id="upload-avatar">
        <?php
        echo Form::label(__('EMPLOYEE_AVATAR'), 'avatar', array(
            'class' => 'control-label'));
        ?><br/>
        <?php echo Form::file('avatar') ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('Title', 'title', array('class' => 'control-label')); ?>

        <?php echo Form::input('title', Input::post('title', isset($material) ? $material->title : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Title')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Description', 'description', array('class' => 'control-label')); ?>

        <?php echo Form::textarea('description', Input::post('description', isset($material) ? $material->description : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder' => 'Description')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Price', 'price', array('class' => 'control-label')); ?>

        <?php echo Form::input('price', Input::post('price', isset($material) ? $material->price : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Price')); ?>

    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
</fieldset>
<?php echo Form::close(); ?>
<p>
	<?php echo Html::anchor('material/view/'.$material->id, 'View'); ?> |
	<?php echo Html::anchor('material', 'Back'); ?></p>
