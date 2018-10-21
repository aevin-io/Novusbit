<?php

class Novus_Model extends CI_Model
{	
	// Novus initialization functions
	
	public function get_novus_by_key( $id )
	{
		$novus_bean = $this->rb->load( 'novus', $id );
		
		if( $novus_bean-> id != 0 )
		{
			$this->find_author( $novus_bean );
			// $this->find_comments( $novus_bean );
			$novus_bean->appreciations   = $this->count_my_appreciations( $id );
			$novus_bean->num_of_bits     = $this->count_my_bits( $id );
			$novus_bean->category_title  = $this->find_my_category( $id );
			$novus_bean->type_title  = $this->find_my_type( $id );
			
			return $novus_bean;
		}		
	}
	
	// Creation..
	
	public function create_novus( $image_data )
	{
		
			$title    = $_POST['title'];
			$desc     = $_POST['description'];
			$sandbox  = $_POST['sandbox'];
			$category = $_POST['category'];
			$type	  = $_POST['type'];
			$visibility  = $_POST['visibility'];
			$tags = $_POST['tag'];
			$filename = $image_data['file_name'];
			
			$novus_bean              = $this->rb->dispense( 'novus' );
			$novus_bean->title       = $title;
			$novus_bean->description = $desc;
			$novus_bean->sandbox     = $sandbox;
			$novus_bean->cover_image = $filename;
			$novus_bean->category_id = $category;
			$novus_bean->type_id 	 = $type;
			
			
			
			if($visibility != 'public')
			{
				$novus_bean->restricted	  = 'Y';
				$visibility_bean          = $this->rb->dispense( 'visibility' );
				$visibility_bean->author  = $visibility ;
				$a = new RedBean_AssociationManager( $this->rb->toolbox );
				$a->associate(  $novus_bean, $visibility_bean );
			}
			else
				$novus_bean->restricted	 = 'N';
			
			$novus_bean->dateposted  = mdate( "%Y-%m-%d %h:%i:%s", time() );
			$this->rb->store( $novus_bean );
			
			$t = new RedBean_TagManager( $this->rb->toolbox );
			$t->tag( $novus_bean, $tags );
			
			$userid = $this->session->userdata( 'user_id' );
		$author = $this->rb->load( 'author', $userid );
		$this->novus_model->assign_author( $author, $novus_bean ); 			// Relate the novus to an author
		
			return $novus_bean;
		
	}
	/*
	public function create_comment()
	{
		
			$comment_bean             = $this->rb->dispense( 'comments' );
			$comment_bean->body       = $_POST['comment'];
			$comment_bean->dateposted = mdate( "%Y-%m-%d %h:%i:%s", time() );			
			$this->rb->store( $comment_bean );
			
			return $comment_bean;
		
	}*/
	
	// Assignment functions
	
	public function assign_author( $author_bean, $novus_bean )
	{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			$a->associate( $author_bean, $novus_bean );
		
	}
	public function unassign_author( $author_bean, $novus_bean )
	{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			$a->unassociate( $author_bean, $novus_bean );
		
	}
	
	public function assign_comment_author( $author_bean, $comment_bean )
	{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			$a->associate( $author_bean, $comment_bean );
		
	}
	
	public function append_comment( $comment_bean, $curnvs )
	{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			$a->associate( $curnvs, $comment_bean );
		
		
	}
	
	public function append_bit( $bit_bean, $novus_bean )
	{
		
			$rb        = $this->rb;
			$ea        = new RedBean_ExtAssociationManager( $rb->toolbox );
			$position  = $rb->dispense( "position" );
			$position->number = 1; // $c + 1;
			$ea->extAssociate( $novus_bean, $bit_bean, $position );
		
	}
	
	public function remove_bit( $bid, $nid )
	{
		
		$bit_bean 	= $this->rb->load( 'bits', $bid );
		$novus_bean 	= $this->rb->load( 'novus', $nid );
		
		if( $novus_bean -> id != 0 && $bit_bean -> id != 0 )
		{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			
			// Unassociate the Bit from the Novus.
			
			$a->unassociate( $bit_bean, $novus_bean );
			
			// Find the associated author of the bit.
			
			$author_arr = ( $this->rb->batch( "author", $a->related( $bit_bean, "author" ) ) );
			$a->unassociate( $bit_bean, get_bean( $author_arr ) );
			
			// Finally delete the Bit record from the database.
			
			$this->rb->trash( $bit_bean );
		}
	}
	
	public function remove_novus( $novus_bean )
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		
		/*
		 * Find the Novus' related Author and unassociate him
		 */
		
		$author_arr = ( $this->rb->batch( "author", $a->related( $novus_bean, "author" ) ) );
		
		$a->unassociate( $novus_bean, get_bean( $author_arr ) );
		
		
		/*
		 * Find the Novus' related Visibility settings
		 */
		
		$visibility_arr = ( $this->rb->batch( "visibility", $a->related( $novus_bean, "visibility" ) ) );
		if(!empty($visibility_arr)){
		$a->unassociate( $novus_bean, get_bean( $visibility_arr ) );
		
		$this->rb->trash( get_bean( $visibility_arr ) );
		}
		
		/*
		 * Find all Novus' related Comments
		 */
		/*
				$related_comments_arr = ( $this->rb->batch( "comments", $a->related( $novus_bean, "comments" ) ) );
		
		foreach ( $related_comments_arr as $onecomment )
		{
			$a->unassociate( $onecomment, $novus_bean );
			
			$related_auth = ( $this->rb->batch( "author", $a->related( $onecomment, "author" ) ) );
			
			$a->unassociate( $onecomment, get_bean( $related_auth ) );
			
			$this->rb->trash( $onecomment );
		}
		*/
		
		/*
		 * Find all Novus' related Bits
		 */
		
		$bits_arr = ( $this->rb->batch( "bits", $a->related( $novus_bean, "bits" ) ) );
		$bit_ret  = array();
		
		foreach ( $bits_arr as $onebit )
		{
			// Unassociated each related Bit
			
			$a->unassociate( $onebit, $novus_bean );
			
			// Find the author of each bit and unassociated them.
			
			$related_auth = ( $this->rb->batch( "author", $a->related( $onebit, "author" ) ) );
			
			$a->unassociate( $onebit, get_bean( $related_auth ) );
			
			// Finally delete this bit from the database.
			
			$this->rb->trash( $onebit );
		}
		
		// Finally, delete the Novus record from the database.
		$tmp = $novus_bean->export();
		
		
			unlink( './uploads/novus/' . $tmp['cover_image'] );
		
		
		$this->rb->trash( $novus_bean );
	}
	
	function find_my_category( $novus_id )
	{
		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$cattitle = $a->getRow( "SELECT novus_category.title AS title FROM novus,novus_category where novus.id = " . $novus_id. " AND novus.category_id = novus_category.id" );
			return $cattitle['title'];
		
		
	}
	
	function find_my_type( $novus_id )
	{
		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$type_title = $a->getRow( "SELECT novus_type.title AS title FROM novus,novus_type where novus.id = " . $novus_id. " AND novus.type_id = novus_type.id" );
			return $type_title['title'];
		
		
	}
	
	function count_my_appreciations( $novus_id )
	{
		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$likes = $a->getRow( "SELECT count(*) AS likes FROM novus_appreciations where novus_id = " . $novus_id );
			return $likes['likes'];
		
		
	}
	/*
	function count_my_comments( $novus_id )
	{
		
			$a     = $this->rb->toolbox->getDatabaseAdapter();
			$likes = $a->getRow( "SELECT count(*) AS num_of_comments FROM comments_novus where novus_id = " . $novus_id );
			return $likes['num_of_comments'];
		
		
	}
	*/
	
	function count_my_bits( $novus_id )
	{
		
			$a     = $this->rb->toolbox->getDatabaseAdapter();
			$likes = $a->getRow( "SELECT count(*) AS num_of_bits FROM bits_novus where novus_id = " . $novus_id );
			return $likes['num_of_bits'];
		
		
	}
	
	function my_last_bit_count( $novus_id )
	{
		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$lbc = $a->getRow( "SELECT novus.last_bit_count AS last_bit_count FROM novus where novus.id = " . $novus_id );
			return $lbc['last_bit_count'];
		
		
	}
	
	// Finding functions
	
	public function get_novus( $order = null, $category = null, $type = null, $pageno = null, $authorusername = null )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
		
		$order_condition 	= '';		
		$cat_condition 		= '';
		$type_condition 	= '';
		$recent_type_condition 	= '';
		$author_condition 	= '';

		$sql = "SELECT SQL_CALC_FOUND_ROWS novus.*,
				novus.*,";
		if($order != null && $order =="RECENT_BITS")		
			$sql .= "MAX( bits.dateposted ) as bits_dateposted, ";		
			
			$sql .= 	
			       "
				( SELECT count(*)        FROM novus_appreciations   	WHERE novus_appreciations.novus_id = novus.id ) 	AS appreciations,
				( SELECT count(*)        FROM bits_novus 	    	WHERE bits_novus.novus_id = novus.id ) 			AS num_of_bits,
				( SELECT novus_category.title  FROM novus_category  	WHERE novus.category_id = novus_category.id ) 		AS category_title,
				( SELECT novus_type.title  FROM novus_type  	    	WHERE novus.type_id = novus_type.id ) 			AS type_title,
				( SELECT author.username FROM author, author_novus  	WHERE author.id = author_novus.author_id AND author_novus.novus_id = novus.id ) AS author
			FROM
				novus ";
				
		if($authorusername != null)
			$author_condition = ", author, author_novus  	WHERE author.id = author_novus.author_id AND author_novus.novus_id = novus.id AND author.username ='". $authorusername. "' ";
		
		$sql .= $author_condition;
		
		
		if($category != null && $category != "All")
			$cat_condition = ", novus_category WHERE novus.category_id = novus_category.id AND novus_category.title = '". $category. " ' ";
		
		$sql .= $cat_condition;
		
		if($type != null && $type != "All")
			$type_condition = ", novus_type WHERE novus.type_id = novus_type.id AND novus_type.title = '". $type. " ' ";
		
		$sql .= $type_condition;
		
		
		if($order != null && $order =="RECENT_BITS")
			$recent_type_condition = ", bits, bits_novus WHERE bits_novus.novus_id = novus.id AND bits_novus.bits_id = bits.id";
		
		$sql .= $recent_type_condition;
		
		$sql .= " GROUP BY novus.id ";
		
		switch ( $order ) {
			default:
			    $order_condition = '';
			    break;
			case "ALL":
			    $order_condition = '';
			    break;			
			case "NEW_FIRST":
			    $order_condition = 'ORDER BY novus.dateposted DESC'; 
			    break;
			case "RECENT_BITS":
			    $order_condition = 'ORDER BY bits_dateposted DESC'; // done by isotope too
			    break;
			case "OLD_FIRST":
			    $order_condition = 'ORDER BY novus.dateposted ASC'; // used in welcome
			    break;
			case "CATEGORY":
			    $order_condition = 'ORDER BY novus.category_id ASC'; // done by the category panel
			    break;
			case "BITS":
			    $order_condition = 'ORDER BY num_of_bits DESC'; // done by isotope too
			    break;
			case "APPRECIATIONS":
			    $order_condition = 'ORDER BY appreciations ASC'; // done by isotope too 
			    break;
		}
		
		$sql .= $order_condition;
		
		//echo $sql;
		/*
		if($rightlimit != null && $leftlimit === null){
			
			$limit_condition = " LIMIT 0,". $rightlimit;
			$sql .= $limit_condition;
		}
		*/
		
		if($pageno != null){
			$rows_per_page = 8;
			
			$limit = ' LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
			$sql .= $limit;
		}
		
		
		
		$a = $this->rb->toolbox->getDatabaseAdapter();
		
		
		
		$allnovus_arr = $a->get($sql);
		$sql_found_rows = "SELECT FOUND_ROWS() as how_many_records";
		$sql_found_rows_arr = $a->getRow($sql_found_rows);
		$allnovus_arr['how_many_records']= $sql_found_rows_arr['how_many_records'];
		
		
		
		$allnovus_arr['how_many_pages'] = ceil( $allnovus_arr['how_many_records'] / 8 );
		 
		 
				
		
		return $allnovus_arr;
		
		
		
	}
	
	public function find_author( $novus )
	{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			$author_arr = ( $this->rb->batch( "author", $a->related( $novus, "author" ) ) );
			foreach( $author_arr as $author )
			{
				$tmp = $author->export();
				
				$novus->author = $tmp['username'];
				$novus->author_img = $tmp['picture'];
				$novus->author_id = $tmp['id'];
				$novus->author_email = $tmp['email'];

				
				
				
				//$auth_bean =  get_bean( $author_arr );
				$related_fb_user = ( $this->rb->batch( "user", $a->related($author, "user" ) ) );
				
					$fb_user = get_bean( $related_fb_user );
				
				
				if( !empty( $fb_user ) ){
				    $fb_user = $fb_user->export();
				    $uid = str_replace( 'fb:', '', $fb_user['user_id'] );
				    $novus->fb_user 	= "yes";
				    $novus->fb_uid 	= $uid ;
				}
			}
			
			
			
			
			
			
			
			
	}
	/*
	public function find_comments( $novus )
	{
		
			$a = new RedBean_AssociationManager( $this->rb->toolbox );
			$related_comments_arr = ( $this->rb->batch( "comments", $a->related( $novus, "comments" ) ) );
			
			foreach ( $related_comments_arr as $onecomment )
			{
				$related_auth = ( $this->rb->batch( "author", $a->related( $onecomment, "author" ) ) );
				$onecomment->author = get_bean($related_auth)->export();
			}
			
			$novus->comments = $related_comments_arr;
		
	}
	*/
	
	public function get_novus_id_of_bit( $bit_bean )
	{
		
		
			$opened_bean = $bit_bean->export();
			$a           = $this->rb->toolbox->getDatabaseAdapter();
			$key         = $a->getCol( "SELECT novus_id FROM bits_novus WHERE bits_id = " . $opened_bean['id'] );
			if( !empty( $key[0]) )
			return $key[0];
			else
			return;
		
	}
	
	
	public function update_novus( $id )
	{
		$novus_bean = $this->rb->load( 'novus', $id );
		
		if( $novus_bean -> id != 0 )
		{	
			$title    = $_POST['title'];
			$desc     = $_POST['description'];
			$sandbox  = $_POST['sandbox'];
			$category = $_POST['category'];
			$type 	  = $_POST['type'];
			
			//$filename = $image_data['file_name'];
				
				
			$novus_bean->title       = $title;
			$novus_bean->description = $desc;
			$novus_bean->sandbox     = $sandbox;
			$novus_bean->category_id = $category;
			$novus_bean->type_id 	 = $type;
			//$novus_bean -> cover_image = $filename;
			//$novus_bean -> dateposted = mdate("%Y-%m-%d %h:%i:%s", time());
				
			$this->rb->store( $novus_bean );
		}
	}
	
	public function appreciate( $novus_id )
	{
		
			$appr_bean             = $this->rb->dispense( 'novus_appreciations' );
			$appr_bean->novus_id   = $novus_id;
			$appr_bean->author_id  = $this->session->userdata( 'user_id' );
			$appr_bean->last_bit_count = $this->count_my_bits( $novus_id );
			$appr_bean->dateposted = mdate( "%Y-%m-%d %h:%i:%s", time() );
			
			$this->rb->store( $appr_bean );
		
	}
	
		
	public function unappreciate( $novus_id )
	{
	

		
		$a = $this->rb->toolbox->getDatabaseAdapter();
		
		
		$apnovuses = $a->getRow( "DELETE
											    FROM
												novus_appreciations
											    WHERE
												novus_appreciations.novus_id = " . $novus_id . "
											    AND
												novus_appreciations.author_id = " .  $this->session->userdata( 'user_id' ) ) ;
		//if(empty($apnovuses))
		//return;
		print_r($apnovuses);
		
		$this->rb->trash( get_bean( $apnovuses ) );
		
		
	}
		 
		 
		 
	
	
	public function increase_views($novus_id)
	{
		
			$novus_bean = $this->rb->load( 'novus', $novus_id );
			if( $novus_bean -> id != 0 )
			{
				$novus_bean -> views ++;
				$this -> rb -> store( $novus_bean );
			}
		
	}
	
	public function reset_lastbitcount( $novus_id )
	{	
		$a = $this->rb->toolbox->getDatabaseAdapter();
			
		$appnovuses = ( $this->rb->batch( "novus_appreciations", $a->getCol( "SELECT
												id
											    FROM
												novus_appreciations
											    WHERE
												novus_id = " . $novus_id . "
											    AND
												author_id = " .  $this->session->userdata( 'user_id' ) ) ) );
		if(empty($appnovuses))
		return;
	
		$appreciation = get_bean( $appnovuses );
		//echo $this->count_my_bits( $novus_id );
		$appreciation->last_bit_count = $this->count_my_bits( $novus_id );
		$this->rb->store( $appreciation );
		
	}
	
	public function reset_lastbitcount_my ( $novus_id )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
			
		$novuses = ( $this->rb->batch( "novus", $a->getCol( "SELECT
												novus.id
											    FROM
												novus, author_novus
											    WHERE
												novus.id = " . $novus_id . "
											    AND
												author_novus.novus_id = " . $novus_id . "
											    AND
												author_novus.author_id = " .  $this->session->userdata( 'user_id' ) ) ) );
		if(empty($novuses))
		return;
		$appreciation = get_bean( $novuses );
		
		$appreciation->last_bit_count = $this->count_my_bits( $novus_id );
		$this->rb->store( $appreciation );
		
	}
	
	public function get_categories()
	{
		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$sql = "SELECT
					novus_category.*,
					( SELECT COUNT(*) FROM novus WHERE novus.category_id = novus_category.id ) as how_many
				FROM novus_category
				WHERE active = 'Y'
				ORDER BY priority ASC";
			$allcat_arr = $a->get( $sql ) ;

			return $allcat_arr;
		
		
	}
	
	public function get_types(){
		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$sql = "SELECT
					novus_type.*,
					( SELECT COUNT(*) FROM novus WHERE novus.type_id = novus_type.id ) as how_many
				FROM novus_type
				";
			$allcat_arr = $a->get( $sql ) ;

			return $allcat_arr;
		
	}
	
	public function broadcast(){
			$story_id = $_POST['story_id'];
			$user_id = $_POST['user_id'];
			$status = $_POST['status'];
			
			$rows = array();
			
			
			if($status=='3'){
				$query = $this->db->query("DELETE FROM broadcasting WHERE user_id=$user_id AND story_id=$story_id");
			    }
			    else{
				$result = $query = $this->db->query("SELECT last_typed FROM broadcasting WHERE story_id=$story_id AND user_id=$user_id");
				if($result->num_rows() >0){
				    //akoma grafei autos, kanoume update to timestamp kai to status
				    $query = $this->db->query("UPDATE broadcasting SET last_typed=NOW(),status=$status WHERE story_id=$story_id AND user_id=$user_id");
				}
				else{
				    //molis ksekinhse na grafei
				    $query = $this->db->query("INSERT INTO broadcasting(story_id,user_id,last_typed,status) VALUES($story_id,$user_id,NOW(),1)");
				}
		    
				$result =  $this->db->query("SELECT last_typed FROM broadcasting WHERE story_id=$story_id GROUP BY user_id");
				$result1 =  $this->db->query("SELECT last_typed FROM broadcasting WHERE story_id=$story_id AND status=1 GROUP BY user_id");
		
		
				//mysql_close($conn);
		    
				//return json_encode($rows);
		    
				if($result->num_rows()>1){
				    echo $result->num_rows() . " user(s) typing on same story(".( $result->num_rows()- $result1->num_rows() )." Idle)...";
				}
				else{
				    echo "you are the only one typing here.";
				}
			    }
			
			
	}
	
	public function getTags(){
				$a = $this->rb->toolbox->getDatabaseAdapter();
				$sql = "SELECT	tag.title,
						(SELECT COUNT(*) FROM novus_tag	WHERE tag.id = novus_tag.tag_id GROUP BY novus_tag.tag_id ) as freq
					FROM tag
					ORDER BY freq DESC";
					
				$arr = $a->get( $sql ) ;
				$ret = $this->array2json($arr);
				$ret = str_replace( '"title"', 'tag', $ret );
				$ret = str_replace( '"freq"', 'freq', $ret );
				return $ret;
		}

		public function conclude_next_previous( $id )
		{
			$sqlroot = "SELECT id as id, title as t FROM novus ";
			$sql_next = $sql_prev = "";
			
			$a = $this->rb->toolbox->getDatabaseAdapter();
			
			$sql_next .= $sqlroot."WHERE id < ".$id." ORDER BY id DESC LIMIT 1";

			if( ! $data['nextnovus_title'] = $a->getRow( $sql_next ) )		// if we were in the last record already...
			{
				$sql_next = "";
				$sql_next .= $sqlroot."ORDER BY id DESC LIMIT 1";
				$data['nextnovus_title'] = $a->getRow($sql_next);
			}
			
			$sql_prev .= $sqlroot."WHERE id > ".$id." ORDER BY id ASC LIMIT 1";

			if( ! $data['previousnovus_title'] = $a->getRow( $sql_prev ) )	// if we were in the last record already...
			{
				$sql_prev = "";
				$sql_prev .= $sqlroot."ORDER BY id ASC LIMIT 1";
				$data['previousnovus_title'] = $a->getRow( $sql_prev );
			}
			
			return $data;
		}
		
	public function array2json($arr) { 
	    //if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality. 
	    $parts = array(); 
	    $is_list = false; 
	
	    //Find out if the given array is a numerical array 
	    $keys = array_keys($arr); 
	    $max_length = count($arr)-1; 
	    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1 
		$is_list = true; 
		for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
		    if($i != $keys[$i]) { //A key fails at position check. 
			$is_list = false; //It is an associative array. 
			break; 
		    } 
		} 
	    } 
	
	    foreach($arr as $key=>$value) { 
		if(is_array($value)) { //Custom handling for arrays 
		    if($is_list) $parts[] = $this->array2json($value); /* :RECURSION: */ 
		    else $parts[] = '"' . $key . '":' . $this->array2json($value); /* :RECURSION: */ 
		} else { 
		    $str = ''; 
		    if(!$is_list) $str = '"' . $key . '":'; 
	
		    //Custom handling for multiple data types 
		    if(is_numeric($value)) $str .= $value; //Numbers 
		    elseif($value === false) $str .= 'false'; //The booleans 
		    elseif($value === true) $str .= 'true'; 
		    else $str .= '"' . addslashes($value) . '"'; //All other things 
		    // :TODO: Is there any more datatype we should be in the lookout for? (Object?) 
	
		    $parts[] = $str; 
		} 
	    } 
	    $json = implode(',',$parts); 
	     
	    if($is_list) return '[' . $json . ']';//Return numerical JSON 
	    return '{' . $json . '}';//Return associative JSON 
	} 
}