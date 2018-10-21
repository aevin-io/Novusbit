<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Redux Auth Example</title>
        <?php echo link_tag('assets/css/reset.css')."\n"; ?>
        <?php echo link_tag('assets/css/screen.css')."\n"; ?>
        <!--[if IE]>
            <?php echo link_tag('assets/css/ie.css')."\n"; ?>
        <![endif]-->
        <?php echo link_tag('assets/css/style.css')."\n"; ?>
        <?php echo link_tag('assets/css/typography.css')."\n"; ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="head">
                
            </div>
            <ul id="navigation">
                <li><?php echo anchor('', 'Home'); ?></li>
                <li><?php echo anchor('redux_controller/activate', 'Activate'); ?></li>
                <li><?php echo anchor('redux_controller/register', 'Register'); ?></li>
                <li><?php echo anchor('redux_controller/login', 'Login'); ?></li>
                <li><?php echo anchor('redux_controller/logout', 'Logout'); ?></li>
                <li><?php echo anchor('redux_controller/status', 'Account Status'); ?></li>
                <li><?php echo anchor('redux_controller/change_password', 'Change Password'); ?></li>
                <li><?php echo anchor('redux_controller/forgotten_password', 'Forgotten Password'); ?></li>
                <li><?php echo anchor('redux_controller/profile', 'Profile'); ?></li>
            </ul>
            <div id="content">
                <?php echo $content."\n" ?>
            </div>
            <div id="foot">
                
            </div>
        </div>
    </body>
</html>