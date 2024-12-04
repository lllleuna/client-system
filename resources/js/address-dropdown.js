document.addEventListener('DOMContentLoaded', () => {
    const igSelect = document.getElementById('island-groups');
    const regionSelect = document.getElementById('regions');
    const provinceSelect = document.getElementById('provinces');
    const cmSelect = document.getElementById('cities-municipalities');
    const barangaySelect = document.getElementById('barangays');

    // Function to clear and reset a dropdown
    const resetDropdown = (dropdown, placeholder) => {
        dropdown.innerHTML = `<option value="">${placeholder}</option>`;
        dropdown.disabled = true;
    };

    // Load islandgroup on page load
    fetch('/island-groups')
        .then(response => response.json())
        .then(data => {
            data.forEach(islandgroup => {
                const option = document.createElement('option');
                option.value = islandgroup.code;
                option.textContent = islandgroup.name;
                igSelect.appendChild(option);
            });
        });

    // Handle islandgroup selection
    igSelect.addEventListener('change', () => {
        const igCode = igSelect.value;

        // Reset and disable dependent dropdowns
        resetDropdown(regionSelect, 'Select');
        resetDropdown(provinceSelect, 'Select');

        // Fetch regions if a islandgroup is selected
        if (igCode) {
            fetch(`/island-groups/${igCode}/regions`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(region => {
                        const option = document.createElement('option');
                        option.value = region.code;
                        option.textContent = region.name;
                        regionSelect.appendChild(option);
                    });
                    regionSelect.disabled = false;
                });
        }
    });

    // Handle regions selection
    regionSelect.addEventListener('change', () => {
        const regionCode = regionSelect.value;

        // Reset and disable the province dropdown
        resetDropdown(provinceSelect, 'Select');

        // Fetch provinces if a region is selected
        if (regionCode) {
            fetch(`/regions/${regionCode}/provinces`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.code;
                        option.textContent = province.name;
                        provinceSelect.appendChild(option);
                    });
                    provinceSelect.disabled = false;
                });
        }
    });
    
    // Handle regions selection
    regionSelect.addEventListener('change', () => {
        const regionCode = regionSelect.value;

        // Reset and disable the province dropdown
        resetDropdown(cmSelect, 'Select');

        // Fetch provinces if a region is selected
        if (regionCode) {
            fetch(`/regions/${regionCode}/cities-municipalities`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(citymunicipality => {
                        const option = document.createElement('option');
                        option.value = citymunicipality.code;
                        option.textContent = citymunicipality.name;
                        cmSelect.appendChild(option);
                    });
                    cmSelect.disabled = false;
                });
        }
    });


    // Handle regions selection
    cmSelect.addEventListener('change', () => {
        const cmCode = cmSelect.value;

        // Reset and disable the province dropdown
        resetDropdown(barangaySelect, 'Select');

        // Fetch provinces if a region is selected
        if (cmCode) {
            fetch(`/cities-municipalities/${cmCode}/barangays/`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(barangay => {
                        const option = document.createElement('option');
                        option.value = barangay.code;
                        option.textContent = barangay.name;
                        barangaySelect.appendChild(option);
                    });
                    barangaySelect.disabled = false;
                });
        }
    });

});
