<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client extends Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');

	}
	
	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
		
		$data['cbusiness'] = $this->Client_model->clientWelcome();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['bus_id'] = $this->Client_model->get_bus_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona - Client Portal';
		$data['page'] = '/client/client_message'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
	}
	
	
	// Displays current gallery for Customer
	// Takes input and sends to /client/gallery_up
	function gallery($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
			
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
		
		if ($this->input->post('upload')) {
			$this->Gallery_model->do_upload();
		}
		
		$data['cbusiness'] = $this->Client_model->clientWelcome();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['bus_id'] = $this->Client_model->get_bus_id();
		$data['photos'] = $this->Gallery_model->profile_get_images_from_db($id);
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona - Client Portal';
		$data['page'] = '/client/client_gallery_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
	}
	
	// Updates Gallery Table
	// Receives input from /client/gallery
	function gallery_up()
	{
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
		
		$this->Gallery_model->do_upload();
		
		$url = (string)$this->input->post('redirect', TRUE);
		redirect($url);
	}
	
	// Displays Customer's Business profile
	// Takes Input and sends it to /client/update
	function profile($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
			
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
		
		if ($this->input->post('upload')) {
			$this->Gallery_model->do_upload();
		}
		
		$data['categories'] = $this->Business_model->categoryList();
		$data['cbusiness'] = $this->Client_model->clientWelcome();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['bus_id'] = $this->Client_model->get_bus_id();
		$data['business'] = $this->Client_model->businessQueryByUser();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona - Client Portal';
		$data['page'] = '/client/client_profile_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
	}
	
	// Updates the database with Customer's Special
	// Receives input from /client/specials
	function specupdate()
	{
		$this->load->library('form_validation');
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Special Name', 'trim');
		$this->form_validation->set_rules('description', 'Special Description', 'trim');
		
		if($this->form_validation->run() == FALSE)
		{

		$data['page'] = '/client/client_special_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
		else
		{
			// validation has passed. Now send to model
			$name = (string)$this->input->post('name', TRUE);
			$description = (string)$this->input->post('description', TRUE);
			$userid = (string)$this->input->post('userid', TRUE);
			$busid = (string)$this->input->post('busid', TRUE);
			$redirect = "/client/specials";

			$this->Client_model->updateSpecial($name, $description, $redirect, $userid, $busid);
	}
	}
	
	// Updates the database with Customer's Business Information
	// Receives input from /client/profile
	function update()
	{
		$this->load->library('form_validation');
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('businessname', 'Business Name', 'trim');
		$this->form_validation->set_rules('address', 'Business Address', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim');
		$this->form_validation->set_rules('zip', 'Zip', 'trim');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim');
		$this->form_validation->set_rules('web', 'Web Address', 'trim');
		$this->form_validation->set_rules('category', 'Category', 'trim');
		$this->form_validation->set_rules('description', 'Business Description', 'trim');
		
		if($this->form_validation->run() == FALSE)
		{

		$data['page'] = '/client/client_profile_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
		else
		{
			// validation has passed. Now send to model
			$businessname = (string)$this->input->post('businessname', TRUE);
			$owner = (string)$this->input->post('owner', TRUE);
			$address = (string)$this->input->post('address', TRUE);
			$city = (string)$this->input->post('city', TRUE);
			$zip = (string)$this->input->post('zip', TRUE);
			$phone = (string)$this->input->post('phone', TRUE);
			$web = (string)$this->input->post('web', TRUE);
			$category = (string)$this->input->post('category', TRUE);
			$description = (string)$this->input->post('description', TRUE);
			$userid = (string)$this->input->post('userid', TRUE);
			$busid = (string)$this->input->post('busid', TRUE);
			$redirect = "/client/profile";

			$this->Client_model->updateProfile($businessname, $owner, $address, $city, $zip, $phone, $web, $category, $description, $redirect, $userid, $busid);
	}
	}
	
	
	// Displays current video for Customer
	// Takes input and sends to /client/gallery_up
	function specials($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
			
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
				
		$data['cbusiness'] = $this->Client_model->clientWelcome();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['bus_id'] = $this->Client_model->get_bus_id();
		$data['specials'] = $this->Client_model->profile_get_specials($id);
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Camp Verde - Client Portal';
		$data['page'] = '/client/client_special_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
	}
	
	
	
	
	// Displays current video for Customer
	// Takes input and sends to /client/gallery_up
	function video($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
			
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
				
		$data['cbusiness'] = $this->Client_model->clientWelcome();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['bus_id'] = $this->Client_model->get_bus_id();
		$data['videos'] = $this->Gallery_model->profile_get_video_from_db($id);
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona - Client Portal';
		$data['page'] = '/client/client_video_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
	}
	
	// Updates the database with Customer's Business Information
	// Receives input from /client/profile
	function vidupdate()
	{
		$this->load->library('form_validation');
		$this->load->model('Business_model');
		$this->load->model('Client_model');
		$this->load->model('Gallery_model');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('videoid', 'Video ID', 'trim');
		
		if($this->form_validation->run() == FALSE)
		{

		$data['page'] = 'contactus_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		}
		else
		{
			// validation has passed. Now send to model
			$videoid = (string)$this->input->post('videoid', TRUE);
			$userid = (string)$this->input->post('userid', TRUE);
			$busid = (string)$this->input->post('busid', TRUE);
			$redirect = "/client/video";

			$this->Gallery_model->updateVideo($videoid, $redirect, $userid, $busid);
	}
	}
	
	
	
	
	
}

/* End of file client.php */
/* Location: ./system/application/controllers/client.php */