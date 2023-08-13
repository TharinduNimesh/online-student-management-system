const toggleSideBar = () => {
    const layer = document.querySelector('#layer');
    const sidebar = document.querySelector('#sidebar');
    const screen_width = window.innerWidth;
    const status = sidebar.dataset.status;
    if(status == 'visible') {
        sidebar.dataset.status = 'hidden';
        sidebar.classList.add('d-none');
        layer.classList.add('d-none');
    } else {
        sidebar.dataset.status = 'visible';
        sidebar.classList.remove('d-none');
        
        if (screen_width < 992) {
            layer.classList.remove('d-none');
        }
    }
}