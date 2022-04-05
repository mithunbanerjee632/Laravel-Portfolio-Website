@extends('Layout.app')
@section('title','Contact')
@section('content')

    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4  text-center">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid jumbotron mt-5 ">
        <div class="row">
                    <div class="col-md-6">
                        <div  class="mapstyle">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.824337284384!2d90.35778151478416!3d23.753642784587726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf5c7d2ad32d%3A0x4ad0ef1f2366fe9e!2zS2FkZXJhYmFkIEhvdXNpbmcgU29jaWV0eSDgppXgpr7gpqbgp4fgprDgpr7gpqzgpr7gpqYg4Ka54Ka-4KaJ4Kac4Ka_4KaCIOCmuOCni-CmuOCmvuCmh-Cmn-Cmvw!5e0!3m2!1sen!2sbd!4v1649189825126!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-md-6 contact-form">
                        <h3 class="service-card-title">ঠিকানা</h3>
                        <hr>
                        <p class="footer-text"><i class="fas fa-map-marker-alt"></i> কাদেরাবাদ হাউজিং, মোহাম্মদপুর, ঢাকা  <i class="fas ml-2 fa-phone"></i> ০১৭১৩৫৭৪৮৬৯  <i class="fas ml-2 fa-envelope"></i> mithunbanerjee632@gmail.com</p>
                        <br>


                        <h5 class="service-card-title">যোগাযোগ করুন </h5>
                        <div class="form-group ">
                            <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম লিখুন">
                        </div>
                        <div class="form-group">
                            <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং লিখুন">
                        </div>
                        <div class="form-group">
                            <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল লিখুন ">
                        </div>
                        <div class="form-group">
                            <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ লিখুন">
                        </div>
                        <button id="contactSendBtnId" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
                    </div>

            </div>
        </div>


    {{--<div class="container">
        <div class="row">
            <div  class="col-md-7">
                <div  class="mapstyle">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.824337284384!2d90.35778151478416!3d23.753642784587726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf5c7d2ad32d%3A0x4ad0ef1f2366fe9e!2zS2FkZXJhYmFkIEhvdXNpbmcgU29jaWV0eSDgppXgpr7gpqbgp4fgprDgpr7gpqzgpr7gpqYg4Ka54Ka-4KaJ4Kac4Ka_4KaCIOCmuOCni-CmuOCmvuCmh-Cmn-Cmvw!5e0!3m2!1sen!2sbd!4v1649189825126!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>


            <div class="col-md-5  contact-form ">

                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> কাদেরাবাদ হাউজিং, মোহাম্মদপুর, ঢাকা  <i class="fas ml-2 fa-phone"></i> ০১৭১৩৫৭৪৮৬৯  <i class="fas ml-2 fa-envelope"></i> mithunbanerjee632@gmail.com</p>
                <br>


                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম লিখুন">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং লিখুন">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল লিখুন ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ লিখুন">
                </div>
                <button id="contactSendBtnId" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>

            </div>

    </div>

--}}
@endsection

