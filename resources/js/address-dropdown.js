document.addEventListener('DOMContentLoaded', () => {
    const igSelect = document.getElementById('island-groups');
    const regionSelect = document.getElementById('regions');
    const provinceSelect = document.getElementById('provinces');
    const cmSelect = document.getElementById('cities-municipalities');
    const barangaySelect = document.getElementById('barangays');

    // Retrieve previous values from data attributes
    const previousIslandGroup = igSelect.dataset.selected;
    const previousRegion = regionSelect.dataset.selected;
    const previousProvince = provinceSelect.dataset.selected;
    const previousCM = cmSelect.dataset.selected;
    const previousBarangay = barangaySelect.dataset.selected;

    // Function to clear and reset a dropdown
    const resetDropdown = (dropdown, placeholder) => {
        dropdown.innerHTML = `<option value="">${placeholder}</option>`;
        dropdown.disabled = true;
    };

    // Load island groups on page load and restore selection
    fetch('/island-groups')
        .then(response => response.json())
        .then(data => {
            data.forEach(islandgroup => {
                const option = document.createElement('option');
                option.value = islandgroup.code;
                option.textContent = islandgroup.name;
                if (islandgroup.code === previousIslandGroup) option.selected = true;
                igSelect.appendChild(option);
            });

            if (previousIslandGroup) {
                igSelect.value = previousIslandGroup;
                igSelect.dispatchEvent(new Event('change')); // Trigger change event to load regions
            }
        });

    // Handle island group selection
    igSelect.addEventListener('change', () => {
        const igCode = igSelect.value;

        resetDropdown(regionSelect, 'Select');
        resetDropdown(provinceSelect, 'Select');
        resetDropdown(cmSelect, 'Select');
        resetDropdown(barangaySelect, 'Select');

        if (igCode) {
            fetch(`/island-groups/${igCode}/regions`)
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
        }
    });

    // Handle region selection
    regionSelect.addEventListener('change', () => {
        const regionCode = regionSelect.value;

        resetDropdown(provinceSelect, 'Select');
        resetDropdown(cmSelect, 'Select');
        resetDropdown(barangaySelect, 'Select');

        if (regionCode) {
            fetch(`/regions/${regionCode}/provinces`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.code;
                        option.textContent = province.name;
                        if (province.code === previousProvince) option.selected = true;
                        provinceSelect.appendChild(option);
                    });
                    provinceSelect.disabled = false;

                    if (previousProvince) {
                        provinceSelect.value = previousProvince;
                        provinceSelect.dispatchEvent(new Event('change'));
                    }
                });

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

        resetDropdown(barangaySelect, 'Select');

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
