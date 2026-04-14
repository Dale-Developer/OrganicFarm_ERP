<?php
session_start();
require_once 'config/config.php';

$successMessage = '';
$errorMessage = '';
$errors = [];
$fullname = '';
$email = '';

// Redirect if already logged in as admin
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: static/Admin/admin_dashboard.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Collect & sanitize inputs
    $fullname           = trim($_POST['fullname'] ?? '');
    $email              = trim(strtolower($_POST['email'] ?? ''));
    $password           = $_POST['password'] ?? '';
    $confirm_password   = $_POST['confirm_password'] ?? '';
    $admin_key          = $_POST['admin_key'] ?? '';
    $confirm_admin_key  = $_POST['confirm_admin_key'] ?? '';
    
    // Validation
    if (empty($fullname)) {
        $errors[] = 'Full name is required.';
    } elseif (strlen($fullname) < 2) {
        $errors[] = 'Full name must be at least 2 characters.';
    }
    
    if (empty($email)) {
        $errors[] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }
    
    if (empty($admin_key)) {
        $errors[] = 'Admin security key is required.';
    } elseif (strlen($admin_key) < 8) {
        $errors[] = 'Admin security key must be at least 8 characters.';
    }
    
    if ($admin_key !== $confirm_admin_key) {
        $errors[] = 'Admin security keys do not match.';
    }
    
    // If no validation errors, proceed with registration
    if (empty($errors)) {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT UserID FROM users WHERE Email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                $errorMessage = 'An account with this email already exists.';
            } else {
                // Hash credentials
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $hashed_admin_key = password_hash($admin_key, PASSWORD_BCRYPT);
                
                // Insert new admin - Match your actual table columns
                $stmt = $pdo->prepare("
                    INSERT INTO users (FullName, Email, Password, admin_key, Role, Created_At, Updated_At)
                    VALUES (?, ?, ?, ?, 'admin', NOW(), NOW())
                ");
                $stmt->execute([$fullname, $email, $hashed_password, $hashed_admin_key]);
                
                $_SESSION['success'] = "Admin account for '{$fullname}' created successfully! You can now log in.";
                header('Location: index.php');
                exit();
            }
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            $errorMessage = 'Failed to create admin account: ' . $e->getMessage();
        }
    }
}

// Pull flash messages
if (isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
if (isset($_SESSION['old'])) {
    $fullname = $_SESSION['old']['fullname'] ?? '';
    $email = $_SESSION['old']['email'] ?? '';
    unset($_SESSION['old']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/img/organicfarmlogo.png" />
  <title>Admin Registration — Arnold & Paz Organic Farm</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
    rel="stylesheet"
  />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-dark:   #1a4d1a;
      --green-mid:    #2e7d32;
      --green-accent: #4caf50;
      --green-light:  #81c784;
      --gold:         #f9a825;
      --cream:        #f9f6f0;
      --text-dark:    #1c2b1c;
      --text-mid:     #4a5a4a;
      --white:        #ffffff;
      --red:          #c0392b;
    }

    body {
      font-family: "DM Sans", sans-serif;
      background: var(--cream);
      color: var(--text-dark);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ─── TOPBAR ─────────────────────────────────────── */
    .topbar {
      background: var(--green-dark);
      padding: 0 5%;
      height: 62px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .topbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .topbar-brand .logo-circle {
      width: 38px; height: 38px;
      background: linear-gradient(180deg, #f7f05e 0%, #39a844 100%);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      overflow: hidden;
    }
    .topbar-brand .logo-circle img {
      width: 34px; height: 34px; object-fit: contain;
    }
    .topbar-brand span {
      font-family: "Playfair Display", serif;
      font-size: 13px; font-weight: 700;
      color: #f9d84a; line-height: 1.25;
    }
    .topbar-back {
      font-size: 13px; color: rgba(255,255,255,0.7);
      text-decoration: none; font-weight: 600;
      display: flex; align-items: center; gap: 6px;
      transition: color 0.2s;
    }
    .topbar-back:hover { color: var(--green-light); }

    /* ─── PAGE WRAPPER ───────────────────────────────── */
    .page-wrap {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 20px;
    }

    /* ─── CARD ───────────────────────────────────────── */
    .card {
      display: grid;
      grid-template-columns: 1fr 360px;
      max-width: 920px;
      width: 100%;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 24px 72px rgba(0,0,0,0.14);
    }

    /* ─── FORM PANEL ─────────────────────────────────── */
    .form-panel {
      background: var(--white);
      padding: 3rem 2.8rem 2.4rem;
    }
    .form-panel-head {
      margin-bottom: 2rem;
    }
    .form-panel-head .label-tag {
      font-size: 11px; font-weight: 700;
      letter-spacing: 2.5px; text-transform: uppercase;
      color: var(--green-accent); display: block; margin-bottom: 6px;
    }
    .form-panel-head h1 {
      font-family: "Playfair Display", serif;
      font-size: 2rem; font-weight: 800;
      color: var(--green-dark); line-height: 1.1;
      margin-bottom: 6px;
    }
    .form-panel-head p {
      font-size: 13.5px; color: var(--text-mid); line-height: 1.6;
    }

    /* ─── FORM ROWS ──────────────────────────────────── */
    .row-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .form-group {
      margin-bottom: 1.1rem;
    }
    .form-group label {
      font-size: 11px; font-weight: 700;
      text-transform: uppercase; letter-spacing: 1px;
      color: var(--text-mid); display: block; margin-bottom: 5px;
    }
    .form-group input {
      width: 100%;
      padding: 0.82rem 1rem;
      border: 1.5px solid #dde6dd;
      border-radius: 9px;
      font-family: "DM Sans", sans-serif;
      font-size: 0.93rem;
      color: var(--text-dark);
      background: #fafcfa;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input:focus {
      outline: none;
      border-color: var(--green-mid);
      box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
      background: #fff;
    }
    .form-group input::placeholder { color: #aab5aa; font-style: italic; }
    .form-group small {
      display: block; margin-top: 4px;
      font-size: 11px; color: #888;
    }

    /* password wrapper with show/hide toggle */
    .pw-wrap { position: relative; }
    .pw-wrap input { padding-right: 2.8rem; }
    .pw-toggle {
      position: absolute; right: 12px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      cursor: pointer; font-size: 15px; color: #aab5aa;
      line-height: 1;
      transition: color 0.2s;
    }
    .pw-toggle:hover { color: var(--green-mid); }

    /* strength meter */
    .strength-bar {
      height: 4px; border-radius: 2px;
      background: #e0e8e0; margin-top: 6px; overflow: hidden;
    }
    .strength-fill {
      height: 100%; width: 0%;
      border-radius: 2px;
      transition: width 0.3s, background 0.3s;
    }
    .strength-label {
      font-size: 10px; color: #aaa; margin-top: 3px;
    }

    /* divider */
    .section-divider {
      display: flex; align-items: center; gap: 10px;
      margin: 1.4rem 0 1.2rem;
    }
    .section-divider::before,
    .section-divider::after {
      content: ""; flex: 1; height: 1px; background: #e0e8e0;
    }
    .section-divider span {
      font-size: 11px; font-weight: 700;
      letter-spacing: 1.5px; text-transform: uppercase; color: #aab5aa;
    }

    /* security key box */
    .key-box {
      background: #fff8e1;
      border: 1.5px solid #ffe082;
      border-radius: 10px;
      padding: 14px 16px;
      margin-bottom: 1.1rem;
      font-size: 12.5px; color: #795548; line-height: 1.6;
    }
    .key-box strong { color: #5d4037; }

    /* alerts */
    .alert {
      padding: 12px 16px;
      border-radius: 9px;
      margin-bottom: 1.2rem;
      font-size: 13px;
      line-height: 1.6;
    }
    .alert-error { background: #fdecea; color: var(--red); border-left: 4px solid var(--red); }
    .alert-success { background: #e8f5e9; color: var(--green-mid); border-left: 4px solid var(--green-accent); }

    /* submit */
    .btn-submit {
      width: 100%;
      padding: 0.95rem;
      background: var(--green-mid);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-family: "DM Sans", sans-serif;
      font-size: 1rem; font-weight: 700;
      letter-spacing: 0.5px; text-transform: uppercase;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      box-shadow: 0 4px 18px rgba(46,125,50,0.35);
      margin-top: 0.4rem;
    }
    .btn-submit:hover { background: var(--green-dark); transform: translateY(-1px); }
    .btn-submit:active { transform: translateY(0); }

    .form-footer {
      text-align: center;
      font-size: 13px; color: var(--text-mid);
      margin-top: 1.2rem;
    }
    .form-footer a { color: var(--green-mid); font-weight: 700; text-decoration: none; }
    .form-footer a:hover { text-decoration: underline; }

    /* ─── BRAND PANEL ────────────────────────────────── */
    .brand-panel {
      background: linear-gradient(160deg, #2a7d2e 0%, #1a5c1e 50%, #0f3d12 100%);
      padding: 2.8rem 2rem;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      text-align: center;
      position: relative; overflow: hidden;
    }
    .brand-panel::before {
      content: ""; position: absolute;
      width: 280px; height: 280px;
      background: rgba(255,255,255,0.04);
      border-radius: 50%; top: -80px; right: -80px;
    }
    .brand-panel::after {
      content: ""; position: absolute;
      width: 180px; height: 180px;
      background: rgba(255,255,255,0.04);
      border-radius: 50%; bottom: -50px; left: -50px;
    }
    .brand-logo {
      width: 88px; height: 88px;
      background: linear-gradient(180deg, #f7f05e 0%, #39a844 100%);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.4rem;
      box-shadow: 0 8px 28px rgba(0,0,0,0.3);
      position: relative; z-index: 1;
    }
    .brand-logo img { width: 72px; height: 72px; object-fit: contain; }
    .brand-name {
      font-family: "Playfair Display", serif;
      font-size: 1.55rem; font-weight: 800;
      color: #f9d84a; line-height: 1.15;
      margin-bottom: 4px;
      position: relative; z-index: 1;
      text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .brand-sub {
      font-size: 0.72rem; font-weight: 700;
      letter-spacing: 3px; text-transform: uppercase;
      color: rgba(255,255,255,0.65);
      margin-bottom: 1.6rem;
      position: relative; z-index: 1;
    }

    .info-list {
      list-style: none;
      text-align: left;
      position: relative; z-index: 1;
      width: 100%;
    }
    .info-list li {
      display: flex; align-items: flex-start; gap: 10px;
      padding: 10px 0;
      border-bottom: 1px solid rgba(255,255,255,0.08);
      font-size: 12.5px; color: rgba(255,255,255,0.8); line-height: 1.5;
    }
    .info-list li:last-child { border-bottom: none; }
    .info-list li .icon {
      font-size: 16px; flex-shrink: 0; margin-top: 1px;
    }
    .info-list li strong { color: #fff; display: block; font-size: 12px; }

    .admin-badge {
      margin-top: 1.6rem;
      background: rgba(249,168,37,0.15);
      border: 1px solid rgba(249,168,37,0.35);
      color: #f9d84a;
      font-size: 11px; font-weight: 700;
      letter-spacing: 1px; text-transform: uppercase;
      padding: 8px 18px; border-radius: 20px;
      position: relative; z-index: 1;
    }

    /* ─── FOOTER ─────────────────────────────────────── */
    .page-footer {
      background: var(--green-dark);
      text-align: center;
      padding: 18px;
      font-size: 12px; color: rgba(255,255,255,0.4);
    }

    /* ─── RESPONSIVE ─────────────────────────────────── */
    @media (max-width: 720px) {
      .card { grid-template-columns: 1fr; }
      .brand-panel { padding: 2rem 1.5rem; }
      .brand-panel::before, .brand-panel::after { display: none; }
      .row-2 { grid-template-columns: 1fr; gap: 0; }
      .form-panel { padding: 2rem 1.5rem; }
    }
  </style>
</head>
<body>

  <!-- TOPBAR -->
  <header class="topbar">
    <a href="index.php" class="topbar-brand">
      <div class="logo-circle">
        <img src="assets/img/organicfarmlogo.png" alt="Farm Logo"
          onerror="this.style.display='none'" />
      </div>
      <span>Arnold &amp; Paz<br/>Organic Farm</span>
    </a>
    <a href="index.php" class="topbar-back">← Back to Website</a>
  </header>

  <!-- PAGE BODY -->
  <div class="page-wrap">
    <div class="card">

      <!-- LEFT: Form -->
      <div class="form-panel">
        <div class="form-panel-head">
          <span class="label-tag">🔐 Admin Setup</span>
          <h1>Create Admin Account</h1>
          <p>Register a new administrator for the Arnold &amp; Paz ERP system. Keep your credentials secure.</p>
        </div>

        <!-- Flash messages -->
        <?php if ($successMessage): ?>
          <div class="alert alert-success">✅ <?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
          <div class="alert alert-error">⚠️ <?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
          <div class="alert alert-error">
            <?php foreach ($errors as $err): ?>
              <div>• <?= htmlspecialchars($err) ?></div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="" id="adminRegisterForm" novalidate>

          <!-- Name + Email -->
          <div class="row-2">
            <div class="form-group">
              <label for="fullname">Full Name</label>
              <input type="text" id="fullname" name="fullname"
                placeholder="e.g. Arnold Paz" required
                value="<?= htmlspecialchars($fullname) ?>" />
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email"
                placeholder="admin@organicfarm.com" required
                value="<?= htmlspecialchars($email) ?>" />
            </div>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <div class="pw-wrap">
              <input type="password" id="password" name="password"
                placeholder="At least 8 characters" required />
            </div>
            <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
            <div class="strength-label" id="strengthLabel"></div>
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <div class="pw-wrap">
              <input type="password" id="confirm_password" name="confirm_password"
                placeholder="Re-enter password" required />
            </div>
            <small id="matchMsg" style="font-size:11px;margin-top:3px;"></small>
          </div>

          <!-- Admin Security Key -->
          <div class="section-divider"><span>Admin Security Key</span></div>

          <div class="key-box">
            <strong>⚠️ Important:</strong> The admin security key is a <em>separate secret</em> required
            every time you log in as admin — in addition to your password.
            Store it safely; it cannot be recovered.
          </div>

          <div class="form-group">
            <label for="admin_key">Admin Security Key</label>
            <div class="pw-wrap">
              <input type="password" id="admin_key" name="admin_key"
                placeholder="Create a strong secret key" required />
            </div>
            <small>Min. 8 characters. This is stored hashed in the database.</small>
          </div>

          <div class="form-group">
            <label for="confirm_admin_key">Confirm Admin Security Key</label>
            <div class="pw-wrap">
              <input type="password" id="confirm_admin_key" name="confirm_admin_key"
                placeholder="Re-enter security key" required />
            </div>
            <small id="keyMatchMsg" style="font-size:11px;margin-top:3px;"></small>
          </div>

          <button type="submit" class="btn-submit">Create Admin Account</button>
        </form>

        <div class="form-footer">
          Already have an account?
          <a href="index.php">Login here</a>
        </div>
      </div>

      <!-- RIGHT: Brand -->
      <div class="brand-panel">
        <div class="brand-logo">
          <img src="assets/img/organicfarmlogo.png" alt="Logo"
            onerror="this.style.display='none'" />
        </div>
        <div class="brand-name">Arnold &amp; Paz<br/>Organic Farm</div>
        <div class="brand-sub">Admin Portal</div>

        <ul class="info-list">
          <li>
            <span class="icon">🔐</span>
            <div>
              <strong>Two-Layer Security</strong>
              Password + Admin Key required for every login.
            </div>
          </li>
          <li>
            <span class="icon">🛡️</span>
            <div>
              <strong>Hashed Credentials</strong>
              Passwords and keys are stored using bcrypt — never plain text.
            </div>
          </li>
          <li>
            <span class="icon">📋</span>
            <div>
              <strong>Full ERP Access</strong>
              Manage orders, inventory, customers, and reports.
            </div>
          </li>
          <li>
            <span class="icon">🌿</span>
            <div>
              <strong>Restricted Access</strong>
              Admin accounts are created manually — not through the public site.
            </div>
          </li>
        </ul>

        <div class="admin-badge">🧑‍💼 Administrator Registration</div>
      </div>

    </div>
  </div>

  <footer class="page-footer">
    © 2026 Arnold and Paz Organic Farm. All rights reserved.
  </footer>

  <script>
    // Show/hide password toggles
    document.querySelectorAll('.pw-toggle').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = document.getElementById(btn.dataset.target);
        if (input) {
          input.type = input.type === 'password' ? 'text' : 'password';
          btn.textContent = input.type === 'password' ? '👁' : '🙈';
        }
      });
    });

    // Password strength meter
    const pwInput    = document.getElementById('password');
    const fill       = document.getElementById('strengthFill');
    const label      = document.getElementById('strengthLabel');

    if (pwInput) {
      pwInput.addEventListener('input', () => {
        const val = pwInput.value;
        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))    score++;

        const map = [
          { pct: '0%',   color: '#e0e8e0', text: '' },
          { pct: '25%',  color: '#e53935', text: 'Weak' },
          { pct: '50%',  color: '#ffa726', text: 'Fair' },
          { pct: '75%',  color: '#66bb6a', text: 'Good' },
          { pct: '100%', color: '#2e7d32', text: 'Strong' },
        ];
        fill.style.width      = map[score].pct;
        fill.style.background = map[score].color;
        label.textContent     = map[score].text;
        label.style.color     = map[score].color;
      });
    }

    // Confirm password match
    const confirmPw  = document.getElementById('confirm_password');
    const matchMsg   = document.getElementById('matchMsg');
    if (confirmPw && pwInput) {
      confirmPw.addEventListener('input', () => {
        if (confirmPw.value === '') { matchMsg.textContent = ''; return; }
        const ok = confirmPw.value === pwInput.value;
        matchMsg.textContent = ok ? '✅ Passwords match' : '❌ Passwords do not match';
        matchMsg.style.color = ok ? '#2e7d32' : '#c0392b';
      });
    }

    // Confirm admin key match
    const adminKey        = document.getElementById('admin_key');
    const confirmAdminKey = document.getElementById('confirm_admin_key');
    const keyMatchMsg     = document.getElementById('keyMatchMsg');
    if (confirmAdminKey && adminKey) {
      confirmAdminKey.addEventListener('input', () => {
        if (confirmAdminKey.value === '') { keyMatchMsg.textContent = ''; return; }
        const ok = confirmAdminKey.value === adminKey.value;
        keyMatchMsg.textContent = ok ? '✅ Keys match' : '❌ Keys do not match';
        keyMatchMsg.style.color = ok ? '#2e7d32' : '#c0392b';
      });
    }

    // Client-side form guard
    const form = document.getElementById('adminRegisterForm');
    if (form) {
      form.addEventListener('submit', (e) => {
        if (pwInput && confirmPw && pwInput.value !== confirmPw.value) {
          e.preventDefault();
          alert('Passwords do not match. Please check and try again.');
          return;
        }
        if (adminKey && confirmAdminKey && adminKey.value !== confirmAdminKey.value) {
          e.preventDefault();
          alert('Admin security keys do not match. Please check and try again.');
          return;
        }
        if (pwInput && pwInput.value.length < 8) {
          e.preventDefault();
          alert('Password must be at least 8 characters.');
          return;
        }
        if (adminKey && adminKey.value.length < 8) {
          e.preventDefault();
          alert('Admin security key must be at least 8 characters.');
          return;
        }
      });
    }
  </script>
</body>
</html>