<?php
session_start();

// Handle success/error messages
$successMessage = '';
$errorMessage = '';
$errors = [];

if (isset($_GET['success']) && $_GET['success'] === 'signup') {
  $successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : 'Account created successfully! Please login.';
  unset($_SESSION['success']);
}

if (isset($_GET['error'])) {
  if ($_GET['error'] === 'login') {
    $errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : 'Login failed. Please try again.';
    unset($_SESSION['error']);
  } elseif ($_GET['error'] === 'signup') {
    $errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : 'Signup failed. Please try again.';
    unset($_SESSION['error']);
  }
  elseif ($_GET['error'] === 'admin') {
    $errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : 'Admin login failed.';
    unset($_SESSION['error']);
  }
}

if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../OrganicFarm_ERP/assets/img/organicfarmlogo.png">
  <title>Arnold and Paz Organic Farm</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --green-dark: #1a4d1a;
      --green-mid: #2e7d32;
      --green-accent: #4caf50;
      --green-light: #81c784;
      --gold: #f9a825;
      --cream: #f9f6f0;
      --text-dark: #1c2b1c;
      --text-mid: #4a5a4a;
      --white: #ffffff;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: "DM Sans", sans-serif;
      color: var(--text-dark);
      background: var(--white);
      overflow-x: hidden;
    }

    /* NAVBAR */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 5%;
      height: 68px;
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(8px);
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    .nav-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .nav-logo .logo-icon {
      width: 42px;
      height: 42px;
      background: linear-gradient(180deg,
          rgba(247, 240, 94, 1) 0%,
          rgba(57, 168, 68, 1) 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }

    .nav-logo .logo-icon img {
      width: 40px;
      height: 40px;
      object-fit: contain;
    }

    .nav-logo span {
      font-family: "Playfair Display", serif;
      font-size: 14px;
      font-weight: 700;
      color: var(--green-dark);
      line-height: 1.2;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 36px;
      list-style: none;
    }

    .nav-links a {
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      color: var(--text-dark);
      letter-spacing: 0.3px;
      transition: color 0.2s;
    }

    .nav-links a:hover {
      color: var(--green-mid);
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-login,
    .btn-signup {
      padding: 8px 22px;
      border-radius: 6px;
      font-family: "DM Sans", sans-serif;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-login {
      border: 2px solid var(--green-mid);
      background: transparent;
      color: var(--green-mid);
    }

    .btn-login:hover {
      background: var(--green-mid);
      color: var(--white);
    }

    .btn-signup {
      border: 2px solid var(--green-mid);
      background: var(--green-mid);
      color: var(--white);
    }

    .btn-signup:hover {
      background: var(--green-dark);
      border-color: var(--green-dark);
    }

    /* HERO */
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
      padding-top: 68px;
    }

    .hero-bg {
      position: absolute;
      inset: 0;
      background:
        linear-gradient(to bottom,
          rgba(10, 30, 10, 0.72) 0%,
          rgba(20, 50, 20, 0.55) 50%,
          rgba(10, 30, 10, 0.8) 100%),
        url("https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=1600&q=80") center/cover no-repeat;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 720px;
      padding: 0 20px;
      animation: fadeUp 1s ease both;
    }

    @keyframes fadeUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-badge {
      display: inline-block;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: var(--green-light);
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 6px 18px;
      border-radius: 30px;
      margin-bottom: 22px;
    }

    .hero h1 {
      font-family: "Playfair Display", serif;
      font-size: clamp(38px, 6vw, 72px);
      font-weight: 800;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 20px;
      text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
    }

    .hero h1 em {
      font-style: italic;
      color: var(--green-light);
    }

    .hero p {
      font-size: 16px;
      color: rgba(255, 255, 255, 0.8);
      line-height: 1.7;
      max-width: 520px;
      margin: 0 auto 36px;
    }

    .hero-cta {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-primary {
      padding: 14px 32px;
      background: var(--green-mid);
      color: var(--white);
      border: none;
      border-radius: 8px;
      font-family: "DM Sans", sans-serif;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s;
      box-shadow: 0 4px 18px rgba(46, 125, 50, 0.45);
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary:hover {
      background: var(--green-dark);
      transform: translateY(-2px);
    }

    .btn-outline-white {
      padding: 14px 32px;
      background: transparent;
      color: var(--white);
      border: 2px solid rgba(255, 255, 255, 0.6);
      border-radius: 8px;
      font-family: "DM Sans", sans-serif;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-outline-white:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: white;
    }

    .hero-scroll {
      position: absolute;
      bottom: 32px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      color: rgba(255, 255, 255, 0.6);
      font-size: 11px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
    }

    .scroll-line {
      width: 1px;
      height: 40px;
      background: linear-gradient(to bottom,
          rgba(255, 255, 255, 0.6),
          transparent);
      animation: scrollPulse 2s ease infinite;
    }

    @keyframes scrollPulse {

      0%,
      100% {
        opacity: 0.5;
      }

      50% {
        opacity: 1;
      }
    }

    /* SECTIONS */
    .section-passion {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
      min-height: 560px;
    }

    .passion-text {
      background: var(--cream);
      padding: 80px 60px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .section-tag {
      display: inline-block;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: var(--green-accent);
      margin-bottom: 16px;
    }

    .passion-text h2 {
      font-family: "Playfair Display", serif;
      font-size: clamp(28px, 3.5vw, 44px);
      font-weight: 700;
      color: var(--green-dark);
      line-height: 1.2;
      margin-bottom: 20px;
    }

    .passion-text p {
      font-size: 15px;
      color: var(--text-mid);
      line-height: 1.8;
      margin-bottom: 32px;
      max-width: 440px;
    }

    .passion-image {
      position: relative;
      overflow: hidden;
    }

    .passion-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.6s ease;
    }

    .passion-image:hover img {
      transform: scale(1.04);
    }

    .since-badge {
      position: absolute;
      bottom: 30px;
      left: 30px;
      background: var(--green-dark);
      color: var(--white);
      padding: 14px 22px;
      border-radius: 10px;
      font-family: "Playfair Display", serif;
      font-size: 16px;
      font-weight: 700;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    }

    .since-badge span {
      display: block;
      font-family: "DM Sans", sans-serif;
      font-size: 11px;
      font-weight: 400;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      opacity: 0.8;
      margin-bottom: 2px;
    }

    .section-services {
      padding: 90px 5%;
      background: var(--white);
      text-align: center;
    }

    .section-header {
      max-width: 560px;
      margin: 0 auto 56px;
    }

    .section-header h2 {
      font-family: "Playfair Display", serif;
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 12px;
    }

    .section-header p {
      font-size: 15px;
      color: var(--text-mid);
      line-height: 1.7;
    }

    .divider {
      width: 56px;
      height: 3px;
      background: var(--green-accent);
      border-radius: 2px;
      margin: 14px auto 16px;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .service-card {
      background: var(--white);
      border: 1.5px solid #e8f0e8;
      border-radius: 14px;
      padding: 36px 24px;
      text-align: center;
      transition: all 0.3s ease;
      cursor: default;
    }

    .service-card:hover {
      border-color: var(--green-accent);
      box-shadow: 0 12px 40px rgba(76, 175, 80, 0.12);
      transform: translateY(-5px);
    }

    .service-icon {
      width: 64px;
      height: 64px;
      background: #e8f5e9;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin: 0 auto 20px;
      transition: background 0.3s;
    }

    .service-icon img {
      width: 32px;
      height: 32px;
      object-fit: contain;
    }

    .service-card:hover .service-icon {
      background: var(--green-accent);
    }

    .service-card h3 {
      font-size: 15px;
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 10px;
    }

    .service-card p {
      font-size: 13px;
      color: var(--text-mid);
      line-height: 1.65;
    }

    .section-products {
      padding: 90px 5%;
      background: var(--cream);
      text-align: center;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
      max-width: 1100px;
      margin: 0 auto 40px;
    }

    .product-card {
      background: var(--white);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
      text-align: left;
    }

    .product-card:hover {
      box-shadow: 0 16px 50px rgba(0, 0, 0, 0.12);
      transform: translateY(-6px);
    }

    .product-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
      transition: transform 0.4s;
    }

    .product-card:hover .product-img {
      transform: scale(1.05);
    }

    .product-img-wrap {
      overflow: hidden;
    }

    .product-body {
      padding: 18px 18px 20px;
    }

    .product-body h4 {
      font-size: 14px;
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 6px;
    }

    .product-body p {
      font-size: 12.5px;
      color: var(--text-mid);
      line-height: 1.6;
      margin-bottom: 12px;
    }

    .product-price {
      font-size: 16px;
      font-weight: 700;
      color: var(--green-mid);
    }

    .btn-see-all {
      display: inline-block;
      padding: 14px 38px;
      border: 2px solid var(--green-mid);
      border-radius: 8px;
      color: var(--green-mid);
      font-family: "DM Sans", sans-serif;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.25s;
      cursor: pointer;
    }

    .btn-see-all:hover {
      background: var(--green-mid);
      color: var(--white);
    }

    .stats-strip {
      background: var(--green-mid);
      padding: 48px 5%;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      text-align: center;
    }

    .stat-item h3 {
      font-family: "Playfair Display", serif;
      font-size: 40px;
      font-weight: 800;
      color: var(--white);
      margin-bottom: 6px;
    }

    .stat-item p {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.75);
      text-transform: uppercase;
      letter-spacing: 1.5px;
    }

    footer {
      background: var(--green-dark);
      padding: 64px 5% 36px;
      color: rgba(255, 255, 255, 0.75);
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1.5fr;
      gap: 48px;
      margin-bottom: 48px;
    }

    .footer-brand h3 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--white);
      margin-bottom: 14px;
    }

    .footer-brand p {
      font-size: 13.5px;
      line-height: 1.8;
      margin-bottom: 22px;
    }

    .footer-socials {
      display: flex;
      gap: 12px;
    }

    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      color: var(--white);
      text-decoration: none;
      transition: background 0.2s;
    }

    .social-icon:hover {
      background: var(--green-accent);
    }

    .footer-col h4 {
      font-size: 14px;
      font-weight: 700;
      color: var(--white);
      letter-spacing: 0.5px;
      margin-bottom: 18px;
      text-transform: uppercase;
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col ul li {
      margin-bottom: 10px;
    }

    .footer-col ul li a {
      text-decoration: none;
      color: rgba(255, 255, 255, 0.65);
      font-size: 13.5px;
      transition: color 0.2s;
    }

    .footer-col ul li a:hover {
      color: var(--green-light);
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding-top: 26px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 12.5px;
      color: rgba(255, 255, 255, 0.4);
    }

    .fade-in {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 0.65s ease,
        transform 0.65s ease;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .fade-in-delay-1 {
      transition-delay: 0.1s;
    }

    .fade-in-delay-2 {
      transition-delay: 0.2s;
    }

    .fade-in-delay-3 {
      transition-delay: 0.3s;
    }

    .newsletter {
      background: var(--cream);
      padding: 70px 5%;
      text-align: center;
    }

    .newsletter-inner {
      max-width: 580px;
      margin: 0 auto;
    }

    .newsletter h2 {
      font-family: "Playfair Display", serif;
      font-size: 32px;
      font-weight: 700;
      color: var(--green-dark);
      margin-bottom: 10px;
    }

    .newsletter p {
      font-size: 14px;
      color: var(--text-mid);
      margin-bottom: 28px;
    }

    .newsletter-form {
      display: flex;
      gap: 0;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .newsletter-input {
      flex: 1;
      padding: 16px 20px;
      border: none;
      outline: none;
      font-family: "DM Sans", sans-serif;
      font-size: 14px;
      background: var(--white);
    }

    .newsletter-btn {
      padding: 16px 28px;
      background: var(--green-mid);
      color: var(--white);
      border: none;
      font-family: "DM Sans", sans-serif;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s;
      white-space: nowrap;
    }

    .newsletter-btn:hover {
      background: var(--green-dark);
    }

    /* =============================================
       SPLIT-PANEL MODAL — INCREASED LEFT PANEL WIDTH
       ============================================= */
    .modal-overlay {
      position: fixed;
      inset: 0;
      z-index: 999;
      background-color: rgba(5, 20, 5, 0.75);
      backdrop-filter: blur(6px);
      display: none;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .modal-container {
      display: grid;
      /* CHANGE: left panel takes 1.4 fraction, right panel 1 fraction → more white space */
      grid-template-columns: 1.4fr 1fr;
      max-width: 1000px;
      /* slightly wider to accommodate */
      width: 100%;
      border-radius: 20px;
      box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
      overflow: hidden;
      animation: modalPop 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes modalPop {
      0% {
        opacity: 0;
        transform: scale(0.9) translateY(16px);
      }

      100% {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    /* ---- LEFT: Form Panel (now larger) ---- */
    .modal-form-panel {
      background: #ffffff;
      padding: 2.8rem 2.6rem 2.2rem;
      /* more breathing room */
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .modal-form-panel .close-modal {
      position: absolute;
      top: 1rem;
      right: 1.2rem;
      background: none;
      border: none;
      font-size: 1.6rem;
      line-height: 1;
      cursor: pointer;
      color: #aab5aa;
      transition: color 0.2s;
      z-index: 2;
    }

    .modal-form-panel .close-modal:hover {
      color: var(--green-dark);
    }

    .form-panel-title {
      font-family: "Playfair Display", serif;
      font-size: 2.2rem;
      /* slightly larger */
      font-weight: 800;
      color: var(--green-dark);
      line-height: 1.1;
      margin-bottom: 0;
      text-align: center;
    }

    .form-panel-subtitle {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--text-mid);
      margin-bottom: 1.8rem;
      margin-top: 0.2rem;
      text-align: center;
    }

    /* Tab switcher */
    .modal-tabs {
      display: flex;
      gap: 0;
      background: #f0f4f0;
      border-radius: 10px;
      padding: 4px;
      margin-bottom: 1.8rem;
    }

    .tab-btn {
      flex: 1;
      background: none;
      border: none;
      padding: 0.6rem 0.5rem;
      font-family: "DM Sans", sans-serif;
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--text-mid);
      cursor: pointer;
      border-radius: 7px;
      transition: all 0.2s;
    }

    .tab-btn.active {
      background: var(--green-mid);
      color: #fff;
      box-shadow: 0 2px 10px rgba(46, 125, 50, 0.3);
    }

    /* Forms */
    .auth-form {
      display: none;
      flex-direction: column;
      gap: 0;
    }

    .auth-form.active-form {
      display: flex;
    }

    .form-group {
      margin-bottom: 1.1rem;
      /* a bit more spacing */
    }

    .form-group label {
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--text-mid);
      display: block;
      margin-bottom: 0.3rem;
    }

    /* Style phone number input like other fields */
    .form-group input[type="tel"] {
      width: 100%;
      padding: 0.85rem 1rem;
      border: 1.5px solid #dde6dd;
      border-radius: 9px;
      font-family: "DM Sans", sans-serif;
      font-size: 0.95rem;
      color: var(--text-dark);
      background: #fafcfa;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    /* Focus effect */
    .form-group input[type="tel"]:focus {
      outline: none;
      border-color: #2e7d32;
      /* matches your green */
      box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
      background: #fff;
    }

    /* Optional: placeholder styling */
    .form-group input[type="tel"]::placeholder {
      color: #aab5aa;
      font-style: italic;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 0.85rem 1rem;
      /* taller inputs */
      border: 1.5px solid #dde6dd;
      border-radius: 9px;
      font-family: "DM Sans", sans-serif;
      font-size: 0.95rem;
      color: var(--text-dark);
      background: #fafcfa;
      transition:
        border-color 0.2s,
        box-shadow 0.2s;
    }

    .form-group input:focus {
      outline: none;
      border-color: var(--green-mid);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
      background: #fff;
    }

    .form-row-space {
      display: flex;
      justify-content: flex-end;
      margin-top: -0.4rem;
      margin-bottom: 1rem;
    }

    .forgot-link {
      font-size: 0.78rem;
      color: var(--green-mid);
      text-decoration: none;
      font-weight: 600;
      cursor: pointer;
    }

    .forgot-link:hover {
      text-decoration: underline;
    }

    .btn-modal {
      width: 100%;
      padding: 0.95rem;
      /* slightly bigger button */
      background: var(--green-mid);
      border: none;
      border-radius: 10px;
      color: white;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      transition:
        background 0.2s,
        transform 0.15s;
      box-shadow: 0 4px 16px rgba(46, 125, 50, 0.35);
      margin-bottom: 1rem;
    }

    .btn-modal:hover {
      background: var(--green-dark);
      transform: translateY(-1px);
    }

    .btn-modal:active {
      transform: translateY(0);
    }

    /* Or connect with */
    .divider-or {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #aab5aa;
      font-size: 0.78rem;
      font-weight: 500;
      margin-bottom: 1rem;
    }

    .divider-or::before,
    .divider-or::after {
      content: "";
      flex: 1;
      height: 1px;
      background: #e0e8e0;
    }

    .btn-google {
      width: 100%;
      padding: 0.8rem;
      background: #fff;
      border: 1.5px solid #dde6dd;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      cursor: pointer;
      font-family: "DM Sans", sans-serif;
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-dark);
      transition:
        border-color 0.2s,
        box-shadow 0.2s;
      margin-bottom: 1.3rem;
    }

    .btn-google:hover {
      border-color: #4285f4;
      box-shadow: 0 2px 10px rgba(66, 133, 244, 0.15);
    }

    .btn-google svg {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
    }

    .form-footer {
      text-align: center;
      font-size: 0.88rem;
      color: var(--text-mid);
    }

    .form-footer .link-action {
      color: var(--green-mid);
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
    }

    .form-footer .link-action:hover {
      text-decoration: underline;
    }

    /* ---- RIGHT: Branding Panel (now a bit narrower) ---- */
    .modal-brand-panel {
      background: linear-gradient(160deg,
          #2a7d2e 0%,
          #1a5c1e 50%,
          #0f3d12 100%);
      padding: 2.6rem 1.8rem;
      /* adjust padding to fit */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    /* decorative circles */
    .modal-brand-panel::before {
      content: "";
      position: absolute;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.04);
      border-radius: 50%;
      top: -80px;
      right: -80px;
    }

    .modal-brand-panel::after {
      content: "";
      position: absolute;
      width: 200px;
      height: 200px;
      background: rgba(255, 255, 255, 0.04);
      border-radius: 50%;
      bottom: -60px;
      left: -60px;
    }

    .brand-logo-wrap {
      width: 90px;
      height: 90px;
      background: linear-gradient(180deg, #f7f05e 0%, #39a844 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.4rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      position: relative;
      z-index: 1;
    }

    .brand-logo-wrap img {
      width: 74px;
      height: 74px;
      object-fit: contain;
    }

    .brand-logo-wrap .brand-emoji {
      font-size: 40px;
      line-height: 1;
    }

    .brand-name {
      font-family: "Playfair Display", serif;
      font-size: 1.65rem;
      font-weight: 800;
      color: #f9d84a;
      line-height: 1.15;
      letter-spacing: 0.5px;
      margin-bottom: 0.3rem;
      position: relative;
      z-index: 1;
      text-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
    }

    .brand-sub {
      font-family: "DM Sans", sans-serif;
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 1.4rem;
      position: relative;
      z-index: 1;
    }

    .brand-desc {
      font-size: 0.85rem;
      color: rgba(255, 255, 255, 0.75);
      line-height: 1.75;
      max-width: 220px;
      position: relative;
      z-index: 1;
    }

    .brand-badges {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 1.4rem;
      position: relative;
      z-index: 1;
    }

    .brand-badge {
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: rgba(255, 255, 255, 0.85);
      font-size: 0.72rem;
      font-weight: 600;
      padding: 4px 12px;
      border-radius: 20px;
      letter-spacing: 0.5px;
    }

    /* Responsive */
    @media (max-width: 780px) {
      .modal-container {
        grid-template-columns: 1fr;
        /* stack on mobile */
        max-width: 420px;
      }

      .modal-brand-panel {
        padding: 1.6rem 1.5rem;
      }

      .modal-brand-panel::before,
      .modal-brand-panel::after {
        display: none;
      }

      .form-panel-title {
        font-size: 1.8rem;
      }

      .modal-form-panel {
        padding: 2rem 1.5rem 1.5rem;
      }
    }
  </style>
</head>

<body>
  <!-- ===================== MODAL ===================== -->
  <div class="modal-overlay" id="authModal">
    <div class="modal-container">
      <!-- LEFT: Form Panel -->
      <div class="modal-form-panel">
        <button class="close-modal" id="closeModalBtn" aria-label="Close">
          &times;
        </button>

        <h2 class="form-panel-title" id="modalTitle" style="justify-content: center;">Welcome</h2>
        <p class="form-panel-subtitle" id="modalSubtitle">
          to Producer of Vermicast-Organic Fertilizer
        </p>

        <!-- Tab toggle - Now with 3 tabs -->
        <div class="modal-tabs">
          <button class="tab-btn active" id="tabCustomerLogin">Customer Login</button>
          <button class="tab-btn" id="tabAdminLogin">Admin Login</button>
          <button class="tab-btn" id="tabSignup">Sign Up</button>
        </div>

        <!-- CUSTOMER LOGIN FORM -->
        <form class="auth-form active-form" id="customerLoginForm" action="process/login.php" method="POST">
          <input type="hidden" name="role" value="customer">
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="hello@organicfarm.com" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required />
          </div>
          <div class="form-row-space">
            <span class="forgot-link">Forgot Password?</span>
          </div>

          <?php if ($errorMessage && isset($_GET['error']) && $_GET['error'] === 'login'): ?>
            <div
              style="background: #fee; color: #c33; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px;">
              <?php echo htmlspecialchars($errorMessage); ?>
            </div>
          <?php endif; ?>

          <button type="submit" class="btn-modal">Login as Customer</button>
          <!-- <div class="divider-or">or connect with</div>
          <button type="button" class="btn-google">
            <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
              <path fill="#EA4335"
                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
              <path fill="#4285F4"
                d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
              <path fill="#FBBC05"
                d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
              <path fill="#34A853"
                d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.34-8.16 2.34-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
            </svg>
            Continue with Google
          </button> -->
          <div class="form-footer">
            Don't have an account?
            <span class="link-action" id="gotoSignupFromCustomer">Sign up</span>
          </div>
        </form>

        <!-- ADMIN LOGIN FORM -->
        <form class="auth-form" id="adminLoginForm" action="process/admin_login.php" method="POST">
          <div class="form-group">
            <label>Admin Email</label>
            <input type="email" name="email" placeholder="admin@organicfarm.com" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required />
          </div>
          <div class="form-group">
            <label>Admin Security Key <span style="color:#dc3545;">*</span></label>
            <input type="password" name="admin_key" placeholder="Enter admin security key" required />
            <small style="font-size: 11px; color: #666; display: block; margin-top: 5px;">
              🔒 Additional security key required for admin access
            </small>
          </div>

          <?php if ($errorMessage && isset($_GET['error']) && $_GET['error'] === 'admin'): ?>
            <div
              style="background: #fee; color: #c33; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px;">
              <?php echo htmlspecialchars($errorMessage); ?>
            </div>
          <?php endif; ?>

          <button type="submit" class="btn-modal">Login as Admin</button>
          <div class="divider-or">secure access</div>
          <div
            style="background: #fff3e0; padding: 12px; border-radius: 8px; text-align: center; font-size: 12px; color: #e65100;">
            🔐 This area is restricted to authorized administrators only
          </div>
        </form>

        <!-- SIGNUP FORM -->
        <form class="auth-form" id="signupForm" action="process/signup.php" method="POST">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Arnold Paz" required />
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="hello@organicfarm.com" required />
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" placeholder="+63 912 345 6789" />
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" placeholder="Purok 4 Tranca Bay Laguna" />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="at least 6 characters" required />
          </div>

          <?php if ($errorMessage && isset($_GET['error']) && $_GET['error'] === 'signup'): ?>
            <div
              style="background: #fee; color: #c33; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px;">
              <?php echo htmlspecialchars($errorMessage); ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($errors)): ?>
            <div
              style="background: #fee; color: #c33; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px;">
              <?php foreach ($errors as $err): ?>
                <div>• <?php echo htmlspecialchars($err); ?></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if ($successMessage): ?>
            <div
              style="background: #e8f5e9; color: #2e7d32; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px;">
              <?php echo htmlspecialchars($successMessage); ?>
            </div>
          <?php endif; ?>

          <button type="submit" class="btn-modal">Sign Up</button>
          <!-- <div class="divider-or">or connect with</div>
          <button type="button" class="btn-google">
            <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
              <path fill="#EA4335"
                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
              <path fill="#4285F4"
                d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
              <path fill="#FBBC05"
                d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
              <path fill="#34A853"
                d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.34-8.16 2.34-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
            </svg>
            Continue with Google
          </button> -->
          <div class="form-footer">
            Already have account?
            <span class="link-action" id="gotoLoginFromSignup">Sign in</span>
          </div>
        </form>
      </div>

      <!-- RIGHT: Branding Panel -->
      <div class="modal-brand-panel">
        <div class="brand-logo-wrap">
          <img src="../assets/img/organicfarmlogo.png" alt="Arnold & Paz Logo"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
          <span class="brand-emoji" style="display: none">🧑‍🌾</span>
        </div>
        <div class="brand-name">Arnold &amp; Paz<br />Organic Farm</div>
        <div class="brand-sub">Organic Fertilizer</div>
        <p class="brand-desc">
          Natural, and sustainably grown just for you. Log in to explore our
          products and place your orders with ease.
        </p>
        <div class="brand-badges">
          <span class="brand-badge">🌿 100% Organic</span>
          <span class="brand-badge">🪱 Vermicast</span>
          <span class="brand-badge">✅ Certified</span>
        </div>
      </div>
    </div>
  </div>

  <!-- NAVBAR -->
  <nav>
    <a href="#" class="nav-logo">
      <div class="logo-icon">
        <img src="../OrganicFarm_ERP/assets/img/organicfarmlogo.png" alt="" />
      </div>
      <span>Arnold &amp; Paz<br />Organic Farm</span>
    </a>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#about">About Us</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#products">Products</a></li>
    </ul>
    <div class="nav-actions">
      <button class="btn-login" id="openLoginBtn">Login</button>
      <button class="btn-signup" id="openSignupBtn">Sign Up</button>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content">
      <span class="hero-badge">🌿 100% Certified Organic</span>
      <h1>Arnold and Paz<br /><em>Organic Farm</em></h1>
      <p>
        Soil health. Plant health. Your health. Organic farming powered by
        vermicast.
      </p>
      <div class="hero-cta">
        <!-- <a href="#openLoginBtn" class="btn-primary">Get Started</a> -->
        <button class="btn-primary" id="openLoginBtn">Get Started</button>
        <a href="#about" class="btn-outline-white">Learn More</a>
      </div>
    </div>
    <div class="hero-scroll">
      <div class="scroll-line"></div>
      Scroll
    </div>
  </section>

  <section class="section-passion" id="about">
    <div class="passion-text fade-in">
      <span class="section-tag">🌾 Who We Are</span>
      <h2>Our Passion: Nurturing Growth, Sustaining the Future</h2>
      <p>
        We believe that great food starts with great soil. Our family has
        enriched the same land, guided by generations of wisdom. At the heart
        of our sustainable farm is vermicompost—using the power of worms to
        transform natural waste into the richest, most life-giving soil.
      </p>
      <a href="#" class="btn-primary" style="width: fit-content">Get Started</a>

    </div>
    <div class="passion-image">
      <img src="../OrganicFarm_ERP/assets/img/background.png" alt="Organic farm field" />
      <div class="since-badge"><span>Producing since</span>2018</div>
    </div>
  </section>

  <section class="section-services" id="services">
    <div class="section-header fade-in">
      <h2>Our Service</h2>
      <div class="divider"></div>
      <p>
        We provide high-quality vermicast products and farm essentials to
        support sustainable agriculture and healthy soil for growers
        everywhere.
      </p>
    </div>
    <div class="services-grid">
      <div class="service-card fade-in fade-in-delay-2">
        <div class="service-icon">
          <img src="../OrganicFarm_ERP/assets/icons/food.png" alt="" />
        </div>
        <h3>Vermicast Import &amp; Export</h3>
        <p>
          We connect local and international markets with premium vermicast
          products. Quality and consistency every step of the way.
        </p>
      </div>
      <div class="service-card fade-in fade-in-delay-3">
        <div class="service-icon">
          <img src="../OrganicFarm_ERP/assets/icons/shovel.png" alt="" />
        </div>
        <h3>Farm Necessities &amp; Supplies</h3>
        <p>
          From composting tools to organic farming inputs, we provide the
          essentials for a productive and sustainable farm operation.
        </p>
      </div>
    </div>
  </section>

  <section class="section-products" id="products">
    <div class="section-header fade-in">
      <h2>Our Featured Product</h2>
      <div class="divider"></div>
      <p>
        Nurtured by nature and powered by worms — each bag of vermicast
        carries the richness of healthy soil and our family's commitment to
        organic farming since 2018.
      </p>
    </div>
    <div class="products-grid">
      <div class="product-card fade-in fade-in-delay-1">
        <div class="product-img-wrap">
          <img class="product-img" src="../OrganicFarm_ERP/assets/img/COMPOST.jpg" alt="vermicast compost" />
        </div>
        <div class="product-body">
          <h4>Premium Vermicast Compost</h4>
          <p>
            Pure, nutrient-rich organic fertilizer produced by American
            Nightcrawlers. Enhances soil health and boosts plant growth
            naturally.
          </p>
          <span class="product-price">₱300 / 50kg</span>
        </div>
      </div>
      <div class="product-card fade-in fade-in-delay-2">
        <div class="product-img-wrap">
          <img class="product-img" src="../OrganicFarm_ERP/assets/img/ANC.jpg" alt="ANC" />
        </div>
        <div class="product-body">
          <h4>American Night Crawlers</h4>
          <p>
            Healthy, hardworking composting worms ideal for vermiculture
            operations, home gardens, and organic farms.
          </p>
          <span class="product-price">₱250 / kg</span>
        </div>
      </div>
    </div>
    <a href="#" class="btn-see-all">See All Products</a>
  </section>

  <div class="stats-strip">
    <div class="stat-item fade-in">
      <h3>8+</h3>
      <p>Years of Farming</p>
    </div>
    <div class="stat-item fade-in fade-in-delay-1">
      <h3>1.2k</h3>
      <p>Happy Customers</p>
    </div>
    <div class="stat-item fade-in fade-in-delay-2">
      <h3>2</h3>
      <p>Organic Products</p>
    </div>
    <div class="stat-item fade-in fade-in-delay-3">
      <h3>100%</h3>
      <p>Certified Organic</p>
    </div>
  </div>

  <div class="newsletter">
    <div class="newsletter-inner fade-in">
      <h2>Stay Rooted With Us 🌿</h2>
      <p>
        Get seasonal updates, farm news, and exclusive offers delivered to
        your inbox.
      </p>
      <div class="newsletter-form">
        <input class="newsletter-input" type="email" placeholder="Enter your email address…" />
        <button class="newsletter-btn">Subscribe</button>
      </div>
    </div>
  </div>

  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <h3>🌱 Organic Farm</h3>
        <p>
          Nurtured by nature and powered by worms — each bag of vermicast
          carries the richness of healthy soil and our family's commitment to
          organic farming since 2018.
        </p>
        <div class="footer-socials">
          <a href="#" class="social-icon">f</a><a href="#" class="social-icon">in</a><a href="#"
            class="social-icon">tw</a><a href="#" class="social-icon">ig</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Pages</h4>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Product</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>About</h4>
        <ul>
          <li><a href="#">Our Service</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Careers</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <ul>
          <li><a href="#">📍 Purok 4 Tranca Bay Laguna</a></li>
          <li><a href="#">📞 +63 928 502 6899</a></li>
          <li><a href="#">✉️ mariadelapaztolentino@gmail.com</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Arnold and Paz Organic Farm. All rights reserved.</span><span>Privacy Policy · Terms of
        Service</span>
    </div>
  </footer>

  <script>
    (function () {
      /* Scroll animations */
      const observer = new IntersectionObserver(
        (entries) =>
          entries.forEach((e) => {
            if (e.isIntersecting) e.target.classList.add("visible");
          }),
        { threshold: 0.12 },
      );
      document
        .querySelectorAll(".fade-in")
        .forEach((el) => observer.observe(el));

      /* Modal elements */
      /* Modal elements */
      const modalOverlay = document.getElementById("authModal");
      const openLoginBtn = document.getElementById("openLoginBtn");
      const openSignupBtn = document.getElementById("openSignupBtn");
      const closeModalBtn = document.getElementById("closeModalBtn");

      // New tab buttons
      const tabCustomerLogin = document.getElementById("tabCustomerLogin");
      const tabAdminLogin = document.getElementById("tabAdminLogin");
      const tabSignup = document.getElementById("tabSignup");

      // Forms
      const customerLoginForm = document.getElementById("customerLoginForm");
      const adminLoginForm = document.getElementById("adminLoginForm");
      const signupForm = document.getElementById("signupForm");

      const modalTitle = document.getElementById("modalTitle");
      const modalSubtitle = document.getElementById("modalSubtitle");

      // Link actions
      const gotoSignupFromCustomer = document.getElementById("gotoSignupFromCustomer");
      const gotoLoginFromSignup = document.getElementById("gotoLoginFromSignup");

      function showTab(tab) {
        // Hide all forms
        customerLoginForm.classList.remove("active-form");
        adminLoginForm.classList.remove("active-form");
        signupForm.classList.remove("active-form");

        // Remove active class from all tabs
        tabCustomerLogin.classList.remove("active");
        tabAdminLogin.classList.remove("active");
        tabSignup.classList.remove("active");

        // Show selected form and activate tab
        if (tab === "customer") {
          customerLoginForm.classList.add("active-form");
          tabCustomerLogin.classList.add("active");
          modalTitle.textContent = "Welcome Customer";
          modalSubtitle.textContent = "to Producer of Vermicast-Organic Fertilizer";
        } else if (tab === "admin") {
          adminLoginForm.classList.add("active-form");
          tabAdminLogin.classList.add("active");
          modalTitle.textContent = "Admin Portal";
          modalSubtitle.textContent = "Restricted Access - Admin Only";
        } else if (tab === "signup") {
          signupForm.classList.add("active-form");
          tabSignup.classList.add("active");
          modalTitle.textContent = "Create Account";
          modalSubtitle.textContent = "Join the Arnold & Paz farm community";
        }
      }

      function openModal(tab) {
        showTab(tab);
        modalOverlay.style.display = "flex";
        document.body.style.overflow = "hidden";
      }

      function closeModal() {
        modalOverlay.style.display = "none";
        document.body.style.overflow = "";
      }

      // Event listeners
      openLoginBtn.addEventListener("click", () => openModal("customer"));
      openSignupBtn.addEventListener("click", () => openModal("signup"));
      closeModalBtn.addEventListener("click", closeModal);
      modalOverlay.addEventListener("click", (e) => {
        if (e.target === modalOverlay) closeModal();
      });

      tabCustomerLogin.addEventListener("click", () => showTab("customer"));
      tabAdminLogin.addEventListener("click", () => showTab("admin"));
      tabSignup.addEventListener("click", () => showTab("signup"));

      gotoSignupFromCustomer.addEventListener("click", () => showTab("signup"));
      gotoLoginFromSignup.addEventListener("click", () => showTab("customer"));

      /* Keyboard close */
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeModal();
      });

      /* Demo form submit */
      // document.querySelectorAll(".auth-form").forEach((form) => {
      //   form.addEventListener("submit", (e) => {
      //     e.preventDefault();
      //     alert(
      //       `🌱 ${form.id === "loginForm" ? "Login" : "Sign-up"} submitted! Welcome to the farm.`,
      //     );
      //     closeModal();
      //   });
      // });
    })();
  </script>
</body>

</html>