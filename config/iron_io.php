<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *  Iron.io Configurations
 * 
 */

/**
 * Iron.io Credentials
 */
$config['auth_token'] = '';

$config['project_id'] = '';

/**
 * API Configurations
 */
$config['protocol'] = 'https';

$config['host']     =  array(
    'IronMQ'     => 'mq-aws-us-east-1.iron.io', // for Rackspace use mq-rackspace-dfw.iron.io
    'IronWorker' => 'worker-aws-us-east-1.iron.io',
    'IronCache'  => 'cache-aws-us-east-1.iron.io'
);

$config['port']     = '443';
