<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arnold and Paz Organic Farm · Products</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
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
        font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
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
        background: linear-gradient(
          180deg,
          rgba(247, 240, 94, 1) 0%,
          rgba(57, 168, 68, 1) 100%
        );
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
      .nav-user {
        display: flex;
        align-items: center;
        gap: 16px;
      }
      .notification-bell {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 50%;
        background: rgba(46, 125, 50, 0.1);
        transition: all 0.2s;
      }
      .notification-bell:hover {
        background: rgba(46, 125, 50, 0.2);
      }
      .notification-bell svg {
        width: 20px;
        height: 20px;
        fill: var(--green-mid);
      }
      .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #ff4757;
        color: white;
        font-size: 10px;
        font-weight: 600;
        padding: 2px 5px;
        border-radius: 8px;
        min-width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(255, 71, 87, 0.3);
      }
      .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid var(--green-light);
        transition: border-color 0.2s;
      }
      .user-avatar:hover {
        border-color: var(--green-mid);
      }

      /* Sidebar Styles */
      .sidebar {
        position: fixed;
        left: 0;
        top: 68px;
        height: calc(100vh - 68px);
        width: 250px;
        background: var(--green-dark);
        display: flex;
        flex-direction: column;
        z-index: 99;
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
        color: var(--green-dark);
        padding-left: 30px;
        font-size: 0.9em;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
        margin-left: 10px;
      }

      .sidebar .nav a:hover i {
        color: var(--green-dark);
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
        color: var(--green-dark);
        padding-left: 30px;
        font-size: 0.9em;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
        margin-left: 10px;
      }

      .sidebar .nav a.active i {
        color: var(--green-dark);
      }

      .sidebar .logout {
        padding: 10px;
        background-color: var(--green-dark);
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
      }

      .sidebar .logout a:hover {
        background-color: #ffffff;
        color: var(--green-dark);
      }

      .sidebar .logout a:hover i {
        color: var(--green-dark);
      }

      .sidebar .logout a i {
        font-size: 1.5rem;
        margin-right: 15px;
        color: #ffffff;
        transition: all 0.3s ease;
      }

      /* Search Bar Styles */
    .search-container {
      margin-bottom: 30px;
      display: flex;
      justify-content: center;
    }

    .search-box {
      position: relative;
      width: 100%;
      max-width: 400px;
    }

    .search-box i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
      font-size: 1.1rem;
    }

    .search-box input {
      width: 100%;
      padding: 12px 45px 12px 45px;
      border: 2px solid #e8f0fe;
      border-radius: 12px;
      font-size: 0.95rem;
      outline: none;
      transition: all 0.3s ease;
      background: white;
    }

    .search-box input:focus {
      border-color: var(--green-mid);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .search-box input::placeholder {
      color: var(--text-light);
    }

    .clear-search {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-light);
      cursor: pointer;
      padding: 5px;
      border-radius: 50%;
      transition: all 0.2s ease;
    }

    .clear-search:hover {
      background: var(--background-light);
      color: var(--text-dark);
    }

    .card-wrapper.hidden {
      display: none;
    }

    .no-results {
      text-align: center;
      padding: 40px;
      color: var(--text-light);
      font-size: 1.1rem;
      display: none;
    }

    .no-results.show {
      display: block;
    }
      .dashboard-header {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 40px 0;
        letter-spacing: -0.5px;
        align-self: flex-start;
      }
      .main-content {
        margin-top: 68px;
        margin-left: 280px;
        padding: 30px;
        background-color: #f8f9fa;
        min-height: calc(100vh - 68px);
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      /* Inventory Product Card Styles */
      .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
        max-width: 800px;
        width: 100%;
      }

      .card-wrapper {
        position: relative;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
        transition: transform 0.3s ease;
      }

      .card-wrapper:hover {
        transform: translateY(-5px);
      }

      .stock-card {
        background-color: #2D5F3F;
        padding: 15px;
        color: white;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='400'%3E%3Cpath d='M0 40C0 17.9 17.9 0 40 0h220c22.1 0 40 17.9 40 40v260c0 5.5-4.5 10-10 10h-10c-33.1 0-60 26.9-60 60v10c0 5.5-4.5 10-10 10H40c-22.1 0-40-17.9-40-40V40z'/%3E%3C/svg%3E") no-repeat;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='400'%3E%3Cpath d='M0 40C0 17.9 17.9 0 40 0h220c22.1 0 40 17.9 40 40v260c0 5.5-4.5 10-10 10h-10c-33.1 0-60 26.9-60 60v10c0 5.5-4.5 10-10 10H40c-22.1 0-40-17.9-40-40V40z'/%3E%3C/svg%3E") no-repeat;
        mask-size: 100% 100%;
        -webkit-mask-size: 100% 100%;
        height: 300px;
      }

      .img-container {
        width: 100%;
        height: 180px;
        overflow: hidden;
        border-radius: 24px;
        margin-bottom: 12px;
      }

      .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .card-content {
        padding: 0 5px 35px 5px;
      }

      .card-name {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 5px;
      }

      .card-status {
        font-weight: 400;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
      }
        

.action-btn {
  position: absolute;
  bottom: -5px;
  right: -5px;
  background: #FAB325;
  border: none;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  z-index: 5;
  transition: transform 0.2s;
}

.action-btn:hover {
  transform: scale(1.05);

      }

      /* My Purchases Section Styles */
      .purchases-section {
        width: 100%;
        max-width: 800px;
        margin-top: 40px;
      }

      .purchases-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
      }

      .purchases-header h2 {
        font-size: 1.6rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
      }

      .view-all-link {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--green-mid);
        text-decoration: none;
        transition: color 0.2s;
      }

      .view-all-link:hover {
        color: var(--green-accent);
      }

      .purchases-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 16px;
      }

      .purchase-card {
        background: white;
        border-radius: 16px;
        padding: 24px 20px;
        border: 1px solid #e8f0fe;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        position: relative;
        overflow: hidden;
      }

      .purchase-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--green-mid), var(--green-accent));
        opacity: 0;
        transition: opacity 0.3s ease;
      }

      .purchase-card:hover::before {
        opacity: 1;
      }

      .purchase-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border-color: var(--green-light);
      }

      .purchase-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px auto;
        font-size: 1.2rem;
      }

      .to-pay .purchase-icon {
        background: #fef2f2;
        color: #ef4444;
      }

      .to-ship .purchase-icon {
        background: #f0fdf4;
        color: #10b981;
      }

      .to-receive .purchase-icon {
        background: #eff6ff;
        color: #3b82f6;
      }

      .delivered .purchase-icon {
        background: #f0fdf4;
        color: #22c55e;
      }

      .purchase-card h3 {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .purchase-count {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 12px;
      }

      .purchase-items {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.5;
      }

      .purchase-items .item {
        margin-bottom: 2px;
        opacity: 0.8;
      }

      .purchase-items .item:last-child {
        margin-bottom: 0;
      }

      /* Order Modal Styles */
      .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
      }

      .modal-overlay.active {
        display: flex;
      }

      .modal-container {
        background: white;
        border-radius: 20px;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease;
      }

      @keyframes modalSlideIn {
        from {
          opacity: 0;
          transform: translateY(-20px) scale(0.95);
        }
        to {
          opacity: 1;
          transform: translateY(0) scale(1);
        }
      }

      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 28px;
        border-bottom: 1px solid #e8f0fe;
      }

      .modal-header h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
      }

      .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #6b7280;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
      }

      .close-btn:hover {
        background: #f3f4f6;
        color: var(--text-dark);
      }

      .modal-body {
        padding: 28px;
      }

      .product-info {
        display: flex;
        gap: 20px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e8f0fe;
      }

      .product-image {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
      }

      .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .product-details h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px 0;
      }

      .product-details p {
        font-size: 0.95rem;
        color: #6b7280;
        margin: 0 0 12px 0;
      }

      .price-info {
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .price-label {
        font-size: 0.9rem;
        color: #6b7280;
      }

      .price-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--green-mid);
      }

      .order-form {
        margin-bottom: 24px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-group label {
        display: block;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 8px;
      }

      .quantity-control {
        display: flex;
        align-items: center;
        gap: 0;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        overflow: hidden;
        width: fit-content;
      }

      .quantity-control button {
        background: white;
        border: none;
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s;
      }

      .quantity-control button:hover {
        background: #f3f4f6;
        color: var(--text-dark);
      }

      .quantity-control input {
        width: 60px;
        height: 40px;
        border: none;
        text-align: center;
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-dark);
      }

      .quantity-control input:focus {
        outline: none;
      }

      input[type="date"],
      textarea,
      select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: border-color 0.2s;
        background: white;
      }

      input[type="date"]:focus,
      textarea:focus,
      select:focus {
        outline: none;
        border-color: var(--green-mid);
      }

      select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%236b7280' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
      }

      textarea {
        resize: vertical;
        min-height: 80px;
      }

      #fullAddress {
        min-height: 100px;
      }

      .warning-message {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
      }

      .warning-message i {
        color: #f59e0b;
        font-size: 1.2rem;
        flex-shrink: 0;
      }

      .warning-message span {
        color: #92400e;
        font-size: 0.9rem;
        flex: 1;
      }

      .settings-link {
        color: var(--green-mid);
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
      }

      .settings-link:hover {
        color: var(--green-dark);
        text-decoration: underline;
      }

      .order-summary {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
      }

      .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 0.95rem;
      }

      .summary-row:last-child {
        margin-bottom: 0;
      }

      .summary-row.total {
        border-top: 1px solid #d1d5db;
        padding-top: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-dark);
      }

      .modal-footer {
        display: flex;
        gap: 12px;
        padding: 24px 28px;
        border-top: 1px solid #e8f0fe;
      }

      .btn-cancel,
      .btn-confirm {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        flex: 1;
      }

      .btn-cancel {
        background: #f3f4f6;
        color: #6b7280;
      }

      .btn-cancel:hover {
        background: #e5e7eb;
        color: var(--text-dark);
      }

      .btn-confirm {
        background: var(--green-mid);
        color: white;
      }

      .btn-confirm:hover {
        background: var(--green-dark);
      }

    /* Order Confirmation Popup Styles */
    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    
    .popup-overlay.show {
      opacity: 1;
      visibility: visible;
    }
    
    .popup-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
      max-width: 500px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
      transform: scale(0.9) translateY(20px);
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    
    .popup-overlay.show .popup-container {
      transform: scale(1) translateY(0);
    }
    
    .success-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #10b981, #059669);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      animation: scaleIn 0.5s ease 0.2s both;
    }
    
    @keyframes scaleIn {
      0% {
        transform: scale(0);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }
    
    .order-number {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 10px;
      animation: fadeInUp 0.5s ease 0.3s both;
    }
    
    @keyframes fadeInUp {
      0% {
        transform: translateY(20px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
    
    .success-message {
      font-size: 1.1rem;
      color: #6b7280;
      margin-bottom: 30px;
      animation: fadeInUp 0.5s ease 0.4s both;
    }
    
    .steps-container {
      background: #f9fafb;
      border-radius: 12px;
      padding: 20px;
      margin: 20px 0;
      animation: fadeInUp 0.5s ease 0.5s both;
    }
    
    .step-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 15px;
      padding-left: 30px;
      position: relative;
    }
    
    .step-item:last-child {
      margin-bottom: 0;
    }
    
    .step-number {
      position: absolute;
      left: 0;
      top: 2px;
      width: 24px;
      height: 24px;
      background: #10b981;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 600;
    }
    
    .step-text {
      color: #4b5563;
      font-size: 0.95rem;
      line-height: 1.5;
    }
    
    .highlight-text {
      color: #059669;
      font-weight: 600;
    }
    
    .back-button {
      background: linear-gradient(135deg, #10b981, #059669);
      color: white;
      border: none;
      padding: 14px 28px;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      animation: fadeInUp 0.5s ease 0.6s both;
    }
    
    .back-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }
    
    .back-button:active {
      transform: translateY(0);
    }

    /* Popup content wrapper */
    .popup-container .p-8 {
      width: 100%;
      max-width: 100%;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    /* Responsive Design - Laptop Screens (1024px - 1366px) */
    @media screen and (min-width: 1024px) and (max-width: 1366px) {
      .nav {
        padding: 0 3%;
      }
      
      .nav-links {
        gap: 24px;
      }
      
      .sidebar {
        width: 220px;
      }
      
      .main-content {
        margin-left: 240px;
        padding: 25px;
      }
      
      .dashboard-header {
        font-size: 2.2rem;
      }
      
      .cards-container {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        max-width: 700px;
      }
      
      .purchases-grid {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 14px;
      }
      
      .modal-container {
        max-width: 550px;
      }
    }

    /* Responsive Design - Tablet Screens (768px - 1023px) */
    @media screen and (min-width: 768px) and (max-width: 1023px) {
      .nav {
        padding: 0 3%;
        height: 60px;
      }
      
      .nav-logo .logo-icon {
        width: 36px;
        height: 36px;
        font-size: 18px;
      }
      
      .nav-logo span {
        font-size: 12px;
      }
      
      .nav-links {
        display: none;
      }
      
      .sidebar {
        width: 200px;
        top: 60px;
        height: calc(100vh - 60px);
      }
      
      .sidebar .nav a {
        padding: 12px 20px;
        font-size: 1rem;
      }
      
      .sidebar .nav a i {
        font-size: 1.3rem;
        margin-right: 15px;
      }
      
      .main-content {
        margin-left: 220px;
        padding: 20px;
        margin-top: 60px;
      }
      
      .dashboard-header {
        font-size: 1.8rem;
        margin-bottom: 30px;
      }
      
      .cards-container {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 18px;
        max-width: 600px;
      }
      
      .stock-card {
        height: 260px;
      }
      
      .img-container {
        height: 150px;
      }
      
      .action-btn {
        width: 50px;
        height: 50px;
      }
      
      .purchases-section {
        margin-top: 30px;
      }
      
      .purchases-header h2 {
        font-size: 1.4rem;
      }
      
      .purchases-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 12px;
      }
      
      .purchase-card {
        padding: 20px 16px;
      }
      
      .purchase-icon {
        width: 35px;
        height: 35px;
        font-size: 1rem;
        margin-bottom: 12px;
      }
      
      .purchase-count {
        font-size: 1.5rem;
      }
      
      .purchase-card h3 {
        font-size: 0.8rem;
      }
      
      .purchase-items {
        font-size: 0.75rem;
      }
      
      .modal-container {
        max-width: 500px;
        width: 95%;
      }
      
      .modal-header,
      .modal-footer {
        padding: 20px 24px;
      }
      
      .modal-body {
        padding: 24px;
      }
      
      .product-image {
        width: 80px;
        height: 80px;
      }
    }

    /* Responsive Design - Phone Screens (320px - 767px) */
    @media screen and (max-width: 767px) {
      .nav {
        padding: 0 4%;
        height: 56px;
      }
      
      .nav-logo .logo-icon {
        width: 32px;
        height: 32px;
        font-size: 16px;
      }
      
      .nav-logo .logo-icon img {
        width: 30px;
        height: 30px;
      }
      
      .nav-logo span {
        font-size: 11px;
      }
      
      .nav-links {
        display: none;
      }
      
      .notification-bell {
        width: 36px;
        height: 36px;
      }
      
      .notification-bell svg {
        width: 18px;
        height: 18px;
      }
      
      .user-avatar {
        width: 36px;
        height: 36px;
      }
      
      .sidebar {
        transform: translateX(-100%);
        width: 250px;
        top: 56px;
        height: calc(100vh - 56px);
        transition: transform 0.3s ease;
      }
      
      .sidebar.active {
        transform: translateX(0);
      }
      
      .menu-toggle {
        display: block;
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 56px;
        height: 56px;
        background: var(--green-mid);
        border-radius: 50%;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
      }
      
      .menu-toggle:hover {
        background: var(--green-dark);
        transform: scale(1.05);
      }
      
      .main-content {
        margin-left: 0;
        padding: 15px;
        margin-top: 56px;
        min-height: calc(100vh - 56px);
      }
      
      .dashboard-header {
        font-size: 1.5rem;
        margin-bottom: 25px;
        text-align: center;
      }
      
      .cards-container {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 15px;
        max-width: 100%;
      }
      
      .stock-card {
        height: 220px;
      }
      
      .img-container {
        height: 120px;
      }
      
      .card-content {
        padding: 0 3px 25px 3px;
      }
      
      .card-name {
        font-size: 0.9rem;
      }
      
      .card-status {
        font-size: 0.9rem;
      }
      
      .action-btn {
        width: 45px;
        height: 45px;
        bottom: -3px;
        right: -3px;
      }
      
      .action-btn i {
        font-size: 18px;
      }
      
      .purchases-section {
        margin-top: 25px;
      }
      
      .purchases-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      
      .purchases-header h2 {
        font-size: 1.3rem;
      }
      
      .view-all-link {
        font-size: 0.9rem;
      }
      
      .purchases-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }
      
      .purchase-card {
        padding: 16px 12px;
      }
      
      .purchase-icon {
        width: 32px;
        height: 32px;
        font-size: 0.9rem;
        margin-bottom: 10px;
      }
      
      .purchase-count {
        font-size: 1.3rem;
        margin-bottom: 8px;
      }
      
      .purchase-card h3 {
        font-size: 0.75rem;
        margin-bottom: 6px;
      }
      
      .purchase-items {
        font-size: 0.7rem;
      }
      
      .modal-container {
        max-width: 95%;
        width: 95%;
        margin: 10px;
        max-height: 95vh;
      }
      
      .modal-header {
        padding: 16px 20px;
      }
      
      .modal-header h2 {
        font-size: 1.3rem;
      }
      
      .close-btn {
        width: 28px;
        height: 28px;
        font-size: 1.2rem;
      }
      
      .modal-body {
        padding: 20px;
      }
      
      .product-info {
        flex-direction: column;
        text-align: center;
        gap: 15px;
        margin-bottom: 20px;
      }
      
      .product-image {
        width: 120px;
        height: 120px;
        margin: 0 auto;
      }
      
      .product-details h3 {
        font-size: 1.1rem;
      }
      
      .product-details p {
        font-size: 0.9rem;
      }
      
      .form-group label {
        font-size: 0.9rem;
        margin-bottom: 6px;
      }
      
      .quantity-control button {
        width: 35px;
        height: 35px;
        font-size: 1rem;
      }
      
      .quantity-control input {
        width: 50px;
        height: 35px;
        font-size: 0.9rem;
      }
      
      input[type="date"],
      textarea,
      select {
        padding: 10px 12px;
        font-size: 0.9rem;
      }
      
      textarea {
        min-height: 70px;
      }
      
      #fullAddress {
        min-height: 80px;
      }
      
      .order-summary {
        padding: 15px;
      }
      
      .summary-row {
        font-size: 0.9rem;
        margin-bottom: 8px;
      }
      
      .summary-row.total {
        font-size: 1rem;
        padding-top: 8px;
      }
      
      .modal-footer {
        padding: 16px 20px;
        flex-direction: column;
      }
      
      .btn-cancel,
      .btn-confirm {
        width: 100%;
        margin-bottom: 8px;
      }
      
      .btn-cancel:last-child,
      .btn-confirm:last-child {
        margin-bottom: 0;
      }
      
      .popup-container {
        width: 95%;
        margin: 10px;
        max-height: 95vh;
        overflow-y: auto;
      }
      
      .success-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 15px;
      }
      
      .order-number {
        font-size: 1.5rem;
        margin-bottom: 8px;
      }
      
      .success-message {
        font-size: 1rem;
        margin-bottom: 20px;
      }
      
      .steps-container {
        padding: 15px;
        margin: 15px 0;
      }
      
      .step-item {
        margin-bottom: 12px;
        padding-left: 25px;
      }
      
      .step-number {
        width: 20px;
        height: 20px;
        font-size: 10px;
      }
      
      .step-text {
        font-size: 0.85rem;
      }
      
      .back-button {
        padding: 12px 20px;
        font-size: 0.9rem;
      }
    }

    /* Notifications Popup Styles */
    .notifications-popup {
      position: fixed;
      top: 68px;
      right: 20px;
      width: 450px;
      max-height: 580px;
      background: white;
      border-radius: 24px;
      box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-20px) scale(0.95);
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .notifications-popup.active {
      opacity: 1;
      visibility: visible;
      transform: translateY(0) scale(1);
    }

    .notifications-popup iframe {
      border: none;
      width: 100%;
      height: 100%;
    }

    /* Responsive Notification Popup */
    @media screen and (max-width: 768px) {
      .notifications-popup {
        top: 56px;
        right: 10px;
        width: calc(100vw - 20px);
        max-width: 400px;
        max-height: 70vh;
      }
    }

    @media screen and (max-width: 480px) {
      .notifications-popup {
        top: 56px;
        right: 5px;
        width: calc(100vw - 10px);
        max-width: 350px;
        max-height: 60vh;
        border-radius: 16px;
      }
    }

    /* Small Phone Screens (320px - 480px) */
    @media screen and (max-width: 480px) {
      .cards-container {
        grid-template-columns: 1fr;
        max-width: 280px;
      }
      
      .purchases-grid {
        grid-template-columns: 1fr;
        max-width: 280px;
      }
    }

    </style>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav>
      <a href="#" class="nav-logo">
        <div class="logo-icon">
          <img src="../FrontEnd/assets/img/organicfarmlogo.png" alt="" />
        </div>
        <span>Arnold &amp; Paz<br />Organic Farm</span>
      </a>
      <div class="nav-actions">
        <div class="nav-user">
          <div class="notification-bell" onclick="toggleNotifications()">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
            </svg>
            <span class="notification-badge">4</span>
          </div>
          <a href="User_Profile.html">
            <img src="https://picsum.photos/seed/user-avatar/40/40.jpg" alt="User Avatar" class="user-avatar" />
          </a>
        </div>
      </div>
    </nav>

    <!-- Mobile Menu Toggle Button -->
    <button class="menu-toggle" onclick="toggleSidebar()">
      <i class="bx bx-menu"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="nav">
        <ul>
          <li>
            <a href="#" class="active">
              <i class="bx bxs-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="My_Orders.html">
              <i class="bx bxs-cart-alt"></i>
              <span>My Orders</span>
            </a>
          </li>
          <li>
            <a href="Settings.html">
              <i class="bx bxs-cog"></i>
              <span>Settings</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="logout">
        <a href="#">
          <i class="bx bx-log-out"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
      <h1 class="dashboard-header">DASHBOARD</h1>
      
      <!-- Search Bar -->
      <div class="search-container">
        <div class="search-box">
          <i class='bx bx-search'></i>
          <input type="text" id="productSearch" placeholder="Search products..." autocomplete="off">
          <button class="clear-search" onclick="clearSearch()" style="display: none;">
            <i class='bx bx-x'></i>
          </button>
        </div>
      </div>
      
      <div class="cards-container">
        <div class="card-wrapper">
          <div class="stock-card">
            <div class="img-container">
              <img src="https://picsum.photos/seed/compost/220/220" alt="Compost">
            </div>
            <div class="card-content">
              <div class="card-name">Name: Compost</div>
              <div class="card-status">Available: 500 sacks</div>
            </div>
          </div>
          <button class="action-btn" onclick="openItemModal('Compost', '500 sacks')">
            <i class='bx bx-cart-add'></i>
          </button>
        </div>

        <div class="card-wrapper">
          <div class="stock-card">
            <div class="img-container">
              <img src="https://picsum.photos/seed/fertilizer/220/220" alt="Fertilizer">
            </div>
            <div class="card-content">
              <div class="card-name">Name: Fertilizer</div>
              <div class="card-status">Available: 300 sacks</div>
            </div>
          </div>
          <button class="action-btn" onclick="openItemModal('Fertilizer', '300 sacks')">
            <i class='bx bx-cart-add'></i>
          </button>
        </div>

        <div class="card-wrapper">
          <div class="stock-card">
            <div class="img-container">
              <img src="https://picsum.photos/seed/vegetables/220/220" alt="Vegetables">
            </div>
            <div class="card-content">
              <div class="card-name">Name: Vegetables</div>
              <div class="card-status">Available: 200 sacks</div>
            </div>
          </div>
          <button class="action-btn" onclick="openItemModal('Vegetables', '200 sacks')">
            <i class='bx bx-cart-add'></i>
          </button>
        </div>
      </div>

      <!-- My Purchases Section -->
      <div class="purchases-section">
        <div class="purchases-header">
          <h2>My Purchases</h2>
          <a href="My_Orders.html" class="view-all-link">View All Purchases →</a>
        </div>
        
        <div class="purchases-grid">
          <div class="purchase-card to-ship">
            <div class="purchase-icon">
              <i class='bx bx-package'></i>
            </div>
            <h3>To Ship</h3>
            <div class="purchase-count">1</div>
            <div class="purchase-items">
              <div class="item">Vegetables - 10 sacks</div>
            </div>
          </div>

          <div class="purchase-card to-receive">
            <div class="purchase-icon">
              <i class='bx bx-truck'></i>
            </div>
            <h3>To Receive</h3>
            <div class="purchase-count">3</div>
            <div class="purchase-items">
              <div class="item">Compost - 2 sacks</div>
              <div class="item">Fertilizer - 4 sacks</div>
              <div class="item">Seeds - 1 pack</div>
            </div>
          </div>

          <div class="purchase-card delivered">
            <div class="purchase-icon">
              <i class='bx bx-check-circle'></i>
            </div>
            <h3>Delivered</h3>
            <div class="purchase-count">5</div>
            <div class="purchase-items">
              <div class="item">Compost - 8 sacks</div>
              <div class="item">Fertilizer - 6 sacks</div>
              <div class="item">Vegetables - 5 sacks</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Order Modal -->
    <div id="orderModal" class="modal-overlay">
      <div class="modal-container">
        <div class="modal-header">
          <h2>Place Order</h2>
          <button class="close-btn" onclick="closeOrderModal()">
            <i class='bx bx-x'></i>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="product-info">
            <div class="product-image">
              <img id="modalProductImage" src="" alt="Product">
            </div>
            <div class="product-details">
              <h3 id="modalProductName">Product Name</h3>
              <p id="modalProductStock">Available: 0 sacks</p>
              <div class="price-info">
                <span class="price-label">Price per sack:</span>
                <span class="price-value">₱150</span>
              </div>
            </div>
          </div>
          
          <div class="order-form">
            <div class="form-group">
              <div class="warning-message">
                <i class="bx bx-error-circle"></i>
                <span>Please complete your profile information first. </span>
                <a href="Settings.html" class="settings-link">Add Phone Number and Address →</a>
              </div>
            </div>
            
            <div class="form-group">
              <label for="quantity">Quantity (sacks)</label>
              <div class="quantity-control">
                <button type="button" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" value="1" min="1" max="">
                <button type="button" onclick="increaseQuantity()">+</button>
              </div>
            </div>
            
            <div class="form-group">
              <label for="deliveryOption">Delivery Option</label>
              <select id="deliveryOption" required>
                <option value="">Select delivery option</option>
                <option value="pickup">Pickup - No Fee</option>
                <option value="standard">Standard Delivery (3-5 days) - ₱50</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="paymentMethod">Payment Method</label>
              <select id="paymentMethod" required>
                <option value="cod" selected>Cash on Delivery</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="notes">Additional Notes</label>
              <textarea id="notes" placeholder="Any special instructions..."></textarea>
            </div>
          </div>
          
          <div class="order-summary">
            <div class="summary-row">
              <span>Subtotal:</span>
              <span id="subtotal">₱150</span>
            </div>
            <div class="summary-row">
              <span>Delivery Fee:</span>
              <span>₱50</span>
            </div>
            <div class="summary-row total">
              <span>Total:</span>
              <span id="totalAmount">₱200</span>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" onclick="closeOrderModal()">Cancel</button>
          <button class="btn-confirm" onclick="confirmOrder()">Confirm Order</button>
        </div>
      </div>
    </div>

    <!-- Order Confirmation Popup -->
    <div id="orderConfirmationPopup" class="popup-overlay">
      <div class="popup-container">
        <!-- Popup Content -->
        <div class="p-8 text-center">

          <!-- Order Number -->
          <h2 class="order-number">Order Received</h2>
          <div class="text-2xl font-bold text-green-600 mb-4">#123940</div>

          <!-- Success Icon -->
          <div class="success-icon">
            <i class="fas fa-check text-white text-3xl"></i>
          </div>
          
          <!-- Thank You Message -->
          <p class="success-message">
            Thank you for your order Ma'am/Sir!
          </p>
          
          <!-- Important Next Steps -->
          <div class="steps-container">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-left">Important Next Steps:</h3>
            
            <div class="step-item">
              <span class="step-number">1</span>
              <p class="step-text">
                Check your email to verify your account (sent to <span class="highlight-text">juan@example.com</span>)
              </p>
            </div>
            
            <div class="step-item">
              <span class="step-number">2</span>
              <p class="step-text">
                We will contact you within 2-3 days to confirm your order
              </p>
            </div>
            
            <div class="step-item">
              <span class="step-number">3</span>
              <p class="step-text">
                You'll receive an <span class="highlight-text">NOTIFICATION</span> once your order is approved
              </p>
            </div>
            
            <div class="step-item">
              <span class="step-number">4</span>
              <p class="step-text">
                Track your order status in My Orders
              </p>
            </div>
          </div>
          
          <!-- Back to Dashboard Button -->
          <button class="back-button" onclick="closeOrderConfirmationPopup()">
            <i class="fas fa-arrow-left mr-2"></i>
            Back To Dashboard
          </button>
        </div>
      </div>
    </div>

    <!-- Notifications Popup -->
    <div id="notificationsPopup" class="notifications-popup">
      <iframe src="Notifications.html" frameborder="0" width="450" height="580"></iframe>
    </div>
  </body>
</html>

<script>
  // Search functionality
  function searchProducts() {
    const searchTerm = document.getElementById('productSearch').value.toLowerCase();
    const cardWrappers = document.querySelectorAll('.card-wrapper');
    const clearBtn = document.querySelector('.clear-search');
    let hasResults = false;

    cardWrappers.forEach(wrapper => {
      const productName = wrapper.querySelector('.card-name').textContent.toLowerCase();
      const productStatus = wrapper.querySelector('.card-status').textContent.toLowerCase();
      
      if (productName.includes(searchTerm) || productStatus.includes(searchTerm)) {
        wrapper.classList.remove('hidden');
        hasResults = true;
      } else {
        wrapper.classList.add('hidden');
      }
    });

    // Show/hide clear button
    if (searchTerm) {
      clearBtn.style.display = 'block';
    } else {
      clearBtn.style.display = 'none';
    }

    // Show no results message
    const noResultsMsg = document.querySelector('.no-results');
    if (!hasResults && searchTerm) {
      if (!noResultsMsg) {
        const msg = document.createElement('div');
        msg.className = 'no-results show';
        msg.textContent = 'No products found matching your search.';
        document.querySelector('.cards-container').appendChild(msg);
      }
    } else if (noResultsMsg) {
      noResultsMsg.remove();
    }
  }

  function clearSearch() {
    document.getElementById('productSearch').value = '';
    searchProducts();
  }

  // Add search event listener
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch');
    if (searchInput) {
      searchInput.addEventListener('input', searchProducts);
      searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Escape') {
          clearSearch();
        }
      });
    }
  });
  function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
  }

  // Close sidebar when clicking outside on mobile
  document.addEventListener('click', function(e) {
    const sidebar = document.querySelector('.sidebar');
    const menuToggle = document.querySelector('.menu-toggle');
    
    if (window.innerWidth <= 767 && 
        !sidebar.contains(e.target) && 
        !menuToggle.contains(e.target) && 
        sidebar.classList.contains('active')) {
      sidebar.classList.remove('active');
    }
  });

  // Product data with prices
  const productData = {
    'Compost': { price: 150, image: 'https://picsum.photos/seed/compost/220/220' },
    'Fertilizer': { price: 180, image: 'https://picsum.photos/seed/fertilizer/220/220' },
    'Vegetables': { price: 120, image: 'https://picsum.photos/seed/vegetables/220/220' }
  };

  // Open modal function
  function openItemModal(productName, stock) {
    const modal = document.getElementById('orderModal');
    const product = productData[productName];
    
    // Update modal content
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('modalProductStock').textContent = `Available: ${stock}`;
    document.getElementById('modalProductImage').src = product.image;
    document.querySelector('.price-value').textContent = `₱${product.price}`;
    
    // Set quantity max based on available stock
    const stockNumber = parseInt(stock.match(/\d+/)[0]);
    document.getElementById('quantity').max = stockNumber;
    document.getElementById('quantity').value = 1;
    
    // Update price calculations
    updatePriceCalculations();
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  // Close modal function
  function closeOrderModal() {
    const modal = document.getElementById('orderModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
    
    // Reset form
    document.getElementById('quantity').value = 1;
    document.getElementById('deliveryOption').value = '';
    document.getElementById('paymentMethod').value = 'cod';
    document.getElementById('notes').value = '';
  }

  // Quantity control functions
  function increaseQuantity() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.max);
    if (input.value < max) {
      input.value = parseInt(input.value) + 1;
      updatePriceCalculations();
    }
  }

  function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (input.value > 1) {
      input.value = parseInt(input.value) - 1;
      updatePriceCalculations();
    }
  }

  // Update price calculations
  function updatePriceCalculations() {
    const productName = document.getElementById('modalProductName').textContent;
    const product = productData[productName];
    const quantity = parseInt(document.getElementById('quantity').value);
    const deliveryOption = document.getElementById('deliveryOption').value;
    
    // Delivery fees based on option
    const deliveryFees = {
      'pickup': 0,
      'standard': 50,
    };
    
    const deliveryFee = deliveryFees[deliveryOption] || 0;
    const subtotal = product.price * quantity;
    const total = subtotal + deliveryFee;
    
    document.getElementById('subtotal').textContent = `₱${subtotal}`;
    
    // Show "No Fee" for pickup, otherwise show the actual fee
    if (deliveryOption === 'pickup') {
      document.querySelector('.summary-row:nth-child(2) span:last-child').textContent = 'No Fee';
    } else if (deliveryOption === 'standard') {
      document.querySelector('.summary-row:nth-child(2) span:last-child').textContent = `₱${deliveryFee}`;
    } else {
      document.querySelector('.summary-row:nth-child(2) span:last-child').textContent = '---';
    }
    
    document.getElementById('totalAmount').textContent = `₱${total}`;
  }

  // Confirm order function
  function confirmOrder() {
    const productName = document.getElementById('modalProductName').textContent;
    const quantity = document.getElementById('quantity').value;
    const deliveryOption = document.getElementById('deliveryOption').value;
    const paymentMethod = document.getElementById('paymentMethod').value;
    const notes = document.getElementById('notes').value;
    
    // Validate form
    if (!deliveryOption) {
      alert('Please select a delivery option');
      return;
    }
    
    if (!paymentMethod) {
      alert('Please select a payment method');
      return;
    }
    
    // Here you would typically send order to your backend
    console.log('Order confirmed:', {
      product: productName,
      quantity: quantity,
      deliveryOption: deliveryOption,
      paymentMethod: paymentMethod,
      notes: notes
    });
    
    // Close modal
    closeOrderModal();
    
    // Show order confirmation popup
    showOrderConfirmationPopup();
  }

  // Show order confirmation popup function
  function showOrderConfirmationPopup() {
    const popup = document.getElementById('orderConfirmationPopup');
    popup.classList.add('show');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  }
  
  // Close order confirmation popup function
  function closeOrderConfirmationPopup() {
    const popup = document.getElementById('orderConfirmationPopup');
    popup.classList.remove('show');
    document.body.style.overflow = 'auto'; // Restore scrolling
  }

  // Add event listeners
  document.getElementById('quantity').addEventListener('input', function() {
    const max = parseInt(this.max);
    if (this.value > max) {
      this.value = max;
    }
    if (this.value < 1) {
      this.value = 1;
    }
    updatePriceCalculations();
  });

  document.getElementById('deliveryOption').addEventListener('change', updatePriceCalculations);

  // Close modal when clicking outside
  document.getElementById('orderModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeOrderModal();
    }
  });

  // Close modal with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeOrderModal();
      closeOrderConfirmationPopup();
    }
  });

  // Close popup when clicking outside
  document.getElementById('orderConfirmationPopup').addEventListener('click', function(e) {
    if (e.target === this) {
      closeOrderConfirmationPopup();
    }
  });

  // Add event listener for delivery option change
  document.getElementById('deliveryOption').addEventListener('change', updatePriceCalculations);

  // Notification popup functions
  function toggleNotifications() {
    const popup = document.getElementById('notificationsPopup');
    const badge = document.querySelector('.notification-badge');
    
    popup.classList.toggle('active');
    
    // Hide badge when opening notifications
    if (popup.classList.contains('active')) {
      badge.style.display = 'none';
      // Store in localStorage that notifications have been viewed
      localStorage.setItem('notificationsViewed', 'true');
    }
    
    // Close other popups
    const orderModal = document.getElementById('orderModal');
    const orderConfirmationPopup = document.getElementById('orderConfirmationPopup');
    orderModal.classList.remove('active');
    orderConfirmationPopup.classList.remove('show');
  }

  function closeNotifications() {
    const popup = document.getElementById('notificationsPopup');
    popup.classList.remove('active');
  }

  // Close notifications when clicking outside
  document.addEventListener('click', function(e) {
    const popup = document.getElementById('notificationsPopup');
    const notificationBell = document.querySelector('.notification-bell');
    
    if (!popup.contains(e.target) && !notificationBell.contains(e.target)) {
      closeNotifications();
    }
  });

  // Close notifications with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeNotifications();
    }
  });

  // Check if notifications have been viewed on page load
  document.addEventListener('DOMContentLoaded', function() {
    const badge = document.querySelector('.notification-badge');
    const notificationsViewed = localStorage.getItem('notificationsViewed');
    
    if (notificationsViewed === 'true' && badge) {
      badge.style.display = 'none';
    }
  });
</script>