<?php
require_once 'connection.php';
require_once 'auth-sessiom.php';

requireAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Farm Management</title>
    <style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-color: #27ae60;
    --primary-dark: #1e8449;
    --primary-light: #2ecc71;
    --secondary-color: #16a085;
    --accent-color: #f39c12;
    --danger-color: #e74c3c;
    --warning-color: #f39c12;
    --success-color: #27ae60;
    --info-color: #3498db;
    --bg-dark: #1a1a1a;
    --bg-light: #f5f7fa;
    --text-dark: #2c3e50;
    --text-light: #ecf0f1;
    --border-color: #bdc3c7;
    --card-bg: #ffffff;
    --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 4px 16px rgba(0, 0, 0, 0.15);
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg-light);
    color: var(--text-dark);
    line-height: 1.6;
}

/* Login Page Styles */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
}

.login-box {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    width: 100%;
    max-width: 700px;
    animation: slideUp 0.5s ease;
}

.login-logo img {
  width: 200px;   /* adjust size */
  height: auto;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-logo {
    font-size: 48px;
    text-align: center;
    margin-bottom: 20px;
}

.login-box h1 {
    text-align: center;
    color: var(--text-dark);
    font-size: 24px;
    margin-bottom: 10px;
}

.login-subtitle {
    text-align: center;
    color: #7f8c8d;
    margin-bottom: 30px;
    font-size: 14px;
}

.login-form {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 14px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
}

.btn-login {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.login-demo {
    background: #ecf0f1;
    padding: 15px;
    border-radius: 6px;
    font-size: 12px;
    color: var(--text-dark);
    margin-top: 20px;
}

.login-demo p {
    margin: 5px 0;
}

.login-demo strong {
    color: var(--primary-color);
}

/* Dashboard Layout */
.dashboard-wrapper {
    display: flex;
    height: 100vh;
    overflow: hidden;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background: var(--bg-dark);
    color: var(--text-light);
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    box-shadow: var(--shadow);
}

.sidebar-header {
    padding: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 28px;
    font-weight: bold;
    text-align: center;
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: var(--text-light);
    font-size: 24px;
    cursor: pointer;
}

.sidebar-nav {
    flex: 1;
    padding: 20px 0;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: var(--text-light);
    text-decoration: none;
    transition: all 0.3s;
    cursor: pointer;
    border-left: 3px solid transparent;
    font-size: 14px;
}

.nav-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-left-color: var(--primary-color);
}

.nav-item.active {
    background: rgba(39, 174, 96, 0.2);
    border-left-color: var(--primary-color);
    color: var(--primary-light);
}

.nav-item .icon {
    margin-right: 12px;
    font-size: 18px;
}

.sidebar-footer {
    padding: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.user-profile {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.avatar {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 12px;
    font-size: 14px;
}

.user-info p {
    margin: 0;
    font-size: 13px;
}

.user-info .username {
    font-weight: 600;
    color: var(--text-light);
}

.user-info .role {
    color: #95a5a6;
}

.btn-logout {
    width: 100%;
    padding: 10px;
    background: var(--danger-color);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
}

.btn-logout:hover {
    background: #c0392b;
}

/* Main Content */
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.top-header {
    background: white;
    padding: 20px 30px;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: var(--shadow);
}

.header-left h1 {
    font-size: 28px;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.header-left p {
    color: #7f8c8d;
    font-size: 14px;
}

.header-right {
    display: flex;
    gap: 10px;
}

.content {
    flex: 1;
    overflow-y: auto;
    padding: 30px;
}

.section {
    display: none;
    animation: fadeIn 0.3s ease;
}

.section.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Buttons */
.btn-primary,
.btn-secondary,
.btn-text {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.btn-secondary {
    background: #ecf0f1;
    color: var(--text-dark);
    border: 1px solid #bdc3c7;
}

.btn-secondary:hover {
    background: #d5dbdf;
}

.btn-text {
    background: none;
    color: var(--primary-color);
    padding: 5px 10px;
}

.btn-text:hover {
    text-decoration: underline;
}

/* Cards */
.card {
    background: var(--card-bg);
    padding: 25px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    margin-bottom: 20px;
}

.card h2 {
    font-size: 20px;
    margin-bottom: 20px;
    color: var(--text-dark);
}

.card h3 {
    font-size: 16px;
    margin-bottom: 15px;
    color: var(--text-dark);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card-bg);
    padding: 20px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-icon {
    font-size: 32px;
}

.stat-content h3 {
    font-size: 13px;
    color: #7f8c8d;
    margin-bottom: 8px;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    color: var(--primary-color);
    margin-bottom: 5px;
}

.stat-change {
    font-size: 12px;
    color: #27ae60;
}

/* Dashboard Grid */
.dashboard-grid,
.grid-2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
}

/* Data Table */
.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.data-table thead {
    background: #f8f9fa;
    border-bottom: 2px solid #e0e0e0;
}

.data-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: var(--text-dark);
}

.data-table td {
    padding: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.data-table tr:hover {
    background: #f8f9fa;
}

.badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge.healthy {
    background: #d4edda;
    color: #155724;
}

.badge.warning {
    background: #fff3cd;
    color: #856404;
}

.badge.danger {
    background: #f8d7da;
    color: #721c24;
}

/* Activity List */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid var(--primary-color);
}

.activity-icon {
    font-size: 24px;
    flex-shrink: 0;
}

.activity-content p {
    margin: 5px 0;
    font-size: 14px;
}

.activity-content strong {
    color: var(--text-dark);
}

.text-muted {
    color: #7f8c8d;
    font-size: 13px;
}

.time {
    font-size: 12px;
}

/* Feed List */
.feed-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.feed-item {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.feed-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.feed-header h4 {
    font-size: 14px;
    color: var(--text-dark);
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: #ecf0f1;
    border-radius: 4px;
    overflow: hidden;
}

.progress {
    height: 100%;
    background: var(--primary-color);
    border-radius: 4px;
}

/* Allocation Chart */
.allocation-chart {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.allocation-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.allocation-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
}

.allocation-label p {
    margin: 0;
}

.allocation-bar {
    height: 30px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 12px;
}

/* Production Stats */
.production-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.prod-stat {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    border-top: 3px solid var(--primary-color);
}

.prod-stat h4 {
    font-size: 14px;
    color: #7f8c8d;
    margin-bottom: 10px;
}

.stat-large {
    font-size: 28px;
    font-weight: bold;
    color: var(--primary-color);
    margin-bottom: 5px;
}

.text-success {
    color: var(--success-color);
    font-size: 13px;
}

.text-neutral {
    color: #7f8c8d;
    font-size: 13px;
}

/* Schedule and Alerts */
.schedule-list,
.alert-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.schedule-item,
.alert-item {
    display: flex;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid var(--primary-color);
}

.alert-item.warning {
    border-left-color: var(--warning-color);
}

.alert-item.info {
    border-left-color: var(--info-color);
}

.schedule-dot,
.alert-icon {
    font-size: 16px;
    flex-shrink: 0;
}

.schedule-content,
.alert-item > div {
    flex: 1;
}

.schedule-content p,
.alert-item p {
    margin: 4px 0;
    font-size: 14px;
}

/* Finance */
.finance-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.finance-card {
    padding: 20px;
    border-radius: 10px;
    color: white;
    text-align: center;
}

.finance-card.income {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
}

.finance-card.expense {
    background: linear-gradient(135deg, var(--danger-color), #ec7063);
}

.finance-card.profit {
    background: linear-gradient(135deg, var(--secondary-color), #1bbc9b);
}

.finance-card h4 {
    font-size: 13px;
    opacity: 0.9;
    margin-bottom: 8px;
}

.amount {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.period {
    font-size: 12px;
    opacity: 0.8;
}

.revenue-items {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.revenue-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.revenue-item span {
    font-size: 14px;
    color: #7f8c8d;
}

.revenue-item strong {
    font-size: 18px;
    color: var(--primary-color);
}

.revenue-item .bar {
    height: 20px;
    background: var(--primary-color);
    border-radius: 4px;
}

/* Reports */
.reports-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.report-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s;
}

.report-item:hover {
    background: #ecf0f1;
}

.report-icon {
    font-size: 28px;
}

.report-content {
    flex: 1;
}

.report-content h4 {
    font-size: 15px;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.report-content p {
    font-size: 13px;
    color: #7f8c8d;
    margin: 0;
}

/* Section Header */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.section-header > div h2 {
    font-size: 24px;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.section-header > div p {
    color: #7f8c8d;
    font-size: 14px;
}

/* Profile Form */
.profile-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.profile-form .form-group {
    display: flex;
    flex-direction: column;
}

.profile-form label {
    margin-bottom: 8px;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 14px;
}

.profile-form input {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.profile-form input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
}

/* Modal dialog styles */
.modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s ease;
}

.modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 0;
    border-radius: 10px;
    box-shadow: var(--shadow-lg);
    width: 90%;
    max-width: 500px;
    animation: slideUp 0.3s ease;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.modal-header h3 {
    font-size: 20px;
    color: var(--text-dark);
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: #7f8c8d;
    transition: all 0.3s;
}

.modal-close:hover {
    color: var(--text-dark);
}

.modal-form {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.modal-form .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.modal-form label {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 14px;
}

.modal-form input,
.modal-form select,
.modal-form textarea {
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    transition: all 0.3s;
}

.modal-form input:focus,
.modal-form select:focus,
.modal-form textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
}

.modal-footer {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    padding: 20px;
    border-top: 1px solid #e0e0e0;
}

.modal-footer button {
    min-width: 100px;
}

/* Add button-group styling for responsive button layout */
.button-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.button-group button {
    white-space: nowrap;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        left: -260px;
        height: 100vh;
        z-index: 1000;
        transition: left 0.3s;
    }

    .sidebar.active {
        left: 0;
    }

    .menu-toggle {
        display: block;
    }

    .dashboard-wrapper.sidebar-open .sidebar {
        left: 0;
    }

    .top-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }

    .header-right {
        width: 100%;
        justify-content: flex-start;
    }

    .main-content {
        margin-left: 0;
    }

    .content {
        padding: 20px;
    }

    .stats-grid,
    .dashboard-grid,
    .grid-2,
    .production-stats {
        grid-template-columns: 1fr;
    }

    .login-box {
        margin: 20px;
    }

    /* Make section header responsive with stacked buttons on mobile */
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .section-header > div {
        width: 100%;
    }

    .button-group {
        width: 100%;
    }

    .button-group button {
        flex: 1;
        min-width: 120px;
    }
}

@media (max-width: 600px) {
    .modal-content {
        width: 95%;
        max-width: 100%;
    }

    /* Make buttons stack vertically on very small screens */
    .button-group {
        flex-direction: column;
    }

    .button-group button {
        width: 100%;
    }
}
</style>
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">🚜 Farm</div>
                <button class="menu-toggle" id="menuToggle">☰</button>
            </div>
            
            <nav class="sidebar-nav" id="sidebarNav">
                <a href="#" class="nav-item active" onclick="showSection('dashboard')">
                    <span class="icon">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item" onclick="showSection('users')">
                    <span class="icon">👥</span>
                    <span>Users Management</span>
                </a>
                <a href="#" class="nav-item" onclick="showSection('livestock')">
                    <span class="icon">🐄</span>
                    <span>All Livestock</span>
                </a>
                <a href="#" class="nav-item" onclick="showSection('production')">
                    <span class="icon">📦</span>
                    <span>Production</span>
                </a>
                <a href="#" class="nav-item" onclick="showSection('reports')">
                    <span class="icon">📈</span>
                    <span>Reports</span>
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="avatar" id="userAvatar">A</div>
                    <div class="user-info">
                        <p class="username" id="userName"><?php echo $_SESSION['full_name']; ?></p>
                        <p class="role">Administrator</p>
                    </div>
                </div>
                <button class="btn-logout" onclick="logout()">Logout</button>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="header-left">
                    <h1 id="pageTitle">Dashboard</h1>
                    <p id="pageSubtitle">System Overview & Statistics</p>
                </div>
                <div class="header-right">
                    <button class="btn-secondary" onclick="showSection('settings')">Settings</button>
                </div>
            </header>

            <section class="content">
                <div id="dashboard" class="section active">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">👥</div>
                            <div class="stat-content">
                                <h3>Total Users</h3>
                                <p class="stat-number" id="totalUsers">0</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">🐄</div>
                            <div class="stat-content">
                                <h3>Total Livestock</h3>
                                <p class="stat-number" id="totalLivestock">0</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">📊</div>
                            <div class="stat-content">
                                <h3>Total Production</h3>
                                <p class="stat-number" id="totalProduction">0</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">💰</div>
                            <div class="stat-content">
                                <h3>Total Revenue</h3>
                                <p class="stat-number" id="totalRevenue">$0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="users" class="section">
                    <div class="section-header">
                        <div>
                            <h2>Users Management</h2>
                            <p>Manage all farm users</p>
                        </div>
                    </div>
                    
                    <div class="card">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTable">
                                <tr><td colspan="6" style="text-align: center;">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="livestock" class="section">
                    <div class="section-header">
                        <div>
                            <h2>All Livestock</h2>
                            <p>System-wide livestock overview</p>
                        </div>
                    </div>
                    
                    <div class="card">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Tag Number</th>
                                    <th>Type</th>
                                    <th>Owner</th>
                                    <th>Status</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody id="livestockTable">
                                <tr><td colspan="5" style="text-align: center;">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="production" class="section">
                    <div class="section-header">
                        <div>
                            <h2>Production Records</h2>
                            <p>System-wide production overview</p>
                        </div>
                    </div>
                    
                    <div class="card">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Value</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody id="productionTable">
                                <tr><td colspan="5" style="text-align: center;">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="reports" class="section">
                    <div class="section-header">
                        <div>
                            <h2>System Reports</h2>
                            <p>Analytics and statistics</p>
                        </div>
                    </div>
                    
                    <div class="card">
                        <h3>Monthly Summary</h3>
                        <div style="padding: 20px; text-align: center;">
                            <p id="reportSummary">Loading report data...</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script >// =================================================================
// 1. ENVIRONMENT SETUP & CONSTANTS
// =================================================================

// Simulated user data pulled from PHP session variables in a real scenario
const USER_FULL_NAME = document.getElementById('userName').textContent;
const USER_AVATAR_INITIAL = USER_FULL_NAME.charAt(0).toUpperCase();

// Placeholder API Endpoints (These files would need to be created on the backend)
const API_ENDPOINTS = {
    STATS: 'api/fetch_admin_stats.php',
    USERS: 'api/fetch_users.php',
    LIVESTOCK: 'api/fetch_livestock.php',
    PRODUCTION: 'api/fetch_production.php',
    LOGOUT: 'logout.php'
};

// =================================================================
// 2. NAVIGATION AND UI CONTROLS
// =================================================================

/**
 * Changes the active section in the main content area.
 * @param {string} sectionId - The ID of the section to show (e.g., 'dashboard', 'users').
 */
function showSection(sectionId) {
    // 1. Update Navigation State
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    const activeNavItem = document.querySelector(`.nav-item[onclick*='${sectionId}']`);
    if (activeNavItem) {
        activeNavItem.classList.add('active');
    }

    // 2. Update Content Visibility
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.add('active');
        
        // 3. Update Header Info
        const sectionInfo = getSectionInfo(sectionId);
        document.getElementById('pageTitle').textContent = sectionInfo.title;
        document.getElementById('pageSubtitle').textContent = sectionInfo.subtitle;

        // 4. Trigger Data Fetch for the activated section
        if (sectionId === 'dashboard') fetchDashboardStats();
        if (sectionId === 'users') fetchUsers();
        if (sectionId === 'livestock') fetchLivestock();
        if (sectionId === 'production') fetchProduction();
        if (sectionId === 'reports') fetchReports();
    }

    // Close sidebar on mobile after navigation
    document.body.classList.remove('sidebar-open');
    document.querySelector('.sidebar').classList.remove('active');
}

/**
 * Provides titles and subtitles for the main header.
 * @param {string} sectionId 
 * @returns {object} {title, subtitle}
 */
function getSectionInfo(sectionId) {
    switch (sectionId) {
        case 'dashboard':
            return { title: 'Admin Dashboard', subtitle: 'System Overview & Key Metrics' };
        case 'users':
            return { title: 'Users Management', subtitle: 'Manage farm staff, roles, and access.' };
        case 'livestock':
            return { title: 'All Livestock Records', subtitle: 'View system-wide animal health and location data.' };
        case 'production':
            return { title: 'Production Overview', subtitle: 'Review aggregated farm output and performance.' };
        case 'reports':
            return { title: 'System Reports', subtitle: 'In-depth analytics and statistics.' };
        case 'settings':
            return { title: 'System Settings', subtitle: 'Configure application parameters.' };
        default:
            return { title: 'Welcome', subtitle: 'Farm Management System' };
    }
}

/**
 * Toggles the sidebar visibility for mobile devices.
 */
document.getElementById('menuToggle').addEventListener('click', () => {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
    document.querySelector('.dashboard-wrapper').classList.toggle('sidebar-open');
});

// =================================================================
// 3. LOGOUT
// =================================================================

/**
 * Redirects the user to the logout endpoint.
 */
function logout() {
    if (confirm('Are you sure you want to log out?')) {
        window.location.href = API_ENDPOINTS.LOGOUT;
    }
}

// =================================================================
// 4. DATA FETCHING AND RENDERING
// =================================================================

/**
 * Fetches and displays key statistics on the dashboard.
 */
async function fetchDashboardStats() {
    try {
        const response = await fetch(API_ENDPOINTS.STATS);
        if (!response.ok) throw new Error('Failed to fetch stats');
        const stats = await response.json();

        // Assuming stats structure: {totalUsers: 50, totalLivestock: 350, totalProduction: 1200, totalRevenue: 85000}
        document.getElementById('totalUsers').textContent = stats.totalUsers.toLocaleString();
        document.getElementById('totalLivestock').textContent = stats.totalLivestock.toLocaleString();
        document.getElementById('totalProduction').textContent = stats.totalProduction.toLocaleString() + ' Kg';
        document.getElementById('totalRevenue').textContent = '$' + stats.totalRevenue.toLocaleString();

    } catch (error) {
        console.error('Error fetching dashboard stats:', error);
        // Fallback for UI elements
        document.getElementById('totalUsers').textContent = 'N/A';
    }
}

/**
 * Fetches and renders the Users Management table.
 */
async function fetchUsers() {
    const usersTableBody = document.getElementById('usersTable');
    usersTableBody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Fetching user data...</td></tr>';
    
    try {
        const response = await fetch(API_ENDPOINTS.USERS);
        if (!response.ok) throw new Error('Failed to fetch users');
        const users = await response.json();

        if (users.length === 0) {
            usersTableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: #7f8c8d;">No users found in the system.</td></tr>';
            return;
        }

        usersTableBody.innerHTML = users.map(user => {
            const statusClass = user.status === 'Active' ? 'healthy' : (user.status === 'Inactive' ? 'danger' : 'warning');
            const actions = `
                <div class="button-group">
                    <button class="btn-text" onclick="editUser(${user.id})">Edit</button>
                    <button class="btn-text" style="color: var(--danger-color);" onclick="deleteUser(${user.id})">Delete</button>
                </div>
            `;
            
            return `
                <tr>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.full_name}</td>
                    <td><strong>${user.role}</strong></td>
                    <td><span class="badge ${statusClass}">${user.status}</span></td>
                    <td>${actions}</td>
                </tr>
            `;
        }).join('');

    } catch (error) {
        console.error('Error fetching users:', error);
        usersTableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; color: var(--danger-color);">Error loading users. Please check the backend API.</td></tr>';
    }
}

/**
 * Fetches and renders the Livestock table.
 */
async function fetchLivestock() {
    const livestockTableBody = document.getElementById('livestockTable');
    livestockTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center;">Fetching livestock data...</td></tr>';
    
    try {
        const response = await fetch(API_ENDPOINTS.LIVESTOCK);
        if (!response.ok) throw new Error('Failed to fetch livestock');
        const livestock = await response.json();

        if (livestock.length === 0) {
            livestockTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #7f8c8d;">No livestock records found.</td></tr>';
            return;
        }

        livestockTableBody.innerHTML = livestock.map(animal => {
            const statusClass = animal.health_status === 'Healthy' ? 'healthy' : (animal.health_status === 'Sick' ? 'danger' : 'warning');
            
            return `
                <tr>
                    <td>#${animal.tag_number}</td>
                    <td>${animal.type}</td>
                    <td>${animal.owner_name}</td>
                    <td><span class="badge ${statusClass}">${animal.health_status}</span></td>
                    <td>${animal.age_months} months</td>
                </tr>
            `;
        }).join('');

    } catch (error) {
        console.error('Error fetching livestock:', error);
        livestockTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: var(--danger-color);">Error loading livestock data.</td></tr>';
    }
}

/**
 * Fetches and renders the Production table.
 */
async function fetchProduction() {
    const productionTableBody = document.getElementById('productionTable');
    productionTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center;">Fetching production data...</td></tr>';
    
    try {
        const response = await fetch(API_ENDPOINTS.PRODUCTION);
        if (!response.ok) throw new Error('Failed to fetch production');
        const production = await response.json();

        if (production.length === 0) {
            productionTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: #7f8c8d;">No production records found.</td></tr>';
            return;
        }

        productionTableBody.innerHTML = production.map(record => {
            const valueDisplay = `$${record.value.toFixed(2)}`;
            const quantityDisplay = `${record.quantity} ${record.unit}`;
            
            return `
                <tr>
                    <td>${new Date(record.date).toLocaleDateString()}</td>
                    <td>${record.product_type}</td>
                    <td>${quantityDisplay}</td>
                    <td>${valueDisplay}</td>
                    <td>${record.user_name}</td>
                </tr>
            `;
        }).join('');

    } catch (error) {
        console.error('Error fetching production:', error);
        productionTableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: var(--danger-color);">Error loading production data.</td></tr>';
    }
}

/**
 * Fetches and generates a simple system report summary.
 */
async function fetchReports() {
    const reportSummaryElement = document.getElementById('reportSummary');
    reportSummaryElement.textContent = 'Generating monthly summary...';

    // Simulate report generation data
    try {
        // In a real app, this would fetch complex analytics data.
        await new Promise(resolve => setTimeout(resolve, 800)); // Simulate network delay
        
        const summary = {
            month: 'November 2025',
            revenue: 85000,
            expense: 32000,
            profit: 53000,
            best_product: 'Milk',
            user_count: 5,
        };

        reportSummaryElement.innerHTML = `
            <p style="font-size: 16px; margin-bottom: 10px;">
                The monthly financial summary for <strong>${summary.month}</strong> shows strong performance.
            </p>
            <p style="font-size: 28px; font-weight: bold; color: var(--primary-color); margin-bottom: 15px;">
                Net Profit: $${summary.profit.toLocaleString()}
            </p>
            <p style="font-size: 14px; color: var(--text-dark);">
                Total Revenue: <span style="color: var(--success-color); font-weight: 600;">$${summary.revenue.toLocaleString()}</span> | 
                Total Expenses: <span style="color: var(--danger-color); font-weight: 600;">$${summary.expense.toLocaleString()}</span>
            </p>
            <p class="text-muted" style="margin-top: 10px;">
                Top selling product this month was <strong>${summary.best_product}</strong>.
            </p>
        `;
        
    } catch (error) {
        reportSummaryElement.textContent = 'Failed to load report data.';
    }
}

// =================================================================
// 5. CRUD PLACEHOLDERS (For future modal interaction)
// =================================================================

function editUser(userId) {
    // In a real application, this would open a modal pre-filled with user data.
    console.log(`Action: Editing user ID ${userId}`);
    // Example: openModal('editUserModal', userId);
}

function deleteUser(userId) {
    if (confirm(`Are you sure you want to permanently delete user ID ${userId}?`)) {
        // In a real application, this would send a DELETE request to the server.
        console.log(`Action: Deleting user ID ${userId}`);
        // Example: sendDeleteRequest(API_ENDPOINTS.USERS, userId).then(fetchUsers);
    }
}

// =================================================================
// 6. INITIALIZATION
// =================================================================

/**
 * Initializes the dashboard on page load.
 */
function initDashboard() {
    // Set user avatar initial
    const avatar = document.getElementById('userAvatar');
    if (avatar) {
        avatar.textContent = USER_AVATAR_INITIAL;
    }

    // Load initial data for the default 'dashboard' view
    showSection('dashboard');
}

// Run the initialization function when the page loads
window.onload = initDashboard;</script>
</body>
</html>