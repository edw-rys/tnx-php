<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($obj->title)?$obj->title:'Home';?></title>
    <!-- Materialize style -->
	<link rel="stylesheet" href="<?php echo CSS?>styles.css">
    <link rel="stylesheet" href="<?php echo CSS?>animate.css">
    <link rel="stylesheet" href="<?php echo CSS?>toastr.min.css">
	<link rel="stylesheet" href="<?php echo CSS?>calendar.min.css">
    
    <!-- JQUERY -->
    <script src="<?php echo JS?>pluggins/jquery.min.js"></script>
    <!-- PLUGGINS -->
	<script src="<?php echo JS?>pluggins/toastr.min.js"></script>
	<script src="<?php echo JS?>pluggins/calendar.min.js"></script>
    <!-- ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
    <!-- Link server -->
    <script>
		const url="<?php echo URL?>";
	</script>
</head>
<body class="<?php echo isset($obj->bck) && $obj->bck=="dark"?'bck-dark':'bck-light';?>">
    <?php include_once COMPONENTS."modal.php"?>

    
