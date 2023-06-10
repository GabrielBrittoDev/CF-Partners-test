<!DOCTYPE html>
<!--
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.5.1
Author: Sunnyat A.
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0?ref=myorange
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        Register
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/template') ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/template') ?>/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="<?= base_url('assets/template') ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/css/fa-brands.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
</head>
<!-- BEGIN Body -->
<body>
<script>
    /**
     *	This script should be placed right after the body tag for fast execution
     *	Note: the script is written in pure javascript and does not depend on thirdparty library
     **/
    'use strict';

    var classHolder = document.getElementsByTagName("BODY")[0],
        /**
         * Load from localstorage
         **/
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';
    /**
     * Load theme options
     **/
    if (themeSettings.themeOptions)
    {
        classHolder.className = themeSettings.themeOptions;
        console.log("%c✔ Theme settings loaded", "color: #148f32");
    }
    else
    {
        console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
    }
    if (themeSettings.themeURL && !document.getElementById('mytheme'))
    {
        var cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);

    }
    else if (themeSettings.themeURL && document.getElementById('mytheme'))
    {
        document.getElementById('mytheme').href = themeSettings.themeURL;
    }
    /**
     * Save to localstorage
     **/
    var saveSettings = function()
    {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
        {
            return /^(nav|header|footer|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme'))
        {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        };
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
    }
    /**
     * Reset settings
     **/
    var resetSettings = function()
    {
        localStorage.setItem("themeSettings", "");
    }

</script>
<div class="page-wrapper auth">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="<?= base_url('assets/template')?>/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">CF Partners Test</span>
                        </a>
                    </div>
                    <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                                Already have an account?
                            </span>
                    <a href="/" class="btn-link text-white ml-auto ml-sm-0">
                        Login
                    </a>
                </div>
            </div>
            <div class="flex-1">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    <div class="row">
                        <div class="col-xl-12">
                            <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                Register now!
                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                    Your registration will give you access to manage all the users
                                </small>
                            </h2>
                        </div>
                        <div class="col-xl-6 ml-auto mr-auto">
                            <div class="card p-4 rounded-plus bg-faded">
                                <form id="user-form" method="POST" action="/register">
                                    <?php $user = session()->getFlashdata('data')['user'] ?? []?>
                                    <div class="form-group row">
                                        <label class="col-xl-12 form-label" for="first-name">Your first and last name</label>
                                        <div class="col-6 pr-1">
                                            <input type="text" id="first-name" value="<?= $user['first_name'] ?? null ?>" name="first_name" class="form-control" placeholder="First Name" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <input type="text" id="last-name" value="<?= $user['last_name'] ?? null ?>" name="last_name" class="form-control" placeholder="Last Name" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email" value="<?= $user['email'] ?? null ?>" class="form-control" placeholder="Email for verification" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" id="username" name="username" value="<?= $user['username'] ?? null ?>"class="form-control" placeholder="Email for verification" required>
                                        <div class="invalid-feedback"></div>
                                        <div class="help-block">Your username must be unique.</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" value="<?= $user['mobile'] ?? null ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Mobile number" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Pick a password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="minimum 8 characters" required>
                                        <div class="invalid-feedback"></div>
                                        <div class="help-block">Your password must be 8-20 characters long.</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="confirm_password">Repeat the password</label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="minimum 8 characters" required>
                                        <div class="invalid-feedback"></div>
                                        <div class="help-block">Both password must be equals.</div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 ml-auto text-right">
                                            <button id="js-login-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-3">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                    2020 © SmartAdmin by&nbsp;<a href='https://www.gotbootstrap.com' class='text-white opacity-40 fw-500' title='gotbootstrap.com' target='_blank'>gotbootstrap.com</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const errors = JSON.parse('<?= json_encode(session()->getFlashdata('data')['errors'] ?? '{}'); ?>');

        if (Object.keys(errors).length > 0) {
            for (const key in errors) {
                const input = $(`[name='${key}']`);
                const inputGroup = input.parent();

                input.addClass('is-invalid');
                inputGroup.find('.invalid-feedback').html(errors[key]);

            }

            const allFormInputs = $('#user-form').find('.form-control');
            console.log(allFormInputs);
        }
    });

</script>
</body>
<!-- END Body -->
</html>