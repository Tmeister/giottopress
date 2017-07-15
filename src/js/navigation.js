(function () {
    'use strict';
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Ready');
        // Get all "nav-burger" elements
        console.log(document.querySelectorAll('.nav-burger'));
        const $navBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        // Check if there are any nav burgers
        console.log($navBurgers);
        if ($navBurgers.length > 0) {
            // Add a click event on each of them
            $navBurgers.forEach(function ($el) {
                $el.addEventListener('click', () => {
                    // Get the target from the "data-target" attribute
                    let target = $el.dataset.target;
                    let $target = document.getElementById(target);
                    // Toggle the class on both the "nav-burger" and the "nav-menu"
                    $el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }
    });
})();