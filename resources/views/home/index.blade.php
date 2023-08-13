@extends('base')

@section('title', 'Welcome')

@section('content')
    {{-- header start --}}
    <div class="w-100 d-flex bg-dark px-3 header justify-content-between align-items-center">
        <div class="d-flex align-items-center h-100 gap-2 cursor-pointer">
            <img src="/img/logo.png" class="logo" />
            <h1 class="text-light">School<span class="text-primary">Plus</span></h1>
        </div>

        <div class="d-lg-flex d-none h-100 align-items-center mt-3">
            <ul>
                <a href="#">
                    <li class="active">Home</li>
                </a>
                <a href="#about">
                    <li>About</li>
                </a>
                <a href="#">
                    <li>Features</li>
                </a>
                <a href="#">
                    <li>Contact</li>
                </a>
                <a href="{{ route('login') }}" class="btn btn-danger mx-4">Get Started</a>
            </ul>
        </div>

        <div class="d-lg-none d-flex justify-content-center align-items-center sider-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    {{-- header end --}}

    <div class="container-fluid p-0" style="margin-top: 80px">
        {{-- Hero start --}}
        <div class="hero" id="home">
            <div class="layer"></div>
            <div class="row h-100 content">
                <div
                    class="col-10 offset-1 offset-lg-0 text-center text-lg-left col-lg-6 h-100 d-flex flex-column justify-content-center px-5 text-light">
                    <h1 class="text-primary">Seamless Education Beyond Boundaries :
                    </h1>
                    <h2>Adapting, Evolving, Excelling.</h2>
                    <p>Experience limitless learning with our student management system. Seamlessly adapt to virtual
                        classrooms,
                        evolve your skills, and excel in your education journey. Break free from boundaries and unlock your
                        potential for success.</p>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="{{ route('login') }}" class="btn btn-danger px-5">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-flex flex-column col-lg-6 h-100 student align-items-center">
                    <img src="/img/home/question.gif" class="position-absolute question" />
                    <img src="/img/home/student.png" class="position-absolute bottom-0 boy" />
                </div>
            </div>
        </div>
        {{-- Hero End --}}

        {{-- About Start --}}
        <div class="about w-100 bg-dark pb-5" id="about">
            <div class="heading">
                <div class="main-heading">
                    <h1>About</h1>
                </div>
                <div class="sub-heading">
                    <h2>who are we <span class="text-primary">?</span> </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 px-4 px-md-5 mt-4 text-light order-2 order-lg-1">
                    <p class="font-italic">At SchoolPlus, we understand the importance of education even in the face of
                        challenging
                        circumstances. As an online student management system, our platform aims to bridge the gap between
                        traditional learning environments and the new normal imposed by the pandemic.</p>

                    <h4 class="text-decoration-underline mt-4">Our Mission</h4>
                    <p class="mb-4">
                        During the pandemic, the need for a reliable online education platform became more apparent than
                        ever.
                        Recognizing this need, we embarked on a mission to create a comprehensive student management system
                        that
                        would seamlessly enable educational institutions to continue their operations, regardless of
                        physical
                        limitations.
                    </p>
                    <hr>
                </div>
                <div class="col-12 col-lg-6 px-3 px-md-5 mt-4 order-1 order-lg-2">
                    <img src="/img/home/about.avif" style="width: 100%" />
                </div>
            </div>
            {{-- Overview Start --}}
            <div class="heading">
                <div class="main-heading">
                    <h1>Overview</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 px-4 px-md-5 mt-4 text-light order-2">
                    <h3 class="text-primary">Join Us in Redefining Education</h3>
                    <p class="font-italic">At schoolPlus, we're proud to share the incredible growth of our student
                        management system community. Our platform has rapidly gained traction, and the numbers speak for
                        themselves:</p>

                    <ul>
                        <li class="my-2"><strong>Over 1,000,000 Students:</strong> We've touched the lives of over a
                            million students globally, providing them with a seamless platform for effective learning
                            management.</li>
                        <li class="my-2"><strong>Dedicated Teachers:</strong> Our platform is trusted by more than 50,000
                            teachers who rely on schoolPlus to enhance their teaching experience and connect with their
                            students effortlessly.</li>
                        <li class="my-2"><strong>98% User Satisfaction:</strong> With a remarkable 98% user satisfaction
                            rate, our commitment to excellence reflects in every interaction, making schoolPlus a trusted
                            choice among educators, students, and parents alike.</li>
                        <li class="my-2"><strong>Government-Approved Solution:</strong> The Sri Lankan government has
                            officially recognized the quality and impact of our student management system. This endorsement
                            solidifies our position as a reliable and innovative education solution provider.</li>
                    </ul>
                    <hr>
                    <p class="font-italic mt-3">At schoolPlus, we're more than just numbers - we're a passionate team
                        committed to shaping the future of education. Join us on this journey as we continue to empower
                        educators, inspire students, and foster a culture of growth and excellence.</p>
                </div>
                <div class="col-12 col-lg-6 px-3 px-md-5 mt-4 order-1">
                    <img src="/img/home/overview.jpg" style="width: 100%" />
                </div>
            </div>
            {{-- Overview End --}}
        </div>
        {{-- About End --}}

        {{-- Features Start --}}
        <div class="features w-100 bg-dark pb-5">
            <div class="heading">
                <div class="main-heading">
                    <h1>Features</h1>
                </div>
                <div class="sub-heading">
                    <h2>What Can We Do <span class="text-primary">?</span> </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row features-container gap-4 px-3">
                        <div class="feature-box position-relative">
                            <div class="row d-flex justify-content-center py-4">
                                <div class="icon-box">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="row content text-center px-3">
                                <h4>Student Management</h4>
                                <p class="text-light mt-3">Simplify enrollment, track attendance, centralize records, and
                                    promote positive behavior tracking. Enhance student engagement, academic transparency,
                                    and a conducive learning environment.</p>
                            </div>
                            <div class="w-100 position-absolute d-flex justify-content-center bottom-0 pb-4">
                                <button class="btn btn-danger">Learn More</button>
                            </div>
                        </div>

                        <div class="feature-box position-relative">
                            <div class="row d-flex justify-content-center py-4">
                                <div class="icon-box">
                                    <i class="fa-solid fa-person-chalkboard"></i>
                                </div>
                            </div>
                            <div class="row content text-center px-3">
                                <h4>Teacher Management</h4>
                                <p class="text-light mt-3">Efficiently manage teacher profiles, assign classes, facilitate
                                    communication, and access performance insights, enabling educators to focus on impactful
                                    teaching and nurturing students' growth.</p>
                            </div>
                            <div class="w-100 position-absolute d-flex justify-content-center bottom-0 pb-4">
                                <button class="btn btn-danger">Learn More</button>
                            </div>
                        </div>

                        <div class="feature-box position-relative">
                            <div class="row d-flex justify-content-center py-4">
                                <div class="icon-box">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                </div>
                            </div>
                            <div class="row content text-center px-3">
                                <h4>Assignment Management</h4>
                                <p class="text-light mt-3">Create assignments, track submissions, employ a user-friendly
                                    grading system, and foster effective feedback exchange, optimizing teaching efficiency
                                    and students' learning experiences.</p>
                            </div>
                            <div class="w-100 position-absolute d-flex justify-content-center bottom-0 pb-4">
                                <button class="btn btn-danger">Learn More</button>
                            </div>
                        </div>

                        <div class="feature-box position-relative">
                            <div class="row d-flex justify-content-center py-4">
                                <div class="icon-box">
                                    <i class="fa-solid fa-chart-area"></i>
                                </div>
                            </div>
                            <div class="row content text-center px-3">
                                <h4>Marks Controllling</h4>
                                <p class="text-light mt-3">Automate accurate grade calculation, visualize performance
                                    insights, generate comprehensive reports, and individualize progress tracking. Empower
                                    informed decision-making and personalized educational support.</p>
                            </div>
                            <div class="w-100 position-absolute d-flex justify-content-center bottom-0 pb-4">
                                <button class="btn btn-danger">Learn More</button>
                            </div>
                        </div>

                        <div class="feature-box position-relative">
                            <div class="row d-flex justify-content-center py-4">
                                <div class="icon-box">
                                    <i class="fa-regular fa-note-sticky"></i>
                                </div>
                            </div>
                            <div class="row content text-center px-3">
                                <h4>Lesson Notes Management</h4>
                                <p class="text-light mt-3">Effortlessly create and organize lesson notes, facilitating
                                    seamless sharing with students. Enhance teaching effectiveness and student learning by
                                    providing accessible, structured learning materials.</p>
                            </div>
                            <div class="w-100 position-absolute d-flex justify-content-center bottom-0 pb-4">
                                <button class="btn btn-danger">Learn More</button>
                            </div>
                        </div>

                        <div class="feature-box position-relative">
                            <div class="row d-flex justify-content-center py-4">
                                <div class="icon-box">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </div>
                            </div>
                            <div class="row content text-center px-3">
                                <h4>Data Security</h4>
                                <p class="text-light mt-3">Implement robust user authentication, role-based access control,
                                    encryption measures, and regular data backups. Ensure data confidentiality, integrity,
                                    and system reliability, safeguarding sensitive educational information.</p>
                            </div>
                            <div class="w-100 position-absolute d-flex justify-content-center bottom-0 pb-4">
                                <button class="btn btn-danger">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Features End --}}

        {{-- Footer Start --}}
        <div class="footer row">
            <div class="col-12 bg-black">
                <div class="row px-2 py-3 px-lg-4">
                    <div class="col-12 col-md-6 mb-5 mb-lg-0">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="/img/logo.png" style="width: 90px;" />
                            <h3 class="text-light">School<span class="text-primary">Plus</span></h3>
                        </div>
                        <p class="text-light font-italic">
                            <span class="text-primary" style="font-size: 20px">E</span>xperience limitless learning with our student management system. Seamlessly adapt to virtual
                            classrooms,
                            evolve your skills, and excel in your education journey. Break free from boundaries and unlock
                            your
                            potential for success.
                        </p>
                        <div class="row px-5">
                            <div class="col-12 text-light">
                                <p>
                                    <strong>Address :</strong>
                                    693/3, Gonawala Road, <br>
                                    Kelaniya, Sri Lanka.
                                </p>
                                <p>
                                    <strong>Phone :</strong>
                                    +94 77 111 2223 <br>
                                    +94 77 111 2224
                                </p>
                                <p>
                                    <strong>Email :</strong>
                                    tharindunimesh.abc@gmail.com<br>
                                    tharindunimesh@eversoft.cf
                                </p>
                            </div>
                        </div>
                        <div class="row social">
                            <div class="col-12 d-flex flex-row justify-content-center gap-3">
                                <div class="social-box">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </div>
                                <div class="social-box">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div class="social-box">
                                    <i class="fa-brands fa-instagram"></i>
                                </div>
                                <div class="social-box">
                                    <i class="fa-brands fa-threads"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-2 contact-form">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <h3 class="text-light text-center">CONTACT US</h3>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 mt-2">
                                <label class="text-light mx-2">Full Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                                <label class="text-light mx-2">Mobile</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="text-light mx-2">Email</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="text-light mx-2">Message</label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button class="btn btn-danger">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center text-light bg-dark py-2">
                &copy; {{ Date('Y') }} Copyright By <strong>Tharindu Nimesh</strong>. All Rights Reserved
            </div>
        </div>
        {{-- Footer End --}}
    </div>
@endsection
