<?php
if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {



  ?>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">

      <span class="sr-only"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>

      </button>
      <a href="index.php?dashboard" class="navbar-brand"><span>Admin Panel</span></a>
    </div>

    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn"><i class="fa fa-user"></i> <?php echo $admin_name; ?></a></button>

      <div id="myDropdown" class="dropdown-content">
        <a href="index.php?user_profile?id=<?php echo $admin_id ?>">Profile</a>
        <a href="index.php?view_product">Products

        </a>


        <a href="index.php?view_customer">Cattles
        </a>

        <a class="divider" href="logout.php"> Logout <i class="fa fa-fw fa-power-off"></i></a>

      </div>

    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        <li>
          <a href="index.php?dashboard"><i class="fa fa-bar-chart"></i> Dashboard</a>
        </li>
        <li class="button-dropdown" id="#products">
          <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#products"><i
              class="fa fa-fw fa-table"></i> Product <i class="fa fa-fw fa-caret-down"></i></a>

          <ul class="dropdown-menu" id="products">
            <li>
              <a href="index.php?insert_product">Insert Product</a>
            </li>
            <li>
              <a href="index.php?view_product">view Product</a>
            </li>
          </ul>
        </li>

        <li class="button-dropdown" id="#category">
          <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#category"><i
              class="fa fa-fw fa-table"></i> Cattle <i class="fa fa-fw fa-caret-down"></i></a>

          <ul id="#category" class="dropdown-menu">
            <li>
              <a href="index.php?insert_cattle">Insert cattle info</a>
            </li>
            <li>
              <a href="index.php?view_cattle">view cattle</a>
            </li>
          </ul>
        </li>



        <li>
          <a href="index.php?view_customer">
            <i class="fa fa-fw fa-edit"></i> View Customer
          </a>
        </li>
        <li>
          <a href="index.php?view_order">
            <i class="fa fa-fw fa-list"></i> View Order
          </a>
        </li>
        <li>
          <a href="index.php?view_payments">
            <i class="fa fa-fw fa-money"></i> View Payments
          </a>
        </li>
        <li class="button-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#users"><i
              class="fa fa-fw fa-table"></i> Admin control <i class="fa fa-fw fa-caret-down"></i></a>

          <ul id="#users" class="dropdown-menu">
            <li>
              <a href="index.php?insert_user">Insert admin</a>
            </li>
            <li>
              <a href="index.php?view_user">view admin</a>
            </li>
            <li>
              <a href="index.php?user_profile=<?php echo $admin_id ?>">Edit Profile</a>
            </li>
          </ul>
        </li>

      </ul>

    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  </nav>

  <script>
    $('.collapse > .a').click(function() {
      $(this).parent().siblings().find('li').fadeOut(500);
      $(this).next('li').stop(true, false, true).fadeToggle(500);
      return false;
    });

  </script>
  <script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>



  <script>

    jQuery(document).ready(function(e) {
      function t(t) {
        e(t).bind("click", function(t) {
          t.preventDefault();
          e(this).parent().fadeOut()
        })
      }
      e(".dropdown-toggle").click(function() {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
          e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
      });
      e(document).bind("click", function(t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
      });
      e(document).bind("click", function(t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
      })
    });</script>

<?php } ?>