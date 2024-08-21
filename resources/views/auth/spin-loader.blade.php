<style>
    /* Preloader styles */
    #spin-loader {
        display: none;
        /* Initially hidden */
        z-index: 9999;
    }

    #spin-loader .animate-spin {
        border-top-color: transparent;
        border-left-color: transparent;
        border-bottom-color: transparent;
        border-right-color: #3490dc;
        border-width: 4px;
        border-style: solid;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div id="spin-loader" class="fixed inset-0 flex items-center justify-center bg-gray-200 bg-opacity-75 z-50 hidden">
    <div class="flex items-center justify-center space-x-2">
        <div class="w-12 h-12 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
        <span class="text-gray-600">Loading...</span>
    </div>
</div>
