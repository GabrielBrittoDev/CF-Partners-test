<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?= $this->renderSection('title') ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta charset="utf-8">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print"
          href="<?= base_url('assets/template') ?>/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print"
          href="<?= base_url('assets/template') ?>/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/#">
    <link id="myskin" rel="stylesheet" media="screen, print"
          href="<?= base_url('assets/template') ?>/css/skins/skin-master.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" media="screen, print" href="<?= base_url('assets/template') ?>/css/notifications/toastr/toastr.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?= base_url('assets/template') ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?= base_url('assets/template') ?>/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="<?= base_url('assets/template') ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <!-- You can add your own stylesheet here to override any styles that comes before it
    <link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->
</head>
<body class="mod-bg-1">
<!-- DOC: script to save and load page settings -->
<script>
    /**
     *    This script should be placed right after the body tag for fast execution
     *    Note: the script is written in pure javascript and does not depend on thirdparty library
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
    if (themeSettings.themeOptions) {
        classHolder.className = themeSettings.themeOptions;
        console.log("%c✔ Theme settings loaded", "color: #148f32");
    } else {
        console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
    }
    if (themeSettings.themeURL && !document.getElementById('mytheme')) {
        var cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);

    } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
        document.getElementById('mytheme').href = themeSettings.themeURL;
    }
    /**
     * Save to localstorage
     **/
    var saveSettings = function () {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function (item) {
            return /^(nav|header|footer|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme')) {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        }
        ;
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
    }
    /**
     * Reset settings
     **/
    var resetSettings = function () {
        localStorage.setItem("themeSettings", "");
    }

</script>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
        <aside class="page-sidebar">
            <div class="page-logo">
                <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                   data-toggle="modal" data-target="#modal-shortcut">
                    <img src="<?= base_url('assets/template') ?>/img/logo.png" alt="SmartAdmin WebApp"
                         aria-roledescription="logo">
                    <span class="page-logo-text mr-1">CF Partners test</span>
                    <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                </a>
            </div>
            <!-- BEGIN PRIMARY NAVIGATION -->
            <nav id="js-primary-nav" class="primary-nav" role="navigation">
                <div class="nav-filter">
                    <div class="position-relative">
                        <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                               tabindex="0">
                        <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                           data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                            <i class="fal fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-text">
                        <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
                                        <?= ucfirst(session()->get('first_name')) . ' ' . ucfirst(session()->get('last_name')) ?>
                                    </span>
                        </a>
                    </div>
                    <img src="<?= base_url('assets/template') ?>/img/card-backgrounds/cover-2-lg.png" class="cover"
                         alt="cover">
                    <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                       data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                        <i class="fal fa-angle-down"></i>
                    </a>
                </div>
                <ul id="js-nav-menu" class="nav-menu">
                    <li class="nav-title">Management</li>
                    <li>
                        <a href="#" title="User" data-filter-tags="user">
                            <i class="fal fa-user"></i>
                            <span class="nav-link-text">User</span>
                        </a>
                        <ul>
                            <li>
                                <a href="/user" title="Menu child" data-filter-tags="user list">
                                    <i class="fal fa-list"></i>
                                    <span class="nav-link-text">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="/user/create" title="Menu child" data-filter-tags="user add new">
                                    <i class="fal fa-plus"></i>
                                    <span class="nav-link-text">Add new</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="filter-message js-filter-message bg-success-600"></div>
            </nav>
            <!-- END PRIMARY NAVIGATION -->
            <!-- NAV FOOTER -->
            <div class="nav-footer shadow-top">
                <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
                   class="hidden-md-down">
                    <i class="ni ni-chevron-right"></i>
                    <i class="ni ni-chevron-right"></i>
                </a>
            </div> <!-- END NAV FOOTER -->
        </aside>
        <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
            <header class="page-header" role="banner">
                <!-- we need this logo when user switches to nav-function-top -->
                <div class="page-logo">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                       data-toggle="modal" data-target="#modal-shortcut">
                        <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                        <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                    </a>
                </div>
                <!-- DOC: nav menu layout change shortcut -->
                <div class="hidden-md-down dropdown-icon-menu position-relative">
                    <a href="#" class="header-btn btn js-waves-off" data-action="toggle"
                       data-class="nav-function-hidden" title="Hide Navigation">
                        <i class="ni ni-menu"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify"
                               title="Minify Navigation">
                                <i class="ni ni-minify-nav"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed"
                               title="Lock Navigation">
                                <i class="ni ni-lock-nav"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- DOC: mobile button appears during mobile width -->
                <div class="hidden-lg-up">
                    <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                        <i class="ni ni-menu"></i>
                    </a>
                </div>
                <div class="ml-auto d-flex">
                    <!-- activate app search icon (mobile) -->
                    <div class="hidden-sm-up">
                        <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                           data-focus="search-field" title="Search">
                            <i class="fal fa-search"></i>
                        </a>
                    </div>
                    <!-- app settings -->
                    <div class="hidden-md-down">
                        <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                            <i class="fal fa-cog"></i>
                        </a>
                    </div>
                    <!-- app user menu -->
                    <div>
                        <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                           class="header-icon d-flex align-items-center justify-content-center ml-2">
                            <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down"><?= ucfirst(session()->get('first_name')) ?></span>
                            <i class="ni ni-chevron-down hidden-xs-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                            <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                    <div class="info-card-text">
                                        <div class="fs-lg text-truncate text-truncate-lg"><?= ucfirst(session()->get('first_name')) . ' ' . ucfirst(session()->get('last_name')) ?></div>
                                        <span class="text-truncate text-truncate-md opacity-80"><?= session()->get('email') ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a href="#" class="dropdown-item" data-action="app-reset">
                                <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                            </a>
                            <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                <span data-i18n="drpdwn.settings">Settings</span>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                <i class="float-right text-muted fw-n">F11</i>
                            </a>
                            <a href="#" class="dropdown-item" data-action="app-print">
                                <span data-i18n="drpdwn.print">Print</span>
                                <i class="float-right text-muted fw-n">Ctrl + P</i>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item fw-500 pt-3 pb-3" href="/logout">
                                <span data-i18n="drpdwn.page-logout">Logout</span>
                                <span class="float-right fw-n">&commat;codexlantern</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END Page Header -->
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                <?= $this->renderSection('content') ?>
            </main>
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
            <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700">2020 © SmartAdmin by&nbsp;<a href='https://www.gotbootstrap.com'
                                                                                     class='text-primary fw-500'
                                                                                     title='gotbootstrap.com'
                                                                                     target='_blank'>gotbootstrap.com</a></span>
                </div>
                <div>
                    <ul class="list-table m-0">
                        <li><a href="#" class="text-secondary fw-700">About</a></li>
                        <li class="pl-3"><a href="#" class="text-secondary fw-700">License</a>
                        </li>
                        <li class="pl-3"><a href="#" class="text-secondary fw-700">Documentation</a>
                        </li>
                        <li class="pl-3 fs-xl"><a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary"
                                                  target="_blank"><i class="fal fa-question-circle"
                                                                     aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </footer>
            <!-- END Page Footer -->
            <!-- BEGIN Color profile -->
            <!-- this area is hidden and will not be seen on screens or screen readers -->
            <!-- we use this only for CSS color refernce for JS stuff -->
            <p id="js-color-profile" class="d-none">
                <span class="color-primary-50"></span>
                <span class="color-primary-100"></span>
                <span class="color-primary-200"></span>
                <span class="color-primary-300"></span>
                <span class="color-primary-400"></span>
                <span class="color-primary-500"></span>
                <span class="color-primary-600"></span>
                <span class="color-primary-700"></span>
                <span class="color-primary-800"></span>
                <span class="color-primary-900"></span>
                <span class="color-info-50"></span>
                <span class="color-info-100"></span>
                <span class="color-info-200"></span>
                <span class="color-info-300"></span>
                <span class="color-info-400"></span>
                <span class="color-info-500"></span>
                <span class="color-info-600"></span>
                <span class="color-info-700"></span>
                <span class="color-info-800"></span>
                <span class="color-info-900"></span>
                <span class="color-danger-50"></span>
                <span class="color-danger-100"></span>
                <span class="color-danger-200"></span>
                <span class="color-danger-300"></span>
                <span class="color-danger-400"></span>
                <span class="color-danger-500"></span>
                <span class="color-danger-600"></span>
                <span class="color-danger-700"></span>
                <span class="color-danger-800"></span>
                <span class="color-danger-900"></span>
                <span class="color-warning-50"></span>
                <span class="color-warning-100"></span>
                <span class="color-warning-200"></span>
                <span class="color-warning-300"></span>
                <span class="color-warning-400"></span>
                <span class="color-warning-500"></span>
                <span class="color-warning-600"></span>
                <span class="color-warning-700"></span>
                <span class="color-warning-800"></span>
                <span class="color-warning-900"></span>
                <span class="color-success-50"></span>
                <span class="color-success-100"></span>
                <span class="color-success-200"></span>
                <span class="color-success-300"></span>
                <span class="color-success-400"></span>
                <span class="color-success-500"></span>
                <span class="color-success-600"></span>
                <span class="color-success-700"></span>
                <span class="color-success-800"></span>
                <span class="color-success-900"></span>
                <span class="color-fusion-50"></span>
                <span class="color-fusion-100"></span>
                <span class="color-fusion-200"></span>
                <span class="color-fusion-300"></span>
                <span class="color-fusion-400"></span>
                <span class="color-fusion-500"></span>
                <span class="color-fusion-600"></span>
                <span class="color-fusion-700"></span>
                <span class="color-fusion-800"></span>
                <span class="color-fusion-900"></span>
            </p>
            <!-- END Color profile -->
        </div>
    </div>
</div>
<!-- END Page Wrapper -->
<!-- BEGIN Page Settings -->
<div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-right modal-md">
        <div class="modal-content">
            <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                <h4 class="m-0 text-center color-white">
                    Layout Settings
                    <small class="mb-0 opacity-80">User Interface Settings</small>
                </h4>
                <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="settings-panel">
                    <div class="mt-4 d-table w-100 px-5">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0">
                                App Layout
                            </h5>
                        </div>
                    </div>
                    <div class="list" id="fh">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="header-function-fixed"></a>
                        <span class="onoffswitch-title">Fixed Header</span>
                        <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
                    </div>
                    <div class="list" id="nff">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-function-fixed"></a>
                        <span class="onoffswitch-title">Fixed Navigation</span>
                        <span class="onoffswitch-title-desc">left panel is fixed</span>
                    </div>
                    <div class="list" id="nfm">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-function-minify"></a>
                        <span class="onoffswitch-title">Minify Navigation</span>
                        <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
                    </div>
                    <div class="list" id="nfh">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-function-hidden"></a>
                        <span class="onoffswitch-title">Hide Navigation</span>
                        <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
                    </div>
                    <div class="list" id="nft">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-function-top"></a>
                        <span class="onoffswitch-title">Top Navigation</span>
                        <span class="onoffswitch-title-desc">Relocate left pane to top</span>
                    </div>
                    <div class="list" id="fff">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="footer-function-fixed"></a>
                        <span class="onoffswitch-title">Fixed Footer</span>
                        <span class="onoffswitch-title-desc">page footer is fixed</span>
                    </div>
                    <div class="list" id="mmb">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-main-boxed"></a>
                        <span class="onoffswitch-title">Boxed Layout</span>
                        <span class="onoffswitch-title-desc">Encapsulates to a container</span>
                    </div>
                    <div class="expanded">
                        <ul class="mb-3 mt-1">
                            <li>
                                <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                            </li>
                            <li>
                                <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                            </li>
                            <li>
                                <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                            </li>
                            <li>
                                <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                            </li>
                            <li>
                                <div class="bg-white border" data-action="toggle" data-class="mod-bg-none"></div>
                            </li>
                        </ul>
                        <div class="list" id="mbgf">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                               data-class="mod-fixed-bg"></a>
                            <span class="onoffswitch-title">Fixed Background</span>
                        </div>
                    </div>
                    <div class="mt-4 d-table w-100 px-5">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0">
                                Mobile Menu
                            </h5>
                        </div>
                    </div>
                    <div class="list" id="nmp">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-mobile-push"></a>
                        <span class="onoffswitch-title">Push Content</span>
                        <span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
                    </div>
                    <div class="list" id="nmno">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-mobile-no-overlay"></a>
                        <span class="onoffswitch-title">No Overlay</span>
                        <span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
                    </div>
                    <div class="list" id="sldo">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="nav-mobile-slide-out"></a>
                        <span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
                        <span class="onoffswitch-title-desc">Content overlaps menu</span>
                    </div>
                    <div class="mt-4 d-table w-100 px-5">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0">
                                Accessibility
                            </h5>
                        </div>
                    </div>
                    <div class="list" id="mbf">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-bigger-font"></a>
                        <span class="onoffswitch-title">Bigger Content Font</span>
                        <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
                    </div>
                    <div class="list" id="mhc">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-high-contrast"></a>
                        <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                        <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
                    </div>
                    <div class="list" id="mcb">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-color-blind"></a>
                        <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                        <span class="onoffswitch-title-desc">color vision deficiency</span>
                    </div>
                    <div class="list" id="mpc">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-pace-custom"></a>
                        <span class="onoffswitch-title">Preloader Inside</span>
                        <span class="onoffswitch-title-desc">preloader will be inside content</span>
                    </div>
                    <div class="list" id="mpi">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-panel-icon"></a>
                        <span class="onoffswitch-title">SmartPanel Icons (not Panels)</span>
                        <span class="onoffswitch-title-desc">smartpanel buttons will appear as icons</span>
                    </div>
                    <div class="mt-4 d-table w-100 px-5">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0">
                                Global Modifications
                            </h5>
                        </div>
                    </div>
                    <div class="list" id="mcbg">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-clean-page-bg"></a>
                        <span class="onoffswitch-title">Clean Page Background</span>
                        <span class="onoffswitch-title-desc">adds more whitespace</span>
                    </div>
                    <div class="list" id="mhni">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-hide-nav-icons"></a>
                        <span class="onoffswitch-title">Hide Navigation Icons</span>
                        <span class="onoffswitch-title-desc">invisible navigation icons</span>
                    </div>
                    <div class="list" id="dan">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-disable-animation"></a>
                        <span class="onoffswitch-title">Disable CSS Animation</span>
                        <span class="onoffswitch-title-desc">Disables CSS based animations</span>
                    </div>
                    <div class="list" id="mhic">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-hide-info-card"></a>
                        <span class="onoffswitch-title">Hide Info Card</span>
                        <span class="onoffswitch-title-desc">Hides info card from left panel</span>
                    </div>
                    <div class="list" id="mlph">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-lean-subheader"></a>
                        <span class="onoffswitch-title">Lean Subheader</span>
                        <span class="onoffswitch-title-desc">distinguished page header</span>
                    </div>
                    <div class="list" id="mnl">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-nav-link"></a>
                        <span class="onoffswitch-title">Hierarchical Navigation</span>
                        <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
                    </div>
                    <div class="list" id="mdn">
                        <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                           data-class="mod-nav-dark"></a>
                        <span class="onoffswitch-title">Dark Navigation</span>
                        <span class="onoffswitch-title-desc">Navigation background is darkend</span>
                    </div>
                    <hr class="mb-0 mt-4">
                    <div class="mt-4 d-table w-100 pl-5 pr-3">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0">
                                Global Font Size
                            </h5>
                        </div>
                    </div>
                    <div class="list mt-1">
                        <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                            <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm"
                                   data-target="html">
                                <input type="radio" name="changeFrontSize"> SM
                            </label>
                            <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text"
                                   data-target="html">
                                <input type="radio" name="changeFrontSize" checked=""> MD
                            </label>
                            <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg"
                                   data-target="html">
                                <input type="radio" name="changeFrontSize"> LG
                            </label>
                            <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl"
                                   data-target="html">
                                <input type="radio" name="changeFrontSize"> XL
                            </label>
                        </div>
                        <span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem
                                    values (resets on page refresh)</span>
                    </div>
                    <hr class="mb-0 mt-4">
                    <div class="mt-4 d-table w-100 pl-5 pr-3">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0 pr-2 d-flex">
                                Theme colors
                                <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus"
                                   data-placement="top" title="" data-html="true"
                                   data-content="The settings below uses <code>localStorage</code> to load the external <strong>CSS</strong> file as an overlap to the base css. Due to network latency and <strong>CPU utilization</strong>, you may experience a brief flickering effect on page load which may show the intial applied theme for a split second. Setting the prefered style/theme in the header will prevent this from happening."
                                   data-original-title="<span class='text-primary'><i class='fal fa-exclamation-triangle mr-1'></i> Heads up!</span>"
                                   data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i
                                            class="fal fa-info-circle mr-1"></i> more info</a>
                            </h5>
                        </div>
                    </div>
                    <div class="expanded theme-colors pl-5 pr-3">
                        <ul class="m-0">
                            <li>
                                <a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme=""
                                   data-toggle="tooltip" data-placement="top" title="Wisteria (base css)"
                                   data-original-title="Wisteria (base css)"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-1" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top"
                                   title="Tapestry" data-original-title="Tapestry"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-2" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top"
                                   title="Atlantis" data-original-title="Atlantis"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-3" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top"
                                   title="Indigo" data-original-title="Indigo"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-4" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top"
                                   title="Dodger Blue" data-original-title="Dodger Blue"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-5" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top"
                                   title="Tradewind" data-original-title="Tradewind"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-6" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top"
                                   title="Cranberry" data-original-title="Cranberry"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-7" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top"
                                   title="Oslo Gray" data-original-title="Oslo Gray"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-8" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top"
                                   title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-9" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top"
                                   title="Apricot" data-original-title="Apricot"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-10" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top"
                                   title="Blue Smoke" data-original-title="Blue Smoke"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-11" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top"
                                   title="Green Smoke" data-original-title="Green Smoke"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-12" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top"
                                   title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-13" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top"
                                   title="Emerald" data-original-title="Emerald"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-14" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-14.css" data-toggle="tooltip" data-placement="top"
                                   title="Supernova" data-original-title="Supernova"></a>
                            </li>
                            <li>
                                <a href="#" id="myapp-15" data-action="theme-update" data-themesave
                                   data-theme="css/themes/cust-theme-15.css" data-toggle="tooltip" data-placement="top"
                                   title="Hoki" data-original-title="Hoki"></a>
                            </li>
                        </ul>
                    </div>
                    <hr class="mb-0 mt-4">
                    <div class="mt-4 d-table w-100 pl-5 pr-3">
                        <div class="d-table-cell align-middle">
                            <h5 class="p-0 pr-2 d-flex">
                                Theme Modes (beta)
                                <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus"
                                   data-placement="top" title="" data-html="true"
                                   data-content="This is a brand new technique we are introducing which uses CSS variables to infiltrate color options. While this has been working nicely on modern browsers without much issues, some users <strong>may still face issues on Internet Explorer </strong>. Until these issues are resolved or Internet Explorer improves, this feature will remain in Beta"
                                   data-original-title="<span class='text-primary'><i class='fal fa-question-circle mr-1'></i> Why beta?</span>"
                                   data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i
                                            class="fal fa-question-circle mr-1"></i> why beta?</a>
                            </h5>
                        </div>
                    </div>
                    <div class="pl-5 pr-3 py-3">
                        <div class="ie-only alert alert-warning d-none">
                            <h6>Internet Explorer Issue</h6>
                            This particular component may not work as expected in Internet Explorer. Please use with
                            caution.
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4 pr-2 text-center">
                                <div id="skin-default" data-action="toggle-replace"
                                     data-replaceclass="mod-skin-light mod-skin-dark" data-class=""
                                     data-toggle="tooltip" data-placement="top" title=""
                                     class="d-flex bg-white border border-primary rounded overflow-hidden text-success js-waves-on"
                                     data-original-title="Default Mode" style="height: 80px">
                                    <div class="bg-primary-600 bg-primary-gradient px-2 pt-0 border-right border-primary"></div>
                                    <div class="d-flex flex-column flex-1">
                                        <div class="bg-white border-bottom border-primary py-1"></div>
                                        <div class="bg-faded flex-1 pt-3 pb-3 px-2">
                                            <div class="py-3"</div>
                                        </div>
                                    </div>
                                </div>
                                Default
                            </div>
                            <div class="col-4 px-1 text-center">
                                <div id="skin-light" data-action="toggle-replace" data-replaceclass="mod-skin-dark"
                                     data-class="mod-skin-light" data-toggle="tooltip" data-placement="top" title=""
                                     class="d-flex bg-white border border-secondary rounded overflow-hidden text-success js-waves-on"
                                     data-original-title="Light Mode" style="height: 80px">
                                    <div class="bg-white px-2 pt-0 border-right border-"></div>
                                    <div class="d-flex flex-column flex-1">
                                        <div class="bg-white border-bottom border- py-1"></div>
                                        <div class="bg-white flex-1 pt-3 pb-3 px-2">
                                            <div class="py-3"</div>
                                        </div>
                                    </div>
                                </div>
                                Light
                            </div>
                            <div class="col-4 pl-2 text-center">
                                <div id="skin-dark" data-action="toggle-replace" data-replaceclass="mod-skin-light"
                                     data-class="mod-skin-dark" data-toggle="tooltip" data-placement="top" title=""
                                     class="d-flex bg-white border border-dark rounded overflow-hidden text-success js-waves-on"
                                     data-original-title="Dark Mode" style="height: 80px">
                                    <div class="bg-fusion-500 px-2 pt-0 border-right"></div>
                                    <div class="d-flex flex-column flex-1">
                                        <div class="bg-fusion-600 border-bottom py-1"></div>
                                        <div class="bg-fusion-300 flex-1 pt-3 pb-3 px-2">
                                            <div class="py-3 opacity-30"></div>
                                        </div>
                                    </div>
                                </div>
                                Dark
                            </div>
                        </div>
                    </div>
                    <hr class="mb-0 mt-4">
                    <div class="pl-5 pr-3 py-3 bg-faded">
                        <div class="row no-gutters">
                            <div class="col-6 pr-1">
                                <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset
                                    Settings</a>
                            </div>
                            <div class="col-6 pl-1">
                                <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory
                                    Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="saving"></span>
            </div>
        </div>
    </div>
</div>
<!-- END Page Settings -->
<script src="<?= base_url('assets/template') ?>/js/vendors.bundle.js"></script>
<script src="<?= base_url('assets/template') ?>/js/app.bundle.js"></script>
<script src="<?= base_url('assets/template') ?>/js/notifications/toastr/toastr.js"></script>


<script>
    $(document).ready(function ($) {
        const menuTags = "<?= $this->renderSection('menuTags')?>";
        let menuElement = $(`[data-filter-tags="${menuTags}"]`).parent();
        menuElement.addClass('active');

        const tags = menuTags.split(' ');

        tags.pop();
        for (let i = 0; i <= tags.length; i++) {
            menuElement = $(`[data-filter-tags="${tags.join(' ')}"]`).parent();
            menuElement.addClass('active open');
            tags.pop();
        }

        <?php if (isset($message)): ?>
            toastr.success('<?= $message ?>')
        <?php endif; ?>

        <?php if (isset($error)): ?>
            toastr.error('<?= $error ?>')
        <?php endif; ?>

    });
</script>
</body>
</html>