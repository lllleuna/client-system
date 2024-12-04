
@php
$showModal = empty(Auth::user()->accreditation_no);
@endphp

@if($showModal)
    <x-modal id="modalCreate"
    class="">
    <x-slot:closebtnSlot>
        <x-modal-close-button onclick="closeModal('modalCreate')" />
    </x-slot:closebtnSlot>

        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Get Accredited</h2>
        <p class="text-gray-600 mb-4 text-sm">
            To access other features of the website, update your information first and make sure to provide the required accreditation details.
        </p>
        <p class="text-gray-600 mb-6 text-sm">
            If you are not yet accredited, get accredited by clicking the <strong>Accreditation Link</strong> below.
        </p>

        <div class="flex flex-col space-y-4">
            <a href="#" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition">
                Update Information
            </a>
            <a href="/accreditation" class="text-blue-500 hover:underline text-center text-sm">
                Accreditation Link
            </a>
        </div>  

    </x-modal>
@endif

   
