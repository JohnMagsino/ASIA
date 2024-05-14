<style>
    .sidebar {
        display: block;
        padding: 10px;
        box-shadow: none;
        background: #1E1E1E;
        font-size: medium;
    }

    .sidebar ul {
        margin: 20px 0px;
    }

    .sidebar form {
        padding: 10px 0 0 0;
        margin: 10px 10px 20px 10px;
    }

    @media (min-width: 768px) {
        .sidebar {
            display: block;
            position: fixed;
            top: 60px;
            bottom: 0;
            left: 0;
            z-index: 1000;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .navbar-header {
            width: 100%;
        }
    }

    .sidebar ul.nav a {
        transition: all 0.3s ease;
    }

    .sidebar ul.nav a:hover,
    .sidebar ul.nav li.parent ul li a:hover {
        text-decoration: none;
        background-color: #72CD4B;
        color: #fff;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .sidebar ul.nav .active a,
    .sidebar ul.nav .active a:hover { /* Updated selector to include hover state for active button */
        color: #fff;
        background-color: #72CD4B;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .sidebar ul.nav ul,
    .sidebar ul.nav ul li {
        list-style: none;
        list-style-type: none;
    }

    .sidebar ul.nav li a {
        height: 50px;
        font-size: 15px;
        line-height: 2em;
        color: #fff;
        padding-left: 20px; /* Added padding for alignment */
    }

    .sidebar ul.nav ul.children {
        width: auto;
        padding: 0;
        margin: 0;
        background: #f9f9f9;
    }

    .sidebar ul.nav ul.children li a {
        height: 40px;
        background: #f1f4f7;
        color: #fff;
    }

    .sidebar ul.nav li.current a {
        background-color: #72CD4B;
        color: #fff !important;
    }

    .sidebar ul.nav li.parent ul li a {
        border: none;
        display: block;
        padding-left: 30px;
        line-height: 40px;
        border-radius: 0;
    }

    .sidebar ul.nav li.divider {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0px 0;
    }

    .profile-sidebar {
        padding: 10px 0;
        border-bottom: 1px solid #e9ecf2;
    }
</style>

</head>
<body>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <h3 style="color: white; margin-left:10px;">Menu</h3>
        <ul class="nav menu">
            <li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li><a href="new-task.php"><em class="fa fa-plus">&nbsp;</em> New Task</a></li>
            <li><a href="task-information.php"><em class="fa fa-line-chart">&nbsp;</em> Task List</a></li>
            <li><a href="invoice.php"><em class="fa fa-file-text">&nbsp;</em> Invoice</a></li>
            <li><a href="payment.php"><em class="fa fa-money">&nbsp;</em> Payment</a></li>
            <li><a href="profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
            <li><a href="../index.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div><!--/.sidebar-->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll(".sidebar ul.nav li a");

            navLinks.forEach(link => {
                link.addEventListener("click", function(event) {
                    // Prevent the default link behavior
                    event.preventDefault();

                    // Remove 'active' class from all links
                    navLinks.forEach(link => link.parentElement.classList.remove("active"));

                    // Add 'active' class to the clicked link
                    this.parentElement.classList.add("active");

                    // Redirect to the link's href
                    window.location.href = this.href;
                });
            });

            // Check the current URL to keep the active class on page load
            const currentPath = window.location.pathname;
            navLinks.forEach(link => {
                if (link.href.endsWith(currentPath)) {
                    link.parentElement.classList.add("active");
                }
            });
        });
    </script>
