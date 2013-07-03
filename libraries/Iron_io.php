<?php
/**
 * Codeigniter library for Iron.io
 *
 *
 * @link https://github.com/jrutheiser/Codeigniter-Iron.io
 * @link http://www.iron.io
 * @link http://dev.iron.io/
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
    const IRON_IO_DIR = 'Iron.io';
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
    private $_cache_name;
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
        if(! empty($config)) 
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
     * Initialize preferences
     *
     * @param   array
     * @return  void
     */
    private function _initialize($config = array())
    {
        foreach ($config as $key => $val)
        {
            if (isset($this->_{$key}))
            {
                $this->_{$key} = $val;
            }
        }
    }

    /**
     * Load configuration variables
     */
    private function _load_config()
    {
        $this->_auth_token = $this->_ci->config->item('auth_token', self::CONFIG_FILE);
        $this->_project_id = $this->_ci->config->item('project_id', self::CONFIG_FILE);
        
        $this->_protocol   = $this->_ci->config->item('protocol', self::CONFIG_FILE);
        $this->_host       = $this->_ci->config->item('host', self::CONFIG_FILE);
        $this->_port       = $this->_ci->config->item('port', self::CONFIG_FILE);
        
        $this->_cache_name = $this->_ci->config->item('cache_name', self::CONFIG_FILE);
    }

    /**
     * __get()
     *
     * @param   string $child
     * 
     * @return  object
     */
    public function __get($child)
    {
        if ( ! isset($this->_classes[$child]))
        {
            throw new Exception('Undefined class ' . $child . ' called');
        }

        if( ! isset($this->_loaded[$child]))
        {
            include_once(__DIR__. '/' . self::IRON_IO_DIR . '/' . $this->_classes[$child] . '.class.php');

            // Set API host for iron.io class
            $this->_config['host'] = $this->_host[$this->_classes[$child]];

            // Set name of cache - if used
            if($child == 'cache')
            {
                $this->_config['cache_name'] = $this->_cache_name;
            }

            $this->_loaded[$child] = new $this->_classes[$child]($this->_config);
        }

        return $this->_loaded[$child];
    }

}
