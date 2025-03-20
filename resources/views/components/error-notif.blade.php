@if (session('error'))
<div id="error-message" class="bg-red-200 text-red-800 p-3 rounded">
    {{ session('error') }}
</div>

<script>
    setTimeout(() => {
        document.getElementById('error-message').style.display = 'none';
    }, 10000); // Hides the message after 5 seconds
</script>
@endif