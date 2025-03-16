<x-accredit-steps>
    <div class="my-6 pt-20 mx-auto w-full text-center sm:w-1/2 flex flex-col p-5 rounded-lg shadow-md bg-white">
        <h1>Application Submitted Successfully!</h1> <br>
        <p class="text-center">Reference Number <br>
            <span class="text-green-700 text-2xl font-bold">
                {{ request()->query('referenceNumber') }}
            </span>
        </p>
        

        <div class="mt-10 flex justify-end p-4">
            <a href="/dash" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                Go to Dashboard
            </a>
        </div>
    </div>
    
</x-accredit-steps>