<div class="container py-4">
    <h1 class="h4 mb-4">
        <i class="bi bi-diagram-2-fill text-primary me-2"></i> Compare Cars
    </h1>

    <!-- Search box -->
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" id="carSearch" class="form-control" placeholder="Search car by brand or model...">
            <button id="addToCompare" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add to Compare
            </button>
        </div>
        <div id="searchResults" class="list-group mt-2"></div>
    </div>

    <!-- Bootstrap alert -->
    <div id="alertBox" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
        <span id="alertMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<script>
    let selectedCars = [];
    window.CARS_SEARCH_URL = "<?= site_url('cars/search') ?>";

    // Search cars
    document.getElementById('carSearch').addEventListener('input', function () {
        const query = this.value.trim();
        if (query.length < 2) return;

        fetch(`${window.CARS_SEARCH_URL}?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(results => {
                const resultsBox = document.getElementById('searchResults');
                resultsBox.innerHTML = '';
                results.forEach(car => {
                    const item = document.createElement('button');
                    item.className = 'list-group-item list-group-item-action';
                    item.textContent = `${car.make} ${car.model} ${car.variant ?? ''}`;
                    item.onclick = () => {
                        if (!selectedCars.includes(car.vehicle_id)) {
                            selectedCars.push(car.vehicle_id);
                            item.classList.add('active');
                        }
                    };
                    resultsBox.appendChild(item);
                });
            });
    });

    const compareBaseUrl = "<?= site_url('cars/compare') ?>";

    // Add to compare
    document.getElementById('addToCompare').addEventListener('click', function () {
        if (selectedCars.length < 2) {
            showAlert('Please select at least two cars to compare.');
            return;
        }
        // Build query string style: ?ids=12,33,44
        const idsParam = selectedCars.join(',');
        window.location.href = `${compareBaseUrl}?ids=${idsParam}`;
    });

    // Show Bootstrap alert
    function showAlert(message) {
        const alertBox = document.getElementById("alertBox");
        const alertMessage = document.getElementById("alertMessage");
        alertMessage.textContent = message;
        alertBox.classList.remove("d-none");

        setTimeout(() => {
            alertBox.classList.add("d-none");
        }, 3000);
    }

    // Remove column from compare table
    function removeColumn(colIndex) {
        const table = document.getElementById("compareTable");
        if (!table) return;

        const totalCols = table.rows[0].cells.length;

        if (totalCols <= 3) {
            showAlert("You must keep at least two cars in the comparison.");
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
</script>