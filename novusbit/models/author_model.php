<?php

class Author_Model extends CI_Model
{
	public $author;
	/*
	public function create_unregistered_user( $alias, $email )
	{
		$author_bean             = $this->rb->dispense( 'author' );
		$author_bean->username   = $alias;
		$author_bean->email      = $email;
		$author_bean->registered = 'N';
		$this->rb->store( $author_bean );
		return $author_bean;
	}
	*/
	
	public function search( $query )
	{
	}
	
	
	public function get_author_by_username( $author_username )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
		$author_bean_arr = ( $this->rb->batch( "author", $a->getCol( "select * from author where username = '" . $author_username . "'" ) ) );
		
		if(empty($author_bean_arr)) return FALSE;
		
		
		$this->author = get_bean( $author_bean_arr );
		$this->author->appreciations_count 	= $this->count_my_appreciations();
		$this->author->novus_count 		= $this->count_my_novus();
		$this->author->bits_count 		= $this->count_my_bits();
		$this->author->watching_who_count 	= $this->count_watching_who();
		$this->author->watched_by_count 	= $this->count_watched_by();
		$this->author->received_appreciations 	= $this->received_appreciations();
		$this->author->received_likes 		= $this->received_likes();
		$this->author->my_friends		= $this->find_my_friends();
		
		if ( $this->author->registered == 'N' )
			return FALSE;
		
		//$a = new RedBean_AssociationManager( $this->rb->toolbox );  
		//$related_fb_user =  $this->rb->batch( "user", $this->author->id ) ;
		
		//$fb_user = get_bean( $related_fb_user );
		$current_auth = $this->author->export();
		$cur_id = $current_auth['id'];
		
		$a       = new RedBean_AssociationManager( $this->rb->toolbox );
		$adp     = $this->rb->toolbox->getDatabaseAdapter();
		
		$sql     = "SELECT
				user.*
			    FROM
				user, author_user, author
			    WHERE
				user.id = author_user.user_id
			    AND
				author.id = author_user.author_id
			    AND
				author.id = ".$cur_id;
				

		$fb_user = $adp->getRow( $sql );

		if( !empty( $fb_user ) ){

		    $uid = str_replace( 'fb:', '', $fb_user['user_id'] );
		    $this->author->fb_user 	= "yes";
		    $this->author->fb_uid 	= $uid ;
		    
		}
		
		    
		return $this->author;
	}
	
	
	public function get_author_by_username_lite( $author_username )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
		$author_bean_arr = ( $this->rb->batch( "author", $a->getCol( "select * from author where username = '" . $author_username . "'" ) ) );
		
		if(empty($author_bean_arr)) return FALSE;
		
		$this->author = get_bean( $author_bean_arr );
		/*
		$this->author->appreciations_count 	= $this->count_my_appreciations();
		$this->author->novus_count 		= $this->count_my_novus();
		$this->author->bits_count 		= $this->count_my_bits();
		$this->author->watching_who_count 	= $this->count_watching_who();
		$this->author->watched_by_count 	= $this->count_watched_by();
		$this->author->received_appreciations 	= $this->received_appreciations();
		$this->author->received_likes 		= $this->received_likes();
		$this->author->my_friends		= $this->find_my_friends();
		*/
		if ( $this->author->registered == 'N' )
			return FALSE;
		
		//$a = new RedBean_AssociationManager( $this->rb->toolbox );  
		//$related_fb_user =  $this->rb->batch( "user", $this->author->id ) ;
		
		//$fb_user = get_bean( $related_fb_user );
		$current_auth = $this->author->export();
		$cur_id = $current_auth['id'];
		
		$a       = new RedBean_AssociationManager( $this->rb->toolbox );
		$adp     = $this->rb->toolbox->getDatabaseAdapter();
		
		$sql     = "SELECT
				user.*
			    FROM
				user, author_user, author
			    WHERE
				user.id = author_user.user_id
			    AND
				author.id = author_user.author_id
			    AND
				author.id = ".$cur_id;
				

		$fb_user = $adp->getRow( $sql );

		if( !empty( $fb_user ) ){

		    $uid = str_replace( 'fb:', '', $fb_user['user_id'] );
		    $this->author->fb_user 	= "yes";
		    $this->author->fb_uid 	= $uid ;
		    
		}
		
		    
		return $this->author;
	}
	
	public function received_appreciations()
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$adpt = $this->rb->toolbox->getDatabaseAdapter();
		$related_novus_arr = ( $this->rb->batch( "novus", $a->related( $this->author, "novus" ) ) );
		
		$total_appreciations = 0;
		
		foreach ( $related_novus_arr as $novus_bean )
		{
			$appreciations = $adpt->getRow( "SELECT count(*) AS appreciations
							    FROM novus_appreciations
							    WHERE
							    novus_appreciations.novus_id = " . $novus_bean->id ."
							    GROUP BY novus_appreciations.novus_id");
		
						
			$total_appreciations += $appreciations[ 'appreciations' ];
		}
		
		return $total_appreciations;
	}
	
	public function received_likes()
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$adpt = $this->rb->toolbox->getDatabaseAdapter();
		$related_novus_arr = ( $this->rb->batch( "novus", $a->related( $this->author, "novus" ) ) );
		
		$total_likes = 0;
		
		foreach ( $related_novus_arr as $novus_bean )
		{
			$likes = $adpt->getRow( "SELECT count(*) AS likes
							    FROM bit_likes
							    WHERE
							    bit_likes.novus_id = " . $novus_bean->id ."
							    GROUP BY bit_likes.novus_id");
		
						
			$total_likes += $likes[ 'likes' ];
		}
		
		return $total_likes;
	}
	
	function count_my_appreciations()
	{		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$likes = $a->getRow( "SELECT count(*) AS likes
						FROM novus, novus_appreciations
						WHERE
						novus_appreciations.author_id = " . $this->author->id .
						" AND novus_appreciations.novus_id = novus.id" );
			return $likes['likes'];			
	}
	
	function count_my_bits()
	{		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$howmany = $a->getRow( "SELECT count(*) AS howmany
						FROM author_bits, bits
						WHERE
						author_bits.author_id = " . $this->author->id .
						" AND author_bits.bits_id = bits.id" );
			return $howmany['howmany'];			
	}
	
	function count_my_novus()
	{		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$howmany = $a->getRow( "SELECT count(*) AS howmany
						FROM author_novus, novus
						WHERE
						author_novus.author_id = " . $this->author->id .
						" AND author_novus.novus_id = novus.id" );
			return $howmany['howmany'];			
	}
	
	function count_watching_who()
	{		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$howmany = $a->getRow( "SELECT count(*) AS howmany
						FROM author_author, author
						WHERE
						author_author.author_id = " . $this->author->id .
						" AND author_author.author_id = author.id" );
			return $howmany['howmany'];			
	}
	
	function count_watched_by()
	{		
			$a = $this->rb->toolbox->getDatabaseAdapter();
			$howmany = $a->getRow( "SELECT count(*) AS howmany
						FROM author_author, author
						WHERE
						author_author.author2_id = " . $this->author->id .
						" AND author_author.author_id = author.id" );
			return $howmany['howmany'];			
	}
	
	/*
	public function find_my_novus()
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$related_novus_arr = ( $this->rb->batch( "novus", $a->related( $this->author, "novus" ) ) );
		
		foreach ( $related_novus_arr as $novus_bean )
		{
			$temp = $novus_bean->export();
			
			$novus_bean->appreciations 	= $this->novus_model->count_my_appreciations( $temp['id'] );
			$novus_bean->num_of_comments 	= $this->novus_model->count_my_comments( $temp['id'] );
			$novus_bean->num_of_bits 	= $this->novus_model->count_my_bits( $temp['id'] );
			$novus_bean->category_title  	= $this->novus_model->find_my_category( $temp['id'] );
			$novus_bean->type_title  	= $this->novus_model->find_my_type( $temp['id'] );
			
		}
		
		return $related_novus_arr;
	}*/
	
	public function find_my_novus($page = null)
	{
		
		$current_auth = $this->author->export();
		$cur_username = $current_auth['username'];
		$related_novus_arr = $this->novus_model->get_novus( 'NEW_FIRST', null, null, $page, $cur_username ) ;
		
		
		return $related_novus_arr;
	}
	
	public function count_my_unread_bits()
	{
	    	$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$related_novus_arr = ( $this->rb->batch( "novus", $a->related( $this->author, "novus" ) ) );
		
		$sum_of_unread_bits = 0;
		
		foreach ( $related_novus_arr as $novus_bean )
		{
			$temp = $novus_bean->export();
			$novus_bean->last_bit_count 	= $this->novus_model->my_last_bit_count( $temp['id'] );
			$novus_bean->num_of_bits 	= $this->novus_model->count_my_bits( $temp['id'] );
			
			$sum_of_unread_bits += $novus_bean->num_of_bits - $novus_bean->last_bit_count;
		}
		
		if( !is_int( $sum_of_unread_bits ) )
		$sum_of_unread_bits = 0;
		
		return $sum_of_unread_bits;
	}
	
	public function count_unread_bits_of_appreciations()
	{
	    		$a = $this->rb->toolbox->getDatabaseAdapter();


		$sql = "SELECT
				novus.*,
				( SELECT count(*)        FROM bits_novus 	   WHERE bits_novus.novus_id = novus.id ) 		AS num_of_bits,
				novus_appreciations.novus_id 		AS 	novus_id,
				novus_appreciations.last_bit_count 	AS 	last_bit_count,
				ROUND( ( SELECT count(*)        FROM bits_novus 	   WHERE bits_novus.novus_id = novus.id )  - novus_appreciations.last_bit_count )	AS unread_bits
			FROM
				novus, novus_appreciations
			WHERE
				novus_appreciations.novus_id  = novus.id
			AND
				novus_appreciations.author_id = " . $this->author->id;
		
		$sql .= " GROUP BY novus.id ";
			
		
		$a = $this->rb->toolbox->getDatabaseAdapter();
		$appnovuses = $a->get($sql);
		
		$sum_of_unread_bits = 0;
		
		foreach ( $appnovuses as $novus_bean )
		{
			
			
			$sum_of_unread_bits += $novus_bean['unread_bits'];
		}
		
		if( !is_int( $sum_of_unread_bits ) )
		$sum_of_unread_bits = 0;
		
		return $sum_of_unread_bits;
	}
	
	public function find_my_bits()
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$related_bits_arr = ( $this->rb->batch( "bits", $a->related( $this->author, "bits" ) ) );
		
		foreach ( $related_bits_arr as $onebit_bean )
		{
			$onebit_bean->parent_novus_id = $this->novus_model->get_novus_id_of_bit( $onebit_bean );
			
			$running_novus                = $this->rb->load( "novus", $onebit_bean->parent_novus_id );
			$running_novus                = $running_novus->export();
			
			    if( array_key_exists( 'title', $running_novus ) ){
				$onebit_bean->novus_title     = $running_novus['title'];
				$onebit_bean->novus_image     = $running_novus['cover_image'];
			    }

			$onebit_bean->likes           = $this->bit_model->count_my_appreciations( $onebit_bean->id );
		}
		
		return array_reverse($related_bits_arr);
	}
	
	public function find_my_appreciated_novus( $loggeduser = false )
	{
		/*
		 *	Consider to update get_novus() from the novus_model
		 *	in order to accept author as argument
		 *	The following sql statement is 99% similar to the one in
		 *	get_novus()...!
		 */
		
		
		$a = $this->rb->toolbox->getDatabaseAdapter();
		
		$order_condition 	= '';		
		$cat_condition 		= '';
		$type_condition 	= '';

		$sql = "SELECT SQL_CALC_FOUND_ROWS novus.*,
				novus.*,
				
				( SELECT count(*)        FROM novus_appreciations  WHERE novus_appreciations.novus_id = novus.id ) 	AS appreciations,
				( SELECT count(*)        FROM bits_novus 	   WHERE bits_novus.novus_id = novus.id ) 		AS num_of_bits,
				( SELECT novus_category.title  FROM novus_category WHERE novus.category_id = novus_category.id ) 	AS category_title,
				( SELECT novus_type.title  FROM novus_type  	    WHERE novus.type_id = novus_type.id ) 		AS type_title,
				( SELECT author.username FROM author, author_novus  WHERE author.id = author_novus.author_id AND author_novus.novus_id = novus.id ) AS author,
				novus_appreciations.novus_id 		AS 	novus_id,
				novus_appreciations.last_bit_count 	AS 	last_bit_count
				
			FROM
				novus, novus_appreciations
			WHERE
				novus_appreciations.novus_id  = novus.id
			AND";
			if( !$loggeduser ){
				$sql .= " novus_appreciations.author_id = " . $this->author->id;
			}
			else
				$sql .= " novus_appreciations.author_id = " . $this->session->userdata( 'user_id' );
		
		$sql .= " GROUP BY novus.id ";
			
		
		$a = $this->rb->toolbox->getDatabaseAdapter();
		
		$appnovuses = $a->get($sql);

$sql_found_rows = "SELECT FOUND_ROWS() as how_many_records";
		$sql_found_rows_arr = $a->getRow($sql_found_rows);
		$appnovuses['how_many_records']= $sql_found_rows_arr['how_many_records'];
		
		
		
		$appnovuses['how_many_pages'] = ceil( $appnovuses['how_many_records'] / 8 );
		
		
		
		return $appnovuses;
	}
	
	public function find_my_followers()
	{
	    	$a       = new RedBean_AssociationManager( $this->rb->toolbox );
		$adp     = $this->rb->toolbox->getDatabaseAdapter();
		
		$sql     = "SELECT
				author_author.author_id
			    FROM
				author_author
			    WHERE
				author_author.author2_id= " . $this->author->id;
				
		$friends = ( $this->rb->batch( "author", $adp->getCol( $sql ) ) );
		
		return $friends;
	}
	
	public function friends_and_notices()
	{
		return $this->find_my_notices( $this->find_my_friends() );
	}
	
	public function find_my_friends( $loggeduser = false )
	{
		$a       = new RedBean_AssociationManager( $this->rb->toolbox );
		$adp     = $this->rb->toolbox->getDatabaseAdapter();
		if( !$loggeduser ){
		$sql     = "SELECT
				author_author.author2_id
			    FROM
				author_author
			    WHERE
				author_author.author_id= " . $this->author->id;
		}
		if( $loggeduser ){
		    $user_id     = $this->session->userdata( 'user_id' );
		    $sql     = "SELECT
				author_author.author2_id
			    FROM
				author_author
			    WHERE
				author_author.author_id= " . $user_id;
		}
		
		$friends = ( $this->rb->batch( "author", $adp->getCol( $sql ) ) );
		
		// -------
		/*
		$current_auth = $this->author->export();
		$cur_id = $current_auth['id'];
		
		$a       = new RedBean_AssociationManager( $this->rb->toolbox );
		$adp     = $this->rb->toolbox->getDatabaseAdapter();
		
		$sql     = "SELECT
				user.*
			    FROM
				user, author_user, author
			    WHERE
				user.id = author_user.user_id
			    AND
				author.id = author_user.author_id
			    AND
				author.id = ".$cur_id;
				

		$fb_user = $adp->getRow( $sql );

		if( !empty( $fb_user ) ){

		    $uid = str_replace( 'fb:', '', $fb_user['user_id'] );
		    $this->author->fb_user 	= "yes";
		    $this->author->fb_uid 	= $uid ;
		    
		}
		*/
		
		return $friends;
	}
	
	public function find_my_notices( $friends )
	{
		foreach ( $friends as $friend_bean )
		{
			$adp = $this->rb->toolbox->getDatabaseAdapter();
			
			$sql = "SELECT 
				    novus.id AS novus_id, novus.title AS novus_title, novus.dateposted AS dateposted, novus.cover_image AS cover_image
				FROM 
				    author, author_novus, novus, notice										
				WHERE 
				    author_novus.author_id = author.id
				AND 
				    author_novus.novus_id = novus.id
				AND
				    author_novus.author_id = " . $friend_bean->id . "
				AND
				     novus.id NOT IN ( SELECT notice.novus_id FROM notice WHERE notice.to_author = " . $this->session->userdata( 'user_id' ) . "  )
				GROUP BY
				    novus_id";
			
			$res = $adp->get( $sql );
			$friend_bean->novuses = $res;
		}
		
		$notices = $friends;
		
		

		
		
		return $notices;
	}
	
	public function count_my_notices()
	{
		$user_id     = $this->session->userdata( 'user_id' );
		$a           = new RedBean_AssociationManager( $this->rb->toolbox );
		$adp         = $this->rb->toolbox->getDatabaseAdapter();
		
		$sql         = "SELECT
				    author_author.author2_id
				FROM
				    author_author
				WHERE
				    author_author.author_id= " . $user_id;
				 
		 $friends_arr = ( $this->rb->batch( "author", $adp->getCol( $sql ) ) );
		//die( $user_id );
		$c           = 0;
		
		foreach ( $friends_arr as $friend_bean ) {
			
			
			$sql = "SELECT count(*) as how_many_notices FROM
			        ( SELECT 
				    novus.id AS novus_id, novus.dateposted AS dateposted
				FROM 
				    author, author_novus, novus, notice										
				WHERE 
				    author_novus.author_id = author.id
				AND 
				    author_novus.novus_id = novus.id
				AND
				    author_novus.author_id = " . $friend_bean->id . "
				AND
				     novus.id NOT IN ( SELECT notice.novus_id FROM notice WHERE notice.to_author = " . $this->session->userdata( 'user_id' ) . "  )
				GROUP BY
				    novus_id ) as alias ";
				    
			$res = $adp->getCol( $sql );
			
			$c += $res[0];
			
		}
		
		if( !is_int( $c ) ) $c  = 0;
		
		
		return $c;
	}
	
	public function assign_watcher( $watch_user_id )
	{
		$user_id           = $this->session->userdata( 'user_id' );
		$cur_author_bean   = $this->rb->load( 'author', $user_id );
		$watch_author_bean = $this->rb->load( 'author', $watch_user_id );
                
		if ( $watch_author_bean->id == 0 )
			die( 'This user id is not valid' );
                        
		if ( $watch_author_bean->id == $cur_author_bean->id )
			die( 'You cant follow yourself. Is like following your own shadow...' );
                        
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$a->associate( $cur_author_bean, $watch_author_bean );
		
		// should return error if found etc...
		
	}
	
	public function unassign_watcher( $watch_user_id )
	{
		$user_id           = $this->session->userdata( 'user_id' );
		$cur_author_bean   = $this->rb->load( 'author', $user_id );
		$watch_author_bean = $this->rb->load( 'author', $watch_user_id );
                
		if ( $watch_author_bean->id == 0 )
			die( 'This user id is not valid' );
                        
		if ( $watch_author_bean->id == $cur_author_bean->id )
			die( 'You cant follow yourself. Is like following your own shadow...' );
                        
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		
		$a->unassociate( $cur_author_bean, $watch_author_bean  );
		
		
		
		// should return error if found etc...
		
	}
	
	public function hide_notice( $novus_id )
	{
		
		try {
		    $user_id                = $this->session->userdata( 'user_id' );
			$notice_bean            = $this->rb->dispense( 'notice' );
			$notice_bean->to_author = $user_id;
			$notice_bean->novus_id  = $novus_id;
			$this->rb->store( $notice_bean );
		} catch (Exception $e) {
		   //echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		
		// should return error if found etc...
	}
	/*
	public function conclude_next_previous( & $data, $author_username, $id ){
	    $a = $this->rb->toolbox->getDatabaseAdapter();
	  
                                    $auth = $this->author_model->get_author_by_username( $author_username );
                                    $auth = $auth->export();
                                    
				    $data['nextnovus_title'] = $a->getRow( "SELECT novus.id as id, novus.title as t
								FROM novus , author_novus
								WHERE novus.id < ".$id." AND novus.id = author_novus.novus_id
								 AND 	        author_novus.author_id = ".$auth['id']." 
                                                                ORDER BY novus.id DESC 
								LIMIT 1" );
                                    
				    if( ! isset( $data['nextnovus_title'] ))		// if we were in the last record already...
				    {
					$a = $this->rb->toolbox->getDatabaseAdapter();
					$data['nextnovus_title'] = $a->getRow( "SELECT novus.id as id, novus.title as t
								FROM novus, author_novus
                                                                WHERE 		novus.id = author_novus.novus_id
								AND 	        author_novus.author_id = ".$auth['id']." 
								ORDER BY novus.id DESC 
								LIMIT 1" );
				    }
                                    
				    
				    $a = $this->rb->toolbox->getDatabaseAdapter();
				    $data['previousnovus_title'] = $a->getRow( "SELECT novus.id as id, novus.title as t
								FROM novus , author_novus
								WHERE novus.id > ".$id."
                                                                AND novus.id = author_novus.novus_id AND author_novus.author_id = ".$auth['id']." 
                                                                ORDER BY novus.id ASC 
								LIMIT 1" );
				    
                                    
				    if( ! isset( $data['previousnovus_title'] ))		// if we were in the last record already...
				    {
					$a = $this->rb->toolbox->getDatabaseAdapter();
					$data['previousnovus_title'] = $a->getRow( "SELECT novus.id as id, novus.title as t
								FROM novus, author_novus
                                                                WHERE 		novus.id = author_novus.novus_id
								AND 	        author_novus.author_id = ".$auth['id']." 
								ORDER BY novus.id ASC 
								LIMIT 1" );
				    }
	}
	*/
	
}