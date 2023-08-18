const toggleSideBar = () => {
    // get sidebar element
    const sidebar = document.querySelector("#sidebar");
    const status = sidebar.dataset.status;

    // toggle sidebar
    if (status == "visible") {
        sidebar.dataset.status = "hidden";
        sidebar.classList.add("nav-bar-show");
    } else {
        sidebar.dataset.status = "visible";
        sidebar.classList.remove("nav-bar-show");
        sidebar.classList.remove("nav-bar-lg-show");
    }
};

const updateActiveMenu = (currentItem) => {
    // remove active class from all menu items
    const items = document.querySelectorAll(".nav-item");
    items.forEach((item) => {
        item.classList.remove("active");
    });

    // add active class to current menu item
    document.querySelector(`#${currentItem}`).classList.add("active");
};

const login = (path) => {
    // get email and password
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;
    const message = document.querySelector("#error-message");
    message.classList.add("d-none");

    // validte email and password
    if (!email.trim() || !password.trim()) {
        message.innerHTML = "Please Enter Email and Password";
        message.classList.remove("d-none");
        return;
    }

    // send data to server
    const data = {
        email,
        password,
    };
    fetch(path, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="_csrf"]')
                .getAttribute("content"),
        },
    })
        .then((res) => res.json())
        .then((res) => {
            // check if the user is logged in
            if (res.status === "success") {
                window.location.href = "/" + res.role + "/dashboard";
            } else {
                message.innerHTML = "Invalid Login Credentials";
                message.classList.remove("d-none");
            }
        });
};

const addStudent = (path) => {
    const form = document.querySelector("#add_student_form");

    // validate form inputs, select
    let isValid = true;
    const inputs = form.querySelectorAll("input, select");
    inputs.forEach((input) => {
        if (!input.value.trim()) {
            input.classList.add("is-invalid");
            isValid = false;
        } else {
            input.classList.remove("is-invalid");
        }
    });

    if (isValid) {
        const data = {
            name: form.name.value,
            email: form.email.value,
            mobile: form.mobile.value,
            dob: form.dob.value,
            city: form.city.value,
            gender: form.gender.value,
        };
        // use fetch and send data to server
        fetch(path, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="_csrf"]')
                    .getAttribute("content"),
            },
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.status === "success") {
                    form.reset();
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Student Added Successfully",
                    });
                } else {
                    // already exist with given email
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "An User Already Exist with given Email",
                    });
                }
            });
    } else {
        // error message
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please fill all the fields",
        });
    }
};

const setPassword = (path) => {
    const form = document.querySelector("#set_password_form");
    const inputs = form.querySelectorAll("input");
    const message = document.querySelector("#error-message");
    message.classList.add("d-none");

    // validate form inputs
    let isValid = true;
    inputs.forEach((input) => {
        if (!input.value.trim()) {
            input.classList.add("is-invalid");
            isValid = false;
        } else {
            input.classList.remove("is-invalid");
        }
    });

    if (isValid) {
        // validate password
        if (!validatePassword(form.password.value)) {
            form.password.classList.add("is-invalid");
            message.innerHTML = "Password must be strong";
            message.classList.remove("d-none");
            return;
        }
        form.password.classList.remove("is-invalid");

        // send data to server
        const data = {
            name: form.name.value,
            email: form.email.value,
            role: form.role.value,
            password: form.password.value,
            id: form.id.value,
        };
        fetch(path, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="_csrf"]')
                    .getAttribute("content"),
            },
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.status === "success") {
                    window.location.href = "/login";
                } else {
                    message.innerHTML = "Something went wrong";
                    message.classList.remove("d-none");
                }
            });
    } else {
        message.innerHTML = "Please fill all the fields";
        message.classList.remove("d-none");
    }
};

const checkPassword = (input) => {
    if (validatePassword(input.value)) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
    } else {
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
    }
};

const validatePassword = (password) => {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(password);
};
