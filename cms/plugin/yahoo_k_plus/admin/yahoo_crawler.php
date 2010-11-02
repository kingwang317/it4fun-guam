<?php
class ykpCrawler {
 
	protected $markup = '';
	private $ansUrl = "http://tw.knowledge.yahooapis.com/v1/QACK/answer/";
	private $quesUrl = "http://tw.knowledge.yahooapis.com/v1/QACK/question/";
	private $appid = "xyLJGNrV34H6aZOlcrj4Kd4YBeHhwALJkoHQzi8S1PqZls38JNwuvC1l3wbO_rsHXYA-";

  public function __construct($qid,$getType) {
		$this->markup = $this->getMarkup($qid,$getType);
  }
 
  public function getMarkup($qid,$getType) {

	if($getType == "answer")
		return @simplexml_load_file($this->ansUrl . $qid . '?appid=' . $this->appid);
	else
		return @simplexml_load_file($this->quesUrl . $qid . '?appid=' . $this->appid);
  }

  public function get($type) {
    $method = "_get_{$type}";
    if (method_exists($this, $method)){
      return call_user_method($method, $this);
    }
  }
 
  protected function _get_reply_time() {
    if (!empty($this->markup)){
	$last_time = "";
	foreach($this->markup->OtherAnswer as $oa){
		$last_time = $oa->ReplyDate;
	}
	return (string)$last_time;

    }
  }
  protected function _get_title() {
    if (!empty($this->markup)){
	  return (string)$this->markup->Subject;
    }
  }
  protected function _get_post_time() {
    if (!empty($this->markup)){
	  return (string)$this->markup->AskDate;
    }
  }
}
?>