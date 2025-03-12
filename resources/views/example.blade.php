<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Bootstrap Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
        .sortable {
            cursor: pointer;
        }
        .sortable:after {
            content: "\F132";
            font-family: "bootstrap-icons";
            font-size: 0.75em;
            opacity: 0.5;
            margin-left: 5px;
        }
        .sortable.asc:after {
            content: "\F128";
            opacity: 1;
        }
        .sortable.desc:after {
            content: "\F12C";
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group">
                    <button class="btn btn-outline-primary" id="exportCSV">Export CSV</button>
                    <button class="btn btn-outline-primary" id="printTable">Print</button>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="sortable" data-sort="id">ID</th>
                        <th class="sortable" data-sort="name">Name</th>
                        <th class="sortable" data-sort="position">Position</th>
                        <th class="sortable" data-sort="office">Office</th>
                        <th class="sortable" data-sort="age">Age</th>
                        <th class="sortable" data-sort="salary">Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data will be populated via JavaScript -->
                </tbody>
            </table>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <p>Showing <span id="rowCount">0</span> entries</p>
            </div>
            <div class="col-md-6">
                <nav>
                    <ul class="pagination justify-content-end" id="pagination">
                        <!-- Pagination will be populated via JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal for viewing/editing records -->
    <div class="modal fade" id="recordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="recordForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position">
                        </div>
                        <div class="mb-3">
                            <label for="office" class="form-label">Office</label>
                            <input type="text" class="form-control" id="office">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age">
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salary">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data
            const data = [
                { id: 1, name: "John Smith", position: "Developer", office: "New York", age: 32, salary: 85000 },
                { id: 2, name: "Jane Doe", position: "Designer", office: "London", age: 27, salary: 72000 },
                { id: 3, name: "Robert Johnson", position: "Manager", office: "San Francisco", age: 41, salary: 120000 },
                { id: 4, name: "Emily Brown", position: "Analyst", office: "Tokyo", age: 29, salary: 68000 },
                { id: 5, name: "Michael Davis", position: "Developer", office: "New York", age: 34, salary: 92000 },
                { id: 6, name: "Sarah Wilson", position: "Designer", office: "London", age: 31, salary: 76000 },
                { id: 7, name: "David Thompson", position: "Manager", office: "San Francisco", age: 45, salary: 130000 },
                { id: 8, name: "Lisa Garcia", position: "Analyst", office: "Tokyo", age: 28, salary: 65000 },
                { id: 9, name: "Kevin Martinez", position: "Developer", office: "New York", age: 33, salary: 88000 },
                { id: 10, name: "Amanda Robinson", position: "Designer", office: "London", age: 30, salary: 74000 }
            ];
            
            let filteredData = [...data];
            let currentPage = 1;
            const rowsPerPage = 5;
            let currentSort = { column: 'id', direction: 'asc' };
            
            // Initialize table
            renderTable();
            updatePagination();
            
            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                filteredData = data.filter(item => 
                    Object.values(item).some(val => 
                        val.toString().toLowerCase().includes(searchTerm)
                    )
                );
                currentPage = 1;
                renderTable();
                updatePagination();
            });
            
            // Sorting functionality
            document.querySelectorAll('th.sortable').forEach(th => {
                th.addEventListener('click', function() {
                    const column = this.dataset.sort;
                    
                    // Change sort direction or set to asc if new column
                    if (currentSort.column === column) {
                        currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                    } else {
                        currentSort.column = column;
                        currentSort.direction = 'asc';
                    }
                    
                    // Update UI
                    document.querySelectorAll('th.sortable').forEach(el => {
                        el.classList.remove('asc', 'desc');
                    });
                    this.classList.add(currentSort.direction);
                    
                    // Sort data
                    filteredData.sort((a, b) => {
                        const aVal = a[column];
                        const bVal = b[column];
                        
                        if (currentSort.direction === 'asc') {
                            return aVal > bVal ? 1 : aVal < bVal ? -1 : 0;
                        } else {
                            return aVal < bVal ? 1 : aVal > bVal ? -1 : 0;
                        }
                    });
                    
                    renderTable();
                });
            });
            
            // Pagination functionality
            document.getElementById('pagination').addEventListener('click', function(e) {
                if (e.target.classList.contains('page-link')) {
                    e.preventDefault();
                    const targetPage = e.target.dataset.page;
                    
                    if (targetPage === 'prev') {
                        currentPage = Math.max(1, currentPage - 1);
                    } else if (targetPage === 'next') {
                        currentPage = Math.min(Math.ceil(filteredData.length / rowsPerPage), currentPage + 1);
                    } else {
                        currentPage = parseInt(targetPage);
                    }
                    
                    renderTable();
                    updatePagination();
                }
            });
            
            // Edit record functionality
            const modal = new bootstrap.Modal(document.getElementById('recordModal'));
            let currentEditId = null;
            
            document.getElementById('tableBody').addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-edit')) {
                    const id = parseInt(e.target.dataset.id);
                    const record = data.find(item => item.id === id);
                    currentEditId = id;
                    
                    // Populate form
                    document.getElementById('name').value = record.name;
                    document.getElementById('position').value = record.position;
                    document.getElementById('office').value = record.office;
                    document.getElementById('age').value = record.age;
                    document.getElementById('salary').value = record.salary;
                    
                    modal.show();
                }
            });
            
            document.getElementById('saveChanges').addEventListener('click', function() {
                const record = data.find(item => item.id === currentEditId);
                
                // Update record
                record.name = document.getElementById('name').value;
                record.position = document.getElementById('position').value;
                record.office = document.getElementById('office').value;
                record.age = parseInt(document.getElementById('age').value);
                record.salary = parseInt(document.getElementById('salary').value);
                
                // Refresh table
                filteredData = [...data];
                renderTable();
                
                modal.hide();
            });
            
            // Export to CSV
            document.getElementById('exportCSV').addEventListener('click', function() {
                const headers = ['ID', 'Name', 'Position', 'Office', 'Age', 'Salary'];
                const csvRows = [headers.join(',')];
                
                filteredData.forEach(item => {
                    const values = [
                        item.id,
                        `"${item.name}"`,
                        `"${item.position}"`,
                        `"${item.office}"`,
                        item.age,
                        item.salary
                    ];
                    csvRows.push(values.join(','));
                });
                
                const blob = new Blob([csvRows.join('\n')], { type: 'text/csv' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'table-data.csv';
                a.click();
                URL.revokeObjectURL(url);
            });
            
            // Print table
            document.getElementById('printTable').addEventListener('click', function() {
                window.print();
            });
            
            // Helper functions
            function renderTable() {
                const tableBody = document.getElementById('tableBody');
                tableBody.innerHTML = '';
                
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const pageData = filteredData.slice(start, end);
                
                pageData.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.position}</td>
                        <td>${item.office}</td>
                        <td>${item.age}</td>
                        <td>$${item.salary.toLocaleString()}</td>
                        <td>
                            <button class="btn btn-sm btn-primary me-1 btn-edit" data-id="${item.id}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
                
                document.getElementById('rowCount').textContent = filteredData.length;
            }
            
            function updatePagination() {
                const totalPages = Math.ceil(filteredData.length / rowsPerPage);
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';
                
                // Previous button
                const prevItem = document.createElement('li');
                prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
                prevItem.innerHTML = `<a class="page-link" href="#" data-page="prev">Previous</a>`;
                pagination.appendChild(prevItem);
                
                // Page numbers
                for (let i = 1; i <= totalPages; i++) {
                    const pageItem = document.createElement('li');
                    pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
                    pageItem.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
                    pagination.appendChild(pageItem);
                }
                
                // Next button
                const nextItem = document.createElement('li');
                nextItem.className = `page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}`;
                nextItem.innerHTML = `<a class="page-link" href="#" data-page="next">Next</a>`;
                pagination.appendChild(nextItem);
            }
        });
    </script>
</body>
</html>