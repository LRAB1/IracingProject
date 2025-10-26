const API_BASE = '/api';

function showView(viewName) {
    const views = document.querySelectorAll('.view');
    views.forEach(view => view.classList.remove('active'));
    
    const targetView = document.getElementById(`${viewName}-view`);
    if (targetView) {
        targetView.classList.add('active');
    }
    
    if (viewName === 'list') {
        loadSetups();
    }
}

function showMessage(elementId, message, isError = false) {
    const messageEl = document.getElementById(elementId);
    messageEl.textContent = message;
    messageEl.className = 'message ' + (isError ? 'error' : 'success');
    
    setTimeout(() => {
        messageEl.textContent = '';
        messageEl.className = 'message';
    }, 5000);
}

async function saveSetup(event) {
    event.preventDefault();
    
    const form = document.getElementById('setup-form');
    const formData = new FormData(form);
    const setupData = {};
    
    for (let [key, value] of formData.entries()) {
        setupData[key] = value;
    }
    
    const confirmation = confirm('Save this setup?');
    if (!confirmation) {
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/setups`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(setupData)
        });
        
        const result = await response.json();
        
        if (response.ok) {
            showMessage('add-message', 'Setup saved successfully!', false);
            form.reset();
        } else {
            showMessage('add-message', `Error: ${result.error}`, true);
        }
    } catch (err) {
        showMessage('add-message', `Error saving setup: ${err.message}`, true);
    }
}

async function loadSetups() {
    try {
        const response = await fetch(`${API_BASE}/setups`);
        const setups = await response.json();
        
        const listContainer = document.getElementById('setups-list');
        
        if (setups.length === 0) {
            listContainer.innerHTML = '<p>No setups saved yet.</p>';
            return;
        }
        
        listContainer.innerHTML = setups.map(setup => `
            <div class="setup-card">
                <h4>${setup.setupName}</h4>
                <p><strong>Car:</strong> ${setup.car} | <strong>Track:</strong> ${setup.track}</p>
                <p><strong>Created:</strong> ${new Date(setup.dateCreated).toLocaleDateString()}</p>
                <div class="setup-details">
                    <div class="detail-item">
                        <strong>Fuel Level</strong>
                        <span>${setup.fuelLevel} L</span>
                    </div>
                    <div class="detail-item">
                        <strong>Front Toe</strong>
                        <span>${setup.frontToe} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>Front ARB</strong>
                        <span>${setup.frontARB}</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Pressure</strong>
                        <span>${setup.LF_Pressure} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Pressure</strong>
                        <span>${setup.RF_Pressure} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Pressure</strong>
                        <span>${setup.RR_Pressure} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Pressure</strong>
                        <span>${setup.LR_Pressure} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Camber</strong>
                        <span>${setup.LF_Camber}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Camber</strong>
                        <span>${setup.RF_Camber}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Camber</strong>
                        <span>${setup.RR_Camber}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Camber</strong>
                        <span>${setup.LR_Camber}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>Rear Toe</strong>
                        <span>${setup.rearToe} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>Rear ARB</strong>
                        <span>${setup.rearARB}</span>
                    </div>
                </div>
                <div class="actions">
                    <button class="btn-danger" onclick="deleteSetup('${setup.id}')">Delete</button>
                </div>
            </div>
        `).join('');
    } catch (err) {
        const listContainer = document.getElementById('setups-list');
        listContainer.innerHTML = `<p class="error">Error loading setups: ${err.message}</p>`;
    }
}

async function deleteSetup(id) {
    const confirmation = confirm('Are you sure you want to delete this setup?');
    if (!confirmation) {
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/setups/${id}`, {
            method: 'DELETE'
        });
        
        if (response.ok) {
            loadSetups();
        } else {
            const result = await response.json();
            alert(`Error: ${result.error}`);
        }
    } catch (err) {
        alert(`Error deleting setup: ${err.message}`);
    }
}

async function calculateAverage() {
    const car = document.getElementById('avg-car').value;
    const track = document.getElementById('avg-track').value;
    
    if (!car || !track) {
        alert('Please enter both car and track');
        return;
    }
    
    try {
        const response = await fetch(`${API_BASE}/setups/average/${encodeURIComponent(car)}/${encodeURIComponent(track)}`);
        const result = await response.json();
        
        const resultContainer = document.getElementById('average-result');
        
        if (!response.ok) {
            resultContainer.innerHTML = `<p class="error">${result.error}</p>`;
            return;
        }
        
        resultContainer.innerHTML = `
            <div class="average-card">
                <h3>Average Setup: ${result.setupName}</h3>
                <p><strong>Car:</strong> ${result.car} | <strong>Track:</strong> ${result.track}</p>
                <div class="setup-details">
                    <div class="detail-item">
                        <strong>Fuel Level</strong>
                        <span>${result.fuelLevel.toFixed(2)} L</span>
                    </div>
                    <div class="detail-item">
                        <strong>Front Toe</strong>
                        <span>${result.frontToe.toFixed(2)} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>Front ARB</strong>
                        <span>${result.frontARB.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Pressure</strong>
                        <span>${result.LF_Pressure.toFixed(2)} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Spring Perch</strong>
                        <span>${result.LF_SpringPerchOffset.toFixed(2)} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Bump</strong>
                        <span>${result.LF_BumpStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Rebound</strong>
                        <span>${result.LF_ReboundStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>LF Camber</strong>
                        <span>${result.LF_Camber.toFixed(2)}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Pressure</strong>
                        <span>${result.RF_Pressure.toFixed(2)} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Spring Perch</strong>
                        <span>${result.RF_SpringPerch.toFixed(2)} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Bump</strong>
                        <span>${result.RF_BumpStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Rebound</strong>
                        <span>${result.RF_ReboundStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>RF Camber</strong>
                        <span>${result.RF_Camber.toFixed(2)}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Pressure</strong>
                        <span>${result.RR_Pressure.toFixed(2)} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Spring Perch</strong>
                        <span>${result.RR_SpringPerch.toFixed(2)} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Bump</strong>
                        <span>${result.RR_BumpStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Rebound</strong>
                        <span>${result.RR_ReboundStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>RR Camber</strong>
                        <span>${result.RR_Camber.toFixed(2)}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Pressure</strong>
                        <span>${result.LR_Pressure.toFixed(2)} PSI</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Spring Perch</strong>
                        <span>${result.LR_SpringPerch.toFixed(2)} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Bump</strong>
                        <span>${result.LR_BumpStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Rebound</strong>
                        <span>${result.LR_ReboundStiffness.toFixed(2)}</span>
                    </div>
                    <div class="detail-item">
                        <strong>LR Camber</strong>
                        <span>${result.LR_Camber.toFixed(2)}°</span>
                    </div>
                    <div class="detail-item">
                        <strong>Rear Toe</strong>
                        <span>${result.rearToe.toFixed(2)} mm</span>
                    </div>
                    <div class="detail-item">
                        <strong>Rear ARB</strong>
                        <span>${result.rearARB.toFixed(2)}</span>
                    </div>
                </div>
            </div>
        `;
    } catch (err) {
        const resultContainer = document.getElementById('average-result');
        resultContainer.innerHTML = `<p class="error">Error calculating average: ${err.message}</p>`;
    }
}

async function importSetups() {
    const fileInput = document.getElementById('setup-files');
    const files = fileInput.files;
    
    if (files.length === 0) {
        showMessage('import-message', 'Please select at least one setup file', true);
        return;
    }
    
    const confirmation = confirm(`You have selected ${files.length} file(s) to import. Do you want to proceed?`);
    if (!confirmation) {
        return;
    }
    
    const resultsContainer = document.getElementById('import-results');
    resultsContainer.innerHTML = '<p>Processing files...</p>';
    
    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('setupFiles', files[i]);
    }
    
    try {
        const response = await fetch(`${API_BASE}/setups/import`, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (response.ok) {
            const successCount = result.imported || 0;
            const failCount = result.failed || 0;
            
            let resultHTML = `<div class="import-summary">
                <h3>Import Complete</h3>
                <p><strong>Successfully imported:</strong> ${successCount} setup(s)</p>`;
            
            if (failCount > 0) {
                resultHTML += `<p><strong>Failed to import:</strong> ${failCount} file(s)</p>`;
            }
            
            if (result.errors && result.errors.length > 0) {
                resultHTML += '<h4>Errors:</h4><ul>';
                result.errors.forEach(error => {
                    resultHTML += `<li>${error}</li>`;
                });
                resultHTML += '</ul>';
            }
            
            if (result.details && result.details.length > 0) {
                resultHTML += '<h4>Imported Setups:</h4><ul>';
                result.details.forEach(detail => {
                    resultHTML += `<li>${detail.setupName} - ${detail.car} @ ${detail.track}</li>`;
                });
                resultHTML += '</ul>';
            }
            
            resultHTML += '</div>';
            resultsContainer.innerHTML = resultHTML;
            
            showMessage('import-message', `Import completed: ${successCount} successful, ${failCount} failed`, failCount > 0);
            
            // Clear the file input
            fileInput.value = '';
        } else {
            resultsContainer.innerHTML = `<p class="error">Import failed: ${result.error}</p>`;
            showMessage('import-message', `Error: ${result.error}`, true);
        }
    } catch (err) {
        resultsContainer.innerHTML = `<p class="error">Error during import: ${err.message}</p>`;
        showMessage('import-message', `Error: ${err.message}`, true);
    }
}

document.getElementById('setup-form').addEventListener('submit', saveSetup);
