<div class="relative bg-{{ $type === 'success' ? 'green-100' : ($type === 'error' ? 'red-100' : 'yellow-100') }} border-{{ $type === 'success' ? 'green-400' : ($type === 'error' ? 'red-400' : 'yellow-400') }} text-{{ $type === 'success' ? 'green-700' : ($type === 'error' ? 'red-700' : 'yellow-700') }} px-4 py-3 rounded-lg shadow-md" role="alert">
    <span class="block sm:inline">{{ $message }}</span>
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none focus:ring" aria-label="Close" onclick="this.parentElement.style.display='none'">
        <svg class="fill-current h-6 w-6 text-{{ $type === 'success' ? 'green-700' : ($type === 'error' ? 'red-700' : 'yellow-700') }}" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414 7.066 14.35a1 1 0 11-1.415-1.415L8.586 10 5.651 7.066a1 1 0 011.415-1.415L10 8.586l2.935-2.935a1 1 0 011.415 1.415L11.414 10l2.935 2.935a1 1 0 010 1.414z"/>
        </svg>
    </button>
</div>
