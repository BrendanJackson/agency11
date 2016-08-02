<?php
$assetfolder = "/themes/agency11/assets/";
$logo = "/assets/files/id/" . \config::site_logo;
$logo_alternate = "/assets/files/id/" . \config::site_logo_alternative;
$modules = \sa\application\app::get()->getModules();
$module_list = array_column($modules, 'module');
$search = in_array('search', $module_list);
$catalog = in_array('catalog', $module_list);
$member = in_array('member', $module_list);

?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title><?=!empty($page_name) ? $page_name : \config::site_name ?></title>
   
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assetfolder?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assetfolder?>css/animate.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="<?=$assetfolder?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$assetfolder?>css/main.css">
    <link rel="stylesheet" href="<?=$assetfolder?>css/custom-styles.css">
<!--
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
-->
    <!-- Fav and touch icons -->
   <!--
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$assetfolder?>/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$assetfolder?>/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$assetfolder?>/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=$assetfolder?>/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?=$assetfolder?>/favicon.png">
    -->
</head>

<body data-spy="scroll" data-target=".navbar">

<!--Nav Bar -->
<div class="navbar navbar-inverse navbar-fixed-top animated fadeInDownBig">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/"><img class="img-responsive col-lg-1" src="<?= $logo ?>" alt="lOGO" height="60" width="60"></a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">

                    <?php
                    if(!empty($catalog)) {
                        $minicart_data = \sa\application\modRequest::request('site.minicart', array('disable_minicart' => $disable_minicart, 'html' => ''), '');
                        echo "<li class=' vertically-center cart btn btn-xs' >" . $minicart_data['html'] . "</li>";
                    }?>
                    <?php
                    if(!empty($search)){
                        echo
                        "<li>
                           <a href='/search'>Search</a>
                        </li>";
                    }?>
                    <?php if(!empty($member)){
                        echo "<li>
                            <a href='/member/login'>Login</a>
                            </li>";
                    }?>
                    <?php
                    $navigation = \sa\application\modRequest::request('site.navigation', $data = array('level' => 2));
                    foreach ($navigation['navigation']['page_editor'] as $menuItem){
                        ?>


                        <li class="dropdown <?= ($menuItem['has_sub_pages'] == 1) ? 'has-children' : '' ?>">
                            <a  href="<?=($menuItem['route'] != '/') ? '/'.$menuItem['route']:'/'?>" class="dropdown-toggle scroll" data-toggle="dropdown">
                                <span><?= $menuItem['title'] ?></span>
                                <?= ($menuItem['has_sub_pages'] == 1) ? '<span class="sf-sub-indicator"><i class="fa fa-chevron-down"></i></span>' : '' ;?>
                            </a>

                            <?php if($menuItem['has_sub_pages'] == 1){
                                echo '<ul class="dropdown-menu">';

                                foreach ($menuItem['sub_pages'] as $pages) {
                                    echo "<li class=''><a href='" . $pages['title'] . " ' class='scroll'> ". $pages['title'] . "</a></li>" ;


                                }
                                echo "</ul>" ;
                            } ?>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="space"></div>