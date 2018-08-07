<!DOCTYPE html>
<html>
<head>
    <!-- meta name="viewport" content="width=device-width, initial-scale=1"-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= (isset($this->title) ? $this->title : 'MVC') ?></title>

    <!-- <link rel="shortcut icon" href="<?php echo URL; ?>public/icon/small-icon.png" > -->
   
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/default.css?noCache=<?php echo date("YmdHis")?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/bootstrap.css?noCache=<?php echo date("YmdHis")?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/font-awesome.css?noCache=<?php echo date("YmdHis")?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/admin-lte.css?noCache=<?php echo date("YmdHis")?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/skins/skin-black.css?noCache=<?php echo date("YmdHis")?>" />
    
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-3.1.1.js?noCache=<?php echo date("YmdHis")?>"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.js?noCache=<?php echo date("YmdHis")?>"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/admin-lte.js?noCache=<?php echo date("YmdHis")?>"></script>

    <?php 
        if (isset($this->js)) {
            foreach ($this->js as $js)
                echo '<script type="text/javascript" src="'. URL .'app/views/'. $js .'"></script>';
        }
    ?>
</head>
<body>
	
	<section class="content" style="padding: 24%">
		<div class="error-page">
			<!-- <h2 class="headline text-yellow">404</h2> -->
			<div class="error-content" style="margin-left: 10%">
				<h3><i class="fa fa-warning text-yellow"></i> A página que você está tentando acessar não existe!</h3>
				<p>Clique <a href="<?php echo URL; ?>">aqui</a> para ser redirecionado para a página principal.</p>
			</div>
		</div>
	</section>

</body>