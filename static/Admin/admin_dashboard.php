<?php include('../sidebar.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Arnold & Paz Organic Farm</title>
    
    <!-- Styles moved from sidebar.php are now in the include -->
    <!-- Additional dashboard-specific styles -->
    <style>
        /* Override body styles to work with sidebar */
        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #303030;
        }

        /* Main content wrapper to work with fixed sidebar and topbar */
        .dashboard-main-wrapper {
            margin-left: 250px; /* Width of sidebar */
            margin-top: 65px; /* Height of topbar */
            padding: 30px;
            min-height: calc(100vh - 65px);
            background-color: #f8f9fa;
        }

        /* ===== GLOBAL & ANIMATIONS ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulse-effect {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(34, 207, 106, 0.836);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 8px rgba(46, 204, 113, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
            }
        }

        /* TOP KPI ROW */
        .kpi-row {
            display: flex;
            gap: 25px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: white;
            flex: 1;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(154, 51, 51, 0.08);
            border: 1.5px solid rgba(27, 211, 104, 0.74);
            transition: all 0.1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
        }

        .kpi-card svg {
            animation: float 4s ease-in-out infinite;
        }

        .kpi-card h3 {
            margin: 0;
            font-size: 14px;
            color: #424242;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .kpi-card .value {
            font-size: 28px;
            font-weight: 800;
            margin: 10px 0;
            color: #273442;
        }
        
        .kpi-card .growth {
            display: inline-block;
            background: rgba(46, 204, 113, 0.1);
            color: #28a745;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 6px;
        }

        /* MAIN WRAPPER */
        .dashboard-layout {
            display: flex;
            gap: 25px;
            align-items: flex-start;
        }

        .ops-column {
            flex: 1;
            min-width: 0;
        }
        
        .schedule-column {
            flex: 1.2;
            min-width: 0;
        }

        .content-block {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: border 0.3s ease;
            border: 1px solid rgba(59, 59, 59, 0.392);
        }

        /* SCROLLABLE NEW ORDERS */
        .orders-scroll-container {
            max-height: 180px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .orders-scroll-container::-webkit-scrollbar {
            width: 4px;
        }
        
        .orders-scroll-container::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .orders-scroll-container::-webkit-scrollbar-thumb {
            background: #b9b9ba;
            border-radius: 10px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .orders-table tr {
            transition: background 0.2s;
            cursor: pointer;
        }
        
        .orders-table tr:hover {
            background: #f9fbf9;
        }
        
        .orders-table td {
            padding: 14px 10px;
            border-bottom: 1px solid #a0a0a0;
            font-size: 14px;
        }

        .pulse-badge {
            background: linear-gradient(135deg, #2ecc71, #21b760a6);
            color: rgb(255, 253, 253);
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 9px;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
            animation: pulse-effect 2s infinite;
        }

        .chart-frame {
            height: 280px;
            width: 100%;
            margin-top: 15px;
        }

        /* CALENDAR STYLES */
        .cal-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .cal-wrapper {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }
        
        .weekday-label {
            font-weight: 700;
            color: #2f2f2f;
            text-align: center;
            font-size: 11px;
            text-transform: uppercase;
        }

        .nav-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .nav-arrow {
            background: none;
            border: none;
            cursor: pointer;
            color: #95a5a6;
            font-size: 18px;
            transition: color 0.3s;
            padding: 0 5px;
        }
        
        .nav-arrow:hover {
            color: #2ecc71;
        }

        .date-cell {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            min-height: 90px;
            padding: 8px;
            font-size: 13px;
            transition: all 0.1s ease;
        }

        .date-cell:hover {
            transform: scale(1.03);
            z-index: 2;
            border-color: #13cf71;
        }

        .order-day {
            background-color: #fafffa;
            border: 1.5px solid #2ecc71 !important;
        }
        
        .empty-cell {
            background-color: transparent;
            border: none;
        }

        .agenda-tag {
            font-size: 9px;
            padding: 4px 6px;
            border-radius: 6px;
            margin-top: 4px;
            color: white;
            display: block;
            text-align: left;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .clr-meeting {
            background: #2f9ae1;
        }
        
        .clr-order {
            background: #13cf71;
        }

        /* INPUT DRAWER & BUTTONS */
        .action-btn {
            cursor: pointer;
            background: white;
            border: 1px solid #e0e0e0;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            background: #f8f9fa;
            border-color: #28a745;
            color: #2ecc71;
        }

        #agenda-drawer {
            display: none;
            background-color: #f8fbf9;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1.5px dashed #28a745;
            animation: fadeIn 0.3s ease;
        }

        .field-input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border 0.3s;
        }
        
        .field-input:focus {
            border-color: #28a745;
        }
        
        .save-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: opacity 0.3s;
        }
        
        .save-btn:hover {
            opacity: 0.9;
        }

        /* Fix any conflicts with sidebar styles */
        .dashboard-main-wrapper .content-block h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar and Topbar are included via sidebar.php -->
    <?php include('../sidebar.php'); ?>
    <!-- Main Dashboard Content -->
    <div class="dashboard-main-wrapper">
        <div class="kpi-row">
            <div class="kpi-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3>Compost Stock</h3>
                        <div class="value">1,000 kg</div>
                        <div class="growth">↑ 5.2%</div>
                    </div>
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#2ecc71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                        <path d="m3.3 7 8.7 5 8.7-5"></path>
                        <path d="M12 22V12"></path>
                    </svg>
                </div>
            </div>

            <div class="kpi-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3>Profit</h3>
                        <div class="value">₱12,600</div>
                        <div class="growth">↑ 10.1%</div>
                    </div>
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#2ecc71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
            </div>

            <div class="kpi-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3>Total Sales</h3>
                        <div class="value">₱54,000</div>
                        <div class="growth">↑ 8.4%</div>
                    </div>
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#2ecc71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="8" cy="21" r="1"></circle>
                        <circle cx="19" cy="21" r="1"></circle>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="dashboard-layout">
            <div class="ops-column">
                <div class="content-block">
                    <h3 style="font-size: 16px; margin-bottom: 20px">New Orders Only</h3>
                    <div class="orders-scroll-container">
                        <table class="orders-table" id="orders-list-table">
                            <thead>
                                <tr style="border-bottom: 1px solid #242424">
                                    <th style="text-align: left; font-size: 11px; text-transform: uppercase; color: #1b1b1b; padding-bottom: 10px; letter-spacing: 0.5px;">Date</th>
                                    <th style="text-align: left; font-size: 11px; text-transform: uppercase; color: #1b1b1b; padding-bottom: 10px; letter-spacing: 0.5px;">Order ID</th>
                                    <th style="text-align: left; font-size: 11px; text-transform: uppercase; color: #1b1b1b; padding-bottom: 10px; letter-spacing: 0.5px;">Name</th>
                                    <th style="text-align: right; font-size: 11px; text-transform: uppercase; color: #1b1b1b; padding-bottom: 10px; letter-spacing: 0.5px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-day="18" onclick="window.location.href='orders.html?tab=new'">
                                    <td>Feb 10</td>
                                    <td style="color: #1b1b1b">#0001</td>
                                    <td style="font-weight: 500">AgroPh</td>
                                    <td style="text-align: right"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="20" onclick="window.location.href='orders.html?tab=new'">
                                    <td>Feb 17</td>
                                    <td style="color: #1b1b1b">#0002</td>
                                    <td style="font-weight: 500">GreenCity</td>
                                    <td style="text-align: right"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="24" onclick="window.location.href='orders.html?tab=new'">
                                    <td>Feb 24</td>
                                    <td style="color: #1b1b1b">#0004</td>
                                    <td style="font-weight: 500">NovaRiches</td>
                                    <td style="text-align: right"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="27" onclick="window.location.href='orders.html?tab=new'">
                                    <td>Feb 27</td>
                                    <td style="color: #1b1b1b">#0005</td>
                                    <td style="font-weight: 500">Tabby</td>
                                    <td style="text-align: right"><span class="pulse-badge">NEW</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="content-block">
                    <h3 style="font-size: 16px">Sales Report</h3>
                    <div class="chart-frame">
                        <canvas id="mainSalesChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="schedule-column">
                <div class="content-block">
                    <div class="cal-top-bar">
                        <div class="nav-controls">
                            <button class="nav-arrow" onclick="changeMonth(-1)">❮</button>
                            <h2 id="month-label" style="margin: 0; font-size: 20px; font-weight: 800; min-width: 150px;">February 2026</h2>
                            <button class="nav-arrow" onclick="changeMonth(1)">❯</button>
                        </div>
                        <button class="action-btn" onclick="toggleDrawer()">+ EVENTS</button>
                    </div>

                    <div id="agenda-drawer">
                        <input type="number" id="day-val" class="field-input" placeholder="Day" style="width: 60px" />
                        <input type="text" id="txt-val" class="field-input" placeholder="What's happening?" />
                        <button class="save-btn" onclick="addNoteToDay()">Save</button>
                    </div>

                    <div class="cal-wrapper" id="cal-grid">
                        <!-- calendar injected via js -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let currentViewDate = new Date(2026, 1, 1);

        function renderCalendar() {
            const grid = document.getElementById("cal-grid");
            const label = document.getElementById("month-label");
            grid.innerHTML = "";

            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            label.innerText = `${monthNames[currentViewDate.getMonth()]} ${currentViewDate.getFullYear()}`;

            ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"].forEach((day) => {
                grid.innerHTML += `<div class="weekday-label">${day}</div>`;
            });

            const firstDayIndex = new Date(currentViewDate.getFullYear(), currentViewDate.getMonth(), 1).getDay();
            const lastDayDate = new Date(currentViewDate.getFullYear(), currentViewDate.getMonth() + 1, 0).getDate();

            for (let i = 0; i < firstDayIndex; i++) {
                grid.innerHTML += `<div class="date-cell empty-cell"></div>`;
            }

            for (let i = 1; i <= lastDayDate; i++) {
                let cell = document.createElement("div");
                cell.className = "date-cell";
                cell.id = "day-cell-" + i;
                cell.innerHTML = '<b style="color: #34495e">' + i + "</b>";
                grid.appendChild(cell);
            }

            if (currentViewDate.getMonth() === 1 && currentViewDate.getFullYear() === 2026) {
                syncOrdersToCalendar();
                const d12 = document.getElementById("day-cell-12");
                const d5 = document.getElementById("day-cell-5");
                if (d12) d12.innerHTML += '<span class="agenda-tag clr-meeting">BIR Schedule</span>';
                if (d5) d5.innerHTML += '<span class="agenda-tag clr-meeting">Meeting</span>';
            }
        }

        function changeMonth(step) {
            currentViewDate.setMonth(currentViewDate.getMonth() + step);
            renderCalendar();
        }

        function syncOrdersToCalendar() {
            const orderRows = document.querySelectorAll("#orders-list-table tbody tr");
            orderRows.forEach((row) => {
                const day = row.getAttribute("data-day");
                if (!day) return;
                const customer = row.cells[2].innerText;
                const targetCell = document.getElementById("day-cell-" + day);
                if (targetCell) {
                    targetCell.classList.add("order-day");
                    targetCell.innerHTML += `<span class="agenda-tag clr-order">${customer}</span>`;
                }
            });
        }

        function toggleDrawer() {
            let d = document.getElementById("agenda-drawer");
            d.style.display = d.style.display === "block" ? "none" : "block";
        }

        function addNoteToDay() {
            let d = document.getElementById("day-val").value;
            let t = document.getElementById("txt-val").value;
            const lastDay = new Date(currentViewDate.getFullYear(), currentViewDate.getMonth() + 1, 0).getDate();

            if (d > 0 && d <= lastDay && t.trim() != "") {
                let cell = document.getElementById("day-cell-" + d);
                if (!cell) {
                    alert("day out of range for this month");
                    return;
                }
                let tag = document.createElement("span");
                tag.className = "agenda-tag clr-meeting";
                tag.style.animation = "fadeIn 0.5s ease";
                tag.innerText = t;
                cell.appendChild(tag);
                document.getElementById("txt-val").value = "";
                document.getElementById("day-val").value = "";
                toggleDrawer();
            } else {
                alert("invalid day or empty description");
            }
        }

        renderCalendar();

        const ctx = document.getElementById("mainSalesChart").getContext("2d");
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, "rgba(46, 204, 113, 0.2)");
        gradient.addColorStop(1, "rgba(46, 204, 113, 0)");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Sept", "Oct", "Nov", "Dec", "Jan", "Feb"],
                datasets: [{
                    data: [32000, 38000, 35000, 48000, 51000, 54000],
                    borderColor: "#2ecc71",
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: { callback: (v) => "₱" + v.toLocaleString() },
                    },
                },
            },
        });
    </script>
</body>
</html>