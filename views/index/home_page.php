<form name="form" method="post" action="<?php echo URL::abs('membership/login/standard'); ?>">
    <input type="text" value="" name="username" /> <br />
    <input type="password" value="" name="password" /> <br />
    <input type="submit" value="login" name="login" />
</form>

<br />

<form name="form" method="post" action="<?php echo URL::abs('membership/logout'); ?>">
    <input type="submit" value="logout" name="logout" />
</form>
 
<br />

<label>
    <?php if(Membership::instance()->user->user_level > 0) {
        echo Membership::instance()->user->full_name;
    } ?>
</label>

