<div class="well">
<?php
echo Form::open();
echo Form::fieldset_open(null, "Ievadiet lietotāja datus");
?>

<label for="username">Lietotājvārds</label>
<input type="text" name="username" id="usermail" /> <br/>

<label for="email">E-pasta adrese</label>
<input type="text" name="email" id="usermail" /> <br/>

<label for="password">Parole</label>
<input type="password" name="password" id="password" /> <br/>

<label for="repeat_password">Parole vēlreiz</label>
<input type="password" name="repeat_password" id="repeat_password" /> <br/>

<label for="group">Tiesību grupa</label>
<input type="text" name="group" id="usermail" /> <br/>

<input type="Submit" value="Pievienot" class="btn btn-primary" />
<?php
echo Form::fieldset_close();
echo Form::close(); ?>
</div>