	
<?php
$pluginname = 'theme_roshni';
$place = 'contactus';
$mapplace = $DB->get_record_sql('select config.value from {config_plugins} config where config.plugin="'.$pluginname.'" and config.name="'.$place.'"');

if(!empty($mapplace)) { 
	$map = json_decode($mapplace->value,true);
} else {
	$map = '';
}
$mapArray=array(); 
?>

<div class = "clearfix"></div>
<div class="contact">
<?php 
/******************************* Google Map *************************************/
	if(!empty($map)) {
		foreach ($map as $key => $mapval) {
			foreach($mapval as $mapvalue) {
				$mapArray[$key] = $mapvalue;
			}
		}
	?>
		<div class="container">
			<?php
			if(!empty($mapArray['mapmhead']) && $mapArray['mapmhead'][0] != NULL) {
				if(str_word_count($mapArray['mapmhead']) == 2) { 
					$lastwordstart = strrpos($mapArray['mapmhead'], ' ') + 1; 
					$lastword = substr($mapArray['mapmhead'], $lastwordstart);
					$zap = '';
					$firststring = str_replace($lastword, $zap, $mapArray['mapmhead']);?>
					<h1 class="h-large"><?php echo $firststring; ?><span><?php echo $lastword?></span></h1>
				<?php 
				} else { ?>
					<h1 class="h-large"><?php echo $mapArray['mapmhead']; ?></h1>
			    <?php 
			    } ?>
			<?php 
			} else { ?>
				<h1 class="h-large">CONTACT <span>ROSHNI</span></h1>
			<?php
			} 
			if(!empty($mapArray['mapshead']) && $mapArray['mapshead'][0] != NULL) { ?>
				<h3 class="header-b-2"><?php echo $mapArray['mapshead']; ?></h3>
			<?php } else { ?>	
				<h3 class="header-b-2">A Beautiful Contact Us Block - It Has a Map As Well As Contact Coordinates</h3>
			<?php } ?>
		</div>
		<?php 
		if(!empty($mapArray['place']) && !empty($mapArray['country'])) {
			$googlemap = '<iframe class = "mapframe" height="330" src="https://www.google.com/maps/embed/v1/place?q='.$mapArray['place'].',+'.$mapArray['country'].'&amp;key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>';

			echo $googlemap; 
		} else { 
		    $googlemap = '<iframe class = "mapframe" height="330" src="https://www.google.com/maps/embed/v1/place?q=Kolkata,India&amp;key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>';

			echo $googlemap;
		} ?>

<?php
    } else { ?>
		<div class="container">
			<h1 class="h-large">CONTACT <span>ROSHNI</span></h1>
			<h3 class="header-b-2">A Beautiful Contact Us Block - It Has a Map As Well As Contact Coordinates</h3>
		</div>
	    <?php 
	    $googlemap = '<iframe class = "mapframe" height="330" src="https://www.google.com/maps/embed/v1/place?q=Kolkata,India&amp;key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>';

		echo $googlemap;
	} ?>
  	
</div>