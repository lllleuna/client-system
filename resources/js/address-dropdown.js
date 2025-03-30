document.addEventListener('DOMContentLoaded', () => {
    const regionSelect = document.getElementById('regions');
    const cmSelect = document.getElementById('cities-municipalities');
    const barangaySelect = document.getElementById('barangays');

    // Retrieve previous values from data attributes
    const previousRegion = regionSelect.dataset.selected;
    const previousCM = cmSelect.dataset.selected;
    const previousBarangay = barangaySelect.dataset.selected;

    // Enable region dropdown by default (fix for disabled issue)
    regionSelect.disabled = false;

    // Function to clear and reset a dropdown
    const resetDropdown = (dropdown, placeholder) => {
        dropdown.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
        dropdown.disabled = true;
    };

    // Fetch regions and populate dropdown
    fetch('/regions')
        .then(response => response.json())
        .then(data => {
            regionSelect.innerHTML = `<option value="" disabled selected>Select Region</option>`;
            data.forEach(region => {
                const option = document.createElement('option');
                option.value = region.code;
                option.textContent = region.name;
                if (region.code === previousRegion) option.selected = true;
                regionSelect.appendChild(option);
            });

            if (previousRegion) {
                regionSelect.value = previousRegion;
                regionSelect.dispatchEvent(new Event('change'));
            }
        })
        .catch(error => console.error('Error fetching regions:', error));

    // Handle region selection
    regionSelect.addEventListener('change', () => {
        const regionCode = regionSelect.value;

        resetDropdown(cmSelect, 'Select City/Municipality');
        resetDropdown(barangaySelect, 'Select Barangay');

        if (regionCode) {
            fetch(`/regions/${regionCode}/cities-municipalities`)
                .then(response => response.json())
                .then(data => {
                    cmSelect.innerHTML = `<option value="" disabled selected>Select City/Municipality</option>`;
                    data.forEach(citymunicipality => {
                        const option = document.createElement('option');
                        option.value = citymunicipality.code;
                        option.textContent = citymunicipality.name;
                        if (citymunicipality.code === previousCM) option.selected = true;
                        cmSelect.appendChild(option);
                    });
                    cmSelect.disabled = false;

                    if (previousCM) {
                        cmSelect.value = previousCM;
                        cmSelect.dispatchEvent(new Event('change'));
                    }
                })
                .catch(error => console.error('Error fetching cities/municipalities:', error));
        }
    });

    // Handle city/municipality selection
    cmSelect.addEventListener('change', () => {
        const cmCode = cmSelect.value;

        resetDropdown(barangaySelect, 'Select Barangay');

        if (cmCode) {
            fetch(`/cities-municipalities/${cmCode}/barangays/`)
                .then(response => response.json())
                .then(data => {
                    barangaySelect.innerHTML = `<option value="" disabled selected>Select Barangay</option>`;
                    data.forEach(barangay => {
                        const option = document.createElement('option');
                        option.value = barangay.code;
                        option.textContent = barangay.name;
                        if (barangay.code === previousBarangay) option.selected = true;
                        barangaySelect.appendChild(option);
                    });
                    barangaySelect.disabled = false;

                    if (previousBarangay) {
                        barangaySelect.value = previousBarangay;
                    }
                })
                .catch(error => console.error('Error fetching barangays:', error));
        }
    });
});
