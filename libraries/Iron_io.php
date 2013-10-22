<?php
/**
 * Codeigniter library for Iron.io
 *
 * Wrapper library for utilizing IronMQ, IronWorker, and IronCache. Uses
 * the PHP Iron.io client libraries.
 *
 * You can use all class methods that are found in the "Library/Iron_io/" directory.
 *
 * _________________________________________________________________________________
 *
 * How to use library:
 *
 * // Load library
 * $this->load->library('iron_io');
 *
 * // IronMQ
 * $this->iron_io->queue->postMessage("test_queue", "Hello world");
 *
 * // IronCache
 * $this->iron_io->cache->put("cache_name", "key", "value");
 *
 * // IronWorker
 * $this->iron_io->worker->postTask("name", $payload = array(), $options = array());
 *
 * _________________________________________________________________________________
 *
 *
 * @link https://github.com/jrutheiser/Codeigniter-IronMQ
 * @link http://www.iron.io
 * @link http://dev.iron.io/
 *
 * @author  Jonathan Rutheiser <jonathan.rutheiser@gmail.com>
 */


class Iron_io {
    // Supported classes
    private $_classes = array(
        'cache'  => 'IronCache',
        'queue'  => 'IronMQ',
        'worker' => 'IronWorker'
    );

    // Codeigniter instance
    private $_ci = NULL;

    // Iron.io file locations
    const IRON_IO_DIR = 'Iron_io';
    const CONFIG_FILE = 'iron_io';

    // Iron.io objects
    private $_loaded = array();

    // Configurations
    private $_config = array();

    // API variables
    private $_auth_token;
    private $_project_id;
    private $_protocol;
    private $_port;
    private $_host = array();


    /**
     * __construct()
     *
     * @param array $config
     * @return void
     */
    public function __construct($config = array())
    {
        $this->_ci =& get_instance();

        // Load core class
        require_once(__DIR__. '/' . self::IRON_IO_DIR . '/IronCore.class.php');

        // Load Configurations
        if (! empty($config))
        {
            $this->_initialize($config);
        }
        else
        {
            $this->_ci->load->config(self::CONFIG_FILE, true);
            $this->_load_config();
        }

        $this->_config = array(
            'token'       => $this->_auth_token,
            'project_id'  => $this->_project_id,
            'protocol'    => $this->_protocol,
            'port'        => $this->_port,
        );
    }

    /**
     * Set config settings from array
     *
     * @param   array
     * @return  void
     */
    private function _initialize($config = array())
    {
        foreach ($config as $key => $val)
        {
            $this->{'_' . $key} = $val;
        }
    }

    /**
     * Load configuration variables
     *
     * @return void
     */
    private function _load_config()
    {
        $this->_auth_token = $this->_ci->config->item('auth_token', self::CONFIG_FILE);
        $this->_project_id = $this->_ci->config->item('project_id', self::CONFIG_FILE);

        $this->_protocol   = $this->_ci->config->item('protocol', self::CONFIG_FILE);
        $this->_host       = $this->_ci->config->item('host', self::CONFIG_FILE);
        $this->_port       = $this->_ci->config->item('port', self::CONFIG_FILE);
    }

    /**
     * __get()
     *
     * @param   string $child
     * @return  mixed
     */
    public function __get($child)
    {
        if ( isset($this->_classes[$child]))
        {
            // Has class been initialized?
            if (! isset($this->_loaded[$child]))
            {
                // Load class file
                require_once(__DIR__. '/' . self::IRON_IO_DIR . '/' . $this->_classes[$child] . '.class.php');

                // Set API host for iron.io class
                $this->_config['host'] = $this->_host[$this->_classes[$child]];

                // Init class
                $this->_loaded[$child] = new $this->_classes[$child]($this->_config);

                return $this->_loaded[$child];
            }

            return $this->_loaded[$child];
        }

        return $this->$child;
    }

}
