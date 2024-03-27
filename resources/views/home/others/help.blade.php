@extends('layouts.home')

@section('body.content')
    <div class="col-md-9 col-lg-8 offset-lg-1">
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <!-- Help -->
            <h1 class="fw-bold">Help Center</h1>

            <div class="section mt-5">
                <p>Welcome to our Help Center! Whether you're a new user or looking for specific information, we're here to
                    assist you. Follow these steps to get started:</p>
            </div>

            <div class="section mt-5">
                <h2 class="fw-semibold text-primary">Frequently Asked Questions (FAQs)</h2>
                <ol>
                    <li>
                        How do I reset my password?
                        <ul>
                            <li>To reset your password, go to the login page and click on the "Forgot Password" link. Follow
                                the instructions sent to your registered email to set a new password.</li>
                        </ul>
                    </li>
                    <li>
                        Can I change my account information?
                        <ul>
                            <li>Yes, you can update your account information at any time. Navigate to the "Account Settings"
                                page after logging in to make changes.</li>
                        </ul>
                    </li>
                </ol>
            </div>

            <div class="section mt-5">
                <h2 class="fw-semibold text-primary">Contact Support</h2>
                <p>Our dedicated support team is ready to assist you. Reach out to us through the following channels:</p>
                <ul>
                    <li>Email: <a href="mailto:support@example.com">support@example.com</a></li>
                    <li>Phone: (123) 456-7890</li>
                    <li>Live Chat: Available on our website during business hours.</li>
                </ul>
                <p>We're committed to providing you with the best possible support and ensuring a seamless experience on our
                    platform. Thank you for choosing us!</p>
            </div>

        </div>
    </div>
@endsection
