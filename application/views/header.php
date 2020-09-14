<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="utf-8">
        <title>Azarstar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="<?php echo base_url('cssjs/javascript.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('cssjs/w3.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('cssjs/mycss.css'); ?>">
    </head>
    <body class="w3-light-gray">
        <!-- Navbar -->
        <div class="w3-container">
            <div class="w3-bar w3-border">
                <a id="nav1" href="<?= base_url('') ?>" class="w3-bar-item w3-button  w3-mobile  w3-green">Home</a>
                <a id="nav2" href="<?= base_url('downloads') ?>" class="w3-bar-item w3-button  w3-mobile">Downloads</a>
                <a id="nav3" href="<?= base_url('tools') ?>" class="w3-bar-item w3-button  w3-mobile">Tools</a>
                <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?><a href="<?= base_url('user/logout') ?>" class="w3-bar-item w3-button  w3-mobile">Logout</a>
                <?php else : ?><a id="nav4" href="<?php echo base_url('user/login'); ?>" class="w3-bar-item w3-button  w3-mobile">Login</a> <?php endif; ?>
            </div> 
        </div>