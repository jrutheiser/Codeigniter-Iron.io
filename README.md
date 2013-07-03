Codeigniter IronMQ
-------------

[IronMQ](http://www.iron.io/products/mq) is an elastic message queue for managing data and event flow within cloud applications and between systems.

This is a slight modification of the PHP API to allow you to use IronMQ as a Codeigniter library.

## Getting Started

### Get credentials

To start using iron_mq_php, you need to sign up and get an oauth token.

1. Go to http://iron.io/ and sign up.
2. Get an Oauth Token at http://hud.iron.io/tokens

--

### Install Library

1. Move library files and directory into application/libraries
2. Move configuration file into application/config

--

### Configure

Edit config/iron_io.php and fill it in with your Iron.io credentials.

--

### Basic Usage

```php
<?php
    $this->load->library('iron_io');

    /**
     * For a complete list of available methods look in Iron_MQ.class.php
     */
    // IronMQ example
    $this->iron_io->queue->postMessage($queue_name, $message, $properties = array());


    /**
     * For a complete list of available methods look in Iron_Cache.class.php
     */
    // IronMQ example
    $this->iron_io->cache->put($key, $item);

    $this->iron_io->cache->get($key);


    /**
     * For a complete list of available methods look in Iron_Worker.class.php
     */
    // IronMQ example
    $this->iron_io->worker->postTask($name, $payload = array(), $options = array());

```


