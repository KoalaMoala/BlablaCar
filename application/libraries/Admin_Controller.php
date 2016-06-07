<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ---------------------------------------------------------------------------

/**
 * Admin_Controller
 *
 * Extends the Site_Controller class so I can declare special Admin controllers
 *
 * @package       	SCMS
 * @subpackage      Controllers
 */
class Admin_Controller extends MY_Controller {
    function __construct() {
        parent::__construct();
        
        // Set container variable
        $this->_container = $this->config->item('ci_my_admin_template_dir_admin') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');

        log_message('debug', 'CI My Admin : Admin_Controller class loaded');
    }

}

/* End of Admin_controller.php */
/* Location: ./application/libraries/Admin_controller.php */