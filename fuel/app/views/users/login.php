<?php echo Form::open(array('class'=>'form-signin','role'=>'form')) ?>


<p>Please sign in</p>
        <input type="text" class="form-control" name="username" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>



<?php echo Form::close() ?>