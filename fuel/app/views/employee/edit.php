<h2><?php __('EMPLOYEE_EDIT') ?></span></h2>
<br>

<?php
echo Form::open(array(
    "class" => "form-horizontal ",
    "enctype" => "multipart/form-data",));
?>

<fieldset class='editor'>
    <div class="form-group">
        <?php echo Form::label(__('EMPLOYEE_NAME'), 'name', array('class' => 'control-label')); ?>

        <?php echo Form::input('name', Input::post('name', isset($employee) ? $employee->name : ''), array(
            'class' => 'col-md-4 form-control', 
            'placeholder' => __('PH_FORM_NAME'))); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label(__('EMPLOYEE_SURNAME'), 'surname', array('class' => 'control-label')); ?>

        <?php echo Form::input('surname', Input::post('surname', isset($employee) ? $employee->surname : ''), array(
            'class' => 'col-md-4 form-control', 
            'placeholder' => __('PH_FORM_SURNAME'))); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label(__('EMPLOYEE_EMAIL'), 'email', array('class' => 'control-label')); ?>

        <?php echo Form::input('email', Input::post('email', isset($employee) ? $employee->email : ''), array(
            'class' => 'col-md-4 form-control', 
            'placeholder' => __('PH_FORM_EMAIL'))); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label(__('EMPLOYEE_PHONE_NUMBER'), 'phonenumber', array('class' => 'control-label')); ?>

        <?php echo Form::input('phonenumber', Input::post('phonenumber', isset($employee) ? $employee->phonenumber : ''), array(
            'class' => 'col-md-4 form-control', 
            'placeholder' => __('PH_FORM_PHONENUMBER'))); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label(__('EMPLOYEE_DESCRIPTION'), 'description', array('class' => 'control-label')); ?>

        <?php echo Form::textarea('description', Input::post('description', isset($employee) ? $employee->description : ''), array(
            'class' => 'col-md-8 form-control editor', 
            'rows' => 8, 
            'placeholder' => __('PH_FORM_DESCRIPTION'))); ?>
    </div>
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
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::submit('submit', __('NAV_SAVE'), array('class' => 'btn btn-primary'),array(
            'class'=>'btn-w-load')); ?>		</div>
</fieldset>
<?php echo Form::close(); ?>
<p>

    <?php echo Html::anchor('employee', __('NAV_BACK')); ?></p>
