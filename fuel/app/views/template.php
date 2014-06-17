<?php
//Setting template variables for language system because
//template doesn not get variables from Controller_Public which holds
//language settings ( default language  & language file load )
$current_lang = Session::get('lang');
Config::set('language', $current_lang);
Lang::load('main');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <title><?php echo $title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <?php
//Loading all assets from public/assets
            echo Asset::css('magnific-popup.css');
            echo Asset::css('bootstrap.min.css');
            echo Asset::css('stylesheet.css');
            echo Asset::js('jquery.min.js');
            echo Asset::js('bootstrap.min.js');
            echo Asset::js('jquery.magnific-popup.min.js');
            echo Asset::js('tinymce/tinymce.min.js');
            echo Asset::js('https://maps.googleapis.com/maps/api/js?sensor=false');
            echo Asset::js('script.js');

            ?>
    </head>
    <body>
        <!--Header part of the page. -->
        <div class="page-header">
            <?php
            echo Html::anchor('public/lang/en', Html::img('assets/img/flags/enflag.png'), array('class' => 'flag'));
            echo Html::anchor('public/lang/lv', Html::img('assets/img/flags/lvflag.png'), array('class' => 'flag'));
            ?>
            <div id="logo-container">
                <?php echo Html::img('assets/img/logo.png', array('id' => 'logo')); ?>
                </br> <div id="intro-text"><?php echo __('INTRO'); ?></div>

            </div>
        </div>
        <!--Horizontal navigation bar. Using bootstrap defined styles. Links/Buttons displaying as 
        html anchors, which hold variables for language translation.
        
        Drop down menus are implemented with bootstrap js.
        Drop down menu is activated by A tag element, with data-toogle:dropdown parameter
        selected.
        -->
        <nav class="navbar" role="navigation">
            <ul class="nav navbar-nav" id="navigation">
                <li>
                    <?php
                    echo Html::anchor('welcome', __('NAV_WELCOME'), array(
                        'id' => 'welcome-btn',
                    ));
                    ?> 
                </li>
                <li class="dropdown">
                    <?php
                    echo Html::anchor('psychology', __('NAV_PSYCHOLOGY') . ' <b class="caret"></b>', array(
                        'class' => 'hor-nav-btn dropdown-toggle',
                        'data-toggle' => 'dropdown'
                    ));
                    ?>
                    <ul class="dropdown-menu">
                        <li><?php
                            echo Html::anchor('psychology/consultations', __('NAV_PSYCH_CONSULTING'), array(
                                'class' => 'hor-nav-btn',
                            ));
                            ?> </li>
                        <li><?php
                            echo Html::anchor('psychology/diagnostics', __('NAV_PSYCH_DIAGNOSTICS'), array(
                                'class' => 'hor-nav-btn',
                            ));
                            ?></li>
                        <li><?php
                            echo Html::anchor('psychology/lectures', __('NAV_PSYCH_LECTURES'), array(
                                'class' => 'hor-nav-btn',
                            ));
                            ?></li>
                    </ul></li>
                <li> <?php
                    echo Html::anchor('sand', __('NAV_SAND'), array(
                        'class' => 'hor-nav-btn',
                    ));
                    ?></li> 
                <li class="dropdown"> <?php
                    echo Html::anchor('/', __('NAV_MONTESORI') . ' <b class="caret"></b>', array(
                        'class' => 'hor-nav-btn dropdown-toggle',
                        'data-toggle' => 'dropdown'
                    ));
                    ?>
                    <ul class="dropdown-menu">
                        <li><?php
                            echo Html::anchor('montessori/about', __('NAV_MON_ABOUT_MONTESORI'), array(
                                'class' => 'hor-nav-btn',
                            ));
                            ?></li>
                        <li><?php
                            echo Html::anchor('montessori/lessons', __('NAV_MON_ACTIVITIES'), array(
                                'class' => 'hor-nav-btn',
                            ));
                            ?></li>
                        <li><?php
                            echo Html::anchor('montessori/therapy', __('NAV_MON_THERAPY'), array(
                                'class' => 'hor-nav-btn',
                            ));
                            ?></li>
                    </ul>
                </li>
                <li> <?php
                    echo Html::anchor('orff', __('NAV_ORFF'), array(
                        'class' => 'hor-nav-btn',
                    ));
                    ?></li> 
                <li> <?php
                    echo Html::anchor('physiotherapy', __('NAV_PHYSIOTHERAPY'), array(
                        'class' => 'hor-nav-btn',
                    ));
                    ?></li> 
                <li> <?php
                    echo Html::anchor('massage', __('NAV_MASSAGE'), array(
                        'class' => 'hor-nav-btn',
                    ));
                    ?></li> 
                </li>
            </ul>
        </nav>
        <div class="sidebar">
            <ul class="nav navbar-stacked">
                <li class="dropdown"> <?php
                    echo Html::anchor('employee', __('NAV_EMPLOYEE')
                            //, array('data-toggle' => 'dropdown')
                    );
                    ?> 

                </li>
                <li> <?php echo Html::anchor('contact', __('NAV_CONTACT')); ?> </li>
                <li> <?php echo Html::anchor('faq', __('NAV_FAQ')); ?> </li>
                <li> <?php echo Html::anchor('imagegallery', __('NAV_GALLERY')); ?> </li>
                <li> <?php echo Html::anchor('material', __('NAV_METHODICAL_MATERIALS')); ?> </li>
                <?php if (Auth::has_access('users.manage')): ?>
                    <li id="userpanel"> <?php echo Html::anchor('#', __('NAV_ADMIN_PANEL')); ?> </li>
                    <li class="user-hidden"> <?php echo Html::anchor('users/list', 'Labot lietotāju'); ?> </li>
                    <li class="user-hidden"> <?php echo Html::anchor('users/create', 'Pievienot jaunu lietotāju'); ?> </li>
                <?php endif ?>
            </ul>
        </div>
        <div class="view-holder well">
            <?php if (Session::get_flash('success')): ?>
                <div class="alert alert-success">
                    <strong>Success</strong>
                    <p>
                        <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                    </p>
                </div>
            <?php endif; ?>
            <?php if (Session::get_flash('error')): ?>
                <div class="alert alert-error">
                    <strong>Error</strong>
                    <p>
                        <?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                    </p>
                </div>
            <?php endif; ?>
            <?php echo $content; ?>
        </div>
        <footer>
            Autortiesības www.laimas.lv © 2014 | 

            <!-- Autentification panel-->

            <?php if ($current_user): ?>
                Pierakstījies kā <?php echo $current_user->username ?>
                (<?php echo Html::anchor('users/logout', 'Izrakstīties') ?>)
            <?php else: ?>
                <?php echo Html::anchor('users/login', 'Pierakstīties', array('class' => 'login-btn')) ?> 
            <?php endif ?>
            <!-- End of auth panel --> 

        </footer>

    </body>
</html>

