<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');

		$this->load->library('installer_lib');
		if (! $this->installer_lib->is_installed()) {
			$ci =& get_instance();
			$ci->hooks->enabled = false;
			redirect('install');
		}

		// Make the requested page var available, since
		// we're not extending from a Bonfire controller
		// and it's not done for us.
		$this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
	}
	public function index()
	{

        $this->load->library('users/auth');
        $this->set_current_user();

        Template::render();
	}

    //--------------------------------------------------------------------

    /**
     * If the Auth lib is loaded, it will set the current user, since users
     * will never be needed if the Auth library is not loaded. By not requiring
     * this to be executed and loaded for every command, we can speed up calls
     * that don't need users at all, or rely on a different type of auth, like
     * an API or cronjob.
     *
     * Copied from Base_Controller
     */
    protected function set_current_user()
    {
        if (class_exists('Auth')) {
            // Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
                $this->current_user = clone $this->auth->user();

                $this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

                // if the user has a language setting then use it
                if (isset($this->current_user->language)) {
                    $this->config->set_item('language', $this->current_user->language);
                }
            } else {
                $this->current_user = null;
            }

            // Make the current user available in the views
            if (! class_exists('Template')) {
                $this->load->library('Template');
            }
            Template::set('current_user', $this->current_user);
            Template::set('language', 'fr');
            Template::set('active', 'active');
            $link_class = array(
                'home' => '',
                'blog'   => '',
                'services'    => 'active',
                'job'    => '',
                'about'    => '',
                'contact'    => ''
            );

            Template::set('link_class', $link_class);
        }
    }
}
