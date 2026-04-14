<?php
session_start();
require_once '../../config/config.php';

// Debug: Log what we have
error_log("Session data: " . print_r($_SESSION, true));

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    error_log("No user_id in session");
    header('Location: ../../index.php?error=access');
    exit();
}

// Check if user is Admin (exact match)
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    error_log("Wrong role: " . ($_SESSION['user_role'] ?? 'null'));
    header('Location: 2004://../index.php?error=access');
    exit();
}

// echo "<h1>Welcome Admin!</h1>";
// echo "You have successfully logged in!";
// Rest of your dashboard code...
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Arnold & Paz Organic Farm</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

    <style>
        /* ===== GLOBAL REFRESH ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, sans-serif;
            background-color: #F5F9F0;
            margin: 0;
            padding: 0;
            color: #1E2F2B;
        }

        /* Main content wrapper (respects sidebar) */
        .dashboard-main-wrapper {
            margin-left: 250px;
            margin-top: 65px;
            padding: 32px 36px;
            min-height: calc(100vh - 65px);
            background-color: #F5F9F0;
            transition: all 0.2s;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes softGlow {
            0% {
                box-shadow: 0 0 0 0 rgba(69, 158, 92, 0.3);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(69, 158, 92, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(69, 158, 92, 0);
            }
        }

        @keyframes floatIcon {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-4px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* TOP KPI ROW - earthy & modern */
        .kpi-row {
            display: flex;
            gap: 24px;
            margin-bottom: 36px;
            flex-wrap: wrap;
        }

        .kpi-card {
            background: #FFFFFF;
            flex: 1;
            min-width: 200px;
            padding: 22px 26px;
            border-radius: 28px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02), 0 2px 6px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(126, 164, 112, 0.25);
            transition: all 0.25s ease;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 28px -12px rgba(48, 86, 48, 0.12);
            border-color: #C8E0BD;
        }

        .kpi-card svg {
            animation: floatIcon 3.5s ease-in-out infinite;
            stroke: #3C8D5E;
        }

        .kpi-card h3 {
            margin: 0;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #67836E;
        }

        .kpi-card .value {
            font-size: 2rem;
            font-weight: 800;
            margin: 8px 0 6px;
            color: #1A3C2C;
            letter-spacing: -0.02em;
        }

        .kpi-card .growth {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #EAF5E6;
            color: #2C7840;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 40px;
        }

        /* MAIN LAYOUT - equal height columns using flexbox */
        .dashboard-layout {
            display: flex;
            gap: 28px;
            align-items: stretch;
            flex-wrap: wrap;
        }

        .ops-column {
            flex: 1;
            min-width: 280px;
            display: flex;
            flex-direction: column;
        }

        .schedule-column {
            flex: 1.2;
            min-width: 340px;
            display: flex;
            flex-direction: column;
        }

        /* Make both columns' content blocks stretch to full height */
        .ops-column .content-block,
        .schedule-column .content-block {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* content blocks */
        .content-block {
            background: #FFFFFF;
            border-radius: 28px;
            padding: 26px 28px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.02), 0 1px 2px rgba(0, 0, 0, 0.02);
            border: 1px solid #E2EFDA;
            margin-bottom: 0;
            transition: 0.2s;
        }

        /* ===== NEW ORDERS SECTION — UPDATED COLOR SCHEME & FONTS ===== */
        .orders-section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1A4A2F;
            letter-spacing: -0.3px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 5px solid #479D6E;
            padding-left: 16px;
            flex-shrink: 0;
        }

        .orders-section-title i {
            font-size: 1.4rem;
            color: #479D6E;
        }

        .orders-scroll-container {
            max-height: 100%;
            flex: 1;
            overflow-y: auto;
            padding-right: 6px;
        }

        .orders-scroll-container::-webkit-scrollbar {
            width: 5px;
        }

        .orders-scroll-container::-webkit-scrollbar-track {
            background: #EAF2E5;
            border-radius: 12px;
        }

        .orders-scroll-container::-webkit-scrollbar-thumb {
            background: #B9D2B0;
            border-radius: 12px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table thead tr {
            border-bottom: 2px solid #DBEBD3;
        }

        .orders-table th {
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #638A6F;
            padding-bottom: 12px;
            padding-top: 4px;
        }

        .orders-table td {
            padding: 14px 8px 14px 0;
            border-bottom: 1px solid #EDF4E8;
            font-size: 0.85rem;
            font-weight: 500;
            color: #2D4438;
        }

        .orders-table tr {
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 16px;
        }

        .orders-table tr:hover {
            background-color: #F8FCF4;
            transform: scale(1.01);
        }

        .order-id {
            font-weight: 600;
            color: #2A6B46;
            letter-spacing: -0.2px;
            font-family: monospace;
            font-size: 0.8rem;
        }

        .customer-name {
            font-weight: 600;
            color: #2E4A3C;
        }

        .pulse-badge {
            background: linear-gradient(115deg, #3C9E62, #2A7C48);
            color: white;
            padding: 5px 14px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.7rem;
            letter-spacing: 0.3px;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(60, 158, 98, 0.25);
            animation: softGlow 2.2s infinite;
        }

        .chart-frame {
            height: 260px;
            width: 100%;
            margin-top: 12px;
        }

        /* ===== CALENDAR STYLES — ORIGINAL SPACING PRESERVED ===== */
        .cal-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-shrink: 0;
        }

        .cal-wrapper {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            flex: 1;
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

        /* Event tags are hidden - temporarily removed */
        .agenda-tag {
            display: none;
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
            flex-shrink: 0;
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
            flex-shrink: 0;
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

        .dashboard-main-wrapper .content-block h3 {
            margin-top: 20px;
        }

        /* Make schedule column's content block display flex column to fill height */
        .schedule-column .content-block {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Calendar container takes remaining space */
        .calendar-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 1000px) {
            .dashboard-main-wrapper {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar and Topbar are included via sidebar.php -->
    <?php include('../sidebar.php'); ?>
    <!-- Main Dashboard Content -->
    <div class="dashboard-main-wrapper">
        <!-- KPI row -->
        <div class="kpi-row">
            <div class="kpi-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3>Compost Stock</h3>
                        <div class="value">1,240 kg</div>
                        <div class="growth"><span>↑</span> 5.2%</div>
                    </div>
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#3C8D5E" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z">
                        </path>
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
                        <div class="growth"><span>↑</span> 10.1%</div>
                    </div>
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#3C8D5E" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
            </div>

            <div class="kpi-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3>Total Sales</h3>
                        <div class="value">₱54,200</div>
                        <div class="growth"><span>↑</span> 8.4%</div>
                    </div>
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#3C8D5E" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="8" cy="21" r="1"></circle>
                        <circle cx="19" cy="21" r="1"></circle>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="dashboard-layout">
            <div class="ops-column">
                <!-- NEW ORDERS block with enhanced styling - now stretches to full height -->
                <div class="content-block">
                    <div class="orders-section-title">
                        <i class='bx bx-package'></i>
                        <span>New Orders Only</span>
                    </div>
                    <div class="orders-scroll-container">
                        <table class="orders-table" id="orders-list-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th style="text-align: right;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-day="10" onclick="window.location.href='orders.html?tab=new'">
                                    <td style="font-weight: 500;">Feb 10</td>
                                    <td class="order-id">#ORD-1001</td>
                                    <td class="customer-name">AgroPh</td>
                                    <td style="text-align: right;"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="17" onclick="window.location.href='orders.html?tab=new'">
                                    <td style="font-weight: 500;">Feb 17</td>
                                    <td class="order-id">#ORD-1002</td>
                                    <td class="customer-name">GreenCity</td>
                                    <td style="text-align: right;"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="24" onclick="window.location.href='orders.html?tab=new'">
                                    <td style="font-weight: 500;">Feb 24</td>
                                    <td class="order-id">#ORD-1004</td>
                                    <td class="customer-name">NovaRiches</td>
                                    <td style="text-align: right;"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="27" onclick="window.location.href='orders.html?tab=new'">
                                    <td style="font-weight: 500;">Feb 27</td>
                                    <td class="order-id">#ORD-1005</td>
                                    <td class="customer-name">Tabby Organics</td>
                                    <td style="text-align: right;"><span class="pulse-badge">NEW</span></td>
                                </tr>
                                <tr data-day="28" onclick="window.location.href='orders.html?tab=new'">
                                    <td style="font-weight: 500;">Feb 28</td>
                                    <td class="order-id">#ORD-1007</td>
                                    <td class="customer-name">Verdant Co.</td>
                                    <td style="text-align: right;"><span class="pulse-badge">NEW</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="schedule-column">
                <div class="content-block">
                    <div class="cal-top-bar">
                        <div class="nav-controls">
                            <button class="nav-arrow" onclick="changeMonth(-1)">❮</button>
                            <h2 id="month-label"
                                style="margin: 0; font-size: 20px; font-weight: 800; min-width: 150px;">
                                February 2026
                            </h2>
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
        let currentViewDate = new Date(2026, 1, 1); // February 2026

        function renderCalendar() {
            const grid = document.getElementById("cal-grid");
            const label = document.getElementById("month-label");
            if (!grid) return;
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

            // Only mark order days with highlight, but NO text events
            if (currentViewDate.getMonth() === 1 && currentViewDate.getFullYear() === 2026) {
                markOrderDays();
            }
        }

        function markOrderDays() {
            const orderRows = document.querySelectorAll("#orders-list-table tbody tr");
            orderRows.forEach((row) => {
                const day = row.getAttribute("data-day");
                if (!day) return;
                const targetCell = document.getElementById("day-cell-" + day);
                if (targetCell) {
                    targetCell.classList.add("order-day");
                    // No event text added - temporarily removed
                }
            });
        }

        function changeMonth(step) {
            currentViewDate.setMonth(currentViewDate.getMonth() + step);
            renderCalendar();
        }

        function toggleDrawer() {
            let drawer = document.getElementById("agenda-drawer");
            if (drawer) drawer.style.display = drawer.style.display === "block" ? "none" : "block";
        }

        function addNoteToDay() {
            // Event addition is disabled for now (temporarily removed)
            alert("Event display is temporarily disabled. Calendar events are hidden for now.");
            // Clear inputs
            document.getElementById("txt-val").value = "";
            document.getElementById("day-val").value = "";
            toggleDrawer();
        }

        // initial render
        renderCalendar();

        // Optional chart code
        const chartCanvas = document.getElementById("mainSalesChart");
        if (chartCanvas) {
            const ctxChart = chartCanvas.getContext("2d");
            const grad = ctxChart.createLinearGradient(0, 0, 0, 240);
            grad.addColorStop(0, "rgba(71, 157, 110, 0.2)");
            grad.addColorStop(1, "rgba(71, 157, 110, 0)");
            new Chart(ctxChart, {
                type: "line",
                data: {
                    labels: ["Sept", "Oct", "Nov", "Dec", "Jan", "Feb"],
                    datasets: [{
                        data: [32400, 38700, 36200, 49100, 52200, 54200],
                        borderColor: "#479D6E",
                        borderWidth: 3,
                        backgroundColor: grad,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3,
                        pointBackgroundColor: "#2C7840"
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { ticks: { callback: (v) => "₱" + v.toLocaleString() } }
                    }
                }
            });
        }
    </script>
</body>

</html>