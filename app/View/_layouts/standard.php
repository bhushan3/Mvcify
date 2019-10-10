<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>Mvcify</title>
    <meta name='description' content='>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='<?php echo SITE_URL; ?>/css/style.css' rel='stylesheet'>
</head>
<body>
    <div class='page-wrap'>
        <img class='logo' src='<?php echo SITE_URL; ?>/img/logo.png' alt='Mvcify Logo' />
        <div class='nav'>
            <a href='<?php echo SITE_URL; ?>'>home</a>
            <a href='<?php echo SITE_URL; ?>/home/subpage'>home/subpage</a>
            <a href='<?php echo SITE_URL; ?>/users'>users</a>
        </div>
        <?php echo $this->content; ?>
        <div class='footer'>
            Find <a href='https://github.com/bhushan3/mvcify'>Mvcify on GitHub</a>.
        </div>
    </div>

    <!-- Define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var siteUrl = '<?php echo SITE_URL; ?>';
    </script>

    <!-- Our JavaScripts -->
    <script src='<?php echo SITE_URL; ?>/js/app.js'></script>
    <?php echo $this->printJavaScripts(); ?>
</body>
</html>
