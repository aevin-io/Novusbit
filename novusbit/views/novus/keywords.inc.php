 <h3>Keywords and why should we care.</h3>

    We've gathered some frequently used words as food for thought, while you're writing your bit.
    <br>
	By all means, you may ingnore them. However, using the words which appear to be bigger,<br>
	might keep the novus script on track and make your bits fit in well with the rest.<br> The choice is yours!
	<br>
	    <br>
    <div id="keywords" style="width:450px; background: white; line-height:15pt; ">
    <style> 
            
            .size6 { 
                font-size: 6pt; 
                color: #9cb3e7; 
            } 
            .size5 { 
                font-size: 8pt; 
                color: #7693d4; 
            } 
            .size4 { 
                font-size: 12pt; 
                color: #5375c3; 
            } 
            .size3 { 
                font-size: 14pt; 
                color: #355aaf; 
            } 
            .size2 { 
                font-size: 16pt;  
                color: #1a429c; 
            } 
            .size1 { 
                font-size: 18pt; 
                color: #002a8b; 
            } 
        </style>
<?php
    $highest = 0;
    foreach( $keywords as $keyword => $num_of_occurancies )
    {
	  $highest = ($num_of_occurancies>$highest)?$num_of_occurancies:$highest; //highest  
    }
    


    $total = ""; //starts string 
    foreach($keywords as $keyword=>$num_of_occurancies) { 
    $hv = ceil($num_of_occurancies*(100/$highest)); //gets percent
    
    if($hv>90) { 
        $hn = 1; 
    } else if ($hv>80) { 
        $hn = 2; 
    } else if ($hv>60) { 
        $hn = 3; 
    } else if ($hv>40) { 
        $hn = 4; 
    } else if ($hv>30) { 
        $hn = 5; 
    } else if ($hv>15) { 
        $hn = 6; 
    } else { 
        $hn = 0; 
    } 
    if($hn != 0) { 
       // $total .= "<span class='size{$hn} scloud'>   {$id} </h{$hn}>   </span>&nbsp;\n"; 

	?>
	
	
	
	<div style="float:left; padding: 3px;" class="size<?php echo $hn; ?>">
		
		<?php echo $keyword; ?>
		
	</div>
	
	<?php
       } 
} 
   // echo $highest;
?>
</div>

</div>
    
</div> <!-- End of expander class found in expander.php -->

