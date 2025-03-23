@vite('resources/js/modal.js')

@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    $user = Auth::user();
    $applicationExists = DB::table('applications')
        ->where('user_id', $user->id)
        ->where('status', '!=', 'rejected')
        ->exists();

    $accreditationStatus = DB::table('externalusers')->where('id', $user->id)->value('accreditation_status');

    $showModal = !$applicationExists && in_array($accreditationStatus, ['New']);
@endphp

{{-- Store showModal condition in a JavaScript variable --}}
<script>
    var shouldShowModal = @json($showModal);
</script>

<x-modal id="modalCreate" class="hidden">
    <x-slot:closebtnSlot>
        <x-modal-close-button onclick="closeModal('modalCreate')" />
    </x-slot:closebtnSlot>

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Get Accredited</h2>

    <p class="text-gray-700 mb-4 text-sm text-start leading-relaxed">
        To access all features of this website, your Cooperative must first be 
        <span class="font-semibold text-blue-900">ACCREDITED</span> by the <span class="font-semibold text-blue-900 uppercase">Office of Transportation Cooperatives</span>.
    </p>
    
    <p class="text-gray-700 mb-6 text-sm text-start leading-relaxed">
        If your Cooperative is not yet accredited, click the link below to begin the process. Ensure all Cooperative information is complete and accurate, as this will be used 
        to evaluate your application and determine approval.
    </p>

    <p class="text-gray-700 mb-6 text-sm text-start leading-relaxed">
        Incomplete information may lead to processing delays or <span class="text-red-700 font-semibold">REJECTION</span> of your application.
    </p>    


    <div class="flex flex-col space-y-4 mt-10">
        <a href="/accreditation" class="block text-center bg-blue-900 hover:bg-blue-800 text-white font-medium py-2 px-4 rounded transition">
            Accreditation Link
        </a>
    </div>

</x-modal>
