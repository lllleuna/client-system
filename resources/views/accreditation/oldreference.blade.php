<x-accredit-steps>
    <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
    
        <x-form-title>Reference Number</x-form-title>

        <!-- Placeholder for the random reference number -->
        <p id="referenceNumber" class="text-gray-700 font-mono">Generating reference number...</p>
        
    </div>
</x-accredit-steps>

<script>
    // Function to generate a random letter
    function getRandomLetter() {
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return alphabet[Math.floor(Math.random() * alphabet.length)];
    }

    // Function to generate a random number of a given length
    function getRandomNumber(length) {
        return Math.floor(Math.pow(10, length - 1) + Math.random() * 9 * Math.pow(10, length - 1));
    }

    // Generate the reference number
    const randomLetter = getRandomLetter();
    const randomNumber = getRandomNumber(8); // 8-digit number
    const referenceNumber = `${randomLetter}${randomNumber}`;

    // Insert the reference number into the HTML
    document.getElementById('referenceNumber').textContent = referenceNumber;
</script>