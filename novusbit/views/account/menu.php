

<div id="account_menu">
	<?php
	echo anchor('profile','Profile', array('class' => 'profile_links '));
	//echo anchor('account','account', array('class' => 'profile_links '));
	 if($this->tank_auth->is_logged_in()){ echo anchor('password','Password', array('class' => 'profile_links ')); }
	 
	
	echo anchor('settings','Notifications', array('class' => 'profile_links '));
	?>

</div>

