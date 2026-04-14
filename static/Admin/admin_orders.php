<?php
session_start();
require_once '../../config/config.php';
session_write_close(); // ← Release session lock immediately
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>Arnold & Paz | Order Management</title>
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Google Fonts: Inter & fallback -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <!-- Boxicons (optional) -->
   <link href='https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #f4f7fc;
      overflow-x: hidden;
    }

    /* SIDEBAR SIMULATION (consistent with your include) – we mimic admin sidebar styles */
    /* ensure your actual sidebar.php has correct positioning; this wrapper respects left margin */
    .orders-page-wrapper {
      margin-left: 260px;
      margin-top: 70px;
      padding: 28px 32px;
      min-height: calc(100vh - 70px);
      background: #f5f9f0;
      transition: all 0.2s ease;
    }

    .app-wrapper {
      max-width: 1440px;
      margin: 0 auto;
    }

    /* main card container */
    .main-card {
      background: #ffffff;
      border-radius: 28px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05), 0 4px 8px rgba(0, 0, 0, 0.02);
      overflow: hidden;
      transition: all 0.2s;
    }

    /* action bar */
    .action-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 28px;
      background: white;
      border-bottom: 1px solid #eef2f6;
      flex-wrap: wrap;
      gap: 12px;
    }

    .btn-back {
      background: #f1f5f9;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: 0.2s;
      color: #1e293b;
      font-size: 1.2rem;
    }

    .btn-back:hover {
      background: #e2e8f0;
      transform: scale(0.96);
    }

    .btn-add {
      background: #2c6e3c;
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 24px;
      border-radius: 40px;
      font-size: 0.9rem;
      letter-spacing: 0.3px;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: 0.2s;
      box-shadow: 0 2px 6px rgba(44, 110, 60, 0.2);
    }

    .btn-add i {
      font-size: 1rem;
    }

    .btn-add:hover {
      background: #1f5430;
      transform: translateY(-1px);
      box-shadow: 0 6px 12px rgba(44, 110, 60, 0.25);
    }

    .icon-btn {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      padding: 8px 20px;
      border-radius: 32px;
      font-weight: 500;
      font-size: 0.85rem;
      color: #1e2a3e;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: 0.2s;
    }

    .icon-btn i {
      font-size: 0.9rem;
      color: #4b5563;
    }

    .icon-btn:hover {
      background: #ffffff;
      border-color: #cbd5e1;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    /* TABS */
    .nav-container {
      padding: 0 24px;
      border-bottom: 1px solid #edf2f7;
      background: white;
    }

    .tabs {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .tab-item {
      padding: 14px 24px;
      font-weight: 600;
      font-size: 0.9rem;
      color: #4b5565;
      cursor: pointer;
      transition: 0.2s;
      border-radius: 40px 40px 0 0;
      letter-spacing: -0.2px;
      background: transparent;
      margin-bottom: -1px;
    }

    .tab-item:hover {
      color: #2c6e3c;
      background: #f1f9f0;
    }

    .tab-item.active {
      color: #2c6e3c;
      border-bottom: 3px solid #2c6e3c;
      background: transparent;
      font-weight: 700;
    }

    /* TABLE AREA */
    .table-area {
      overflow-x: auto;
      padding: 0 0 20px 0;
      scrollbar-width: thin;
    }

    #main-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.85rem;
      min-width: 900px;
    }

    #main-table th {
      text-align: center;
      padding: 18px 14px;
      background-color: #f9fbfd;
      color: #1f2a44;
      font-weight: 600;
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-bottom: 1px solid #e9edf2;
    }

    #main-table td {
      padding: 16px 12px;
      text-align: center;
      border-bottom: 1px solid #f0f2f5;
      vertical-align: middle;
      color: #1e2a3a;
      font-weight: 500;
    }

    /* client name specific left alignment? but center looks consistent */
    .client-bold {
      font-weight: 700;
      color: #1f2a3e;
    }

    .phone-no {
      font-family: monospace;
      letter-spacing: 0.2px;
    }

    /* status badges */
    .status-processing {
      background: #fff7e5;
      color: #b85c00;
      font-weight: 700;
      font-size: 0.7rem;
      padding: 6px 12px;
      border-radius: 100px;
      display: inline-block;
      width: fit-content;
      margin: 0 auto;
      text-transform: uppercase;
    }

    .status-to-receive {
      background: #eef2ff;
      color: #1e40af;
      font-weight: 700;
      font-size: 0.7rem;
      padding: 6px 12px;
      border-radius: 100px;
      display: inline-block;
    }

    .status-delivered {
      background: #e0f2e9;
      color: #0b5e42;
      font-weight: 700;
      font-size: 0.7rem;
      padding: 6px 12px;
      border-radius: 100px;
      display: inline-block;
    }

    /* ACTION BUTTON (accept / out for delivery) refined */
    .btn-accept {
      background: transparent;
      border: 1px solid #cbdbe0;
      padding: 6px 14px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 0.7rem;
      cursor: pointer;
      transition: 0.2s;
      font-family: inherit;
      background: white;
      color: #2c3e50;
    }

    .btn-accept:hover {
      background: #f0f4f9;
      transform: translateY(-1px);
      border-color: #9aa9bc;
    }

    /* specific color overrides for dynamic status buttons */
    .btn-outline-orange {
      color: #b45309;
      border-color: #fed7aa;
      background: #fffaf0;
    }

    .btn-outline-blue {
      color: #2563eb;
      border-color: #bfdbfe;
      background: #eff6ff;
    }

    .btn-outline-green {
      color: #0b5e42;
      border-color: #bbf7d0;
      background: #f0fdf4;
    }

    /* Modals (unchanged but polished) */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(3px);
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    .add-order-container, .modal-box {
      background: white;
      border-radius: 32px;
      max-width: 750px;
      width: 90%;
      padding: 28px 32px;
      box-shadow: 0 30px 45px rgba(0, 0, 0, 0.2);
    }

    .modal-box {
      max-width: 460px;
      text-align: center;
    }

    .modal-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .modal-btns {
      display: flex;
      gap: 14px;
      justify-content: center;
      margin-top: 28px;
    }

    .m-btn {
      padding: 10px 26px;
      border-radius: 60px;
      font-weight: 600;
      border: none;
      cursor: pointer;
    }

    .btn-confirm {
      background: #2c6e3c;
      color: white;
    }

    .btn-cancel {
      background: #eef2f6;
      color: #1f2a3e;
    }

    /* add order form minimal adjustments */
    .input-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 30px;
    }

    .form-field {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .form-field label {
      font-weight: 600;
      font-size: 0.75rem;
      color: #4a5b6e;
    }

    .form-field input {
      padding: 12px 14px;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      font-family: inherit;
    }

    .order-summary-pane {
      background: #fafcff;
      border-radius: 24px;
      padding: 20px;
      border: 1px solid #eef2fa;
    }

    .summary-header {
      font-weight: 700;
      margin-bottom: 16px;
      font-size: 1rem;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
    }

    .summary-total {
      font-weight: 800;
      border-top: 1px solid #e2e8f0;
      margin-top: 10px;
      padding-top: 12px;
    }

    .add-order-footer {
      display: flex;
      justify-content: flex-end;
      gap: 14px;
      margin-top: 28px;
    }

    .btn-green {
      background: #2c6e3c;
      border: none;
      padding: 10px 28px;
      border-radius: 40px;
      color: white;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-gray {
      background: #eef2f6;
      border: none;
      padding: 10px 28px;
      border-radius: 40px;
      cursor: pointer;
    }

    /* Responsive */
    @media (max-width: 1100px) {
      .orders-page-wrapper {
        margin-left: 0;
        padding: 20px;
      }
      .action-bar {
        padding: 14px 20px;
      }
    }

    /* empty state fix */
    .table-area td:first-child, .table-area th:first-child {
      border-top-left-radius: 0;
    }
  </style>
</head>
<body>
  <!-- Sidebar include (simulate your existing sidebar) -->
  <?php include('../sidebar.php'); ?>
  
  
  <div class="orders-page-wrapper">
    <div class="app-wrapper">
      <div class="main-card">
        <div class="action-bar">
          <button class="btn-back" onclick="window.location.href='admin_dashboard.php'">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button id="btn-add-order" class="btn-add" onclick="openAddOrder()">
            <i class="fa-solid fa-plus"></i> Add New Order
          </button>
          <div id="queue-actions" style="display: none; gap: 12px">
            <button class="icon-btn" onclick="onFilterClick()">
              <i class="fa-solid fa-filter"></i> Filter
            </button>
            <button class="icon-btn" onclick="onEditClick()">
              <i class="fa-solid fa-pen"></i> Edit
            </button>
          </div>
        </div>

        <div class="nav-container">
          <div class="tabs">
            <div class="tab-item" id="tab-new" onclick="switchTab(this, 'new')">New Order</div>
            <div class="tab-item" id="tab-queue" onclick="switchTab(this, 'queue')">Order Queue</div>
            <div class="tab-item" id="tab-out" onclick="switchTab(this, 'out')">Out for Delivery</div>
            <div class="tab-item" id="tab-delivered" onclick="switchTab(this, 'delivered')">Delivered</div>
            <div class="tab-item" id="tab-all" onclick="switchTab(this, 'all')">All Orders</div>
          </div>
        </div>

        <div class="table-area">
          <table id="main-table">
            <thead id="table-head"></thead>
            <tbody id="table-body"></tbody>
          </table>
        </div>

        <!-- Add order modal (kept structure, but improved) -->
        <div class="modal-overlay" id="addOrderModal">
          <div class="add-order-container">
            <div class="add-order-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
              <div class="brand-section" style="display: flex; align-items: center; gap: 12px;">
                <img src="https://i.postimg.cc/85M8PZ8V/image-d439ec.png" alt="Logo" style="height: 40px;" />
                <div class="brand-text" style="font-weight: 700;">ARNOLD & PAZ <span style="font-weight:400;">ORGANIC FARM</span></div>
              </div>
              <div class="order-id-label" style="background:#f1f5f9; padding:6px 14px; border-radius:40px;">ORDER_ID: 0004</div>
            </div>
            <div class="add-order-body">
              <div class="input-grid">
                <div class="form-field"><label>Customer Name:</label><input type="text" placeholder="Full name" /></div>
                <div class="form-field"><label>Quantity</label><input type="text" placeholder="e.g., 150 Sacks" /></div>
                <div class="form-field"><label>Address:</label><input type="text" /></div>
                <div class="form-field"><label>Contact no.</label><input type="text" /></div>
                <div class="form-field"><label>Delivery Fee</label><input type="text" /></div>
                <div class="form-field"><label>Discount:</label><input type="text" /></div>
              </div>
              <div class="order-summary-pane">
                <div class="summary-header">Order Summary</div>
                <div class="summary-item"><span>Sub total</span> <span>0.00</span></div>
                <div class="summary-item"><span>Discount</span> <span>0.00</span></div>
                <div class="summary-item"><span>Shipping</span> <span>0.00</span></div>
                <div class="summary-item summary-total"><span>Total Amount</span> <span>0.00</span></div>
              </div>
            </div>
            <div class="add-order-footer">
              <button class="btn-green">ADD ORDER</button>
              <button class="btn-gray" onclick="closeAddOrder()">CANCEL</button>
            </div>
          </div>
        </div>

        <div class="modal-overlay" id="orderModal">
          <div class="modal-box">
            <div class="modal-title">This order has already been accepted and is <br /> now being processed.</div>
            <div class="delivery-fee" style="margin: 12px 0;">Delivery Fee: <span class="fee-line">₱150.00</span></div>
            <div class="modal-btns">
              <button class="m-btn btn-confirm" onclick="closeModal()">CONFIRM</button>
              <button class="m-btn btn-cancel" onclick="closeModal()">CANCEL</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // ----- SAMPLE DATA (enriched with better examples) -----
    const queueData = [
      { id: "0001", date: "02/10/2026", client: "AgroPh", address: "Angono Rizal", contact: "+63 917 123 4567", qty: "250 Sacks", amount: "₱75,000", si: "SI - 00254", status: "PROCESSING" },
      { id: "0002", date: "02/17/2026", client: "GreenCity", address: "Quezon City", contact: "+63 918 987 6543", qty: "200 Sacks", amount: "₱60,000", si: "SI - 00255", status: "PROCESSING" },
      { id: "0003", date: "02/24/2026", client: "NovaRiches", address: "Quezon City Brgy Nova", contact: "+63 905 555 1234", qty: "100 Sacks", amount: "₱30,000", si: "SI - 00256", status: "PROCESSING" },
      { id: "0004", date: "03/01/2026", client: "FreshMart", address: "Pasig", contact: "+63 977 123 7890", qty: "320 Sacks", amount: "₱96,000", si: "SI - 00257", status: "TO RECEIVE" },
      { id: "0005", date: "03/05/2026", client: "EcoRice", address: "Makati", contact: "+63 912 345 6789", qty: "180 Sacks", amount: "₱54,000", si: "SI - 00258", status: "DELIVERED" }
    ];

    // Helper: generate status badge HTML (centered design)
    function getStatusBadge(status) {
      if (status === "PROCESSING") return `<span class="status-processing"><i class="fa-regular fa-clock" style="margin-right:4px;"></i> PROCESSING</span>`;
      if (status === "TO RECEIVE") return `<span class="status-to-receive"><i class="fa-regular fa-truck"></i> TO RECEIVE</span>`;
      if (status === "DELIVERED") return `<span class="status-delivered"><i class="fa-regular fa-circle-check"></i> DELIVERED</span>`;
      return `<span>${status}</span>`;
    }

    // helper: action button style based on context
    function getActionButton(type, rowData) {
      if (type === 'queue') {
        return `<button class="btn-accept btn-outline-orange" onclick="alert('Out for delivery: ${rowData.id}')"><i class="fa-solid fa-truck-fast"></i> OUT FOR DELIVERY</button>`;
      }
      if (type === 'out') {
        return `<button class="btn-accept btn-outline-blue" onclick="alert('Mark as received: ${rowData.id}')"><i class="fa-regular fa-check-circle"></i> TO RECEIVE</button>`;
      }
      if (type === 'delivered') {
        return `<button class="btn-accept btn-outline-green" onclick="alert('Order completed: ${rowData.id}')"><i class="fa-solid fa-check-double"></i> DONE</button>`;
      }
      if (type === 'new') {
        return `<button class="btn-accept" onclick="openModal()">Accept</button>`;
      }
      return '';
    }

    function switchTab(el, type) {
      // active tab styling
      document.querySelectorAll(".tab-item").forEach(t => t.classList.remove("active"));
      if (el) el.classList.add("active");

      const btnAdd = document.getElementById("btn-add-order");
      const queueActions = document.getElementById("queue-actions");
      const thead = document.getElementById("table-head");
      const tbody = document.getElementById("table-body");

      const standardHeader = `<tr>
        <th>ORDER ID</th><th>DATE</th><th>CLIENT NAME</th><th>ADDRESS</th><th>CONTACT NO.</th><th>QUANTITY</th><th>AMOUNT</th><th>SI / REF</th><th>STATUS</th><th style="text-align:center">ACTION</th>
      </tr>`;

      // NEW ORDER TAB
      if (type === "new") {
        btnAdd.style.display = "block";
        queueActions.style.display = "none";
        thead.innerHTML = `<tr><th>DATE</th><th>CLIENT NAME</th><th>ADDRESS</th><th>CONTACT NO.</th><th>QUANTITY</th><th>AMOUNT</th><th style="text-align:center">ACTION</th></tr>`;
        tbody.innerHTML = `
          <tr><td>02/10/2026</td><td class="client-bold">AgroPh</td><td>Angono Rizal</td><td class="phone-no">+63 917 123 4567</td><td>250 Sacks</td><td><strong>₱75,000</strong></td><td style="text-align:center"><button class="btn-accept" onclick="openModal()">Accept</button></td></tr>
          <tr><td>02/17/2026</td><td class="client-bold">GreenCity</td><td>Quezon City</td><td class="phone-no">+63 918 987 6543</td><td>200 Sacks</td><td><strong>₱60,000</strong></td><td style="text-align:center"><button class="btn-accept" onclick="openModal()">Accept</button></td></tr>
          <tr><td>02/24/2026</td><td class="client-bold">NovaRiches</td><td>Quezon City Brgy Nova</td><td class="phone-no">+63 905 555 1234</td><td>100 Sacks</td><td><strong>₱30,000</strong></td><td style="text-align:center"><button class="btn-accept" onclick="openModal()">Accept</button></td></tr>
          <tr><td>03/01/2026</td><td class="client-bold">FreshMart</td><td>Pasig</td><td class="phone-no">+63 977 123 7890</td><td>320 Sacks</td><td><strong>₱96,000</strong></td><td style="text-align:center"><button class="btn-accept" onclick="openModal()">Accept</button></td></tr>
        `;
      } 
      else if (type === "queue") {
        btnAdd.style.display = "none";
        queueActions.style.display = "flex";
        thead.innerHTML = standardHeader;
        const filtered = queueData.filter(d => d.status === "PROCESSING");
        tbody.innerHTML = filtered.map(item => `
          <tr>
            <td>${item.id}</td><td>${item.date}</td><td class="client-bold">${item.client}</td><td>${item.address}</td><td>${item.contact}</td><td>${item.qty}</td><td><strong>${item.amount}</strong></td><td>${item.si}</td>
            <td>${getStatusBadge(item.status)}</td>
            <td style="text-align:center">${getActionButton('queue', item)}</td>
          </tr>
        `).join("");
      } 
      else if (type === "out") {
        btnAdd.style.display = "none";
        queueActions.style.display = "flex";
        thead.innerHTML = standardHeader;
        const outData = queueData.filter(d => d.status === "TO RECEIVE");
        tbody.innerHTML = outData.map(item => `
          <tr>
            <td>${item.id}</td><td>${item.date}</td><td class="client-bold">${item.client}</td><td>${item.address}</td><td>${item.contact}</td><td>${item.qty}</td><td><strong>${item.amount}</strong></td><td>${item.si}</td>
            <td>${getStatusBadge("TO RECEIVE")}</td>
            <td style="text-align:center">${getActionButton('out', item)}</td>
          </tr>
        `).join("");
        if(outData.length === 0) {
          tbody.innerHTML = `<tr><td colspan="10" style="text-align:center; padding: 40px;">No orders out for delivery</td></tr>`;
        }
      }
      else if (type === "delivered") {
        btnAdd.style.display = "none";
        queueActions.style.display = "flex";
        thead.innerHTML = standardHeader;
        const deliveredData = queueData.filter(d => d.status === "DELIVERED");
        tbody.innerHTML = deliveredData.map(item => `
          <tr>
            <td>${item.id}</td><td>${item.date}</td><td class="client-bold">${item.client}</td><td>${item.address}</td><td>${item.contact}</td><td>${item.qty}</td><td><strong>${item.amount}</strong></td><td>${item.si}</td>
            <td>${getStatusBadge("DELIVERED")}</td>
            <td style="text-align:center">${getActionButton('delivered', item)}</td>
          </tr>
        `).join("");
      }
      else if (type === "all") {
        btnAdd.style.display = "none";
        queueActions.style.display = "flex";
        // All orders - action column removed according to original requirement but we keep with eye-candy
        thead.innerHTML = `<tr><th>ORDER ID</th><th>DATE</th><th>CLIENT NAME</th><th>ADDRESS</th><th>CONTACT NO.</th><th>QUANTITY</th><th>AMOUNT</th><th>SI</th><th>STATUS</th><th style="text-align:center">ACTION</th></tr>`;
        tbody.innerHTML = queueData.map(item => {
          let statusDisplay = '';
          if (item.status === "PROCESSING") statusDisplay = getStatusBadge("PROCESSING");
          else if (item.status === "TO RECEIVE") statusDisplay = getStatusBadge("TO RECEIVE");
          else statusDisplay = getStatusBadge("DELIVERED");
          let actionBtn = '';
          if (item.status === "PROCESSING") actionBtn = `<button class="btn-accept btn-outline-orange" onclick="alert('Update to Out for Delivery')">OUT FOR DELIVERY</button>`;
          else if (item.status === "TO RECEIVE") actionBtn = `<button class="btn-accept btn-outline-blue" onclick="alert('Mark as Delivered')">TO RECEIVE</button>`;
          else actionBtn = `<button class="btn-accept btn-outline-green" disabled style="opacity:0.6;">COMPLETED</button>`;
          return `<tr>
            <td>${item.id}</td><td>${item.date}</td><td class="client-bold">${item.client}</td><td>${item.address}</td><td>${item.contact}</td><td>${item.qty}</td><td><strong>${item.amount}</strong></td><td>${item.si}</td>
            <td>${statusDisplay}</td>
            <td style="text-align:center">${actionBtn}</td>
          </tr>`;
        }).join("");
      }
    }

    // MODAL controls (keep original behavior)
    function openModal() { document.getElementById("orderModal").style.display = "flex"; }
    function closeModal() { document.getElementById("orderModal").style.display = "none"; }
    function openAddOrder() { document.getElementById("addOrderModal").style.display = "flex"; }
    function closeAddOrder() { document.getElementById("addOrderModal").style.display = "none"; }

    function onFilterClick() { alert("Advanced filter options will be available soon."); }
    function onEditClick() { alert("Select an order to edit details (coming soon)."); }

    // On load default to New Order tab
    window.onload = () => {
      const defaultTab = document.getElementById("tab-new");
      switchTab(defaultTab, "new");
      // click outside modal close (optional)
      window.onclick = function(e) {
        if (e.target.classList.contains('modal-overlay')) {
          e.target.style.display = "none";
        }
      };
    };
  </script>
</body>
</html>