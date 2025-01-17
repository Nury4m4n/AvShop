document.addEventListener('DOMContentLoaded', function () {
    // // Dropdown Menu
    // const dropdownToggle = document.querySelector('.dropdown-toggle');
    // if (dropdownToggle) {
    //     const dropdownMenu = dropdownToggle.nextElementSibling;

    //     dropdownToggle.addEventListener('click', function (event) {
    //         event.preventDefault();
    //         dropdownMenu.classList.toggle('show');
    //     });

    //     document.addEventListener('click', function (event) {
    //         if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
    //             dropdownMenu.classList.remove('show');
    //         }
    //     });
    // }

    const menuBtn = document.getElementById('menu-btn');
    const menuBtnDesktop = document.getElementById('menu-btn-desktop');
    const sidebar = document.getElementById('sidebar');

    if (menuBtn) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    }

    if (menuBtnDesktop) {
        menuBtnDesktop.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    }
});
