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

const login = (path) => {
    // get email and password
    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;
    const message = document.querySelector('#error-message');
    message.classList.add('d-none');

    // validte email and password
    if(!email.trim() || !password.trim()) {
        message.innerHTML = 'Please Enter Email and Password';
        message.classList.remove('d-none');
        return; 
    }

    // send data to server
    const data = {
        email,
        password
    };
    fetch(path, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="_csrf"]').getAttribute('content')
        }
    }).then(res => res.json())
    .then(res => {
        // check if the user is logged in
        if(res.status === 'success') {
            window.location.href = '/' + res.role + '/dashboard';
        } else {
            message.innerHTML = "Invalid Login Credentials";
            message.classList.remove('d-none');
        }
    });
}