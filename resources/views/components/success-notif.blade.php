@if (session('success'))
<div id="success-message" class="bg-green-200 text-green-800 p-3 rounded">
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        document.getElementById('success-message').style.display = 'none';
    }, 10000); // Hides the message after 5 seconds
</script>
@endif