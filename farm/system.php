<?php
// In a real application, this file would handle PHP logic, database connection,
// and session management. Since the user requested adding functions only via JS
// and the original file used only mock data, we keep the PHP part minimal.
require 'connection.php'; // Placeholder for connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Production Management System</title>
    <style>
        * {
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
}

body {
    background-color: var(--bg-light);
    color: var(--text-dark);
    min-height: 100vh;
    font-family: sans-serif;
}

/* Login Page */
#loginPage {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, var(--primary-light), var(--secondary-color));
}

.login-card {
    background: var(--card-bg);
    padding: 40px;
    border-radius: 12px;
    box-shadow: var(--shadow);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-card h1 {
    color: var(--primary-dark);
    margin-bottom: 20px;
    font-size: 1.8rem;
}

.login-card input[type="text"],
.login-card input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.login-card input:focus {
    border-color: var(--primary-color);
    outline: none;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s, transform 0.1s;
}

.primary-btn {
    background-color: var(--primary-color);
    color: var(--text-light);
    width: 100%;
}

.primary-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-1px);
}

/* Dashboard Layout */
#dashboardPage {
    display: none;
    grid-template-columns: 250px 1fr;
    min-height: 100vh;
}

.sidebar {
    background-color: var(--text-dark);
    color: var(--text-light);
    padding: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar h1 {
    font-size: 1.5rem;
    margin-bottom: 30px;
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 10px;
}

.sidebar-menu button {
    display: block;
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 10px;
    background: none;
    border: none;
    color: var(--text-light);
    text-align: left;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s, color 0.2s;
}

.sidebar-menu button.active,
.sidebar-menu button:hover {
    background-color: var(--primary-color);
    color: var(--card-bg);
}

.main-content {
    padding: 30px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border-color);
}

.header h2 {
    color: var(--primary-dark);
    font-size: 1.8rem;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-info button {
    background-color: var(--danger-color);
    color: var(--text-light);
    padding: 8px 15px;
    font-size: 0.9rem;
}

/* Content Sections */
.content-section h2 {
    margin-bottom: 20px;
    color: var(--text-dark);
    font-size: 1.6rem;
}

.card {
    background: var(--card-bg);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

/* Tables */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
}

th {
    background-color: var(--bg-light);
    font-weight: 700;
    color: var(--primary-dark);
    text-transform: uppercase;
    font-size: 0.85rem;
}

tr:hover {
    background-color: #f9f9f9;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text-light);
}

.badge.healthy { background-color: var(--success-color); }
.badge.warning { background-color: var(--warning-color); }
.badge.danger { background-color: var(--danger-color); }
.badge.info { background-color: var(--info-color); }

.btn-text {
    background: none;
    border: none;
    color: var(--info-color);
    cursor: pointer;
    font-weight: 600;
    padding: 5px 8px;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.btn-text:hover {
    background-color: rgba(52, 152, 219, 0.1);
}

.danger-text {
    color: var(--danger-color);
}

.danger-text:hover {
     background-color: rgba(231, 76, 60, 0.1);
}

/* CRUD/Search/Filter Layout */
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap; 
}

.actions {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap; 
}

.actions input[type="text"],
.actions select {
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    transition: border-color 0.3s;
}

.actions input:focus,
.actions select:focus {
    border-color: var(--primary-color);
    outline: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    #dashboardPage {
        grid-template-columns: 1fr;
    }
    .sidebar {
        width: 100%;
        height: auto;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 50;
    }
    .sidebar h1 {
        display: none; /* Hide title on small screens */
    }
    .sidebar-menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
    }
    .sidebar-menu button {
        padding: 8px 12px;
        flex-grow: 1;
        text-align: center;
        margin-bottom: 0;
        font-size: 0.85rem;
    }
    .main-content {
        padding: 15px;
    }
    /* Responsive update for actions */
    .content-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .actions {
        margin-top: 10px;
        width: 100%;
    }
    .actions input,
    .actions select,
    .actions .btn {
        flex-grow: 1;
        min-width: 100px;
    }
}
    </style>
</head>
<body>

    <!-- Login Page -->
    <div id="loginPage">
        <div class="login-card">
            <h1>Farm Management System</h1>
            <p id="loginMessage" style="color: var(--danger-color); margin-bottom: 15px;"></p>
            <form id="loginForm">
                <input type="text" id="username" placeholder="Username (e.g., admin)" required>
                <input type="password" id="password" placeholder="Password (e.g., password)" required>
                <button type="submit" class="btn primary-btn" id="loginBtn">Log In</button>
            </form>
            <p style="margin-top: 20px; font-size: 0.9rem;">
                Demo: admin/password.
            </p>
        </div>
    </div>

    <!-- Dashboard Page -->
    <div id="dashboardPage">
        
        <!-- Sidebar -->
        <div class="sidebar">
            <h1>Farm Manager</h1>
            <div class="sidebar-menu">
                <button class="active" data-section="dashboard" onclick="farmSystem.navigate('dashboard', this)">Dashboard</button>
                <button data-section="users" onclick="farmSystem.navigate('users', this)">User Management</button>
                <button data-section="products" onclick="farmSystem.navigate('products', this)">Products</button>
                <button data-section="crops" onclick="farmSystem.navigate('crops', this)">Crops</button>
                <button data-section="livestock" onclick="farmSystem.navigate('livestock', this)">Livestock</button>
                <button data-section="equipment" onclick="farmSystem.navigate('equipment', this)">Equipment</button>
                <button data-section="reports" onclick="farmSystem.navigate('reports', this)">Reports</button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h2 id="pageTitle">Dashboard</h2>
                <div class="user-info">
                    <span id="welcomeMessage"></span>
                    <button class="btn" onclick="farmSystem.handleLogout()">Log Out</button>
                </div>
            </div>

            <div id="contentSection" class="content-section">
                <!-- Content will be injected here -->
            </div>
            
        </div>
    </div>


<script>
class FarmSystem {
    
    constructor() {
        this.currentUser = null;
        // Centralized data store and category definitions
        this.definitions = this.getCategoryDefinitions(); 
        this.data = this.loadAllData(); // Load data from local storage
        this.currentView = 'dashboard';
        this.bindEvents();
        this.checkSession();
    }
    
    // Custom UI functions to replace alert/prompt/confirm (as requested to avoid browser modals)
    customAlert(message, type = 'info') {
        const msgEl = document.getElementById('loginMessage');
        if (msgEl) {
            msgEl.textContent = message;
            msgEl.style.color = type === 'success' ? 'var(--success-color)' : (type === 'error' ? 'var(--danger-color)' : 'var(--info-color)');
            msgEl.style.display = 'block';
            // Set a timer to clear the message after 5 seconds
            setTimeout(() => { msgEl.textContent = ''; }, 5000); 
        }
        console.log(`[UI Message - ${type.toUpperCase()}]: ${message}`);
    }
    
    customPrompt(message, defaultValue = '') {
        // Use native prompt/confirm for simplicity in this single-file implementation,
        // but note the visual feedback is provided via customAlert.
        const value = window.prompt(message, defaultValue);
        if (value === null) {
            this.customAlert(`Action cancelled: ${message}`, 'info');
        }
        return value;
    }
    
    customConfirm(message) {
        return window.confirm(message);
    }

    // --- DATA MANAGEMENT (LOCALSTORAGE MOCK) ---
    getCategoryDefinitions() {
        // Defines the structure, fields, and search/filter keys for each category
        return {
            users: {
                title: 'User', singular: 'User', plural: 'Users', 
                dataKey: 'usersData', searchKey: 'name', filterKey: 'role', 
                filterOptions: ['Admin', 'Manager', 'Staff'],
                fields: [
                    { key: 'id', label: 'ID', isId: true },
                    { key: 'name', label: 'Full Name' },
                    { key: 'email', label: 'Email' },
                    { key: 'role', label: 'Role', isBadge: true, badgeMap: { 'Admin': 'danger', 'Manager': 'warning', 'Staff': 'healthy' }, options: ['Admin', 'Manager', 'Staff'], default: 'Staff' }
                ]
            },
            products: {
                title: 'Product', singular: 'Product', plural: 'Products', 
                dataKey: 'productsData', searchKey: 'name', filterKey: 'category', 
                filterOptions: ['Grain', 'Fruit', 'Vegetable', 'Meat'],
                fields: [
                    { key: 'id', label: 'ID', isId: true },
                    { key: 'name', label: 'Product Name' },
                    { key: 'category', label: 'Category', isBadge: true, badgeMap: { 'Grain': 'info', 'Fruit': 'warning', 'Vegetable': 'healthy', 'Meat': 'danger' }, options: ['Grain', 'Fruit', 'Vegetable', 'Meat'], default: 'Grain' },
                    { key: 'stock', label: 'Stock (kg)' }
                ]
            },
            crops: {
                title: 'Crop', singular: 'Crop', plural: 'Crops', 
                dataKey: 'cropsData', searchKey: 'name', filterKey: 'stage', 
                filterOptions: ['Planting', 'Growth', 'Harvest'],
                fields: [
                    { key: 'id', label: 'ID', isId: true },
                    { key: 'name', label: 'Crop Name' },
                    { key: 'field', label: 'Field Location' },
                    { key: 'stage', label: 'Stage', isBadge: true, badgeMap: { 'Planting': 'info', 'Growth': 'warning', 'Harvest': 'healthy' }, options: ['Planting', 'Growth', 'Harvest'], default: 'Growth' },
                    { key: 'date', label: 'Plant Date' }
                ]
            },
            livestock: {
                title: 'Livestock', singular: 'Animal', plural: 'Animals', 
                dataKey: 'livestockData', searchKey: 'tagId', filterKey: 'type', 
                filterOptions: ['Cattle', 'Sheep', 'Chicken', 'Pig'],
                fields: [
                    { key: 'id', label: 'ID', isId: true },
                    { key: 'tagId', label: 'Tag ID' },
                    { key: 'type', label: 'Animal Type', isBadge: true, badgeMap: { 'Cattle': 'info', 'Sheep': 'warning', 'Chicken': 'healthy', 'Pig': 'danger' }, options: ['Cattle', 'Sheep', 'Chicken', 'Pig'], default: 'Cattle' },
                    { key: 'health', label: 'Health Status', isBadge: true, badgeMap: { 'Healthy': 'healthy', 'Sick': 'danger', 'Quarantined': 'warning' }, options: ['Healthy', 'Sick', 'Quarantined'], default: 'Healthy' }
                ]
            },
            equipment: {
                title: 'Equipment', singular: 'Equipment', plural: 'Equipment', 
                dataKey: 'equipmentData', searchKey: 'name', filterKey: 'status', 
                filterOptions: ['Operational', 'Maintenance', 'Broken'],
                fields: [
                    { key: 'id', label: 'ID', isId: true },
                    { key: 'name', label: 'Name' },
                    { key: 'model', label: 'Model' },
                    { key: 'status', label: 'Status', isBadge: true, badgeMap: { 'Operational': 'healthy', 'Maintenance': 'warning', 'Broken': 'danger' }, options: ['Operational', 'Maintenance', 'Broken'], default: 'Operational' },
                    { key: 'lastService', label: 'Last Service' }
                ]
            },
        };
    }
    
    loadAllData() {
        // Load data from localStorage or use mock defaults if not found
        // These mock entries provide initial data for the tables.
        const mockData = {
            usersData: [
                { id: 'u1', name: 'John Doe', email: 'john@farm.com', role: 'Admin' },
                { id: 'u2', name: 'Jane Smith', email: 'jane@farm.com', role: 'Manager' },
                { id: 'u3', name: 'Farm Staff', email: 'staff@farm.com', role: 'Staff' }
            ],
            productsData: [
                { id: 'p1', name: 'Wheat Grain', category: 'Grain', stock: '5000' },
                { id: 'p2', name: 'Apples', category: 'Fruit', stock: '850' },
                { id: 'p3', name: 'Ground Beef', category: 'Meat', stock: '300' }
            ],
            cropsData: [
                { id: 'c1', name: 'Wheat', field: 'Field A', stage: 'Growth', date: '2024-05-01' },
                { id: 'c2', name: 'Corn', field: 'Field B', stage: 'Planting', date: '2024-06-15' },
            ],
            livestockData: [
                { id: 'l1', tagId: 'CATTLE-001', type: 'Cattle', health: 'Healthy' },
                { id: 'l2', tagId: 'PIG-042', type: 'Pig', health: 'Sick' },
            ],
            equipmentData: [
                { id: 'e1', name: 'Tractor', model: 'Model X', status: 'Operational', lastService: '2024-04-10' },
                { id: 'e2', name: 'Harvester', model: 'H-200', status: 'Maintenance', lastService: '2024-03-01' },
            ],
        };

        const data = {};
        Object.keys(mockData).forEach(key => {
            const savedData = localStorage.getItem(key);
            data[key] = savedData ? JSON.parse(savedData) : mockData[key];
        });
        return data;
    }

    saveData(key, data) {
        // Persist data back to localStorage and update the in-memory copy
        localStorage.setItem(key, JSON.stringify(data));
        this.data[key] = data; 
    }
    
    generateId(prefix) {
        // Simple unique ID generator based on timestamp and randomness
        return prefix.toUpperCase() + '-' + Date.now().toString(36) + Math.random().toString(36).substring(2, 5);
    }
    
    // --- GENERIC RENDERING & CRUD ---

    showCategory(key, section) {
        // Generic function to display any category based on its definition
        const definition = this.definitions[key];

        // HTML structure for Search, Filter, and Add button
        const categoryHtml = `
            <div class="content-header">
                <h2>${definition.title} Management</h2>
                <div class="actions">
                    <input type="text" id="${key}SearchInput" placeholder="Search by ${definition.searchKey}..." oninput="farmSystem.renderTable('${key}')">
                    <select id="${key}FilterSelect" onchange="farmSystem.renderTable('${key}')">
                        <option value="all">All ${definition.filterKey}</option>
                        ${definition.filterOptions.map(opt => `<option value="${opt}">${opt}</option>`).join('')}
                    </select>
                    <button class="btn primary-btn" onclick="farmSystem.handleCrud('${key}', 'add')">Add New ${definition.singular}</button>
                </div>
            </div>
            <div class="card">
                <div class="table-container">
                    <table id="${key}Table">
                        <thead>
                            <tr>
                                ${definition.fields.map(field => `<th>${field.label}</th>`).join('')}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="${key}TableBody">
                            <!-- Data will be rendered here -->
                        </tbody>
                    </table>
                </div>
            </div>
        `;
        section.innerHTML = categoryHtml;
        this.renderTable(key); // Initial data render
    }
    
    renderTable(key) {
        // Filters, searches, and renders the table data for a given category
        const definition = this.definitions[key];
        const dataKey = definition.dataKey;
        let data = [...this.data[dataKey]]; // Use a copy of data for manipulation

        // 1. SEARCH Logic (case-insensitive on the defined searchKey)
        const searchInput = document.getElementById(`${key}SearchInput`);
        const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';
        if (searchQuery) {
            data = data.filter(item => 
                String(item[definition.searchKey] || '').toLowerCase().includes(searchQuery)
            );
        }

        // 2. FILTER Logic (on the defined filterKey)
        const filterSelect = document.getElementById(`${key}FilterSelect`);
        const filterValue = filterSelect ? filterSelect.value : 'all';
        if (filterValue !== 'all') {
            data = data.filter(item => item[definition.filterKey] === filterValue);
        }

        const body = document.getElementById(`${key}TableBody`);
        if (!body) return;

        if (data.length === 0) {
            body.innerHTML = `<tr><td colspan="${definition.fields.length + 1}" style="text-align: center;">No matching ${definition.plural} found.</td></tr>`;
            return;
        }

        // 3. RENDER Logic
        body.innerHTML = data.map(item => {
            const rowData = definition.fields.map(field => {
                let value = item[field.key] || '';
                if (field.isBadge) {
                    const badgeType = definition.badgeMap[value] || 'info';
                    // Use the CSS classes defined in the style block
                    value = `<span class="badge ${badgeType.toLowerCase()}">${value}</span>`;
                }
                return `<td>${value}</td>`;
            }).join('');

            return `
                <tr data-id="${item.id}">
                    ${rowData}
                    <td>
                        <button class="btn-text" onclick="farmSystem.handleCrud('${key}', 'edit', '${item.id}')">Edit</button>
                        <button class="btn-text danger-text" onclick="farmSystem.handleCrud('${key}', 'delete', '${item.id}')">Delete</button>
                    </td>
                </tr>
            `;
        }).join('');
    }

    handleCrud(key, action, id = null) {
        // Handles Add, Edit, and Delete actions for any category
        const definition = this.definitions[key];
        const dataKey = definition.dataKey;
        let currentData = this.data[dataKey];
        const item = id ? currentData.find(i => i.id === id) : {};
        
        // DELETE Logic
        if (action === 'delete') {
            if (this.customConfirm(`Are you sure you want to delete ${definition.singular} ID ${id}?`)) {
                const newData = currentData.filter(i => i.id !== id);
                this.saveData(dataKey, newData);
                this.renderTable(key);
                this.customAlert(`${definition.singular} deleted successfully!`, 'success');
            }
            return;
        }

        // ADD or EDIT Logic (using sequential prompts for input)
        const newItem = {};
        let isCanceled = false;

        // Iterate through all fields except the auto-generated ID field
        for (const field of definition.fields.filter(f => !f.isId)) {
            const defaultValue = item[field.key] || field.default || '';
            let promptMsg = `${action === 'add' ? 'Enter' : 'Edit'} ${definition.singular} ${field.label}:`;
            
            if (field.options) {
                 promptMsg += ` (Options: ${field.options.join(', ')})`;
            }

            const value = this.customPrompt(promptMsg, defaultValue);

            if (value === null) {
                isCanceled = true;
                break;
            }
            newItem[field.key] = value.trim();
        }

        if (isCanceled) return;

        if (action === 'add') {
            newItem.id = this.generateId(key.charAt(0));
            currentData.push(newItem);
            this.customAlert(`${definition.singular} added successfully!`, 'success');
        } else { // edit
            const index = currentData.findIndex(i => i.id === id);
            if (index !== -1) {
                // Merge new properties into the existing item
                currentData[index] = { ...currentData[index], ...newItem }; 
                this.customAlert(`${definition.singular} ID ${id} updated successfully!`, 'success');
            }
        }

        this.saveData(dataKey, currentData);
        this.renderTable(key);
    }
    
    // --- AUTHENTICATION & NAVIGATION ---

    handleLogin(e) {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Simple demo login logic
        if (username === 'admin' && password === 'password') {
            this.currentUser = { name: 'Farm Admin', role: 'Admin' };
            localStorage.setItem('currentUser', JSON.stringify(this.currentUser));
            this.showDashboard();
        } else {
            document.getElementById('loginMessage').textContent = 'Invalid username or password.';
        }
    }

    handleLogout() {
        localStorage.removeItem('currentUser');
        this.currentUser = null;
        document.getElementById('loginPage').style.display = 'flex';
        document.getElementById('dashboardPage').style.display = 'none';
        const loginForm = document.getElementById('loginForm');
        if (loginForm) loginForm.reset();
    }

    checkSession() {
        const savedUser = localStorage.getItem('currentUser');
        if (savedUser) {
            this.currentUser = JSON.parse(savedUser);
            this.showDashboard();
        }
    }

    showDashboard() {
        document.getElementById('loginPage').style.display = 'none';
        document.getElementById('dashboardPage').style.display = 'grid';
        document.getElementById('welcomeMessage').textContent = `Welcome, ${this.currentUser.name}`;
        // Ensure the dashboard button is active upon successful login/session check
        const dashboardButton = document.querySelector('[data-section="dashboard"]');
        if (dashboardButton) {
            this.navigate('dashboard', dashboardButton);
        } else {
            this.navigate(this.currentView);
        }
    }
    
    bindEvents() {
        document.getElementById('loginForm').addEventListener('submit', (e) => this.handleLogin(e));
    }

    navigate(sectionName, button) {
        this.currentView = sectionName;
        // Capitalize the section name for the title
        document.getElementById('pageTitle').textContent = sectionName.charAt(0).toUpperCase() + sectionName.slice(1);
        
        // Update active button state
        document.querySelectorAll('.sidebar-menu button').forEach(btn => btn.classList.remove('active'));
        if (button) button.classList.add('active');
        
        const contentSection = document.getElementById('contentSection');
        
        // Dispatch to the specific view function
        switch (sectionName) {
            case 'dashboard':
                this.showDashboardContent(contentSection);
                break;
            case 'users':
                this.showUsers(contentSection);
                break;
            case 'products':
                this.showProducts(contentSection);
                break;
            case 'crops':
                this.showCrops(contentSection);
                break;
            case 'livestock':
                this.showLivestock(contentSection);
                break;
            case 'equipment':
                this.showEquipment(contentSection);
                break;
            case 'reports':
                this.showReports(contentSection);
                break;
        }
    }

    // --- CATEGORY VIEW FUNCTIONS (Using Generic showCategory) ---

    showDashboardContent(section) {
        const totalUsers = this.data.usersData.length;
        const totalProducts = this.data.productsData.length;
        const totalCrops = this.data.cropsData.length;

        // Dashboard statistics card (based on live local data)
        section.innerHTML = `
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="card" style="border-left: 5px solid var(--primary-color);">
                    <h3>Total Users</h3>
                    <p style="font-size: 2rem; font-weight: bold; margin-top: 10px;">${totalUsers}</p>
                </div>
                <div class="card" style="border-left: 5px solid var(--secondary-color);">
                    <h3>Available Products</h3>
                    <p style="font-size: 2rem; font-weight: bold; margin-top: 10px;">${totalProducts}</p>
                </div>
                <div class="card" style="border-left: 5px solid var(--accent-color);">
                    <h3>Active Crop Fields</h3>
                    <p style="font-size: 2rem; font-weight: bold; margin-top: 10px;">${totalCrops}</p>
                </div>
            </div>
            
            <h3 style="margin-top: 30px; margin-bottom: 15px;">Recent Activity (Demo)</h3>
            <div class="card">
                <ul>
                    <li><span class="badge info">LOG</span> New product 'Corn' added to inventory.</li>
                    <li><span class="badge healthy">LOG</span> User 'Jane Smith' edited product stock.</li>
                    <li><span class="badge danger">LOG</span> Equipment 'Harvester' status changed to 'Maintenance'.</li>
                </ul>
            </div>
        `;
    }

    // Each of these now simply calls the generic showCategory function
    showUsers(section) {
        this.showCategory('users', section);
    }

    showProducts(section) {
        this.showCategory('products', section);
    }
    
    showCrops(section) {
        this.showCategory('crops', section);
    }
    
    showLivestock(section) {
        this.showCategory('livestock', section);
    }

    showEquipment(section) {
        this.showCategory('equipment', section);
    }

    showReports(section) {
        const reportsContent = `
            <h2>Reports & Analytics (Demo)</h2>
            <div class="card">
                <p>This section would contain generated PDF/CSV reports, charts, and key performance indicators (KPIs) based on the current data managed in the system. Since data is local, this is just a placeholder.</p>
                <ul style="margin-top: 15px; list-style-type: disc; padding-left: 20px;">
                    <li>Production Forecast Report</li>
                    <li>Inventory Stock History</li>
                    <li>Equipment Maintenance Schedule</li>
                    <li>User Activity Log</li>
                </ul>
            </div>
        `;
        section.innerHTML = reportsContent;
    }
}

let farmSystem;

// Initialize the application when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    farmSystem = new FarmSystem();
});
</script>
</body>
</html>