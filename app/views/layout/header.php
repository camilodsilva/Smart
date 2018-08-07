<!DOCTYPE html>
<html>
<head>
    <!-- meta name="viewport" content="width=device-width, initial-scale=1"-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= (isset($this->title) ? $this->title : 'Framework') ?></title>

    <!-- <link rel="shortcut icon" href="<?php echo URL; ?>public/icon/small-icon.png" > -->
   
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/admin-lte.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/skins/skin-blue.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/date-picker.css" />
    
    <script type="text/javascript" src="<?php echo URL; ?>public/js/default.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/admin-lte.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/date-picker.js"></script>

    <script type="text/javascript" src="/smart/bower_components/jquery/dist/jquery.min.js"></script> -->
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <?php 
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="app/views/'. $js .'"></script>';
            }
        }
    ?>
</head>

<?php 
    // Session::init();
?>

<body class="hold-transition skin-blue fixed sidebar-mini" style="background-color: #f3f3f3">
    <div id="content">