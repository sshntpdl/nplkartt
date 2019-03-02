@extends('layouts.app')
@section('content')
<h2 class="pl-4 pt-4" style="margin-top:-2.5em;background:#418000;width:100%;color:white;"><strong>Contact</strong></h2><br>
    <div class="container">
        <div class="row p-3 shadow" style="width:100%;border-radius:15px;background-color:white;">
            <h2><strong>Contact Us</strong></h2>
            <div class="row ml-1 p-2 " style="width:100%;">
                <div class="col-xs-12 col-sm-12 col-md-5 col-ls-5 ml-2">
                   <div class="row p-1"  style="width:100%;">
                       <div class="col-4"><h5>Address :</h5></div>
                       <div class="col-6 ml-2"> Kathmandu,Nepal </div>
                    </div>
                   <div class="row p-1">
                        <div class="col-4"><h5>Email :</h5></div>
                        <div class="col-6"> vasma@gmail.com </div>
                   </div>
                   <div class="row p-1">
                        <div class="col-4"><h5>Phone :</h5></div>
                        <div class="col-6"> 123456789</div>
                   </div>
                   <div class="row p-2 mt-3">
                    <div class="row ml-2" style="width:100%;color:rgba(0,0,0,0.6);"><h3><strong>Follow Us On:</strong></h3></div>
                    <div class="row ml-3 mt-1">
                            <div class="m-1 socialMedia" data-feather="facebook" style="height:35px;width:35px;padding:3px;border-radius:12px;"></div>
                            <div class="m-1 socialMedia" data-feather="twitter" style="height:35px;width:35px;padding:3px;border-radius:12px;"></div>
                            <div class="m-1 socialMedia" data-feather="instagram" style="height:35px;width:35px;padding:4px;border-radius:12px;"></div>
                            <div class="m-1 socialMedia" data-feather="linkedin" style="height:35px;width:35px;padding:4px;border-radius:12px;"></div>
                    </div>
                   </div>
                </div>
                {{-- Green Column Started --}}
                <div class="col-xs-12 col-sm-12 col-md-6 col-ls-6 ml-1 p-3" style="border-radius:15px;background-color:#418000;color:white;">
                    <form action="" class="contactForm">
                    <div class="row d-flex justify-content-center"><h3><strong>Contact Now</strong></h3></div>
                    <div class="row p-1">
                        <div class="form-group contactForm p-2 mt-3 ml-3 mr-4" style="width:100%;">
                            <label for="yourName"><h5><strong>Your Name (required)</strong></h5></label>
                            <input type="text" class="form-control contactFormInput" id="name" required>
                        </div>
                    </div>
                    <div class="row p-1">
                            <div class="form-group contactForm p-2 mt-1 ml-3 mr-4" style="width:100%;">
                                <label for="yourName"><h5><strong>Your Email (required)</strong></h5></label>
                                <input type="text" class="form-control contactFormInput" id="name" required>
                            </div>
                    </div>
                    <div class="row p-1">
                            <div class="form-group contactForm p-2 mt-1 ml-3 mr-4" style="width:100%;">
                                <label for="yourName"><h5><strong>Subject</strong></h5></label>
                                <input type="text" class="form-control contactFormInput" id="name" required>
                            </div>
                    </div>
                    <div class="row p-1">
                            <div class="form-group contactForm p-2 mt-1 ml-3 mr-4" style="width:100%;">
                                <label for="yourName"><h5><strong>Your Message</strong></h5></label>
                                <input type="textarea" class="form-control contactFormInput" id="name" required>
                            </div>
                    </div>
                    <div class="row p-1">
                            <div class="form-group contactForm p-2 mt-1 ml-3 mr-4" style="width:100%;">
                                <button class="btn " type="submit" style="background-color:whitesmoke;border-radius:25px;color:yellowgreen;width:25%;padding:15px;font-size:1.3em;"><strong>Send</strong></button>
                            </div>
                    </div>
                   </form> 
                </div>
            </div>
        </div>
    </div>
@endsection