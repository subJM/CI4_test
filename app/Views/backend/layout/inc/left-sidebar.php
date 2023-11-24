<div class="left-side-bar">
	<div class="brand-logo" style="padding:5px;">
		<a href="/">
			<img src="/images/blog/<?= get_settings()->blog_logo ?>" alt="" class="dark-logo" />
			<img src="/images/blog/<?= get_settings()->blog_logo ?>" alt="" class="light-logo" />
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				<li>
					<a href="<?= route_to('admin.home'); ?>" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-home"></span><span class="mtext">Home</span>
					</a>
				</li>
				<li>
					<a href="<?= route_to('categories') ?>" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-list"></span><span class="mtext">Categories</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon dw dw-newspaper"></span><span class="mtext">posts</span>
					</a>
					<ul class="submenu">
						<li><a href="basic-table.html">All poists</a></li>
						<li><a href="datatable.html">Add new</a></li>
					</ul>
				</li>

				<li>
					<div class="dropdown-divider"></div>
				</li>
				<li>
					<div class="sidebar-small-cap">Settings</div>
				</li>

				<li>
					<a href="<?= route_to('admin.profile') ?>" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-user"></span>
						<span class="mtext">
							Profile
							<!-- <img src="/backend/vendors/images/coming-soon.png" alt="" width="25" -->
						</span>
					</a>
				</li>
				<li>
					<a href="<?= route_to('settings') ?>" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-settings"></span>
						<span class="mtext">
							settings
							<!-- <img src="/backend/vendors/images/coming-soon.png" alt="" width="25" -->
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>