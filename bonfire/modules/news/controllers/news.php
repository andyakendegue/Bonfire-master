<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends Front_Controller {

	private $_settings;
	
	//--------------------------------------------------------------------
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('news_model');
		$this->lang->load('news');

		$this->_settings = $this->settings_model->select('name,value')->find_all_by('module', 'news');

	}

	//--------------------------------------------------------------------
	
	/**
	 *	index.
	 *
	 *	Displays a default list of news articles. The nbumber of articles displayed is managed via
	 *	the news.default_article_count setting.
	 *
	 *	@return     <void>	This function outputs to the Template::render() function
	 *
	 */
        public function index()
	{
		$articles = $this->get_articles($this->_settings['news.default_article_count']);
		$this->set_current_user();
		Template::set('articles', $articles);
		Template::set('settings', $this->_settings);
		Template::set('single', false);
		Template::render();
	}

        //--------------------------------------------------------------------

        /**
	 *	add_news.
	 *
	 *	Displays a default list of news articles. The nbumber of articles displayed is managed via
	 *	the news.default_article_count setting.
	 *
	 *	@return <void>	This function outputs to the Template::render() function
	 *
	 */
        public function add_news()
	{
		$settings = $this->_settings;
		$this->set_current_user();
		
		if ($this->input->post('submit'))
		{
			$this->load->module('news/content'); 
			
			$uploadData = array();
			$upload = true;
                        if (isset($_FILES['attachment']) && is_array($_FILES['attachment']) && $_FILES['attachment']['error'] != 4)
                        {
                            $uploadData = $this->content->handle_upload( );
                            if (isset($uploadData['error']) && !empty($uploadData['error']))
                            {
                                    $upload = false;
                            }
			}
			if ((count($uploadData) > 0 && $upload) || (count($uploadData) == 0 && $upload))
			{
                            if ($id = $this->content->save_article($uploadData))
                            {
				$article = $this->news_model->find($id);

                                    $this->load->model('activities/activity_model');
                                    if (isset($this->current_user) && isset($this->current_user->id)) {
                                        $this->activity_model->log_activity($this->current_user->id, 'Created Article: '. $article->id, 'news');
                                    }
                                    Template::set_message('Article successfully submitted. It will be reviewed by the news moderator.', 'success');
                                    Template::set_view('index');
                                    Template::render();
				}
				else
				{
                                    Template::set_message('There was a problem creating the article: '. $this->news_model->error);
				}
			}
			else
			{
                            Template::set_message('There was a problem saving the file attachment: '. $uploadData['error']);
			}
		}
		
		if ($settings['news.public_submissions'] == 1) 
		{
			$showForm = true;
			
			if ($settings['news.public_submitters'] == 1) 
			{
                            $cookie = unserialize($this->input->cookie($this->config->item('sess_cookie_name')));
                            $showForm = isset ($cookie['logged_in']);
                            $error = 'You must be <a href="'.site_url('/login/').'">logged in</a> to post news to this site.';
                            unset ($cookie);
			}
			if ($showForm) 
			{
                            $this->load->helper('form');
                            Assets::add_css( array(
                                Template::theme_url('js/editors/markitup/skins/markitup/style.css'),
                                Template::theme_url('js/editors/markitup/sets/default/style.css'),
                                css_path() . 'chosen.css',
                                css_path() . 'bootstrap-datepicker.css'

                            ));

                             Assets::add_js( array(
                                Template::theme_url('js/editors/markitup/jquery.markitup.js'),
                                Template::theme_url('js/editors/markitup/sets/default/set.js'),
                                js_path() . 'chosen.jquery.min.js',
                                js_path() . 'bootstrap-datepicker.js'
                            ));
                            Template::set('public', true);
                            Template::set('settings', $settings);
                            Template::set('toolbar_title', lang('us_create_news'));
                            Template::set_view('content/news_form');
                            Template::render();
			} 
			else 
			{
                            show_error($error,501,'Form Access Error');
			}
		} 
		else 
		{
                    show_error('<h2>Sorry</h2><br />Public news submissions are not currently available.<br /><a href="'.site_url().'">Return to the site</a>.',501,'Public News Submission not available');
		}
	}
    //--------------------------------------------------------------------

	/**
	 *	get_article_list.
	 *
	 *	This function assembles a few variables and then queries the database for a list 
	 * 	of articles. 
	 *
	 *	@param	$limit	int		Max number of articles to return. Default is -1 (no limit)
	 *	@param	$offset	int		Index of the first item to return
	 *	@return			array	Array of article objects
	 *
	 */
        public function get_article_list($limit=-1, $offset=0)
        {

            Assets::add_module_css('news','assets/css/news.css');

            $this->load->model('activities/Activity_model', 'activity_model', true);
			$this->set_current_user();

            if ($limit != -1 && $offset == 0)
            {
                    $this->db->limit($limit);
            } else if ($limit != -1 && $offset > 0) {
                    $this->db->limit($limit, $offset);
            }

            $this->db->order_by('date', 'desc');
            $articles = $this->news_model->find_all_by('status_id',3);

            if (!is_array($articles) || !count($articles))
            {
                if (isset($this->current_user) && isset($this->current_user->id)) {
                    $this->activity_model->log_activity($this->current_user->id, 'Get Articles: failed. No articles were found.', 'news');
                }
            }

            return $articles;
        }

	//--------------------------------------------------------------------
	
	/**
	 *	get_articles.
	 *
	 *	A function that returns a HTML block of published article content. This function runs each 
	 *	article returned through the load view and applies the article content against the article
	 * 	view template. 
	 *
	 *	@param	$limit	int		Max number of articles to return. Default is -1 (no limit)
	 *	@param	$offset	int		Index of the first item to return
	 *	@return			varchar	Formatted HTML article blocks
	 *
	 */
        public function get_articles($limit=-1, $offset=0)
	{

		Assets::add_module_css('news','news.css');

		$this->load->model('activities/Activity_model', 'activity_model', true);
		$this->set_current_user();

		$output = '';
		$articles = $this->news_model->get_articles(true,$limit,$offset);

		if (is_array($articles) && count($articles))
		{
			$settings = $this->_settings;
			$this->load->helper('author');

			foreach ($articles as $article)
			{
				$article->asset_url = $settings['news.upload_dir_url'];
				$article->author_name = find_author_name($article->author);
				// COMMENTS
				$comment_count = (in_array('comments',module_list(true)) && $settings['news.comments_enabled'] == 1) ? modules::run('comments/count_comments',$article->comments_thread_id) : 0;
				$output .= $this->load->view('news/article',array('comment_count' => $comment_count, 'article'=>$article,'settings'=>$settings,'single'=>false),true);
			}
		} else {
			$output = lang('us_no_articles');
                        if (isset($this->current_user) && isset($this->current_user->id)) {
                            $this->activity_model->log_activity($this->current_user->id, 'Get Articles: failed. No articles were found.', 'news');
                        }
		}
		return $output;
	}
	
	//--------------------------------------------------------------------
	
	/**
	 *	article.
	 *
	 *	A function that renders an article using the news article template via the Bonire Template::render() function. 
	 *	Unlike get_articles, this function also includes the News social sharing bar if that options is enabled.
	 *
	 *	@param	$article_id		int		The News article ID
	 *	@return					<void>	This function outputs to the Template::render() function
	 *
	 */
        public function article($article_id = false)
	{

		
		if ($article_id === false)
		{
			return false;
		}

		$settings = $this->_settings;
		Assets::add_module_css('news','news.css');

		if ( ($article = $this->news_model->get_article($article_id)) !== false)
		{
			$this->load->helper('author');
			$article->author_name = find_author_name($article->author);
			$article->asset_url = $settings['news.upload_dir_url'];

			Template::set('article',$article);
			if ( isset ($settings['news.sharing_enabled']) && $settings['news.sharing_enabled'] == 1) {
                            Template::set('settings',$settings);
                            Template::set('single',true);
                            Template::set('scripts',$this->load->view('news/news_articles_js',null,true));
			}
			// COMMENTS
			$comments = (in_array('comments',module_list(true)) && $settings['news.comments_enabled'] ==1) ? modules::run('comments/thread_view_with_form',$article->comments_thread_id) : '';
			Template::set('comment_form', $comments);
			
		} else {
			if (isset($this->current_user) && isset($this->current_user->id)) {
                            $this->activity_model->log_activity($this->current_user->id, 'Get Article: '. $article_id .' failed. no article found.', 'news');
                        }
		}
        $this->load->library('users/auth');
        $this->set_current_user();
		Template::set_view('news/article');
		Template::render();
	}

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
				'blog'   => 'active',
				'services'    => '',
				'job'    => '',
				'about'    => '',
				'contact'    => ''
			);

			Template::set('link_class', $link_class);
		}
	}
	
}
// End User Admin class
