<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<ul class="nav menu">
		<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		<li><a href="customer.php"><em class="fa fa-users">&nbsp;</em> Customer</a></li>
		<li><a href="task-information.php"><em class="fa fa-line-chart">&nbsp;</em> Tasks</a></li>
		<li><a href="invoice.php"><em class="fa fa-file-text">&nbsp;</em> Invoice</a></li>
		<li><a href="team.php"><em class="fa fa-user-secret">&nbsp;</em> Team</a></li>
		<li><a href="payment.php"><em class="fa fa-money">&nbsp;</em> Payment</a></li>
		<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-cogs">&nbsp;</em> Settings <span data-toggle="collapse" href="#sub-item-2"
					class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			<ul class="children collapse" id="sub-item-2">
				<li><a class="" href="company-settings.php">
						<span class="fa fa-building">&nbsp;</span> Company
					</a></li>
				<li><a class="" href="sms-settings.php">
						<span class="fa fa-comments">&nbsp;</span>SMS & Email
					</a></li>
			</ul>
		</li>
		<li><a href="income-report.php"><em class="fa fa-bar-chart">&nbsp;</em> Income Report</a></li>
		<li><a href="../index.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
	</ul>
</div><!--/.sidebar-->

<script>
	// Get all the links within the sidebar
	const sidebarLinks = document.querySelectorAll('.sidebar ul.nav a');

	// Add a click event listener to each link
	sidebarLinks.forEach(link => {
		link.addEventListener('click', function (event) {
			// Remove the "active" class from all links
			sidebarLinks.forEach(link => link.classList.remove('active'));

			// Add the "active" class to the clicked link
			this.classList.add('active');
		});
	});
</script>

<style>
	/* Add this CSS to style the active link */
	.sidebar ul.nav a.active {
		background-color: black;
		/* Set the background color to black for active links */
		color: white;
		/* Set text color to white */
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		/* Add a subtle drop shadow */
	}
</style>