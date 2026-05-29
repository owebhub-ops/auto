<style>
    /* Custom styles for compare page */
    .compare-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
    }
    
    .search-container {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .search-input-group {
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .search-input-group .input-group-text {
        background: white;
        border: none;
        color: #667eea;
    }
    
    .search-input-group input {
        border: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    
    .search-input-group input:focus {
        box-shadow: none;
        outline: none;
    }
    
    .search-input-group button {
        border-radius: 0 50px 50px 0;
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        font-weight: 600;
        white-space: nowrap;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .results-container {
        position: relative;
        margin-top: 1rem;
    }
    
    .search-results {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        background: white;
    }
    
    .car-item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 1rem 1.5rem !important;
        border: none !important;
        border-bottom: 1px solid #e0e0e0 !important;
        transition: all 0.3s ease;
        width: 100%;
        text-align: left;
    }
    
    .car-item:last-child {
        border-bottom: none !important;
    }
    
    .car-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }
    
    .car-item.active {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border-left: 4px solid #667eea !important;
    }
    
    .car-info {
        flex: 1;
        min-width: 0; /* Prevents overflow */
    }
    
    .car-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.25rem;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .car-meta {
        font-size: 0.85rem;
        color: #666;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .check-icon {
        color: #28a745;
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-left: 1rem;
    }
    
    .plus-icon {
        color: #667eea;
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-left: 1rem;
    }
    
    .selected-cars-panel {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        margin-top: 2rem;
    }
    
    .selected-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        margin: 0.25rem;
        font-size: 0.9rem;
        max-width: 100%;
        word-wrap: break-word;
    }
    
    .selected-badge span {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .selected-badge button {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        padding: 0;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .compare-btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 50px;
        white-space: nowrap;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .compare-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }
    
    .compare-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .alert-custom {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease;
        z-index: 9999;
        min-width: 300px;
        max-width: 90%;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .loading-spinner {
        text-align: center;
        padding: 2rem;
    }
    
    .spinner-border-custom {
        width: 3rem;
        height: 3rem;
        border: 0.2em solid #f3f3f3;
        border-top: 0.2em solid #667eea;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Comparison Table Styles - Fixed for no overlapping */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .comparison-table {
        min-width: 600px;
        width: 100%;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .comparison-table th,
    .comparison-table td {
        padding: 1rem;
        vertical-align: middle;
        word-wrap: break-word;
        overflow-wrap: break-word;
        max-width: 250px;
    }
    
    .comparison-table th {
        background: #f8f9fa;
        font-weight: 600;
        width: 180px;
    }
    
    .comparison-table td {
        border-left: 1px solid #dee2e6;
    }
    
    .comparison-table tr:first-child td {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    }
    
    .remove-car-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(220, 53, 69, 0.9);
        border: none;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .remove-car-btn:hover {
        background: #dc3545;
        transform: scale(1.05);
    }
    
    .car-image-placeholder {
        width: 100%;
        height: 150px;
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .compare-hero {
            padding: 1.5rem;
        }
        
        .compare-hero h1 {
            font-size: 1.5rem;
        }
        
        .compare-hero .lead {
            font-size: 1rem;
        }
        
        .search-input-group {
            flex-wrap: nowrap;
        }
        
        .search-input-group input {
            min-width: 0;
        }
        
        .search-input-group button {
            padding: 0.75rem 1rem;
            white-space: nowrap;
        }
        
        .selected-cars-panel .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
        
        .comparison-table th,
        .comparison-table td {
            padding: 0.75rem;
            font-size: 0.85rem;
        }
        
        .comparison-table th {
            width: 120px;
        }
        
        .car-name {
            font-size: 0.9rem;
        }
        
        .selected-badge {
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 576px) {
        .comparison-table th,
        .comparison-table td {
            padding: 0.5rem;
            font-size: 0.75rem;
        }
        
        .comparison-table th {
            width: 100px;
        }
        
        .car-name {
            font-size: 0.8rem;
        }
        
        .car-meta {
            font-size: 0.7rem;
        }
    }
</style>

<div class="container py-4">
    <!-- Hero Section -->
    <div class="compare-hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-diagram-2-fill me-2"></i> Compare Cars
                </h1>
                <p class="lead mb-0">Find your perfect match by comparing specs, features, and prices side by side</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <i class="bi bi-car-front-fill" style="font-size: 4rem; opacity: 0.8;"></i>
            </div>
        </div>
    </div>

    <!-- Search Container -->
    <div class="search-container">
        <div class="row">
            <div class="col-12">
                <label class="form-label fw-semibold mb-2">
                    <i class="bi bi-search me-1"></i> Search Cars
                </label>
                <div class="input-group search-input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="carSearch" class="form-control" 
                           placeholder="Type at least 2 characters... (e.g., Toyota, Honda, BMW)">
                    <button id="addToCompare" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Add to Compare
                    </button>
                </div>
                <div class="results-container">
                    <div id="searchResults" class="list-group search-results"></div>
                </div>
                <small class="text-muted mt-2 d-block">
                    <i class="bi bi-info-circle"></i> Search by brand, model, or variant
                </small>
            </div>
        </div>
    </div>

    <!-- Selected Cars Panel -->
    <div class="selected-cars-panel" id="selectedCarsPanel" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Selected Cars for Comparison
                <span id="selectedCount" class="badge bg-primary ms-2">0</span>
            </h5>
            <button class="btn btn-sm btn-outline-danger" onclick="clearAllSelection()">
                <i class="bi bi-trash"></i> Clear All
            </button>
        </div>
        <div id="selectedCarsList" class="d-flex flex-wrap gap-2 mb-3">
            <!-- Selected cars will appear here -->
        </div>
        <div class="text-end">
            <button id="proceedCompare" class="btn compare-btn">
                <i class="bi bi-diagram-2-fill me-2"></i> Compare Selected Cars
            </button>
        </div>
    </div>

    <!-- Bootstrap alert -->
    <div id="alertBox" class="alert alert-warning alert-custom alert-dismissible fade show d-none position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; min-width: 300px;" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <span id="alertMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<script>
let selectedCars = [];
window.CARS_SEARCH_URL = "<?= site_url('cars/search') ?>";

// Function to update selected cars panel
function updateSelectedPanel() {
    const panel = document.getElementById('selectedCarsPanel');
    const listContainer = document.getElementById('selectedCarsList');
    const countSpan = document.getElementById('selectedCount');
    
    if (selectedCars.length > 0) {
        panel.style.display = 'block';
        countSpan.textContent = selectedCars.length;
        
        // Clear and rebuild list
        listContainer.innerHTML = '';
        selectedCars.forEach(carId => {
            // Find car name from search results or store names separately
            // For now, we'll just show IDs, but you should store car names
            const badge = document.createElement('div');
            badge.className = 'selected-badge';
            badge.innerHTML = `
                <i class="bi bi-car-front"></i>
                <span>Car #${carId}</span>
                <button onclick="removeSelectedCar(${carId})">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            `;
            listContainer.appendChild(badge);
        });
    } else {
        panel.style.display = 'none';
    }
}

// Remove individual selected car
function removeSelectedCar(carId) {
    selectedCars = selectedCars.filter(id => id !== carId);
    updateSelectedPanel();
    
    // Also remove active class from search results
    document.querySelectorAll('.car-item').forEach(item => {
        if (item.dataset.id == carId) {
            item.classList.remove('active');
        }
    });
    
    showAlert('Car removed from comparison', 'info');
}

// Clear all selections
function clearAllSelection() {
    selectedCars = [];
    updateSelectedPanel();
    document.querySelectorAll('.car-item').forEach(item => {
        item.classList.remove('active');
    });
    showAlert('All cars cleared from comparison', 'info');
}

// Search cars with better error handling
document.getElementById('carSearch').addEventListener('input', function () {
    const query = this.value.trim();
    if (query.length < 2) {
        document.getElementById('searchResults').innerHTML = '';
        return;
    }

    // Show loading indicator
    const resultsBox = document.getElementById('searchResults');
    resultsBox.innerHTML = `
        <div class="list-group-item text-center">
            <div class="loading-spinner">
                <div class="spinner-border-custom"></div>
                <p class="mt-2 mb-0 text-muted">Searching for "${query}"...</p>
            </div>
        </div>
    `;
    
    fetch(`${window.CARS_SEARCH_URL}?q=${encodeURIComponent(query)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP ${res.status}: ${res.statusText}`);
        }
        return res.json();
    })
    .then(results => {
        resultsBox.innerHTML = '';
        
        if (!results || results.length === 0) {
            resultsBox.innerHTML = '<div class="list-group-item text-center text-muted py-4"><i class="bi bi-emoji-frown" style="font-size: 2rem;"></i><p class="mt-2 mb-0">No cars found. Try a different search term.</p></div>';
            return;
        }
        
        results.forEach(car => {
            const item = document.createElement('button');
            item.className = 'list-group-item list-group-item-action car-item';
            item.dataset.id = car.vehicle_id;
            
            // Create car info HTML
            item.innerHTML = `
                <div class="car-info">
                    <div class="car-name">
                        <i class="bi bi-car-front me-2"></i>
                        ${car.make} ${car.model}
                    </div>
                    <div class="car-meta">
                        ${car.variant || 'Standard'} 
                        <span class="mx-1">•</span>
                        <i class="bi bi-tag"></i> ID: ${car.vehicle_id}
                    </div>
                </div>
                ${selectedCars.includes(car.vehicle_id) ? '<i class="bi bi-check-circle-fill check-icon"></i>' : '<i class="bi bi-plus-circle text-primary"></i>'}
            `;
            
            // Check if already selected
            if (selectedCars.includes(car.vehicle_id)) {
                item.classList.add('active');
            }
            
            item.onclick = () => {
                if (!selectedCars.includes(car.vehicle_id)) {
                    if (selectedCars.length >= 4) {
                        showAlert('You can compare up to 4 cars at a time.', 'warning');
                        return;
                    }
                    selectedCars.push(car.vehicle_id);
                    item.classList.add('active');
                    item.querySelector('.bi-plus-circle').className = 'bi bi-check-circle-fill check-icon';
                    updateSelectedPanel();
                    showAlert(`${car.make} ${car.model} added to comparison (${selectedCars.length} selected)`, 'success');
                } else {
                    // Remove if already selected
                    selectedCars = selectedCars.filter(id => id !== car.vehicle_id);
                    item.classList.remove('active');
                    item.querySelector('.bi-check-circle-fill').className = 'bi bi-plus-circle text-primary';
                    updateSelectedPanel();
                    showAlert(`${car.make} ${car.model} removed from comparison`, 'info');
                }
            };
            resultsBox.appendChild(item);
        });
    })
    .catch(error => {
        console.error('Search error:', error);
        resultsBox.innerHTML = '<div class="list-group-item text-center text-danger py-4"><i class="bi bi-exclamation-triangle-fill" style="font-size: 2rem;"></i><p class="mt-2 mb-0">Error searching cars. Please try again.</p></div>';
        showAlert('Failed to search cars. Please refresh the page and try again.', 'danger');
    });
});

const compareBaseUrl = "<?= site_url('cars/compare') ?>";

// Add to compare button (proceed with comparison)
document.getElementById('proceedCompare')?.addEventListener('click', function () {
    if (selectedCars.length < 2) {
        showAlert(`Please select at least two cars to compare. (Currently selected: ${selectedCars.length})`, 'warning');
        return;
    }
    
    // Build query string style: ?ids=12,33,44
    const idsParam = selectedCars.join(',');
    window.location.href = `${compareBaseUrl}?ids=${idsParam}`;
});

// Also handle old button if exists
const addToCompareBtn = document.getElementById('addToCompare');
if (addToCompareBtn) {
    addToCompareBtn.addEventListener('click', function () {
        if (selectedCars.length < 2) {
            showAlert(`Please select at least two cars to compare. (Currently selected: ${selectedCars.length})`, 'warning');
            return;
        }
        
        const idsParam = selectedCars.join(',');
        window.location.href = `${compareBaseUrl}?ids=${idsParam}`;
    });
}

// Enhanced alert function with different types
function showAlert(message, type = 'warning') {
    const alertBox = document.getElementById("alertBox");
    const alertMessage = document.getElementById("alertMessage");
    
    // Set alert type styling
    alertBox.className = `alert alert-custom alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    
    if (type === 'success') {
        alertBox.classList.add('alert-success');
        alertBox.classList.remove('alert-warning', 'alert-danger', 'alert-info');
    } else if (type === 'danger') {
        alertBox.classList.add('alert-danger');
        alertBox.classList.remove('alert-warning', 'alert-success', 'alert-info');
    } else if (type === 'info') {
        alertBox.classList.add('alert-info');
        alertBox.classList.remove('alert-warning', 'alert-danger', 'alert-success');
    } else {
        alertBox.classList.add('alert-warning');
        alertBox.classList.remove('alert-success', 'alert-danger', 'alert-info');
    }
    
    alertMessage.textContent = message;
    alertBox.classList.remove("d-none");

    setTimeout(() => {
        alertBox.classList.add("d-none");
    }, 3000);
}

// Remove column from compare table (if on compare page)
function removeColumn(colIndex) {
    const table = document.getElementById("compareTable");
    if (!table) return;

    const totalCols = table.rows[0].cells.length;

    if (totalCols <= 3) {
        showAlert("You must keep at least two cars in the comparison.", 'warning');
        return;
    }

    for (let row of table.rows) {
        if (row.cells[colIndex]) {
            row.deleteCell(colIndex);
        }
    }

    // Update URL query string
    const urlParams = new URLSearchParams(window.location.search);
    let ids = urlParams.get("ids") ? urlParams.get("ids").split(",") : [];

    if (ids.length >= colIndex) {
        ids.splice(colIndex - 1, 1);
        urlParams.set("ids", ids.join(","));
        const newUrl = window.location.pathname + "?" + urlParams.toString();
        window.history.replaceState({}, "", newUrl);
    }
}

// Optional: Add keyboard support for search
document.getElementById('carSearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        if (selectedCars.length >= 2) {
            document.getElementById('proceedCompare')?.click();
        }
    }
});
</script>