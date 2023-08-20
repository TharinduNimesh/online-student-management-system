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
    const passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordRegex.test(password);
};

const showStudent = (Button) => {
    let id = Button.dataset.student;
    const modal = document.querySelector("#viewStudentModal");

    fetch(`/student/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="_csrf"]')
                .getAttribute("content"),
        },
    })
        .then((res) => res.json())
        .then((res) => {
            if (res.status == "success") {
                $("#viewStudentModal").modal("show");
                modal.querySelector("#name").value = res.student.name;
                modal.querySelector("#email").value = res.student.email;
                modal.querySelector("#mobile").value = res.student.mobile;
                modal.querySelector("#dob").value = res.student.date_of_birth;
                modal.querySelector("#city").value = res.student.city.name;
                modal.querySelector("#gender").value =
                    res.student.gender_id == 1 ? "Male" : "Female";

                // set grades details
                const table = modal.querySelector("#grades-body");
                const grades = res.student.grades;

                table.innerHTML = "";
                grades.forEach((grade) => {
                    const row = document.createElement("tr");

                    if (grade.has_paid == 1) {
                        var paid = "Yes";
                    } else {
                        var paid = "No";
                    }

                    row.innerHTML = `
                        <td>${grade.year}</td>
                        <td>${grade.grade}</td>
                        <td>${paid}</td>
                    `;
                    table.appendChild(row);
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        })
        .catch((err) => console.log(err));
};

const updateStudentGrade = (Button) => {
    // get student id
    let id = Button.dataset.student;

    $("#updateStudentGrade").modal("show");

    // submit form if user click on confirm button
    const modal = document.querySelector("#updateStudentGrade");
    modal.querySelector(".btn-danger").addEventListener("click", () => {
        $("#updateStudentGrade").modal("hide");
        // submit form
        document.getElementById("update-grade-form-" + id).submit();
    });
};

const showEditStudent = (Button) => {
    let id = Button.dataset.student;
    const modal = document.querySelector("#editStudentModal");

    fetch(`/student/${id}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="_csrf"]')
                .getAttribute("content"),
        },
    })
        .then((res) => res.json())
        .then((res) => {
            if (res.status == "success") {
                modal.querySelector("#name").value = res.student.name;
                modal.querySelector("#email").value = res.student.email;
                modal.querySelector("#mobile").value = res.student.mobile;
                modal.querySelector("#dob").value = res.student.date_of_birth;
                modal.querySelector("#update-grade-button").value = id;

                // submit update grade form
                modal.querySelector("#update-grade-button").addEventListener("click", () => {
                    document.getElementById("update-grade-form-" + id).submit();
                });

                modal.querySelector("#update-button").addEventListener("click", () => {
                    const data = {
                        name: modal.querySelector("#name").value,
                        email: modal.querySelector("#email").value,
                        mobile: modal.querySelector("#mobile").value,
                        dob: modal.querySelector("#dob").value,
                        id: id,
                    };

                    let isValid = true;

                    Object.values(data).forEach((item) => {
                        if(!item.trim()) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Please Fill All Fields",
                            });
                            isValid = false;
                        }
                    });

                    if(!isValid) {
                        return;
                    }

                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "/student/update", true);
                    xhr.setRequestHeader(
                        "Content-Type",
                        "application/json;charset=UTF-8"
                    );
                    xhr.setRequestHeader(
                        "X-CSRF-TOKEN",
                        document
                            .querySelector('meta[name="_csrf"]')
                            .getAttribute("content")
                    );
                    xhr.onload = function () {
                        if (this.status == 200) {
                            const res = JSON.parse(this.responseText);
                            if (res.status == "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Student updated successfully",
                                });
                                $("#editStudentModal").modal("hide");
                                location.reload();
                            } else if(res.status == "error") {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Student With This Email Already Exists",
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Internal Server Error",
                            });
                        }
                    }
                    xhr.send(JSON.stringify(data));
                });

                $("#editStudentModal").modal("show");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        })
        .catch((err) => console.log(err));
};

const removeStudent = (Button) => {
    let id = Button.dataset.student;
    const modal = document.querySelector("#removeStudentModal");

    modal.querySelector(".btn-danger").addEventListener("click", () => {
        $("#removeStudentModal").modal("hide");
        // submit form
        document.getElementById("remove-student-form-" + id).submit();
    });

    $("#removeStudentModal").modal("show");
}

const register = () => {
    const form = document.querySelector("#user-register-form");
    const message = document.querySelector("#error-message");
    message.classList.add("d-none");

    let isValid = true;
    form.querySelectorAll(".form-control").forEach((input) => {
        input.classList.remove("is-invalid");
        if (!input.value) {
            input.classList.add("is-invalid");
            isValid = false;
        }
    });

    if (!isValid) {
        message.innerHTML = "Please Fill All Fields";
        message.classList.remove("d-none");
        return;
    }

    if(!validatePassword(form.password.value)) {
        message.innerHTML = "Password must be at least 8 characters long and contain at least one number, one uppercase and one lowercase letter";
        message.classList.remove("d-none");
        return;
    }

    form.submit();
}

const addTeacher = () => {
    // get form and inputs
    const form = document.querySelector("#add-teacher-form");
    const inputs = form.querySelectorAll(".form-control");

    // validate inputs
    let isValid = true;
    inputs.forEach((input) => {
        input.classList.remove("is-invalid");
        if (!input.value) {
            input.classList.add("is-invalid");
            isValid = false;
        }
    });

    // check if all inputs are valid
    if (!isValid) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please Fill All Fields",
        });
        return;
    }

    // submit form
    form.submit();
}

const showTeacher = Button => {
    const teacher = Button.dataset.teacher;
    const modal = document.querySelector("#viewTeacherModal");

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/teacher/${teacher}`, true);
    xhr.onload = function () {
        if(xhr.status === 200) {
            const res = JSON.parse(this.responseText);
            if(res.status === "success") {
                const subjects_table = modal.querySelector("#subjects-body");
                if(res.teacher.gender_id == 1) {
                    var gender = 'Male';
                } else {
                    var gender = 'Female';
                }

                modal.querySelector("#name").value = res.teacher.name;
                modal.querySelector("#email").value = res.teacher.email;
                modal.querySelector("#mobile").value = res.teacher.mobile;
                modal.querySelector("#city").value = res.teacher.city.name;
                modal.querySelector("#gender").value = gender;

                const subjects = res.teacher.subjects;
                subjects_table.innerHTML = "";
                
                if (subjects.length > 0) {
                    subjects.forEach((subject, index) => {
                        subjects_table.innerHTML += `
                            <tr id='subject-row-${res.teacher.id}-${subject.id}'>
                                <td>${index + 1}</td>
                                <td>${subject.name}</td>
                                <td>
                                <button 
                                    class="btn btn-sm btn-danger" 
                                    onclick="removeSubjectFromTeacher(this)"
                                    data-teacher="${res.teacher.id}"
                                    data-subject="${subject.id}"    
                                >
                                    <i class="fa-solid fa-trash mx-2"></i>
                                </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    subjects_table.innerHTML = `
                        <tr>
                            <td colspan="3" class="bg-primary font-bold text-center">No Any Subjects Found</td>
                        </tr>
                    `;
                }

                const grades_table = modal.querySelector("#grades-body");
                const grades = res.teacher.grades;
                grades_table.innerHTML = "";

                if (grades.length > 0) {
                    grades.forEach((grade, index) => {
                        grades_table.innerHTML += `
                            <tr id='grade-row-${grade.id}'>
                                <td>${index + 1}</td>
                                <td>Grade - ${grade.grade}</td>
                                <td>
                                <button

                                    class="btn btn-sm btn-danger"
                                    onclick="removeGradeFromTeacher(this)"
                                    data-id="${grade.id}"
                                >
                                    <i class="fa-solid fa-trash mx-2"></i>
                                </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    grades_table.innerHTML = `
                        <tr>
                            <td colspan="3" class="bg-primary font-bold text-center">No Any Grades Found</td>
                        </tr>
                    `;
                }

                $("#viewTeacherModal").modal("show");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal Server Error",
            });
        }
    }
    xhr.send();
}

const removeSubjectFromTeacher = Button => {
    var xhr = new XMLHttpRequest();
    data = {
        teacher: Button.dataset.teacher,
        subject: Button.dataset.subject,
    };

    xhr.open("POST", `/teacher/remove-subject/`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="_csrf"]').getAttribute('content'));
    xhr.onload = function () {
        if(xhr.status === 200) {
            const res = JSON.parse(this.responseText);
            if(res.status === "success") {
                document.querySelector(`#subject-row-${data.teacher}-${data.subject}`).remove();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal Server Error",
            });
        }
    }
    xhr.send(JSON.stringify(data));
}

const removeGradeFromTeacher = Button => {
    var xhr = new XMLHttpRequest();
    data = {
        id: Button.dataset.id,
    };

    xhr.open("POST", `/teacher/remove-grade/`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="_csrf"]').getAttribute('content'));
    xhr.onload = function () {
        if(xhr.status === 200) {
            const res = JSON.parse(this.responseText);
            if(res.status === "success") {
                document.querySelector(`#grade-row-${data.id}`).remove();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal Server Error",
            });
        }
    }
    xhr.send(JSON.stringify(data));
}

const showTeacherToEdit = Button => {
    const teacher = Button.dataset.teacher;
    const modal = document.querySelector("#editTeacherModal");

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/teacher/${teacher}`, true);
    xhr.onload = function () {
        if(xhr.status === 200) {
            const res = JSON.parse(this.responseText);
            if(res.status === "success") {
                const subjects_table = modal.querySelector("#subjects-body");
                modal.querySelector("#id").value = res.teacher.id;
                modal.querySelector("#name").value = res.teacher.name;
                modal.querySelector("#mobile").value = res.teacher.mobile;

                const subjects = res.teacher.subjects;
                subjects_table.innerHTML = "";
                
                if (subjects.length > 0) {
                    subjects.forEach((subject, index) => {
                        subjects_table.innerHTML += `
                            <tr id='subject-row-${res.teacher.id}-${subject.id}'>
                                <td>${index + 1}</td>
                                <td>${subject.name}</td>
                                <td>
                                <button 
                                    class="btn btn-sm btn-danger" 
                                    onclick="removeSubjectFromTeacher(this)"
                                    data-teacher="${res.teacher.id}"
                                    data-subject="${subject.id}"    
                                >
                                    <i class="fa-solid fa-trash mx-2"></i>
                                </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    subjects_table.innerHTML = `
                        <tr>
                            <td colspan="3" class="bg-primary font-bold text-center">No Any Subjects Found</td>
                        </tr>
                    `;
                }

                const grades_table = modal.querySelector("#grades-body");
                const grades = res.teacher.grades;
                grades_table.innerHTML = "";

                if (grades.length > 0) {
                    grades.forEach((grade, index) => {
                        grades_table.innerHTML += `
                            <tr id='grade-row-${grade.id}'>
                                <td>${index + 1}</td>
                                <td>Grade - ${grade.grade}</td>
                                <td>
                                <button

                                    class="btn btn-sm btn-danger"
                                    onclick="removeGradeFromTeacher(this)"
                                    data-id="${grade.id}"
                                >
                                    <i class="fa-solid fa-trash mx-2"></i>
                                </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    grades_table.innerHTML = `
                        <tr>
                            <td colspan="3" class="bg-primary font-bold text-center">No Any Grades Found</td>
                        </tr>
                    `;
                }

                $("#editTeacherModal").modal("show");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal Server Error",
            });
        }
    }
    xhr.send();
};

const updateTeacher = () => {
    const form = document.querySelector("#update-teacher-form");
    const inputs = form.querySelectorAll("input");

    let isValid = true;
    inputs.forEach(input => {
        input.classList.remove("is-invalid");
        if(input.value.trim() === "") {
            input.classList.add("is-invalid");
            isValid = false;
        }
    });

    if(isValid) {
        form.submit();
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please fill all the fields!",
        });
    }
};

const addSubject = () => {
    const modal = document.querySelector("#editTeacherModal");
    const subject = modal.querySelector("#subject");

    if(!subject.value) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please Select A Subject!",
        });
        return;
    }

    const xhr = new XMLHttpRequest();
    const data = {
        teacher: modal.querySelector("#id").value,
        subject: subject.value,
    };
    xhr.open("POST", `/teacher/add-subject/`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="_csrf"]').getAttribute('content'));
    xhr.onload = function () {
        if(xhr.status === 200) {
            const res = JSON.parse(this.responseText);
            if(res.status === "success") {
                const subjects_table = modal.querySelector("#subjects-body");
                const subject = res.subjects;
                subjects_table.innerHTML = "";
                subject.forEach((subject, index) => {
                    subjects_table.innerHTML += `
                        <tr id='subject-row-${res.teacher}-${subject.id}'>
                            <td>${index + 1}</td>
                            <td>${subject.name}</td>
                            <td>
                            <button 
                                class="btn btn-sm btn-danger" 
                                onclick="removeSubjectFromTeacher(this)"
                                data-teacher="${data.teacher}"
                                data-subject="${subject.id}"    
                            >
                                <i class="fa-solid fa-trash mx-2"></i>
                            </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal Server Error",
            });
        }
    }
    xhr.send(JSON.stringify(data));
}

const addGrade = () => {
    const modal = document.querySelector("#editTeacherModal");
    const grade = modal.querySelector("#grade");

    if(!grade.value) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please Enter A Grade!",
        });
        return;
    } else {
        if(grade.value < 0 || grade.value > 14) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please Enter A Valid Grade!",
            });
            return;
        }
    }

    const xhr = new XMLHttpRequest();
    const data = {
        teacher: modal.querySelector("#id").value,
        grade: grade.value,
    };
    xhr.open("POST", `/teacher/add-grade/`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="_csrf"]').getAttribute('content'));
    xhr.onload = function () {
        if(xhr.status === 200) {
            const res = JSON.parse(this.responseText);
            if(res.status === "success") {
                const grades_table = modal.querySelector("#grades-body");
                const grades = res.grades;
                grades_table.innerHTML = "";
                Object.values(grades).forEach((grade, index) => {
                    grades_table.innerHTML += `
                        <tr id='grade-row-${grade.id}'>
                            <td>${index + 1}</td>
                            <td>Grade - ${grade.grade}</td>
                            <td>
                            <button

                                class="btn btn-sm btn-danger"
                                onclick="removeGradeFromTeacher(this)"
                                data-id="${grade.id}"
                            >
                                <i class="fa-solid fa-trash mx-2"></i>
                            </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal Server Error",
            });
        }
    }
    xhr.send(JSON.stringify(data));
};

const removeTeacher = id => {
    const modal = document.querySelector("#removeTeacherModal");
    $("#removeTeacherModal").modal("show");

    // get the currect form and submit it when the user confirm
    modal.querySelector(".btn-danger").onclick = () => {
        document.querySelector("#remove-form-" + id).submit();
    }
}

const uploadAssignment = () => {
    const form = document.querySelector("#assignment-form");
    const inputs = form.querySelectorAll(".form-control");

    let isValid = true;
    inputs.forEach(input => {
        input.classList.remove("is-invalid");
        if(input.value.trim() === "") {
            input.classList.add("is-invalid");
            isValid = false;
        }
    });

    if(isValid) {
        form.submit();
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please fill all the fields!",
        });
    }
};

const uploadNotes = () => {
    const form = document.querySelector("#note-form");
    const inputs = form.querySelectorAll(".form-control");

    let isValid = true;
    inputs.forEach(input => {
        input.classList.remove("is-invalid");
        if(input.value.trim() === "") {
            input.classList.add("is-invalid");
            isValid = false;
        }
    });

    if(isValid) {
        form.submit();
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please fill all the fields!",
        });
    }
};

const copyLink = (Button) => {
    // copy link to clipboard
    let link = Button.dataset.link;
    navigator.clipboard.writeText(link);
}

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});