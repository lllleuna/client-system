document.addEventListener('DOMContentLoaded', () => {
    const regionSelect = document.getElementById('regions');
    const cmSelect = document.getElementById('cities-municipalities');
    const barangaySelect = document.getElementById('barangays');

    // Retrieve previous values from data attributes (if applicable)
    const previousRegion = regionSelect.dataset.selected;
    const previousCM = cmSelect.dataset.selected;
    const previousBarangay = barangaySelect.dataset.selected;

    // Function to clear and reset a dropdown
    const resetDropdown = (dropdown, placeholder) => {
        dropdown.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
        dropdown.disabled = true;
    };

    // Load regions on page load (if applicable)
    fetch('/regions')
        .then(response => response.json())
        .then(data => {
            data.forEach(region => {
                const option = document.createElement('option');
                option.value = region.code;
                option.textContent = region.name;
                if (region.code === previousRegion) option.selected = true;
                regionSelect.appendChild(option);
            });
            regionSelect.disabled = false;

            if (previousRegion) {
                regionSelect.value = previousRegion;
                regionSelect.dispatchEvent(new Event('change'));
            }
        });

    // Handle region selection
    regionSelect.addEventListener('change', () => {
        const regionCode = regionSelect.value;

        resetDropdown(cmSelect, 'Select City/Municipality');
        resetDropdown(barangaySelect, 'Select Barangay');

        if (regionCode) {
            fetch(`/regions/${regionCode}/cities-municipalities`)
                .then(response => response.json())
                .then(data => {
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
                });
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
                });
        }
    });
});
