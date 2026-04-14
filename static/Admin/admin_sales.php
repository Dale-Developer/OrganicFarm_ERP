<?php
session_start();
require_once '../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Management - Arnold & Paz</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #f4f7fc;
      color: #1e2a3a;
      overflow-x: hidden;
    }

    /* Main content wrapper - matches orders page */
    .sales-page-wrapper {
      margin-left: 250px;
      margin-top: 65px;
      padding: 28px 32px;
      min-height: calc(100vh - 65px);
      background: #f5f9f0;
      transition: all 0.2s ease;
    }

    .sales-content {
      max-width: 1440px;
      margin: 0 auto;
    }

    /* Main card container - same as orders */
    .main-card {
      background: #ffffff;
      border-radius: 28px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05), 0 4px 8px rgba(0, 0, 0, 0.02);
      overflow: hidden;
      transition: all 0.2s;
    }

    /* Header UI - matching orders action bar */
    .header-container {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 18px 28px;
      background: white;
      border-bottom: 1px solid #eef2f6;
      flex-wrap: wrap;
      gap: 15px;
    }

    h1 {
      font-size: 1.4rem;
      font-weight: 700;
      margin: 0;
      color: #1e293b;
      letter-spacing: -0.3px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    h1 i {
      color: #2c6e3c;
      font-size: 1.6rem;
    }

    .controls {
      display: flex;
      gap: 12px;
      position: relative;
    }

    /* Button styles - matching orders */
    .btn {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      padding: 8px 20px;
      border-radius: 40px;
      font-weight: 600;
      font-size: 0.85rem;
      color: #1e2a3e;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: 0.2s;
      font-family: "Inter", sans-serif;
    }

    .btn:hover {
      background: #ffffff;
      border-color: #cbd5e1;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
      transform: translateY(-1px);
    }

    .btn-green {
      background: #2c6e3c;
      color: #fff;
      border: none;
    }

    .btn-green:hover {
      background: #1f5430;
      transform: translateY(-1px);
      box-shadow: 0 6px 12px rgba(44, 110, 60, 0.25);
    }

    /* Dropdown & Filter Box - polished */
    .dropdown {
      position: absolute;
      top: 48px;
      right: 140px;
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      display: none;
      z-index: 100;
      width: 160px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .dropdown button {
      width: 100%;
      padding: 12px 18px;
      text-align: left;
      border: none;
      background: none;
      cursor: pointer;
      font-size: 0.85rem;
      font-family: "Inter", sans-serif;
      font-weight: 500;
      transition: background 0.2s;
    }

    .dropdown button:hover {
      background: #f1f5f9;
    }

    .filter-box {
      position: absolute;
      top: 48px;
      right: 0;
      background: #fff;
      border: 1px solid #e2e8f0;
      border-radius: 24px;
      padding: 20px;
      display: none;
      width: 360px;
      z-index: 100;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.12);
    }

    .filter-row {
      display: flex;
      gap: 10px;
      margin-bottom: 18px;
      flex-wrap: nowrap;
    }

    .filter-row select,
    .filter-row input {
      background: #f8fafc;
      border-radius: 40px;
      padding: 10px 14px;
      min-width: 0;
      flex: 1;
      text-align: center;
      font-size: 0.8rem;
      border: 1px solid #e2e8f0;
      outline: none;
      font-family: "Inter", sans-serif;
      transition: border 0.2s;
    }

    .filter-row select:focus,
    .filter-row input:focus {
      border-color: #2c6e3c;
    }

    .search-bar {
      display: flex;
      align-items: center;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 40px;
      padding: 8px 18px;
    }

    .search-bar i {
      color: #94a3b8;
    }

    .search-bar input {
      border: none;
      background: transparent;
      width: 100%;
      outline: none;
      margin-left: 10px;
      font-family: "Inter", sans-serif;
      font-size: 0.85rem;
    }

    /* Records Flex Container */
    .records-flex-container {
      display: flex;
      gap: 25px;
      align-items: flex-start;
      flex-wrap: wrap;
      padding: 24px 28px;
    }

    /* Record Card - matches orders table card style */
    .record-card {
      flex: 3;
      min-width: 300px;
      background: #fff;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
      border: 1px solid #edf2f7;
    }

    .table-header {
      padding: 20px 24px;
      border-bottom: 1px solid #edf2f7;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      background: #fefefe;
    }

    .logo-placeholder {
      position: absolute;
      left: 24px;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f1f5f9;
      border-radius: 60px;
    }

    .logo-placeholder img {
      max-width: 32px;
      max-height: 32px;
    }

    .title-text {
      text-align: center;
    }

    .title-text div {
      font-size: 0.7rem;
      font-weight: 600;
      color: #64748b;
      letter-spacing: 1px;
    }

    .title-text h2 {
      font-size: 1.3rem;
      margin: 6px 0 0;
      color: #2c6e3c;
      letter-spacing: -0.3px;
      font-weight: 700;
    }

    /* Table Wrapper & Table Styles - centered, modern */
    .table-wrapper {
      overflow-x: auto;
      padding: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }

    th {
      text-align: center;
      padding: 16px 14px;
      background-color: #f9fbfd;
      color: #1f2a44;
      font-weight: 700;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-bottom: 1px solid #e9edf2;
      border-right: none;
    }

    td {
      padding: 14px 12px;
      text-align: center;
      border-bottom: 1px solid #f0f2f5;
      vertical-align: middle;
      color: #1e2a3a;
      font-weight: 500;
      font-size: 0.85rem;
    }

    /* Action button inside table */
    .action-btn {
      background: transparent;
      border: none;
      cursor: pointer;
      padding: 6px 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s;
      border-radius: 30px;
    }

    .action-btn:hover {
      transform: scale(1.05);
      background: #f1f5f9;
    }

    .action-btn img {
      width: 18px;
      height: 18px;
    }

    .editing {
      background-color: #fef9e3 !important;
    }

    [contenteditable="true"] {
      background-color: #fef9e3;
      outline: none;
      padding: 4px 6px;
      border-radius: 12px;
    }

    /* Breakdown Panel - matching card design */
    .breakdown-panel {
      flex: 1;
      min-width: 280px;
      background: #fff;
      border-radius: 24px;
      position: sticky;
      top: 85px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
      border: 1px solid #edf2f7;
    }

    .breakdown-panel h3 {
      text-align: center;
      margin: 0;
      padding: 18px 20px;
      border-bottom: 1px solid #edf2f7;
      font-size: 0.85rem;
      letter-spacing: 1.5px;
      font-weight: 800;
      color: #2c6e3c;
      background: #fefefe;
    }

    .bd-content {
      padding: 20px;
      min-height: 380px;
    }

    .bd-section-title {
      font-weight: 800;
      font-size: 0.85rem;
      margin-bottom: 14px;
      color: #1e293b;
      letter-spacing: -0.2px;
    }

    .bd-labels {
      display: flex;
      justify-content: space-between;
      font-size: 0.7rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .bd-total-row {
      margin-top: 18px;
      padding-top: 12px;
      border-top: 1px solid #edf2f7;
      text-align: right;
      font-size: 0.85rem;
      font-weight: 700;
      margin-bottom: 28px;
      color: #1e293b;
    }

    .bd-footer {
      border-top: 2px solid #2c6e3c;
      padding: 18px 24px;
      font-weight: 800;
      font-size: 0.95rem;
      display: flex;
      justify-content: space-between;
      background: #fafcff;
      color: #1e293b;
    }

    .hidden {
      display: none !important;
    }

    /* Add button container */
    #addBtnContainer {
      padding: 16px 24px;
      border-top: 1px solid #edf2f7;
      text-align: left;
    }

    #addBtnContainer .btn {
      font-size: 0.75rem;
      padding: 6px 18px;
      background: #f1f5f9;
    }

    /* Print adjustments */
    @media print {
      .sales-page-wrapper {
        margin: 0;
        padding: 0;
        background: white;
      }

      .sidebar,
      .action-bar,
      .controls,
      .btn,
      .dropdown,
      .filter-box {
        display: none !important;
      }

      .breakdown-panel {
        position: static;
        width: 100%;
      }
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .sales-page-wrapper {
        margin-left: 0;
        padding: 20px;
      }

      .records-flex-container {
        flex-direction: column;
      }

      .breakdown-panel {
        position: static;
        width: 100%;
      }
    }

    @media (max-width: 768px) {
      .header-container {
        flex-direction: column;
        align-items: stretch;
      }

      .controls {
        justify-content: flex-start;
      }

      .filter-box {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 350px;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar include -->
  <?php include('../sidebar.php'); ?>

  <!-- Wrapper matching orders page structure -->
  <div class="sales-page-wrapper">
    <div class="sales-content">
      <div class="main-card">
        <div class="header-container">
          <!-- <h1>
            <i class="fas fa-chart-line"></i> 
            Sales Management -->
          </h1>
          <div class="controls">
            <button class="btn" id="viewBtn" onclick="toggleDropdown(event)"></i> SALES <i
                class="fas fa-chevron-down"></i></button>
            <button class="btn" onclick="toggleFilter(event)"><i class="fas fa-filter"></i> Filter</button>
            <button class="btn btn-green" onclick="window.print()"><i class="fas fa-print"></i> Print</button>

            <div class="dropdown" id="dropdown">
              <button onclick="switchView('sales')"><i class="fas fa-chart-simple"></i> SALES</button>
              <button onclick="switchView('expenses')"><i class="fas fa-receipt"></i> EXPENSES</button>
            </div>

            <div class="filter-box" id="filterBox" onclick="event.stopPropagation()">
              <div class="filter-row">
                <select id="filterMonth" onchange="applyFilters()">
                  <option value="">Month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
                <input type="number" id="filterDay" placeholder="Date" min="1" max="31" oninput="applyFilters()">
                <input type="number" id="filterYear" placeholder="Year" value="2026" oninput="applyFilters()">
              </div>
              <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search Customer ..." onkeyup="applyFilters()">
              </div>
            </div>
          </div>
        </div>

        <div class="records-flex-container">
          <div class="record-card">
            <!-- <div class="table-header">
              <div class="logo-placeholder">
                <img src="../../assets/img/organicfarmlogo.png" alt="LOGO">
              </div>
              <div class="title-text">
                <div>ARNOLD & PAZ ORGANIC FARM</div>
                <h2 id="recordTitle">SALES RECORD</h2>
              </div>
            </div> -->

            <div class="table-wrapper">
              <table id="salesTable">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Address</th>
                    <th>No. of Sacks</th>
                    <th>Unit Cost</th>
                    <th>Total Sales</th>
                  </tr>
                </thead>
                <tbody id="salesBody">
                  <tr data-date="2026-02-17">
                    <td>02/17/2026</td>
                    <td>Novaliches</td>
                    <td>Compost</td>
                    <td>Brgy Nova 7 St.liches</td>
                    <td>600</td>
                    <td>300</td>
                    <td>Php 180,000</td>
                  </tr>
                  <tr data-date="2026-02-19">
                    <td>02/19/2026</td>
                    <td>Alex</td>
                    <td>Compost</td>
                    <td>Brgy Malinta</td>
                    <td>600</td>
                    <td>300</td>
                    <td>Php 180,000</td>
                  </tr>
                  <!-- These rows are now non-editable - they serve as visual placeholders only -->
                  <tr data-date="">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr data-date="">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr data-date="">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>

              <table id="expensesTable" class="hidden">
                <thead>
                  <tr>
                    <th>Items</th>
                    <th>Quantity</th>
                    <th>Cost Per</th>
                    <th>Total Cost</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="expensesBody">
                  <tr>
                    <td>COMPOST</td>
                    <td>1</td>
                    <td>300</td>
                    <td>300</td>
                    <td>
                      <button class="action-btn" onclick="toggleEdit(this)">
                        <i class="fas fa-edit" style="color: #2c6e3c;"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>Fertilizer</td>
                    <td>2</td>
                    <td>450</td>
                    <td>900</td>
                    <td>
                      <button class="action-btn" onclick="toggleEdit(this)">
                        <i class="fas fa-edit" style="color: #2c6e3c;"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div id="addBtnContainer" class="hidden">
              <button class="btn" onclick="addNewRow()"><i class="fas fa-plus"></i> Add New Row</button>
            </div>
          </div>

          <div id="breakdownPanel" class="breakdown-panel hidden">
            <h3><i class="fas fa-chart-pie"></i> BREAKDOWN</h3>
            <div class="bd-content">
              <div class="bd-section-title">SALES</div>
              <div class="bd-labels"><span>ITEMS</span><span>QTY</span><span>SALE</span></div>
              <div id="bd-sales-items">
                <div class="bd-labels"><span>Compost</span><span>1,200</span><span>360,000</span></div>
              </div>
              <div class="bd-total-row">Php 360,000.00</div>

              <div class="bd-section-title">EXPENSES</div>
              <div class="bd-labels"><span>ITEMS</span><span>QTY</span><span>COST</span></div>
              <div id="bd-expenses-items">
                <div class="bd-labels"><span>Compost</span><span>1</span><span>300</span></div>
                <div class="bd-labels"><span>Fertilizer</span><span>2</span><span>900</span></div>
              </div>
              <div class="bd-total-row" id="bd-exp-total-display">Php 1,200.00</div>
            </div>
            <div class="bd-footer">
              <span>TOTAL PROFIT:</span>
              <span id="bd-profit-display">Php 358,800.00</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleDropdown(e) {
      e.stopPropagation();
      const d = document.getElementById('dropdown');
      d.style.display = d.style.display === 'block' ? 'none' : 'block';
      document.getElementById('filterBox').style.display = 'none';
    }

    function toggleFilter(e) {
      e.stopPropagation();
      const f = document.getElementById('filterBox');
      f.style.display = f.style.display === 'block' ? 'none' : 'block';
      document.getElementById('dropdown').style.display = 'none';
    }

    function switchView(type) {
      const salesT = document.getElementById('salesTable');
      const expT = document.getElementById('expensesTable');
      const bdP = document.getElementById('breakdownPanel');
      const addBtn = document.getElementById('addBtnContainer');
      const title = document.getElementById('recordTitle');
      const btn = document.getElementById('viewBtn');

      if (type === 'sales') {
        salesT.classList.remove('hidden');
        expT.classList.add('hidden');
        bdP.classList.add('hidden');
        addBtn.classList.add('hidden');
        title.innerText = "SALES RECORD";
        btn.innerHTML = ' SALES <i class="fas fa-chevron-down"></i>';
      } else {
        salesT.classList.add('hidden');
        expT.classList.remove('hidden');
        bdP.classList.remove('hidden');
        addBtn.classList.remove('hidden');
        title.innerText = "EXPENSES RECORD";
        btn.innerHTML = '</i> EXPENSES <i class="fas fa-chevron-down"></i>';
      }
      document.getElementById('dropdown').style.display = 'none';
    }

    function toggleEdit(btn) {
      const row = btn.closest('tr');
      const cells = Array.from(row.querySelectorAll('td:not(:last-child)'));
      const isEditing = row.classList.contains('editing');

      if (!isEditing) {
        row.classList.add('editing');
        cells.forEach(cell => cell.contentEditable = "true");
        if (cells[0]) cells[0].focus();
        btn.innerHTML = '<i class="fas fa-check-circle" style="color: #2c6e3c;"></i>';
      } else {
        row.classList.remove('editing');
        cells.forEach(cell => cell.contentEditable = "false");

        const qty = parseFloat(cells[1]?.innerText) || 0;
        const cost = parseFloat(cells[2]?.innerText) || 0;
        if (cells[3]) cells[3].innerText = (qty * cost).toLocaleString();

        btn.innerHTML = '<i class="fas fa-edit" style="color: #2c6e3c;"></i>';
        updateBreakdown();
        alert("Changes saved!");
      }
    }

    function addNewRow() {
      const tbody = document.getElementById('expensesBody');
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td contenteditable="false">New Item</td>
        <td contenteditable="false">0</td>
        <td contenteditable="false">0</td>
        <td contenteditable="false">0</td>
        <td>
          <button class="action-btn" onclick="toggleEdit(this)">
            <i class="fas fa-edit" style="color: #2c6e3c;"></i>
          </button>
        </td>
      `;
      tbody.appendChild(tr);
      toggleEdit(tr.querySelector('.action-btn'));
    }

    function updateBreakdown() {
      let totalExpense = 0;
      document.querySelectorAll('#expensesBody tr').forEach(row => {
        const qty = parseFloat(row.cells[1]?.innerText) || 0;
        const cost = parseFloat(row.cells[2]?.innerText) || 0;
        totalExpense += qty * cost;
      });
      const expTotalSpan = document.getElementById('bd-exp-total-display');
      if (expTotalSpan) expTotalSpan.innerText = `Php ${totalExpense.toLocaleString()}.00`;

      const profitSpan = document.getElementById('bd-profit-display');
      const salesTotal = 360000;
      if (profitSpan) profitSpan.innerText = `Php ${(salesTotal - totalExpense).toLocaleString()}.00`;
    }

    function applyFilters() {
      const month = document.getElementById('filterMonth').value;
      const day = document.getElementById('filterDay').value.padStart(2, '0');
      const year = document.getElementById('filterYear').value;
      const search = document.getElementById('searchInput').value.toLowerCase();

      const rows = document.querySelectorAll('#salesBody tr');
      rows.forEach(row => {
        const dateAttr = row.getAttribute('data-date');
        if (!dateAttr || dateAttr === "") {
          row.style.display = "";
          return;
        }
        const [rYear, rMonth, rDay] = dateAttr.split('-');
        const text = row.innerText.toLowerCase();
        const matchMonth = month === "" || rMonth === month;
        const matchDay = day === "00" || rDay === day;
        const matchYear = year === "" || rYear === year;
        const matchSearch = text.includes(search);
        row.style.display = (matchMonth && matchDay && matchYear && matchSearch) ? "" : "none";
      });
    }

    window.onclick = function (event) {
      if (!event.target.closest('.dropdown') && !event.target.closest('#viewBtn')) {
        document.getElementById('dropdown').style.display = 'none';
      }
      if (!event.target.closest('.filter-box') && !event.target.closest('#filterBox') && !event.target.closest('[onclick="toggleFilter(event)"]')) {
        document.getElementById('filterBox').style.display = 'none';
      }
    }
  </script>
</body>

</html>