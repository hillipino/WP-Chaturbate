		
<style type="text/css">
<!--
iframe {
height: 530px;
}
-->
</style>		
		<?php
		
		$cams = new SimpleXMLElement('http://chaturbate.com/affiliates/api/onlinerooms/?format=xml&wm='.$_REQUEST['aff'].'', null, true);
		
		echo '<div class="cb_video">';
		
		foreach( $cams as $cam ){ 

			if ( $cam->username == $_REQUEST['user'] ) {
			
				if ( $_REQUEST['type'] == 'revshare' ) {
					
					echo $cam->iframe_embed_revshare;
				
				} else {
				
					echo $cam->iframe_embed;
					
				}
			
			} 
			
		}
		
		echo '</div>';
		
		?>