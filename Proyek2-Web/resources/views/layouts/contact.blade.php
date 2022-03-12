@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

<section class="contact pb-5">
    <ol class="arrows">
        <li><a href="/"><i class="bi bi-house-fill"></i> Home</a></li>
        <li><a href="/contact">Kontak</a></li>
     </ol>
    <div class="form-send mx-5 mt-5">
        <div class="container">
            <div class="row align-content-center ">
                <div class="col px-md-5 ">
                    
                    <h2>Contact Us</h2>
                    <p>Have any question or feedback ? <i class="bi bi-emoji-smile"></i></p>
                    @if(Session::has('status'))
                    <div class="alert alert-success">{{ Session::get('status') }}</div>
                    @endif

                    <form action="" method="post">

                        {{ csrf_field() }}

                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="*" />

                        <label for="email" class="mt-3">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="*@gmail.com" />

                        <label for="message" class="mt-3">Message</label>
                        <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>

                        <button class="btn btn-submit  btn-block mt-3 ">Send <i class="bi bi-forward-fill"></i></button>
                        <form>
                </div>
                <div class="col px-md-5 mt-5">
                    <p><i class="i bi-envelope"> KeramikKinasih@example.com</p></i>
                    <p><i class="bi bi-whatsapp"> 0812-4935-9661</p></i>
                    <p><i class="bi bi-building"> Sen - Sab: 07.00–16.00, Min: Tutup</i></p>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3300.3505563377253!2d113.21579958738518!3d-7.764241189367251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ada01be8124d%3A0x431febfaab7ed747!2sKeramik%20Kinasih!5e0!3m2!1sid!2sus!4v1631588785851!5m2!1sid!2sus"
                        width="550" height="340" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')
@endsection