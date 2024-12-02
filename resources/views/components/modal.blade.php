{{-- pop up container --}}

<div {{ $attributes->merge([
    'class' => 'fixed z-50 inset-0 bg-gray-900 content-center bg-opacity-60 overflow-y-auto h-full w-full px-4'
]) }}>

     
    <div class="relative m-auto shadow-xl rounded-md bg-white w-4/5">
 
         <div class="flex justify-end p-2">
             {{ $closebtnSlot }}
         </div>
 
        <div class="p-6 pt-0">
            {{ $slot }}
        </div>
 
     </div>
 </div>
 