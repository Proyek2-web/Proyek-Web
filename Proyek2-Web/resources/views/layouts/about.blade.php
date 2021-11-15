@extends('master.mainWeb')
@include('layouts.navbar')
@section('body')

<section class="about">
    <div class="ud p-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="title col-lg-12 mx-auto">
                <h1>About Us</h1>
            </div>
            <div class="content" style="margin-top: 90px">
                <div class="company row align-items-center">
                    <div class="col-lg-5">
                        <img src="https://lh3.googleusercontent.com/-eqR1M0D3aUQ/WPhMXRb8b2I/AAAAAAAAPY8/E3Pv7bxN9RIQzcV7HCApr-pq0pwv_IrbQCLIB/w960-h960-n-o-k-v1/" alt=""
                            width="480">
                    </div>
                    <div class="col-lg-7">
                        <h2>UD.Keramik Kinasih</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias quaerat vero nihil ut!
                            Sint
                            error dolores quasi. Libero deserunt illum a accusantium aliquid impedit rem eum nostrum
                            odio
                            quos pariatur iste quam reiciendis ratione quia officia possimus explicabo eveniet,
                            laboriosam
                            id dolorem. Vitae reprehenderit nihil voluptates distinctio est laboriosam reiciendis! Lorem
                            ipsum dolor sit, amet consectetur adipisicing elit. Distinctio sint libero quas cupiditate
                            odit
                            explicabo error quibusdam iure voluptate aliquid facere ipsum ab enim in eveniet, dolorem,
                            ea
                            illo blanditiis et. Illo soluta assumenda possimus id minima? Et obcaecati quis minima nobis
                            amet impedit aut totam ea saepe quam? Esse.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="background-color: #dddddd; padding-block: 180px">
        <div class="container">
            <div class="row align-items-center" >
                <div class="col-lg-7" >
                    <h2>How Our Products
                        <br> Are Made</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem sunt corporis similique quis
                        dicta quas eius dignissimos odio nobis aspernatur?</p>
                </div>
                <div class="col-lg-5">
                    <div id="slideshow">
                        <div>
                            <img src="https://3.bp.blogspot.com/-Yi4GKHAVwqI/VvUG0_r6p6I/AAAAAAAAjsk/NnpfWz5YJo4YNBjNTJRVPvJ95dzTD7WRA/s640/CendanaNewsMalangAgusNurchaliq2.jpg" width="480" height="480">
                        </div>
                        <div>
                            <img src="https://cdn-2.tstatic.net/jatim/foto/bank/images/berita-probolinggo-keramik-di-probolinggo-dilhat-khofifah_20180316_155854.jpg" width="480" height="480">
                        </div>
                        <div>
                            <img src="https://1.bp.blogspot.com/-PUh-0DgpumQ/VvUG09dXXII/AAAAAAAAjsg/w4zZGTf_QokTFA8VVIlVOElShyLGiP2mA/s640/CendanaNewsMalangAgusNurchaliq3.jpg" width="480" height="480">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3300.3505563377253!2d113.21579958738518!3d-7.764241189367251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ada01be8124d%3A0x431febfaab7ed747!2sKeramik%20Kinasih!5e0!3m2!1sid!2sus!4v1631588785851!5m2!1sid!2sus"
        width="100%" height="470" loading="lazy">
    </iframe>
</section>
@include('layouts.footer')
@endsection