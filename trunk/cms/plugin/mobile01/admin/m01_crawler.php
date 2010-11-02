<?php
class m01Crawler {
 
  protected $markup = '';
 
  public function __construct($uri,$getType=null) {
    $this->markup = $this->getMarkup($uri); 
  }
 
  public function getMarkup($uri) {
	$ch = curl_init();
	$options = array(
		CURLOPT_URL => $uri,
		CURLOPT_HEADER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERAGENT => "Google Bot",
		CURLOPT_FOLLOWLOCATION => true
	);
	curl_setopt_array($ch, $options);
	$output = curl_exec($ch);
	curl_close($ch);
    return $output;  
  }

  public function get($type) {
    $method = "_get_{$type}";
    if (method_exists($this, $method)){
      return call_user_method($method, $this);
    }
  }
 
  protected function _get_link_id() {
    if (!empty($this->markup)){
	$final_link = "";
    preg_match_all('/<a href="topicdetail.php([^>]+)\>(.*?)\<\/a\>/i', $this->markup, $links); 
	@$final_link = explode("p=",$links[1][count($links[1])-1]);
	@$final_link = str_replace('" class="page"',"",$final_link[1]);
	  return !empty($links[1]) ? $final_link : FALSE;
    }
  }
  protected function _get_reply_time() {
    if (!empty($this->markup)){
	$last_time = "";
	preg_match_all('/<div class="user_info(.*?)\>([^>]+)\<\/div\>/i', $this->markup, $links);
	@$last_time = explode("<br />",$links[1][count($links[1])-1]);	
	@$last_time = str_replace("<br /","",explode(": ",$last_time[3]));
	  return !empty($last_time) ? $last_time[1] : FALSE;
    }
  }
  protected function _get_post_time() {
    if (!empty($this->markup)){
	$post_time = "";
	preg_match_all('/<div class="user_info(.*?)\>([^>]+)\<\/div\>/i', $this->markup, $links);
	@$post_time = explode("<br />",$links[1][0]);
	@$post_time = explode(": ",$post_time[3]);
	  return !empty($post_time) ? $post_time[1] : FALSE;
    }
  }
  protected function _get_title() {
    if (!empty($this->markup)){
	  preg_match_all('/<title\>([^>]+)\<\/title\>/i', $this->markup, $links);
	  return !empty($links[1]) ? $links[1][0] : FALSE;
    }
  }
}
?>