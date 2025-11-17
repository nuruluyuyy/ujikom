<!-- Share Modal -->
<div id="shareModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 id="shareModalTitle" class="text-xl font-bold text-gray-800">Bagikan</h3>
                <button onclick="closeShareModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tautan</label>
                <div class="flex">
                    <input type="text" id="shareLink" 
                        class="flex-1 rounded-l-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        readonly>
                    <button onclick="copyToClipboard()" 
                            class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition-colors">
                        Salin
                    </button>
                </div>
                <p id="copyStatus" class="text-sm text-green-600 mt-1 hidden">Tautan berhasil disalin!</p>
            </div>
            
            <div class="mb-6">
                <p class="text-sm font-medium text-gray-700 mb-3">Bagikan ke</p>
                <div class="flex space-x-4">
                    <button onclick="shareOnSocial('whatsapp')" 
                            class="flex-1 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </button>
                    <button onclick="shareOnSocial('facebook')" 
                            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fab fa-facebook-f mr-2"></i> Facebook
                    </button>
                    <button onclick="shareOnSocial('twitter')" 
                            class="flex-1 bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                        <i class="fab fa-twitter mr-2"></i> Twitter
                    </button>
                </div>
            </div>
            
            <div class="text-center">
                <p class="text-sm text-gray-600 mb-2">Atau scan QR Code</p>
                <div id="qrcode" class="flex justify-center mb-4"></div>
            </div>
        </div>
    </div>
</div>
