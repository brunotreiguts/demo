<div class="well">

<?php
echo Form::open();
echo Form::fieldset_open(null, "Ievadiet lietotāja datus");
?>
    <label for="newpassword">Vecā parole</label>
<?php echo Form::input('oldpassword', Input::post('oldpassword', isset($user) ? $user->oldpassword : ''),array('type'=>'password')); ?><br/>
    <label for="newpassword">Jaunā parole</label>
<?php echo Form::input('newpassword', Input::post('newpassword', isset($user) ? $user->newpassword : ''),array('type'=>'password')); ?><br/> <br/>


<input type="Submit" value="Nomainīt." class="btn btn-primary" />
<?php
echo Form::fieldset_close();
echo Form::close(); ?>
</div>