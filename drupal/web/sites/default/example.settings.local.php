<?php
/**
 * @file
 * An example settings.local.php file for Drupal. SystemSeed updated version.
 */

assert_options(ASSERT_ACTIVE, TRUE);
\Drupal\Component\Assertion\Handle::register();

// Local hash salt.
$settings['hash_salt'] = 'random_local_salt';

// Enable local development services.
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

// Error logging.
$config['system.logging']['error_level'] = 'verbose';

// Disable CSS and JS aggregation.
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

// Add your database configuration here.
/*
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'username' => '',
  'password' => '',
  'database' => '',
  'prefix' => '',
);
*/
