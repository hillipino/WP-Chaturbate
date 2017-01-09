<?php
	
	function nmp_search_wrapper() {

		

			echo '
			
				<!-- Search Wrapper -->
					<div id="search-wrapper">
						
						<!-- Search -->
							<div class="5grid-layout" id="search">
								<div class="row">
									<div class="8u">
										<span>Search</span>
									</div>
									<div class="4u">
										<div class="side-padded">
											<form method="get" action="' . home_url() . '">
												<div>
													<input type="text" class="text" name="s" placeholder="' . __( 'Search our site', THEMENAME ) . '" />
													<input type="submit" value="Search" class="button" />
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							
					</div>
				
				';
			
			
			
		}