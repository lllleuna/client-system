{{-- Send Message --}}
<div x-data="{ 
    isOpen: false, 
    newMessage: '', 
    messages: [
        { type: 'received', text: 'Hello! How can we help you today?' }
    ],
    sendMessage() {
        if (this.newMessage.trim()) {
            console.log('Sending message:', this.newMessage); // Debug log
            this.messages.push({ type: 'sent', text: this.newMessage.trim() });
            const sentMessage = this.newMessage;
            this.newMessage = '';
            
            // Scroll to bottom after sending
            this.$nextTick(() => {
                const container = document.querySelector('.messages-container');
                container.scrollTop = container.scrollHeight;
            });

            // Simulate OTC response
            setTimeout(() => {
                this.messages.push({ 
                    type: 'received', 
                    text: 'Thanks for your message! This is a simulated response for testing purposes.' 
                });
                // Scroll to bottom after response
                this.$nextTick(() => {
                    const container = document.querySelector('.messages-container');
                    container.scrollTop = container.scrollHeight;
                });
            }, 1000);
        }
    }
}" class="relative">
    <!-- Modified Send Message button to toggle the messenger -->
    <button 
        @click="isOpen = !isOpen" 
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition"
    >
        Send Message
    </button>

    <!-- Messenger Dialog -->
    <div 
        x-show="isOpen" 
        @click.away="isOpen = false"
        class="fixed bottom-4 right-4 w-96 h-[500px] bg-white rounded-lg shadow-xl flex flex-col z-50"
        style="display: none;"
    >
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b bg-white">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/otc-logo.png') }}" alt="OTC Logo" class="h-8 w-8 rounded-full">
                <div>
                    <h3 class="font-semibold text-gray-800">OTC Support</h3>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <p class="text-sm text-gray-500">Active now</p>
                    </div>
                </div>
            </div>
            <button @click="isOpen = false" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Container -->
        <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50 messages-container">
            <template x-for="(message, index) in messages" :key="index">
                <div>
                    <!-- OTC message -->
                    <template x-if="message.type === 'received'">
                        <div class="flex items-start space-x-2 mb-4">
                            <img src="{{ asset('images/otc-logo.png') }}" alt="OTC" class="h-8 w-8 rounded-full">
                            <div class="bg-white rounded-lg p-3 max-w-[80%] shadow-sm">
                                <p class="text-gray-800" x-text="message.text"></p>
                            </div>
                        </div>
                    </template>
                    
                    <!-- User message -->
                    <template x-if="message.type === 'sent'">
                        <div class="flex items-start justify-end space-x-2 mb-4">
                            <div class="bg-blue-600 rounded-lg p-3 max-w-[80%] shadow-sm">
                                <p class="text-white" x-text="message.text"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <!-- Message Input -->
        <div class="border-t p-4 bg-white">
            <form class="flex items-center space-x-2" @submit.prevent="sendMessage()">
                <input 
                    type="text"
                    x-model="newMessage"
                    placeholder="Type a message..."
                    class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:border-blue-500 text-gray-800 bg-white"
                >
                <button 
                    type="submit"
                    class="bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>