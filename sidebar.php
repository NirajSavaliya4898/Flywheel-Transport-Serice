<div class="sidebar">
								<!-- Start: Search By Price -->
								<!-- End: Latest Listing -->
								
								<!-- Start: Listing Category -->
								<div class="widget-boxed">
									<div class="widget-boxed-header">
										<h4><i class="ti-briefcase padd-r-10 " ></i>My Dashboard</h4>
									</div>
									<div class="widget-boxed-body padd-top-10 padd-bot-0">
										<div class="side-list">
											<ul class="category-list">
												
												

												<?php
													if (isset($obj->UserKey)) 
													{
														if ($obj->RegisterType=="business") 
														{
															?>
																<li><a href="gallery.php">Gallery <span class="badge bg-g"></span></a></li>
																<!-- <li><a href="bank.php">Bank<span class="badge bg-g"></span></a></li> -->
																<li><a href="driver.php">Driver<span class="badge bg-g"></span></a></li>
																<li><a href="vehicle.php">Vehicle<span class="badge bg-g"></span></a></li>
																<li><a href="business-myorder.php">My Order<span class="badge bg-g"></span></a></li>
															<?php
														}
														else
														{
															?>
															<!-- <li><a href="bank.php">Bank<span class="badge bg-g"></span></a></li> -->
															<li><a href="orderdisplay.php">Your Order<span class="badge bg-g"></span></a></li>
															<?php
														}
													}
												?>
												<!-- <li><a href="#">Shopping <span class="badge bg-a">7</span></a></li>
												<li><a href="#">Photography <span class="badge bg-d">10</span></a></li>
												<li><a href="#">Intertainment <span class="badge bg-l">55</span></a></li>
												<li><a href="#">Education <span class="badge bg-o">8</span></a></li>
												<li><a href="#">Travel & Tour <span class="badge bg-y">17</span></a></li>
												<li><a href="#">Health & Fitness <span class="badge bg-s">9</span></a></li> -->
											</ul>
										</div>
									</div>
								</div>
								<!-- End: Listing Category -->
								
								
								<!-- End: Help & Support -->
							</div>