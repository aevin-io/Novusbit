 <style>
        #notices_count {
        margin-right: 2px;
color: white;
-webkit-border-radius: 12px !important;
-moz-border-radius: 12px !important;
border-radius: 12px !important;
text-shadow: none !important;
padding: 2px 3px 2px 6px;
font-size: 12px !important;
font-weight: 300;
top: 8px;
right: 24px;
text-align: center;
height: 14px;
background-color: #e02222;

}
        </style>
        <?php
        $this->author_model->get_author_by_username( $this->session->userdata( 'username' ));
        $totalcount = $this->author_model->count_my_notices() + $this->author_model->count_my_unread_bits() + $this->author_model->count_unread_bits_of_appreciations() ;
       if( $totalcount != 0 ) { ?>
        <span id="notices_count">
        <? echo $totalcount; ?>
        </span>
        <?php  } ?>
         Notice<?  if( $totalcount> 1 || $totalcount== 0) echo "s"; ?>
 	
            <ul class="level2" style="width: 200px">
                      <li>
                           <?=anchor( $this->session->userdata( 'username' ).'/watching',$this->author_model->count_my_notices()." New Novus");?>
                      </li>
                      <li>
                           <?=anchor( $this->session->userdata( 'username' ).'/novus',$this->author_model->count_my_unread_bits()." Unread bits on my Novus");?>
                      </li>
                      <li>
                        <?=anchor( $this->session->userdata( 'username' ).'/appreciations',$this->author_model->count_unread_bits_of_appreciations()." Unread bits on likes");?>
                      </li>
                      <li  class="seperate">
                       <a href="http://localhost/www.novusbit.com/<?=$this->session->userdata( 'username' );?>/watchedby" address="true" style="color:gray">0 New followers <strong>(soon)</strong></a>
                      </li>
                      <li >
                       <a href="http://localhost/www.novusbit.com/<?=$this->session->userdata( 'username' );?>/watchedby" address="true" style="color:gray">0 New likes <strong>(soon)</strong></a>
                      </li>
</ul>


