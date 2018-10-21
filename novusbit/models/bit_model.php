<?php

class Bit_Model extends CI_Model
{
	function create_bit()
	{
		$bit_bean             = $this->rb->dispense( 'bits' );
		$bit_bean->body       = $_POST['body'];
		$bit_bean->dateposted = mdate( "%Y-%m-%d %h:%i:%s", time() );
		$this->rb->store( $bit_bean );
		return $bit_bean;
	}
	
	function find_my_author( $bit_bean )
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$author_arr = $this->rb->batch( "author", $a->related( $bit_bean, "author" ) );
		
		$bit_bean->author = get_bean( $author_arr ); // ->export(); TO ALLAKSA META AP TO TANK_AUTH!!!
	}
	
	function count_my_appreciations( $bit_id )
	{
		$a     = $this->rb->toolbox->getDatabaseAdapter();
		$likes = $a->getRow( "select count(*) as likes from bit_likes where bit_id = " . $bit_id );
		if ( $likes['likes'] != 0 )
			return $likes['likes'];
		
	}
	
	function count_my_spamflags( $bit_id )
	{
		$a    = $this->rb->toolbox->getDatabaseAdapter();
		$spam = $a->getRow( "select count(*) as spam from bit_spam where bit_id = " . $bit_id );
		if ( $spam['spam'] != 0 )
			return $spam['spam'];
		
	}
	
	public function assign_author( $author_bean, $bit_bean )
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$a->associate( $author_bean, $bit_bean );
	}
	public function unassign_author( $author_bean, $bit_bean )
	{
		$a = new RedBean_AssociationManager( $this->rb->toolbox );
		$a->unassociate( $author_bean, $bit_bean );
	}
	
	public function find_bits( $novus )
	{
		$a        = new RedBean_AssociationManager( $this->rb->toolbox );
		$bits_arr = ( $this->rb->batch( "bits", $a->related( $novus, "bits" ) ) );
		$bit_ret  = array();
		
		foreach ( $bits_arr as $onebit )
		{
			$this->find_my_author( $onebit );
			$onebit->likes     = $this->count_my_appreciations( $onebit->id );
			$onebit->spamflags = $this->count_my_spamflags( $onebit->id );
			array_push( $bit_ret, $onebit );
		}
		
		return $bit_ret;
	}
	
	public function search( $query )
	{
	}
	
	public function appreciate( $bit_bean )
	{
	}
	
	public function report( $bit_bean )
	{
	}
	
	public function post_comment( $bit_bean )
	{
	}
	
	
}