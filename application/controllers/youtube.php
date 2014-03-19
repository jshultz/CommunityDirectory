<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Youtube extends Controller
{
	public $layout="default";

	function __construct()
	{
		parent::Controller();
		$this->load->library("zend");
		$this->zend->load("Zend/Gdata/YouTube");

		$youtube = new Zend_Gdata_YouTube();
		$this->lang->load("resource");
		$this->load->helper("text");
	}

	function index()
	{

		//$youtube = new Zend_Gdata_YouTube();

		//Grab Video data
		$videoEntry = $youtube->getVideoEntry('video_code');

		//Grab Channel data
		$this->getAndPrintUserUploads("youtube_channel_name");

		$this->load->view('youtube_view', $data);
	}

	function getAndPrintUserUploads($userName)
	{
		  $youtube = new Zend_Gdata_YouTube();
		  $youtube->setMajorProtocolVersion(2);
		  $this->printVideoFeed($youtube->getuserUploads($userName),$page=1,$page_counter=1);
	}  

	function printVideoFeed($videoFeed)
	{
		  $data['no_sidebar'] = true;
		  $count = 1;

		  foreach ($videoFeed as $videoEntry)
		  {

				//$this->printVideoEntry($videoEntry);
				$video_info[$count]['title'] = $videoEntry->getVideoTitle();
				$video_info[$count]['id']    = $videoEntry->getVideoId();
				$video_info[$count]['desc']  = $videoEntry->getVideoDescription();
				$video_info[$count]['tags']  = implode(", ", $videoEntry->getVideoTags());
				$video_info[$count]['updated']  = $videoEntry->getUpdated();
				$video_info[$count]['category']  = $videoEntry->getVideoCategory();				

				$count++;
		  }
		//pre($video_info);

		$data['video_info'] = $video_info;
		$this->load->view("resources/youtube_list_view",$data);
	}

	function printVideoEntry($videoEntry)
	{
	  // the videoEntry object contains many helper functions
	  // that access the underlying mediaGroup object
	  echo 'Video: ' . $videoEntry->getVideoTitle() . "<br>";
	  echo 'Video ID: ' . $videoEntry->getVideoId() . "<br>";
	  echo 'Updated: ' . $videoEntry->getUpdated() . "<br>";
	  echo 'Description: ' . $videoEntry->getVideoDescription() . "<br>";
	  echo 'Category: ' . $videoEntry->getVideoCategory() . "<br>";
	  echo 'Tags: ' . implode(", ", $videoEntry->getVideoTags()) . "<br>";
	  echo 'Watch page: ' . $videoEntry->getVideoWatchPageUrl() . "<br>";
	  echo 'Flash Player Url: ' . $videoEntry->getFlashPlayerUrl() . "<br>";
	  echo 'Duration: ' . $videoEntry->getVideoDuration() . "<br>";
	  echo 'View count: ' . $videoEntry->getVideoViewCount() . "<br>";
	  echo 'Rating: ' . $videoEntry->getVideoRatingInfo() . "<br>";
	  echo 'Geo Location: ' . $videoEntry->getVideoGeoLocation() . "<br>";
	  echo 'Recorded on: ' . $videoEntry->getVideoRecorded() . "<br>";

	  // see the paragraph above this function for more information on the
	  // 'mediaGroup' object. in the following code, we use the mediaGroup
	  // object directly to retrieve its 'Mobile RSTP link' child
	  foreach ($videoEntry->mediaGroup->content as $content) {
		if ($content->type === "video/3gpp") {
		  echo 'Mobile RTSP link: ' . $content->url . "<br>";
		}
	  }

  echo "Thumbnails:<br>";
  $videoThumbnails = $videoEntry->getVideoThumbnails();

		  foreach($videoThumbnails as $videoThumbnail) {
			echo $videoThumbnail['time'] . ' - ' . $videoThumbnail['url'];
			echo ' height=' . $videoThumbnail['height'];
			echo ' width=' . $videoThumbnail['width'] . "<br>";
		  }
	}

}

?>
