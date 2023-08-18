<x-mail::message>
# Welcome To SchoolPlus

Dear {{ $data["name"] }},

Welcome to SchoolPlus! We are excited to have you join our educational community. An admin has successfully
registered your account, and you're just one step away from accessing all the resources and opportunities that
SchoolPlus has to offer.

To complete your account setup and verify your identity, please follow these steps:

1. __Visit the Registration Page__: Click on the link below to access the SchoolPlus registration page:

@php ($url = route('password.student', [
    'role' => $data['role'] , 
    'id' => $data['id']
]))
<x-mail::button :url="$url">
    Set Your Password
</x-mail::button>

2. __Set Your Password__: On the registration page, you will find an option to set your password. Click on the "Set
Password" or "Create Password" button and follow the prompts to choose a secure password for your account.

3. __Log In and Verify__: Once you have set your password, use your registered email address and the newly created password
to log in to your SchoolPlus account. After logging in, you'll be guided through a quick verification process to
ensure the security of your account.

Please keep your password safe and do not share it with anyone. If you ever need to reset your password in the
future, you can do so by clicking on the "Forgot Password" link on the login page.

If you encounter any difficulties while setting up your account, please feel free to reach out to our support team
at home page contact form. We are here to assist you every step of the way.

We are thrilled to have you as a part of the SchoolPlus community and can't wait to see you excel in your
educational journey. Thank you for choosing SchoolPlus for your learning needs.

Best regards,

Tharindu Nimesh <br>
Cheif Executive Officer <br>
SchoolPlus Team

<center> <b>Thank You !!!</b> </center>
</x-mail::message>
