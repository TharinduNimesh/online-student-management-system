const toggleSideBar = () => {
    const sidebar = document.querySelector('#sidebar');
    const status = sidebar.dataset.status;
    if(status == 'visible') {
        sidebar.dataset.status = 'hidden';
        sidebar.classList.add('nav-bar-show');
    } else {
        sidebar.dataset.status = 'visible';
        sidebar.classList.remove('nav-bar-show');
        sidebar.classList.remove('nav-bar-lg-show');
    }
}

const updateActiveMenu = currentItem => {
    const items = document.querySelectorAll('.nav-item');
    items.forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector(`#${currentItem}`).classList.add('active');
}