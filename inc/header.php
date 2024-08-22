<header class="header_section">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg custom_nav-container ">
			<a class="navbar-brand" href="index.html">
				<span>
					Neogym
				</span>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
					<ul class="navbar-nav">
						<?php
						$stmt = $conn->prepare("SELECT page_id, page_menu_name, page_status FROM page");
						$stmt->execute();
						$menus = $stmt->fetchAll();
						foreach ($menus as $menu) {
							$page_status = $menu['page_status'];
							$menu_name = $menu['page_menu_name'];
							$page_id = $menu['page_id'];
							//$menu_link = str_replace(' ', '-', $menu_name);
							//strtolower($menu_link); 
							?>
							<?php if ($page_status == '1') { ?>
								<li class="nav-item ">
									<a class="nav-link"
										href="index.php?page=<?php echo $page_id; ?>"><?php echo $menu['page_menu_name']; ?></a>
								</li>
							<?php }

						}
						?>



					</ul>
					<div class=" user_option">
						<form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
							<button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
						</form>
					</div>
				</div>
			</div>
		</nav>
	</div>
</header>