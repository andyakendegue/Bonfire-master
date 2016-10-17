<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Front Controller
 *
 * This class provides a common place to handle any tasks that need to
 * be done for all public-facing controllers.
 *
 * @package    Bonfire\Core\Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Front_Controller extends Base_Controller
{

    //--------------------------------------------------------------------

    /**
     * Class constructor
     *
     */
    public function __construct()
    {

        $this->autoload['helpers'][]   = 'form';
        $this->autoload['libraries'][] = 'Template';
        $this->autoload['libraries'][] = 'Assets';
        $this->autoload['libraries'][] = 'form_validation';
        parent::__construct();

        Events::trigger('before_front_controller');

        //$this->load->library('template');
        //$this->load->library('assets');
        //$this->load->library('form_validation');


        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('', '');

        $this->set_current_user();
        // Profiler Bar?
        // Profiler bar?
        $this->showProfiler(false);

        Events::trigger('after_front_controller');
    }//end __construct()

    //--------------------------------------------------------------------

}

/* End of file Front_Controller.php */
/* Location: ./application/core/Front_Controller.php */