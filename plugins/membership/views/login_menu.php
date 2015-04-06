<div style="overflow: hidden;">
<?php if (!Membership::instance()->user->user_id): /* @var $user User */ /* @var $membership Membership */ ?>   

    <div style="padding-top: 50px; float: right;">
        
                             
    <script type="text/javascript">
        //<![CDATA[
        document.write('<a href="<?php echo URL::abs('membership/login/facebook?redirect_url=' . urlencode(Membership::instance()->getCurrentUrl())); ?>" id="loginButton" style="cursor: pointer; padding: 5px 8px 2px 8px;" > Најава со Facebook </a>');
        //]]>
    </script>
    | <a href="#"  onclick="return show_anonymous_login();" ><input  type="button" class="button round" value="Анонимно" /></a>
    </div>
<?php else: ?>  
    <div style="padding-top: 50px; float: right;">
        
        <span style="margin:0;font-size: 18px; float: left;margin-top: 5px;"><?php echo Membership::instance()->user->username; ?></span>
        
        
        <?php if(Membership::instance()->user->user_level >= 4): ?>
        <a href="<?php echo URL::abs('admin'); ?>">
        <?php endif; ?>
        <img style="width: 22px; height: 22px; float: left; margin: 3px 5px 0px 5px;" alt="<?php echo Membership::instance()->user->username; ?>" src="<?php echo Membership::instance()->user->image_url; ?>" />
        <?php if(Membership::instance()->user->user_level >= 4): ?>
        </a>
        <?php endif; ?>
        
        
        <a style="float: left;" href="<?php echo URL::abs('membership/logout'); ?>"><input  type="button" class="button round" value="Одјави Се" /></a>
    </div>


    
                                  
<?php endif; ?>
    </div>
<?php if(!Membership::instance()->user->user_id): ?>    
    <div id="anonymous-login-panel" class="great-white">

            <div class="anonymous-login-panel" >

                <h2>Анонимна Најава</h2>

                <form style="margin-top: 10px;" action="<?php echo URL::abs('membership/login-anonymous'); ?>" method="post" onsubmit="return validate_anonymous_login();" >
                    <div style="overflow: hidden;">
                    <label>Вашето Име:<span>Измислете си некое</span></label> <input id="user-name" name="user-name" type="text" />
                   
                    
                    <label>Аватар:<span>Изберете сликичка</span></label>
                    <div style="float: left;margin-bottom: 10px;">
                    <select name="select-image" id="select-image" >
                        <option value="angelina-jolie"  title="<?php echo URL::image('../plugins/membership/images/angelina_jolie.jpg'); ?>" selected="selected">Angelina Jolie</option>
                        <option value="madonna" title="<?php echo URL::image('../plugins/membership/images/madonna.jpg'); ?>">Madonna</option>
                        <option value="kate-middleton" title="<?php echo URL::image('../plugins/membership/images/kate-middleton.jpg'); ?>">Kate Middleton</option>
                        <option value="lady-gaga" title="<?php echo URL::image('../plugins/membership/images/lady-gaga.jpg'); ?>">Lady Gaga</option>
                        <option value="adriana-lima" title="<?php echo URL::image('../plugins/membership/images/adriana-lima.jpg'); ?>">Adriana Lima</option>

                    </select>
                    </div>
                    
                    
                    <label>еМаил:<span>Не се прикажува јавно</span></label> <input id="email" name="email" type="text"  />
                    
                    <input type="submit" value="Најави Се" class="button round" />
                    <input id="cancel-login" type="button" value="Откажи" class="button round red" />
                    </div>
                </form>

            </div>

        </div>
<?php endif; ?>

