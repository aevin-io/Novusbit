<?php

class Novus_Model extends Model
{	
	// Novus initialization functions
	
	public function get_novus_by_key( $id )
	{
		$novus_bean = $this->rb->load( 'novus', $id );
		$this->find_author( $novus_bean );
		$this->find_comments( $novus_bean );
		$novus_bean->appreciations   = $this->count_my_appreciations( $id );
		$novus_bean->num_of_comments = $this->count_my_comments( $id );
		$novus_bean->num_of_bits     = $this->count_my_bits( $id );
		$novus_bean->category_title  = $this->find_my_category( $id );
		return $novus_bean;
		
	}
	
	// Creation..
	
	public function create_novus( $image_data )
	{
		$title    = $_POST['title'];
		$desc     = $_POST['description'];
		$sandbox  = $_POST['sandbox'];
		$category = $_POST['category'];
		$filename = $image_data['file_name'];
		
		$novus_bean              = $this->rb->dispense( 'novus' );
		$novus_bean->title       = $title;
		$novus_bean->description = $desc;
		$novus_bean->sandbox     = $sandbox;
		$novus_bean->cover_image = $filename;
		$novus_bean->category_id = $category;
		$novus_bean->dateposted  = mdate( "%Y-%m-%d %h:%i:%s", time() );
		$this->rb->store( $novus_bean );
		return $novus_bean;
	}
	
	public function create_comment()
	{
		$comment_bean             = $this->rb->dispense( 'comments' );
		$comment_bean->body       = $_POST['comment'];
		$comment_bean->dateposted = mdate( "%Y-%m-%d %h:%i:%s", time() );
		
		
		$this->rb->store( $comment_bean );
		return $comment_bean;
	}
	
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
		//$c = $this->bitsCount;
		$position->number = 1; // $c + 1;
		$ea->extAssociate( $novus_bean, $bit_bean, $position );
	}
	
	public function remove_bit( $bid, $nid )
	{
		
		$bit_bean 	= $this->rb->load( 'bits', $bid );
		$novus_bean 	= $this->rb->load( 'novus', $nid );
		
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		
		// Unassociate the Bit from the Novus.
		
		$a->unassociate( $bit_bean, $novus_bean );
		
		// Find the associated author of the bit.
		
		$author_arr = ( $this->rb->batch( "author", $a->related( $bit_bean, "author" ) ) );
		$a->unassociate( $bit_bean, get_bean( $author_arr ) );
		
		// Finally delete the Bit record from the database.
		
		$this->rb->trash( $bit_bean );
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
		 * Find all Novus' related Comments
		 */
		
		$related_comments_arr = ( $this->rb->batch( "comments", $a->related( $novus_bean, "comments" ) ) );
		
		foreach ( $related_comments_arr as $onecomment )
		{
			$a->unassociate( $onecomment, $novus_bean );
			
			$related_auth = ( $this->rb->batch( "author", $a->related( $onecomment, "author" ) ) );
			
			$a->unassociate( $onecomment, get_bean( $related_auth ) );
			
			$this->rb->trash( $onecomment );
		}
		
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
		try {
			unlink( './uploads/novus/' . $tmp['cover_image'] );
		}
		catch ( Exception $e ) {
		}
		$this->rb->trash( $novus_bean );
	}
	
	function find_my_category( $novus_id )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
		$cattitle = $a->getRow( "SELECT category.title AS title FROM novus,category where novus.id = " . $novus_id. " AND novus.category_id = category.id" );

		return $cattitle['title'];
		
	}
	
	function count_my_appreciations( $novus_id )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
		$likes = $a->getRow( "SELECT count(*) AS likes FROM novus_appreciations where novus_id = " . $novus_id );
		//if( $likes['likes']!=0 )
		return $likes['likes'];
		
	}
	
	function count_my_comments( $novus_id )
	{
		$a     = $this->rb->toolbox->getDatabaseAdapter();
		$likes = $a->getRow( "SELECT count(*) AS num_of_comments FROM comments_novus where novus_id = " . $novus_id );
		//if( $likes['num_of_comments']!=0 )
		return $likes['num_of_comments'];
		
	}
	
	function count_my_bits( $novus_id )
	{
		$a     = $this->rb->toolbox->getDatabaseAdapter();
		$likes = $a->getRow( "SELECT count(*) AS num_of_bits FROM bits_novus where novus_id = " . $novus_id );
		//if( $likes['num_of_bits']!=0 )
		return $likes['num_of_bits'];
		
	}
	
	// Finding functions
	
	public function get_novus( $order = null, $category = null, $type = null )
	{
		$a = $this->rb->toolbox->getDatabaseAdapter();
		
		$order_condition 	= '';
		
		$cat_condition 		= '';
		$type_condition 	= '';
		
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
			case "OLD_FIRST":
			    $order_condition = 'ORDER BY novus.dateposted ASC';
			    break;
			case "CATEGORY":
			    $order_condition = 'ORDER BY novus.category_id ASC';
			    break;
			
		}

		$sql = "SELECT
				novus.*,
				category.id 	AS cat_id,
				category.title 	AS cat_title,
				( SELECT count(*) FROM comments_novus where comments_novus.novus_id = novus.id ) AS num_of_comments 
			FROM
				novus, category ";
				

		if($category != null)
			$cat_condition = "WHERE novus.category_id = category.id AND category.title = '". $category. " ' ";
		/*
		if($type != null)
			$type_condition = 'AND type .. == $type....';
		*/
		$sql .= $cat_condition;
		$sql .= $order_condition;
		
		
		$allnovus_arr = ( $this->rb->batch( "novus", $a->getCol( $sql ) ) );
		echo br(5);
		echo $sql;	
		foreach ( $allnovus_arr as $novus_bean )
		{
			
			$running_novus               = $novus_bean->export();
			echo "<pre>";print_r( $novus_bean );echo "</pre>";
			$novus_bean->appreciations   = $this->count_my_appreciations( $running_novus['id'] );
			//$novus_bean->num_of_comments = $this->count_my_comments( $running_novus['id'] );
			$novus_bean->num_of_bits     = $this->count_my_bits( $running_novus['id'] );
			$novus_bean->category_title  = $this->find_my_category( $running_novus['id'] );
			$this->find_author( $novus_bean );
		}
		
	
		return $allnovus_arr;
	}
	
	public function find_author( $novus )
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$author_arr = ( $this->rb->batch( "author", $a->related( $novus, "author" ) ) );
		foreach( $author_arr as $author )
		{
		$novus->authors = $author->export();
		}
	}
	
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
	
	public function get_latest_novus()
	{
		// ...
		
	}
	
	public function get_novus_of_type()
	{
		// ...
		
	}
	
	public function get_novus_of_language()
	{
		// ...
		
	}
	
	public function get_novus_id_of_bit( $bit_bean )
	{
		$opened_bean = $bit_bean->export();
		$a           = $this->rb->toolbox->getDatabaseAdapter();
		$key         = $a->getCol( "SELECT novus_id FROM bits_novus WHERE bits_id = " . $opened_bean['id'] );
		return $key[0];
	}
	
	public function search( $query )
	{
		
	}
	
	public function update_novus( $id ){
		$novus_bean = $this->rb->load( 'novus', $id );
			
		$title   = $_POST['title'];
		$desc    = $_POST['description'];
		$sandbox = $_POST['sandbox'];
		$category = $_POST['category'];
		//$filename = $image_data['file_name'];
			
			
		$novus_bean->title       = $title;
		$novus_bean->description = $desc;
		$novus_bean->sandbox     = $sandbox;
		$novus_bean->category_id = $category;
		//$novus_bean -> cover_image = $filename;
		//$novus_bean -> dateposted = mdate("%Y-%m-%d %h:%i:%s", time());
			
		$this->rb->store( $novus_bean );
	}
	
	public function appreciate( $novus_id )
	{
		try {
			$appr_bean             = $this->rb->dispense( 'novus_appreciations' );
			$appr_bean->novus_id   = $novus_id;
			$appr_bean->author_id  = $this->session->userdata( 'user_id' );
			$appr_bean->dateposted = mdate( "%Y-%m-%d %h:%i:%s", time() );
			$this->rb->store( $appr_bean );
		}
		catch ( Exception $e ) {
		}
	}
}