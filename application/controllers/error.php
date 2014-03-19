<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Error extends Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

	}
	
	function error_404()
	{
		$data['page_title'] = 'Open Sky Media - Cottonwood Arizona Web Development Professional';
		  $data['page'] = '404_view'; // pass the actual view to use as a parameter
		  $this->load->view('container',$data);
	}
}

/* End of file error.php */
/* Location: ./system/application/controllers/error.php */