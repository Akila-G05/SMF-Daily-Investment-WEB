
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
          <span class="logo_name">SMART Money Fortune</span>
        </div>
        <ul class="nav-links">
          <li onclick="window.location.href='dashboard.php'">
            <a href="#">
              <i class='bx bx-grid-alt' ></i>
              <span class="link_name" >Dashboard</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Dashboard</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="packages.php">
                <i class='bx bx-collection' ></i>
                <span class="link_name">Packages</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="packages.php">Packages</a></li>
              <li><a href="packages.php">Buy new Package</a></li>
              <li><a href="activatedPackages.php">Active Packages</a></li>
            </ul>
          </li>
          <!-- <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-link' ></i>
                <span class="link_name">Referral</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Referral</a></li>
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Login Form</a></li>
              <li><a href="#">Card Design</a></li>
            </ul>
          </li> -->
          <li>
            <a href="Referral.php">
              <i class='bx bx-link' ></i>
              <span class="link_name">Referral</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="Referral.php">Referral</a></li>
            </ul>
          </li>
          <li>
            <a href="profile.php">
              <i class='bx bx-user' ></i>
              <span class="link_name">Profile</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="profile.php">Profile</a></li>
            </ul>
          </li>
          <li>
            <a href="withdraw.php">
              <i class='bx bx-dollar' ></i>
              <span class="link_name">Withdrawals</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="withdraw.php">Withdrawals</a></li>
            </ul>
          </li>
          <li>
            <a href="fundTransfer.php">
              <i class='bx bx-share'></i>
              <span class="link_name">Fund Transfer</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="fundTransfer.php">Fund Transfer</a></li>
            </ul>
          </li>
          <li>
            <a href="payBill.php">
              <i class='bx bx-barcode'></i>
              <span class="link_name">Pay Bill</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="payBill.php">Pay Bill</a></li>
            </ul>
          </li>
          <li>
            <a href="#">
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
            <div class="profile_name"><?php echo $user["user_name"]; ?></div>
            <div class="job"><?php echo $user["b_id"]; ?></div>
          </div>
          <i onclick="signout();" class='bx bx-log-out' ></i>
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
