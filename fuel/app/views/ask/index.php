<h2><?php echo __('ASK_HEADING') ?></h2>

<?php if(! empty($val->error('name'))):?>
<p class="alert alert-danger"> <?php echo $val->error('name'); ?></p>
<?php elseif(! empty($val->error('email'))):?>
<p class="alert alert-danger"> <?php echo $val->error('email'); ?></p>
<?php elseif(! empty($val->error('message'))):?>
<p class="alert alert-danger"> <?php echo $val->error('message'); ?></p>
<?php endif;?>
<div class="col-sm-8 contact-form">
    <?php echo Form::open(array('class' => 'form', 'role' => 'form', 'id' => 'contact')) ?>
    <fieldset>
        <div class="row">
            <div class="col-xs-6 col-md-6 form-group">
                <?php echo Form::input('name', $val->input('name'), array('placeholder' => __('PH_FORM_NAME'), 'class' => 'form-control', 'id' => 'name', 'required autofocus')); ?>
            </div>
            <div class="col-xs-6 col-md-6 form-group">
                <?php echo Form::input('email', $val->input('email'), array('placeholder' => __('PH_FORM_EMAIL'), 'class' => 'form-control', 'id' => 'email','required')) ?>
            </div>
        </div>
        <?php echo Form::textarea('message', $val->input('message'), array('rows' => '5', 'class' => 'form-control', 'id' => 'message','required')) ?>
        <br />
        <div class="row">
            <div class="col-xs-12 col-md-12 form-group">
                <?php echo Form::submit('', __('ASK_SEND'), array('class' => 'btn btn-primary pull-righ')) ?>
                </fieldset>
                <?php echo Form::close(); ?>

            </div>
        </div>
</div>
</div>
