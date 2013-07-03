<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *  Iron.io Configurations
 * 
 */

/**
 * Iron.io Credentials
 */
$config['auth_token'] = 'lbOh7omsfWYIjzpP7opg6B__O2I';
$config['project_id'] = '51d1e2fb5de9387538000d46';

/**
 * API Configurations
 */
$config['protocol'] = 'https';

$config['host']     =  array(
    'IronMQ'     => 'mq-rackspace-dfw.iron.io', //for AWS use mq-aws-us-east-1.iron.io
    'IronWorker' => 'worker-aws-us-east-1.iron.io',
    'IronCache'  => 'cache-aws-us-east-1.iron.io'
);

$config['port']     = '443';


/**
 * Cache Name for IronCache
 */
$config['cache_name'] = 'test';
