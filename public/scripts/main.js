const toggleSideBar = () => {
    const sidebar = document.querySelector('#sidebar');
    const status = sidebar.dataset.status;
    if(status == 'visible') {
        sidebar.dataset.status = 'hidden';
        sidebar.classList.add('d-none');
    } else {
        sidebar.dataset.status = 'visible';
        sidebar.classList.remove('d-none');
    }
}

const updateActiveMenu = currentItem => {
    const items = document.querySelectorAll('.nav-item');
    items.forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector(`#${currentItem}`).classList.add('active');
}