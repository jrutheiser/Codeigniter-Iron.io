Codeigniter-IronMQ
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

Edit config/iron.php and fill it in with your iron.io Token and Project ID

--

### Basic Usage

```php
<?php
    $this->load->library('iron_mq');

    $this->iron_mq->postMessage($queue_name, $message, $properties = array());

    /**
     * 
     * For a complete list of available methods look in Iron_mq.php
     * 
     */
```


