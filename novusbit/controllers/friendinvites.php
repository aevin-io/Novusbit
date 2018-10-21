
<?php
class Friendinvites extends CI_Controller
{
    function __construct()
	{
		parent::__construct(); //changed parent constructor name
		
	}
    public function index() {
		try {
		$friends = $this->fetch_fb_friends();
        $this->load->view('friendinvites/friendinvites_view.php', array('friends'=>$friends));
        } catch ( exception $e ){
	       $this->load->view('friendinvites/fb_native_invite.php');
	      
        }
    }
    public function fetch_fb_friends(){
		$this->load->library('fb_connect');
		
		
		$adp = $this->rb->toolbox->getDatabaseAdapter();
		
		$fbuid = substr( $this->session->userdata( 'fb_uid' ), 3);

		$sql = "SELECT * FROM facebook_friends_cache WHERE user_fb_id = " . $fbuid;
		
		$res = $adp->get( $sql );

		if(count($res) > 0) {
			$friends = array();
			foreach($res as $friend) {
				$arr = array('id' => $friend['friend_fb_id'], 'name'=> $friend['friend_name'], 'invited' => $friend['invited']);
				$friends[] = $arr;
			}
			usort($friends, "_sort");
			return $friends;
		} else {
			$friends =  $this->fb_connect->fb->api('/me/friends');
			$this->_store_fb_friends($this->fb_connect->user_id, $friends['data']);
			usort($friends['data'], "_sort");
			//return $friends['data'];
			redirect('friendinvites');
		}
    }
	public function refresh_fb_friendlist() {
		$this->load->library('fb_connect');
		$adp = $this->rb->toolbox->getDatabaseAdapter();
		$fbuid = substr( $this->session->userdata( 'fb_uid' ), 3);
		$sql = "DELETE FROM `facebook_friends_cache` WHERE `user_fb_id` = " . $fbuid;
		$res = $adp->get( $sql );
		redirect('friendinvites');
	}
	private function _store_fb_friends($fb_id, $friends) {
		$adp = $this->rb->toolbox->getDatabaseAdapter();
		foreach($friends as $friend) {
			$sql = "SELECT `id` FROM `facebook_friends_cache` WHERE `user_fb_id` = " . $fb_id . " AND `friend_fb_id` = " . intval($friend['id']);
			$bean = $this->rb->load( "facebook_friends_cache", $adp->getRow( $sql ));
			$bean->user_fb_id = $fb_id;
			$bean->friend_fb_id = $friend['id'];
			$bean->friend_name = $friend['name'];
			$bean->invited ="N";
			$this->rb->store( $bean );

		}
	}
	public function store_invite($fb_id){
		$this->load->library('fb_connect');
		$adp = $this->rb->toolbox->getDatabaseAdapter();
		$sql = "UPDATE `facebook_friends_cache` SET `invited` = 'Y' WHERE `user_fb_id` = " . $this->fb_connect->user_id . " AND `friend_fb_id` = " .$fb_id;
		//echo $sql;
		$res = $adp->get( $sql );
		
		$this->index();
	}
}

function _sort($a, $b)
{
    if ($a['name'] == $b['name']) {
        return 0;
    }
    return ($a['name'] < $b['name']) ? -1 : 1;
}
