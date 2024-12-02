<form action="/" method="POST" id="log_form">
    @csrf
    
    <x-form-title>Log in to your Account</x-form-title>

    <x-form-input name="email" id="email" placeholder="Email" :value="old('email')" required/>
    <x-form-error name="email" />

    <x-form-input name="password" id="password" type="password" placeholder="Password" required/>
    <x-form-error name="password" />

    <div class="flex justify-between mt-2 mb-2">
        <div>
            <x-cancel-button onclick="closeModal('modallog'), resetForm('log_form')"> Discard </x-cancel-button>
        </div>
        <div>
            <x-form-submit-button> Log in </x-form-submit-button>
        </div>
    </div>

</form>
