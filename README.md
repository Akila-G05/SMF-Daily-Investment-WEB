# SmartMoneyFortune (SMF)

SmartMoneyFortune is a web-based money management platform built with PHP and MySQL.
It provides an investment package system with user wallets, referrals, bill payments,
fund transfers, withdrawals, and a full admin panel to manage everything.

## Project Structure

```
smf/
├── index.php                  # Landing page / User sign in
├── signup.php                 # User registration page
├── forgotPasswordProcess.php  # Forgot password flow
├── resetPasswordProcess.php   # Password reset
│
├── dashboard.php              # User dashboard (wallet, referral & withdrawal stats)
├── packages.php               # Investment packages listing
├── activatedPackages.php      # User's activated packages
├── payBill.php                # Bill payment page
├── fundTransfer.php           # Fund transfer page
├── withdraw.php               # Withdrawal request page
├── Referral.php               # Referral system page
├── profile.php                # User profile page
│
├── adminSignin.php            # Admin sign in page
├── adminPannel.php            # Admin dashboard
├── manageUsers.php            # Manage users
├── managePackages.php         # Manage investment packages
├── manageBill.php             # Manage bills
├── manageWithdrawals.php      # Manage withdrawals
├── ManageFundTranswer.php     # Manage fund transfers
│
├── connection.php             # Database connection class (MySQLi)
├── lineChart.php              # Dashboard chart data
│
├── *Process.php               # Backend process handlers (AJAX/form actions)
├── slidebar.php               # User sidebar navigation
├── adminSlidebar.php          # Admin sidebar navigation
│
├── style.css / slideBarStyle.css / script.js
├── bootstrap.css / bootstrap.js / bootstrap.bundle.js
├── d3.js                      # Charting library
├── PHPMailer.php / SMTP.php / Exception.php
├── fonts/                     # Quicksand font
├── resources/                 # Images (logo, backgrounds)
└── profile_images/            # Uploaded profile pictures
```

## Features

- **User Authentication** – Sign up, sign in, sign out, and password recovery via email verification codes (SMTP).
- **Dashboard** – Wallet balance, total withdrawn, referral count, and chart visualizations at a glance.
- **Investment Packages** – Browse available packages, activate packages, and track activated ones.
- **Wallet System** – Per-user wallet balance managed by admins.
- **Bill Payments** – Pay bills and view payment history with status tracking.
- **Fund Transfers** – Transfer funds between users with admin confirmation.
- **Withdrawals** – Request withdrawals and track approval status.
- **Referral System** – Unique referral codes per user to grow the network.
- **User Profile** – Update personal details and upload a profile image.
- **Admin Panel** – Separate admin login with:
  - Manage users (activate/deactivate, wallet balance updates)
  - Add/delete packages and update package balances
  - Confirm/change bill and bill-type status
  - Confirm or delete withdrawals and fund transfers
  - Change USD value and admin password (with email verification)

## Design

- **Dark theme** UI with a deep purple/navy palette (`#221f3f`) and white accent cards.
- **Quicksand** custom font for a modern, friendly look.
- **Sidebar navigation** layout for both users and admins.
- **Responsive grid** – Built on Bootstrap's 12-column grid; works on desktop and mobile.
- **Card-based widgets** on the dashboard for balances and statistics.
- **Bootstrap Icons** used throughout for clean, consistent iconography.
- Rounded corners, soft shadows, and alert banners for user feedback messages.

## Technologies

| Layer      | Technology |
|------------|------------|
| Frontend   | HTML5, CSS3, JavaScript |
| UI Kit     | Bootstrap 5, Bootstrap Icons |
| Charts     | D3.js |
| Fonts      | Quicksand (custom TTF) |
| Backend    | PHP |
| Database   | MySQL (via MySQLi) |
| Email      | PHPMailer (SMTP) |
| Server     | Apache / XAMPP |

## Getting Started

1. Install [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP).
2. Copy the `smf` folder into your `htdocs` directory.
3. Import `database/smf.sql` into MySQL (creates the `maruwa` database) and update credentials in `smf/connection.php`.
4. Start Apache and MySQL, then open: `http://localhost/smf/index.php`
