<?php
/*
Plugin Name: Project REST Api
Description: Adds an API endpoint for projects
Version: 0.1
Author: Hector Lorenzo
Author URL: http://www.hectorlorenzo.com
Thanks to: https://github.com/inspectorfegter for the boilerplate
*/
class ProjectsAPIEndpoint{

	/** Hook WordPress
	*	@return void
	*/
	public function __construct()
    {
		add_filter('query_vars', array($this, 'AddQueryVars'), 0);
		add_action('parse_request', array($this, 'SniffRequests'), 0);
		add_action('init', array($this, 'AddEndPoint'), 0);
	}

	/** Add public query vars
	*	@param array $vars List of current public query vars
	*	@return array $vars
	*/
	public function AddQueryVars($vars)
    {
		$vars[] = '__api';
		$vars[] = 'action';
        $vars[] = 'project_id';
		return $vars;
	}

	/** Add API Endpoint
	*	This is where the magic happens - brush up on your regex skillz
	*	@return void
	*/
	public function AddEndPoint()
    {
        add_rewrite_rule('^api/projects/all/?','index.php?__api=1&action=get_projects','top');
		add_rewrite_rule('^api/projects/?([0-9]+)?/?','index.php?__api=1&action=get_project&project_id=$matches[1]','top');
	}

	/**	Sniff Requests
	*	This is where we hijack all API requests
	* 	If $_GET['__api'] is set, we kill WP and serve up pug bomb awesomeness
	*	@return die if API request
	*/
	public function SniffRequests()
    {
		global $wp;
		if(isset($wp->query_vars['__api'])){
			$this->HandleRequest();
			exit;
		}
	}

	/** Handle Requests
	*	This is where we send off for an intense pug bomb package
	*	@return void
	*/
	protected function HandleRequest()
    {
		global $wp;
		$action = $wp->query_vars['action'];

		if(!$action) {
            $this->send_response('Please specify an action.');
        }

        switch ($action)
        {
            case 'get_project':

                $project_id = $wp->query_vars['project_id'];

                if( ! $project_id ) {
                    $this->send_response('Please specify a project ID.');
                } else {
                    $this->GetProjectInformation($project_id);
                }

                break;

            case 'get_projects':

                $this->GetAllProjects();

                break;

            default:

                $this->send_response('Please specify a correct action.');

                break;
        }
	}

    /** Get project information
	*	@return void
	*/
	protected function GetProjectInformation($project_id)
    {
		global $wp;
		$project_id = $wp->query_vars['project_id'];
		if(!$project_id)
			$this->send_response('Please specify a Project ID.');

		$project = array(
            'information' => get_post($project_id),
            'content_blocks' => get_field('content_blocks', $project_id)
        );
		if($project)
			$this->send_response('200 OK', json_encode($project));
		else
			$this->send_response('Something went wrong with the pug bomb factory');
	}

    /** Get all projects
	*	@return void
	*/
	protected function GetAllProjects()
    {
		global $wp;

        $project_query_args = array(
            'post_type' => 'project'
        );

        $projects_query = new WP_Query( $project_query_args );

        if($projects_query)
			$this->send_response('200 OK', json_encode($projects_query->posts));
		else
			$this->send_response('Something went wrong with the pug bomb factory');
	}

	/** Response Handler
	*	This sends a JSON response to the browser
	*/
	protected function send_response($msg, $data = ''){
		$response['message'] = $msg;
		if($data)
        {
			$response['data'] = $data;
        }
		header('content-type: application/json; charset=utf-8');
	    echo json_encode($response)."\n";
	    exit;
	}
}
new ProjectsAPIEndpoint();
