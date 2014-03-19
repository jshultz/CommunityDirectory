<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site extends Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		
		// This is our Google API key.
		
	}
	
	function index()
	{
		$this->load->model('Business_model');
		$this->load->library('googlemaps');
		$data['catList']	= $this->Business_model->categoryList();
		$data['featured'] 	= $this->Business_model->frontPageList();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		$data['page'] = 'welcome_message'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
	}
	
	function about_jerome()
	{
		$this->load->model('Business_model');
		
		$data['catList']	= $this->Business_model->categoryList();
		$data['featured'] 	= $this->Business_model->frontPageList();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		$data['page'] = 'about_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
	}
	
	function advertise()
	{
		$this->load->model('Business_model');
		
		$data['catList']	= $this->Business_model->categoryList();
		$data['featured'] 	= $this->Business_model->frontPageList();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		$data['page'] = 'advertise_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
	}
	
	function contact()
	{
		$this->load->model('Business_model');
		
		$data['catList']	= $this->Business_model->categoryList();
		$data['featured'] 	= $this->Business_model->frontPageList();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		$data['page'] = 'contact_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
	}
	

	// Business Page Code
	function business($id)
	{

		$this->load->model('Business_model');
		$this->load->model('Gallery_model');
		
		
		
		$address = $this->Business_model->addressForMap($id); //Get result row
		$config['apikey'] = 'ABQIAAAAG3I2PYsLZmCKSGh9gQyFPxSkWDEkYlQ5KJ8vhCnvmq9rlEp_RBTMlSBt7_VoTSYohY-9DnIXsakEfg';
		$config['center_address'] =  $address->busaddress .', '. $address->buscity;
		$this->googlemaps->initialize($config);
		$marker = array();
		
		// $marker['address'] = $address->busaddress .' '.$address->buscity .', '. $address->buszip;
		$marker['address'] = $address->busaddress .', '. $address->buscity;
		$this->googlemaps->add_marker($marker);
		
		$data['map'] = $this->googlemaps->create_map();
		
		$data['address'] = $address->busaddress .', '.$address->buscity;
		$data['photos'] = $this->Gallery_model->get_images_from_db($id);
		$data['video'] = $this->Gallery_model->get_video_from_db($id);
		$data['specials'] = $this->Business_model->getSpecials($id);
		$data['business'] 	= $this->Business_model->businessQuery($id);
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		$data['page'] = 'business_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
	}
	

	// Categories Page Code
	function categories($id)
	{
		$this->load->model('Business_model');
		$data['businessList'] 	= $this->Business_model->categoryPageList($id);
		$data['catList']	= $this->Business_model->categoryList();
		$data['catpagename'] = $this->Business_model->getCatPageName($id);
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		$data['page'] = 'category_view'; // pass the actual view to use as a parameter
		$this->load->view('container',$data);
		
	}
	
	
	
	function contactus()
	{
		  $data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		  $data['page'] = 'contact_view'; // pass the actual view to use as a parameter
		  $this->load->view('container',$data);
	}
	
	function contact_confirmation()
	{
		  $data['page_title'] = 'Welcome to Sedona Arizona - The Heart of Red Rock Country';
		  $data['page'] = 'confirm_view'; // pass the actual view to use as a parameter
		  $this->load->view('container',$data);
	}
	
	/**
	* Function: youtube data grabber
	*
	* @description :
	* @param  $ : video code, url type (embed/url)
	* @return : data array
	* @author : Mamun.
	* @last -modified-by: Mamun.
	*/
 
 function youtube_data_grabber($video_code, $link_type = "embed")
			{
					if ($video_code != '')
					{
						if ($link_type == "embed")
						{
							$splited_data = explode("=",$video_code);
							$video_unique_code = substr(strrchr($splited_data[4],"/"),1,-strlen(strrchr($splited_data[4],"&")));
	
						}
						else if ($link_type == "url")
						{
							$splited_data = explode("=",$video_code);
							$video_unique_code = substr($splited_data[1],0,-strlen(strrchr($splited_data[1],"&")));
						}
						else
						{
							return;
						}
	
							// set feed URL
							$feedURL = 'http://gdata.youtube.com/feeds/api/videos/'.$video_unique_code;
	
							// read feed into SimpleXML object
							$sxml = simplexml_load_file($feedURL);
	
						return $sxml;
					}
	
			}
 
	 // End Youtube Function

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */