<?php

/**
 * Load the configuration file.
 */
require 'config.php';

/**
 * The composer auto-loader for dependencies and some project files.
 */
require 'vendor/autoload.php';

/**
 * Start the app.
 */
new Mvcify\Core\App();
