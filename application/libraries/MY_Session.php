<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once BASEPATH . '/libraries/Session.php';
class MY_Session extends CI_Session
{
    // function __construct()
    // {
    //     parent::__construct();
    //     $this->CI->session = $this;
    // }


    // function sess_update() {
    //         // skip the session update if this is an AJAX call! This is a bug in CI; see:
    //         // https://github.com/EllisLab/CodeIgniter/issues/154
    //         // http://codeigniter.com/forums/viewthread/102456/P15
    //         if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || ( stripos($_SERVER['REQUEST_URI'], 'live/request') != 0 ) ) { 
    //                 parent::sess_update();
    //         }
    // }

    public function sess_update()
    {
        $CI = get_instance();

        if ( ! $CI->input->is_ajax_request())
        {
            parent::sess_update();
        }
    }
}
