<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="slideBarStyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
  <body>
    
    <div class="sidebar close">
        <div class="logo-details">
          <i class='bx bx-bitcoin '></i>
          <span class="logo_name">Digital Money Fortune</span>
        </div>
        <ul class="nav-links">
          <li onclick="window.location.href='adminPannel.php'">
            <a href="#">
              <i class='bx bx-grid-alt' ></i>
              <span class="link_name" >AdminPannel</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">AdminPannel</a></li>
            </ul>
          </li>
          <li>
            <a href="manageUsers.php">
              <i class='bx bx-user' ></i>
              <span class="link_name">ManageUsers</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="manageUsers.php">ManageUsers</a></li>
            </ul>
          </li>
          <li>
            <a href="managePackages.php">
              <i class='bx bx-collection' ></i>
              <span class="link_name">ManagePackages</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="managePackages.php">ManagePackages</a></li>
            </ul>
          </li>
          <li>
            <a href="manageWithdrawals.php">
              <i class='bx bx-dollar' ></i>
              <span class="link_name">ManageWithdrawals</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="manageWithdrawals.php">ManageWithdrawals</a></li>
            </ul>
          </li>
          <li>
            <a href="ManageFundTranswer.php">
              <i class='bx bx-share'></i>
              <span class="link_name">ManageFundTransfer</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="ManageFundTranswer.php">ManageFundTransfer</a></li>
            </ul>
          </li>
          <li>
            <a href="manageBill.php">
              <i class='bx bx-barcode' ></i>
              <span class="link_name">Manage Bill</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="manageBill.php">Manage Bill</a></li>
            </ul>
          </li>
          <li>
            <a href="">
              <i class='bx bx-info-circle' ></i>
              <span class="link_name">About</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">About</a></li>
            </ul>
          </li>
          <li>
        <div class="profile-details">
          <div class="name-job">
            <div class="profile_name">Shashika</div>
          </div>
          <i onclick="window.location.href='adminSignin.php'" class='bx bx-log-out' ></i>
        </div>
      </li>
    </ul>
    </div>
    <section class="home-section">
      <div class="home-content">
        <i class='bx bx-menu' ></i>
      </div>
    </section>

  </body>
</html>
