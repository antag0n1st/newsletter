<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
      xmlns:og="http://opengraphprotocol.org/schema/"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      >
    <head>
        <?php Head::instance()->display(); ?>
    </head>
    <body>   

        <div class="background1"> 
            <div class="wrapper">
                <?php if (Membership::instance()->user->user_level > 0) { ?>                

                    <p class="loggedin-name"> Hi, <?php echo Membership::instance()->user->full_name; ?> </p>

                    <form id="sign-out-form" name="form" method="post" action="<?php echo URL::abs('membership/logout'); ?>">
                        <a href="#" class="signout" onclick="document.getElementById('sign-out-form').submit();" > Sign out </a>
                    </form>

                <?php } else { ?>

                    <p class="login-title"> Sign in </p>        

                <?php } ?>

                <div class="center"> 

                    <?php if (Membership::instance()->user->user_level < 4): ?>

                        <div class="container1">
                            <div class="right-container">

                                <form id="login-form" name="form" method="post" action="<?php echo URL::abs('membership/login/standard'); ?>">
                                    <div class="login-wrapper">
                                        <div class="text-left"><label>username</label></div>
                                        <input id="username" name="username" class="login" type="text" autocomplete="on"/>
                                    </div>
                                    <div class="login-wrapper">
                                        <div class="text-right"><label>password</label></div>
                                        <input id="password" name="password" class="login" type="password"/>
                                    </div>
                                    <div class="login_button" > 
                                        <a href="#" onclick="document.getElementById('login-form').submit();"> 
                                            <img id="hover-img" src="images/login_button.png" width="40" height="40" 
                                                 alt="Login button" title="Sign in" />
                                        </a>
                                    </div>
                                    <input type="submit" value="submit" style="visibility: hidden;" />
                                </form>
                            </div>
                        </div>
                    
                    <?php else: ?>
                    
                        <?php Load::view('elements/menu'); ?>

                    <?php endif; ?>
                    <?php Controller::load_main_view(); ?> 


                </div>

            </div>
            <?php
            if (HOST_ID != 0) {
                Load::app('debug');
            }
            ?>
        </div>


    </body>
</html>

