(function() {
    function loadScript(src) {
        if (!document.querySelector('script[src="' + src + '"]')) {
            var s = document.createElement('script');
            s.src = src;
            s.async = true;
            document.head.appendChild(s);
        }
    }

    if (document.querySelectorAll("[toast-list]").length > 0) {
        loadScript("https://cdn.jsdelivr.net/npm/toastify-js");
    }
    if (document.querySelectorAll("[data-choices]").length > 0) {
        loadScript("/libs/choices.js/public/assets/scripts/choices.min.js");
    }
    if (document.querySelectorAll("[data-provider]").length > 0) {
        loadScript("/libs/flatpickr/flatpickr.min.js");
    }
})();