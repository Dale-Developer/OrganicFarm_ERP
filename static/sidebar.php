<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Geneva, sans-serif;
    background-color: #ffffff;
    overflow-x: hidden;
  }

  /* Topbar Styles */
  .topbar {
    width: 100%;
    padding: 0px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    z-index: 1000;
    height: 65px;
    gap: 20px;
  }

  .topbar-logo {
    display: flex;
    align-items: center;
    flex-shrink: 0;
  }

  .topbar-logo h1 {
    font-size: 1.3em;
    color: #FF0000;
    /* Changed from red to dark green */
    white-space: nowrap;
    font-weight: 800;
    /* letter-spacing: 0.5px; */
    line-height: 1.2;
    margin: 0;
  }

  .topbar-logo h3 {
    font-size: 1em;
    color: #000000;
    /* Softer green for the subline */
    font-weight: bolder;
    /* letter-spacing: 2px; */
    text-align: center;
    margin: 0;
    line-height: 1.2;
  }

  .topbar-logo img {
    margin-right: 15px;
    width: 40px;
    height: 40px;
    background: linear-gradient(180deg, #f7f05e 0%, #39a844 100%);
    border-radius: 50%;
  }

  /* New container for search + icons */
  .topbar-center {
    display: flex;
    align-items: center;
    gap: 30px;
    /* Space between search and icons */
    flex: 1;
    justify-content: center;
    margin: 0 40px;
  }

  /* Search Container */
  .search-container {
    position: relative;
    display: flex;
    align-items: center;
    width: 400px;
    /* Fixed width */
  }

  .search-container i {
    position: absolute;
    left: 15px;
    color: #70706f;
    z-index: 1;
    font-size: 1.2rem;
  }

  .search-container input {
    padding: 12px 20px 12px 45px;
    border: 1px solid #ddd;
    font-size: 1em;
    border-radius: 15px;
    width: 100%;
    height: 40px;
    background-color: #f8f9fa;
    outline: none;
    transition: all 0.3s ease;
  }

  .search-container input:focus {
    border-color: #3f1378;
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(22, 105, 179, 0.1);
  }

  /* Icon Navigation */
  .icon-nav {
    flex-shrink: 0;
  }

  .icon-nav ul {
    display: flex;
    list-style: none;
    gap: 20px;
    align-items: center;
    margin: 0;
    padding: 0;
  }

  .icon-nav li {
    list-style: none;
  }

  .icon-nav .nav-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: #70706f;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    padding: 8px 12px;
    border-radius: 10px;
    gap: 4px;
    min-width: 70px;
  }

  .icon-nav .nav-icon:hover {
    color: #123f20;
    transform: translateY(-2px);
  }

  .icon-nav .nav-icon i {
    font-size: 1.6rem;
    color: #70706f;
    transition: all 0.3s ease;
  }

  .icon-nav .nav-icon:hover i {
    color: #123f20;
    transform: scale(1.1);
  }

  .icon-nav .nav-icon span {
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .icon-nav .nav-icon.active {
    color: #123f20;
    transform: translateY(-1px);
    background-color: #f0f8ff;
  }

  .icon-nav .nav-icon.active i {
    color: #123f20;
    transform: scale(1.1);
  }

  /* Profile Navigation */
  .profile-nav {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .profile-icon {
    display: flex;
    flex-direction: row-reverse;
    align-items: center;
    text-decoration: none;
    color: #123f20;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 8px 15px 8px 12px;
    border-radius: 10px;
    gap: 10px;
    min-width: auto;
    cursor: pointer;
  }

  .profile-icon:hover {
    color: #123f20;
    transform: translateY(-1px);
  }

  .profile-icon i {
    font-size: 1.8rem;
    color: #4a4a4a;
    transition: all 0.3s ease;
  }

  .profile-icon:hover i {
    color: #123f20;
    transform: scale(1.1);
  }

  .profile-icon span {
    font-weight: 500;
    font-size: 1.2em;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .profile-icon h2 {
    font-size: 1em;
    color: #123f20;
  }

  .profile-icon.active {
    color: #123f20;
    transform: translateY(-2px);
    background-color: #f0f8ff;
  }

  .profile-icon.active i {
    color: #123f20;
    transform: scale(1.1);
  }

  /* Sidebar Styles */
  .sidebar {
    position: fixed;
    left: 0;
    top: 65px;
    height: calc(100vh - 65px);
    width: 250px;
    background: #123f20;

    display: flex;
    flex-direction: column;
    z-index: 999;
    border-top-right-radius: 25px;
  }

  .sidebar .nav {
    flex-grow: 1;
    padding: 30px 0 30px;
  }

  .sidebar .nav ul {
    list-style: none;
  }

  .sidebar .nav li {
    margin-bottom: 20px;
  }

  .sidebar .nav a {
    display: flex;
    align-items: center;
    padding: 15px 25px;
    text-decoration: none;
    color: #ffffff;
    transition: all 0.3s ease;
    font-size: 1.1em;
    font-weight: 500;
    border-left: 4px solid transparent;
  }

  .sidebar .nav a:hover {
    background-color: #ffffff;
    color: #123f20;
    /* border-left-color: #0d4d8c; */
    padding-left: 30px;
    font-size: 0.9em;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    margin-left: 10px;
  }

  .sidebar .nav a:hover i {
    color: #123f20;
  }

  .sidebar .nav a i {
    font-size: 1.5rem;
    margin-right: 20px;
    color: #ffffff;
    width: 24px;
    text-align: center;
    transition: all 0.3s ease;
  }

  .sidebar .nav a span {
    flex-grow: 1;
  }

  .sidebar .nav a.active {
    background-color: #ffffff;
    color: #123f20;
    padding-left: 30px;
    font-size: 0.9em;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    margin-left: 10px;
  }

  .sidebar .nav a.active i {
    color: #123f20;
  }

  .sidebar .nav a:hover,
  .sidebar .nav a.active {
    background-color: #ffffff;
    color: #123f20;
    padding-left: 30px;
    font-size: 0.9em;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    margin-left: 10px;
  }

  .sidebar .nav a:hover i,
  .sidebar .nav a.active i {
    color: #123f20;
  }

  .sidebar .logout {
    padding: 10px;
    background-color: #123f20;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
  }

  .sidebar .logout a {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px 20px;
    text-decoration: none;
    color: #ffffff;
    font-size: 1em;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
    width: 125px;
    /* background-color: rgba(255, 255, 255, 0.1); */
  }

  .sidebar .logout a:hover {
    background-color: #ffffff;
    color: #123f20;
    /* transform: translateX(5px); */
  }

  .sidebar .logout a:hover i {
    color: #123f20;
  }

  .sidebar .logout a i {
    font-size: 1.5rem;
    margin-right: 15px;
    color: #ffffff;
    transition: all 0.3s ease;
  }

  /* Main Content Area */
  .main-content {
    margin-left: 280px;
    margin-top: 65px;
    padding: 30px;
    min-height: calc(100vh - 65px);
    background-color: #f8f9fa;
  }

  /* ===== PAGE TRANSITION ANIMATIONS ===== */
  .page-container {
    position: relative;
    overflow: hidden;
    min-height: calc(100vh - 65px);
  }

  .page {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    transform: translateX(20px);
    transition:
      opacity 0.4s ease,
      transform 0.4s ease;
    pointer-events: none;
  }

  .page.active {
    opacity: 1;
    transform: translateX(0);
    pointer-events: all;
  }

  /* Slide animation for page transitions */
  .page.slide-in {
    animation: slideIn 0.4s ease forwards;
  }

  .page.slide-out {
    animation: slideOut 0.4s ease forwards;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(30px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideOut {
    from {
      opacity: 1;
      transform: translateX(0);
    }

    to {
      opacity: 0;
      transform: translateX(-30px);
    }
  }

  /* Fade animation alternative */
  .page.fade-in {
    animation: fadeIn 0.4s ease forwards;
  }

  .page.fade-out {
    animation: fadeOut 0.4s ease forwards;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes fadeOut {
    from {
      opacity: 1;
    }

    to {
      opacity: 0;
    }
  }

  /* Scale animation alternative */
  .page.scale-in {
    animation: scaleIn 0.4s ease forwards;
  }

  .page.scale-out {
    animation: scaleOut 0.4s ease forwards;
  }

  @keyframes scaleIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  @keyframes scaleOut {
    from {
      opacity: 1;
      transform: scale(1);
    }

    to {
      opacity: 0;
      transform: scale(1.05);
    }
  }

  /* Loading spinner for transitions */
  .page-loading {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: none;
  }

  .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #123f20;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  /* Enhanced sidebar link transitions */
  .sidebar .nav a {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }

  .sidebar .nav a::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent);
    transition: left 0.6s ease;
  }

  .sidebar .nav a:hover::before {
    left: 100%;
  }

  /* Smooth transitions for main content */
  .main-content {
    transition: margin-left 0.3s ease;
  }

  /* Card animations */
  .card {
    animation: cardAppear 0.5s ease forwards;
    opacity: 0;
    transform: translateY(20px);
  }

  @keyframes cardAppear {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Stagger animation for multiple cards */
  .card:nth-child(1) {
    animation-delay: 0.1s;
  }

  .card:nth-child(2) {
    animation-delay: 0.2s;
  }

  .card:nth-child(3) {
    animation-delay: 0.3s;
  }

  .card:nth-child(4) {
    animation-delay: 0.4s;
  }

  /* Add style for role badge */
  .profile-icon small {
    font-size: 0.7rem;
    background: #123f20;
    color: white;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: 5px;
  }
</style>
</head>

<body>
  <div class="topbar">
    <div class="topbar-logo">
      <img src="../../assets/img/organicfarmlogo.png" alt="LSPU Logo" />
      <div class="brandname">
        <h1>Arnold & Paz</h1>
        <h3>Organic Farm</h3>
      </div>
    </div>

    <div class="profile-nav">
      <a class="profile-icon">
        <!-- <i class='bx bxs-bell'></i> -->
      </a>
      <a class="profile-icon" href="#">
        <i class="bx bx-user-circle"></i>
      </a>
    </div>
  </div>

  <div class="sidebar">
    <div class="nav">
      <ul>
        <li>
          <a href="admin_dashboard.php" data-page="dashboard">
            <i class="bx bxs-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../../static/Admin/admin_orders.php" data-page="records">
            <i class="bx bxs-cart-alt"></i>
            <span>Orders</span>
          </a>
        </li>
        <li>
          <a href="../../static/Admin/admin_sales.php" data-page="requests">
            <i class="bx bxs-coin-stack"></i>
            <span>Sales</span>
          </a>
        </li>
        <li>
          <a href="../../static/Admin/admin_inventory.php" data-page="archived">
            <i class="bx bxs-package"></i>
            <span>Inventory</span>
          </a>
        </li>
        <li>
          <a href="../../static/Admin/admin_settings.php" data-page="reports">
            <i class="bx bxs-cog"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="logout">
      <a href="../../process/logout.php">
        <i class="bx bx-log-out"></i>
        <span>Logout</span>
      </a>
    </div>
  </div>

  <script src="../scripts/sidebar.js"></script>