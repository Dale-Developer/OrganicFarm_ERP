<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management - Arnold & Paz</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    .inventory-page-wrapper {
      margin-left: 250px;
      margin-top: 65px;
      padding: 28px 32px;
      min-height: calc(100vh - 65px);
      background: #f5f9f0;
      transition: all 0.2s ease;
    }
    .inventory-content {
      max-width: 1440px;
      margin: 0 auto;
    }
    .main-card {
      background: #ffffff;
      border-radius: 28px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05), 0 4px 8px rgba(0, 0, 0, 0.02);
      overflow: hidden;
    }
    .page-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 28px;
      background: white;
      border-bottom: 1px solid #eef2f6;
    }
    .page-header h1 {
      font-size: 1.4rem;
      font-weight: 700;
      color: #1e293b;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .page-header h1 i {
      color: #2c6e3c;
      font-size: 1.6rem;
    }
    .nav-tabs {
      display: flex;
      gap: 6px;
      padding: 0 24px;
      background: white;
      border-bottom: 1px solid #edf2f7;
    }
    .tab {
      padding: 14px 28px;
      font-weight: 600;
      font-size: 0.85rem;
      color: #4b5565;
      cursor: pointer;
      transition: 0.2s;
      background: transparent;
      border: none;
      font-family: 'Inter', sans-serif;
      letter-spacing: 0.3px;
    }
    .tab:hover {
      color: #2c6e3c;
      background: #f1f9f0;
    }
    .tab.active {
      color: #2c6e3c;
      border-bottom: 3px solid #2c6e3c;
      font-weight: 700;
    }
    .view-content {
      padding: 28px;
    }
    .view-content.hidden {
      display: none;
    }
    /* Stock Cards */
    .cards-container {
      display: flex;
      gap: 24px;
      flex-wrap: wrap;
      margin-bottom: 32px;
    }
    .card-wrapper {
      background: #fff;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border: 1px solid #edf2f7;
      transition: transform 0.2s, box-shadow 0.2s;
      flex: 1;
      min-width: 220px;
    }
    .card-wrapper:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }
    .stock-card {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 20px;
    }
    .img-container {
      width: 70px;
      height: 70px;
      background: #f1f5f9;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .img-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .card-content {
      flex: 1;
    }
    .card-name {
      font-weight: 700;
      font-size: 1rem;
      color: #1e293b;
      margin-bottom: 6px;
    }
    .card-status {
      font-size: 0.8rem;
      color: #2c6e3c;
      font-weight: 600;
      background: #e8f5e9;
      display: inline-block;
      padding: 4px 12px;
      border-radius: 30px;
    }
    .action-btn {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 40px;
      padding: 10px 16px;
      margin: 0 16px 16px 16px;
      width: calc(100% - 32px);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: 0.2s;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 0.75rem;
      color: #4b5565;
    }
    .action-btn:hover {
      background: #2c6e3c;
      border-color: #2c6e3c;
      color: white;
    }
    /* Table Styles */
    .table-date {
      font-size: 0.85rem;
      font-weight: 600;
      color: #64748b;
      margin: 24px 0 16px 0;
      letter-spacing: 0.5px;
    }
    .table-wrapper {
      overflow-x: auto;
      border-radius: 20px;
      border: 1px solid #edf2f7;
      background: white;
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
    .col-particular {
      text-align: left;
      font-weight: 700;
      background-color: #fafcff;
    }
    .subtotal-row {
      background-color: #f8fafc;
      font-weight: 700;
    }
    /* Record section */
    .record-section {
      margin-bottom: 20px;
    }
    .record-actions {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 12px;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }
    .date-pill {
      background: #f1f5f9;
      padding: 8px 20px;
      border-radius: 40px;
      font-size: 0.8rem;
      font-weight: 600;
      color: #1e293b;
      white-space: nowrap;
    }
    .btn-icon {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 40px;
      padding: 8px 14px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: 0.2s;
      font-weight: 500;
      font-size: 0.8rem;
    }
    .btn-icon:hover {
      background: #eef2ff;
      border-color: #2c6e3c;
    }
    /* Year filter inside record-actions (compact & inline) */
    .year-filter-inline {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #f9fbfd;
      padding: 5px 12px 5px 16px;
      border-radius: 48px;
      border: 1px solid #e2e8f0;
      transition: all 0.2s;
    }
    .year-filter-inline:hover {
      background: #ffffff;
      border-color: #cbd5e1;
    }
    .filter-label-icon {
      font-size: 0.75rem;
      font-weight: 600;
      color: #2c6e3c;
      margin-right: 4px;
    }
    .year-input-group-inline {
      display: flex;
      align-items: center;
      gap: 6px;
      background: white;
      padding: 4px 12px;
      border-radius: 32px;
      border: 1px solid #e2e8f0;
    }
    .year-input-group-inline label {
      font-weight: 500;
      font-size: 0.7rem;
      color: #475569;
    }
    .year-input-group-inline input {
      padding: 4px 8px;
      border: 1px solid #cbd5e1;
      border-radius: 30px;
      width: 70px;
      font-family: 'Inter', sans-serif;
      font-size: 0.75rem;
      text-align: center;
      font-weight: 500;
    }
    .apply-year-inline-btn {
      background: #2c6e3c;
      color: white;
      border: none;
      padding: 6px 16px;
      border-radius: 32px;
      font-weight: 600;
      font-size: 0.7rem;
      cursor: pointer;
      transition: 0.2s;
      white-space: nowrap;
    }
    .apply-year-inline-btn:hover {
      background: #1f5430;
      transform: scale(0.98);
    }
    @media (max-width: 860px) {
      .record-actions {
        justify-content: flex-start;
      }
      .year-filter-inline {
        flex-wrap: wrap;
        background: transparent;
        border: none;
        padding-left: 0;
        gap: 8px;
      }
      .year-input-group-inline input {
        width: 65px;
      }
    }
    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }
    .modal.active {
      display: flex;
    }
    .modal-content {
      background: white;
      border-radius: 32px;
      max-width: 800px;
      width: 90%;
      max-height: 85vh;
      overflow-y: auto;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 28px;
      border-bottom: 1px solid #edf2f7;
    }
    .modal-header h2 {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e293b;
    }
    .close-modal {
      background: none;
      border: none;
      font-size: 28px;
      cursor: pointer;
      color: #94a3b8;
      transition: 0.2s;
    }
    .close-modal:hover {
      color: #ef4444;
    }
    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      padding: 20px 28px;
      border-top: 1px solid #edf2f7;
    }
    .btn-save {
      background: #2c6e3c;
      color: white;
      border: none;
      padding: 10px 28px;
      border-radius: 40px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-save:hover {
      background: #1f5430;
    }
    .btn-cancel {
      background: #f1f5f9;
      color: #475569;
      border: none;
      padding: 10px 28px;
      border-radius: 40px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-cancel:hover {
      background: #e2e8f0;
    }
    .form-group {
      margin-bottom: 20px;
      padding: 0 28px;
    }
    .form-group label {
      display: block;
      font-weight: 600;
      font-size: 0.8rem;
      margin-bottom: 6px;
      color: #475569;
    }
    .form-group input, .form-group select, .form-group textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      font-family: 'Inter', sans-serif;
      font-size: 0.85rem;
      transition: border 0.2s;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
      outline: none;
      border-color: #2c6e3c;
    }
    .edit-table {
      width: 100%;
      border-collapse: collapse;
      margin: 16px 0;
    }
    .edit-table th, .edit-table td {
      border: 1px solid #e2e8f0;
      padding: 8px;
      text-align: center;
    }
    .edit-table input {
      width: 100%;
      padding: 8px;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-family: 'Inter', sans-serif;
    }
    .delete-row-btn {
      background: #fee2e2;
      border: none;
      padding: 6px 12px;
      border-radius: 30px;
      color: #dc2626;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.7rem;
    }
    .add-row-btn {
      margin: 0 28px 16px 28px;
      background: #f1f5f9;
      border: 1px solid #e2e8f0;
      padding: 10px 20px;
      border-radius: 40px;
      cursor: pointer;
      font-weight: 600;
      display: inline-block;
    }
    @media (max-width: 1024px) {
      .inventory-page-wrapper {
        margin-left: 0;
        padding: 20px;
      }
    }
    @media (max-width: 768px) {
      .cards-container {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <?php include('../sidebar.php'); ?>

  <div class="inventory-page-wrapper">
    <div class="inventory-content">
      <div class="main-card">
        <div class="page-header">
          <h1><i class="fas fa-boxes"></i> Inventory Management</h1>
        </div>

        <div class="nav-tabs">
          <button class="tab active" onclick="showView('stockLevel', this)">STOCK LEVEL</button>
          <button class="tab" onclick="showView('compostRecord', this)">HARVEST RECORD</button>
        </div>

        <!-- STOCK LEVEL VIEW -->
        <div id="stockLevel" class="view-content">
          <div class="cards-container">
            <div class="card-wrapper">
              <div class="stock-card">
                <div class="img-container"><img src="../../assets/img/COMPOST.jpg" alt="Compost"></div>
                <div class="card-content">
                  <div class="card-name">Compost</div>
                  <div class="card-status">Available: 500 sacks</div>
                </div>
              </div>
              <button class="action-btn" onclick="openItemModal('Compost', '500 sacks')"><i class="fas fa-edit"></i> Edit Item</button>
            </div>
            <div class="card-wrapper">
              <div class="stock-card">
                <div class="img-container"><img src="../../assets/img/ANC.jpg" alt="ANC"></div>
                <div class="card-content">
                  <div class="card-name">ANC</div>
                  <div class="card-status">Available: 300 kg</div>
                </div>
              </div>
              <button class="action-btn" onclick="openItemModal('ANC', '300 kg')"><i class="fas fa-edit"></i> Edit Item</button>
            </div>
            <div class="card-wrapper">
              <div class="stock-card">
                <div class="img-container"><img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=400" alt="Soil Mix"></div>
                <div class="card-content">
                  <div class="card-name">Soil Mix</div>
                  <div class="card-status">Available: for request</div>
                </div>
              </div>
              <button class="action-btn" onclick="openItemModal('Soil Mix', 'for request')"><i class="fas fa-edit"></i> Edit Item</button>
            </div>
          </div>
          <div class="table-date">FEBRUARY 16, 2026</div>
          <div class="table-wrapper">
            <div class="table-container">
              <table>
                <thead>
                  <tr><th>ITEM ID</th><th>ITEM</th><th>QUANTITY</th><th style="width: 60px;"><i class="fas fa-edit" style="cursor: pointer;" onclick="openTableEditModal('stockTable')"></i></th><th>IN STOCK</th><th>RUNNING OUT</th><th>OUT OF STOCK</th></tr>
                </thead>
                <tbody id="stockTable">
                  <tr><td>001</td><td>Sacks</td><td>100</td><td></td><td>Sacks</td><td></td><td></td></tr>
                  <tr><td>002</td><td>Cow Manure</td><td>10</td><td></td><td></td><td>Cow Manure</td><td></td></tr>
                  <tr><td>003</td><td>Plastic Talli</td><td>0</td><td></td><td></td><td></td><td>Plastic Talli</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- HARVEST RECORD (COMPOST RECORD) - Year filter INSIDE record-actions -->
        <div id="compostRecord" class="view-content hidden">
          <div class="record-section">
            <!-- record-actions now contains both the pill, edit button, and inline year filter -->
            <div class="record-actions">
              <div class="date-pill" id="selectedDateRange">2024 - 2025</div>
              <button class="btn-icon" onclick="openTableEditModal('compostTable')"><i class="fas fa-edit"></i> Edit Table</button>
              
              <!-- YEAR FILTER (COMPACT, WITHIN RECORD-ACTIONS) -->
              <div class="year-filter-inline">
                <span class="filter-label-icon"><i class="fas fa-calendar-alt"></i> Year</span>
                <div class="year-input-group-inline">
                  <label>Start:</label>
                  <input type="number" id="harvestStartYearInline" min="2000" max="2100" value="2024" step="1">
                </div>
                <div class="year-input-group-inline">
                  <label>End:</label>
                  <input type="number" id="harvestEndYearInline" min="2000" max="2100" value="2025" step="1">
                </div>
                <button class="apply-year-inline-btn" onclick="applyInlineYearFilter()"><i class="fas fa-check-circle"></i> Apply</button>
              </div>
            </div>
            
            <!-- TABLE DISPLAY -->
            <div class="table-wrapper">
              <div class="table-container">
                <table>
                  <thead>
                    <tr>
                      <th class="col-particular">PARTICULAR</th>
                      <th>JAN.</th><th>FEB.</th><th>MARCH</th><th>APRIL</th><th>MAY</th><th>JUNE</th>
                      <th>JULY</th><th>AUG.</th><th>SEPT.</th><th>OCT.</th><th>NOV.</th><th>DEC.</th><th>TOTAL</th>
                    </tr>
                  </thead>
                  <tbody id="compostTable">
                    <tr><td class="col-particular">Vermicast/KG</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr><td class="col-particular">ANC/KG</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr class="subtotal-row"><td class="col-particular">TOTAL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALS -->
  <div id="itemModal" class="modal">
    <div class="modal-content">
      <div class="modal-header"><h2>Edit Item: <span id="itemModalTitle"></span></h2><button class="close-modal" onclick="closeModal('itemModal')">&times;</button></div>
      <div id="itemModalBody"></div>
      <div class="modal-actions"><button class="btn-cancel" onclick="closeModal('itemModal')">Cancel</button><button class="btn-save" onclick="saveItemChanges()">Save Changes</button></div>
    </div>
  </div>

  <div id="tableEditModal" class="modal">
    <div class="modal-content">
      <div class="modal-header"><h2>Edit Table Records</h2><button class="close-modal" onclick="closeModal('tableEditModal')">&times;</button></div>
      <div id="tableEditBody"></div>
      <button class="add-row-btn" onclick="addTableRow()">+ Add Row</button>
      <div class="modal-actions"><button class="btn-cancel" onclick="closeModal('tableEditModal')">Cancel</button><button class="btn-save" onclick="saveTableChanges()">Save Changes</button></div>
    </div>
  </div>

  <script>
    let currentEditTableId = '';
    
    function showView(viewId, element) {
      document.querySelectorAll('.view-content').forEach(view => view.classList.add('hidden'));
      document.getElementById(viewId).classList.remove('hidden');
      document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
      element.classList.add('active');
      if (viewId === 'compostRecord') {
        syncInlineYearInputs();
      }
    }

    // Sync inline year inputs with current date pill value
    function syncInlineYearInputs() {
      const currentRange = document.getElementById('selectedDateRange').innerText;
      const parts = currentRange.split(' - ');
      if (parts.length === 2) {
        const start = parseInt(parts[0]);
        const end = parseInt(parts[1]);
        if (!isNaN(start)) document.getElementById('harvestStartYearInline').value = start;
        if (!isNaN(end)) document.getElementById('harvestEndYearInline').value = end;
      }
    }
    
    // Apply filter from inline year inputs (inside record-actions)
    function applyInlineYearFilter() {
      const startInput = document.getElementById('harvestStartYearInline');
      const endInput = document.getElementById('harvestEndYearInline');
      let startYear = parseInt(startInput.value);
      let endYear = parseInt(endInput.value);
      
      if (isNaN(startYear)) startYear = 2024;
      if (isNaN(endYear)) endYear = 2025;
      if (startYear > endYear) {
        alert("Start year cannot be greater than end year.");
        return;
      }
      
      const newRange = `${startYear} - ${endYear}`;
      document.getElementById('selectedDateRange').innerText = newRange;
      
      // Show feedback (in a real scenario, you'd fetch filtered table data here)
      alert(`Harvest record date range updated to: ${newRange}\n(Data would refresh based on server with selected years)`);
      
      // Here you can optionally add an AJAX call to reload the table data with the new year range.
      // For demo, we keep UI consistent.
    }
    
    // For any external updates (if needed) keep inputs synced
    function updateYearRangeManually(startYear, endYear) {
      const newRange = `${startYear} - ${endYear}`;
      document.getElementById('selectedDateRange').innerText = newRange;
      if (document.getElementById('harvestStartYearInline')) {
        document.getElementById('harvestStartYearInline').value = startYear;
        document.getElementById('harvestEndYearInline').value = endYear;
      }
    }
    
    function openItemModal(itemName, availability) {
      const modal = document.getElementById('itemModal');
      document.getElementById('itemModalTitle').textContent = itemName;
      const body = document.getElementById('itemModalBody');
      body.innerHTML = `
        <div class="form-group"><label>Item Name</label><input type="text" id="editItemName" value="${itemName}"></div>
        <div class="form-group"><label>Availability</label><input type="text" id="editItemAvailability" value="${availability}"></div>
        <div class="form-group"><label>Status</label><select id="editItemStatus"><option value="in-stock">In Stock</option><option value="running-out">Running Out</option><option value="out-of-stock">Out of Stock</option><option value="for-request">For Request</option></select></div>
        <div class="form-group"><label>Additional Notes</label><textarea id="editItemNotes" rows="4"></textarea></div>
      `;
      modal.classList.add('active');
    }
    
    function openTableEditModal(tableId) {
      currentEditTableId = tableId;
      const table = document.getElementById(tableId);
      const modal = document.getElementById('tableEditModal');
      if (!table) return;
      let editTable = '<table class="edit-table"><thead><tr>';
      const headerRow = table.closest('.table-container')?.querySelector('thead tr');
      if (headerRow) {
        headerRow.querySelectorAll('th').forEach(th => { editTable += `<th>${th.textContent}</th>`; });
      }
      editTable += '<th>Action</th></tr></thead><tbody>';
      table.querySelectorAll('tr').forEach(row => {
        editTable += '<tr>';
        row.querySelectorAll('td').forEach(td => { editTable += `<td><input type="text" value="${td.textContent.trim()}"></td>`; });
        editTable += `<td><button class="delete-row-btn" onclick="this.parentElement.parentElement.remove()">Delete</button></td></tr>`;
      });
      editTable += '</tbody></table>';
      document.getElementById('tableEditBody').innerHTML = editTable;
      modal.classList.add('active');
    }
    
    function addTableRow() {
      const editTable = document.querySelector('.edit-table tbody');
      if (!editTable) return;
      const columnCount = editTable.querySelector('tr')?.querySelectorAll('input').length || 3;
      let newRow = '<tr>';
      for (let i = 0; i < columnCount; i++) { newRow += '<td><input type="text" placeholder="Enter value..."></td>'; }
      newRow += '<td><button class="delete-row-btn" onclick="this.parentElement.parentElement.remove()">Delete</button></td></tr>';
      editTable.insertAdjacentHTML('beforeend', newRow);
    }
    
    function saveTableChanges() {
      const modal = document.getElementById('tableEditModal');
      const editTable = document.querySelector('.edit-table tbody');
      const originalTable = document.getElementById(currentEditTableId);
      if (!originalTable || !editTable) { alert('Error saving changes'); return; }
      originalTable.innerHTML = '';
      editTable.querySelectorAll('tr').forEach(row => {
        const newRow = document.createElement('tr');
        row.querySelectorAll('input').forEach(input => {
          const td = document.createElement('td');
          td.textContent = input.value;
          newRow.appendChild(td);
        });
        originalTable.appendChild(newRow);
      });
      modal.classList.remove('active');
      alert('Table changes saved successfully!');
    }
    
    function saveItemChanges() {
      const itemName = document.getElementById('editItemName').value;
      const availability = document.getElementById('editItemAvailability').value;
      const status = document.getElementById('editItemStatus').value;
      const notes = document.getElementById('editItemNotes').value;
      console.log('Item saved:', { itemName, availability, status, notes });
      closeModal('itemModal');
      alert('Item changes saved successfully!');
    }
    
    function closeModal(modalId) { document.getElementById(modalId).classList.remove('active'); }
    
    window.addEventListener('click', (event) => {
      document.querySelectorAll('.modal').forEach(modal => { if (event.target === modal) modal.classList.remove('active'); });
    });
    
    document.addEventListener('DOMContentLoaded', () => {
      syncInlineYearInputs();
      // allow pressing Enter inside year fields to apply filter
      const startField = document.getElementById('harvestStartYearInline');
      const endField = document.getElementById('harvestEndYearInline');
      if (startField) {
        startField.addEventListener('keypress', (e) => { if (e.key === 'Enter') applyInlineYearFilter(); });
      }
      if (endField) {
        endField.addEventListener('keypress', (e) => { if (e.key === 'Enter') applyInlineYearFilter(); });
      }
    });
  </script>
</body>
</html>