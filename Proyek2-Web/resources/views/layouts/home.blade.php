@extends('master.mainWeb')

@section('body')

{{-- <div class="header">
    <img src="img/header.jpg" alt="" class="w-50h h-100">
</div> --}}
{{-- JUMBOTRON --}}
<!-- Background image -->
<div class="jumbotron  ">
    <div class="container">
        <div class="intro ">
            <div class="title text-center">
                <h3>Keramik Kinasih</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat cupiditate quis deleniti animi
                    itaque consectetur, dolores pariatur accusantium voluptas beatae. Placeat, commodi non! Optio iusto
                    illo expedita </p>

            </div>
            <div class="button">
                <a href="#" class="btn btn-jumbroton">Order Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Background image -->

{{-- PRODUCT --}}
<section class="category">
    <div class=" container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h2 class="text-center ">Our Product</h2>
                <hr class="m-auto">
            </div>
        </div>
        <div class="row mt-5 p-4 box">
            <div class="col-lg-3 ">
                <div class="card border-0" style="width: 18rem;">
                    <img src="https://i.pinimg.com/originals/7b/89/7a/7b897a5fe701e78f8ab44b9c5d29d310.png"
                        class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gelas</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-category">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0" style="width: 18rem; ">
                    <img src="https://img.bestdealplus.com/ae04/kf/Hb4bc4f62d10a496ea3c0b9c773bc205bv.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Celengan</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-category">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="card border-0 " style="width: 18rem;">
                    <img src="https://sc04.alicdn.com/kf/H7c59aa65c48b40ad9624da84b44dcab3s.jpg" class="card-img-top"
                        alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title ">Pot bunga</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-category">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0" style="width: 18rem;">
                    <img src="http://cdn.shopify.com/s/files/1/0411/6889/6156/products/IMG_5826.jpg?v=1607966407"
                        class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Aksesoris</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-category">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OUR STORY --}}
<section class="story ">
    <div class="container">
        <div class="story-intro row align-items-center">
            <div class="col-md-6 line">
                <h2>Our Story.</h2>
                <h3>As a focused technology company, we combine the real and the digital worlds and help customers to
                    meet
                    the great challenges of our time.<br>
                    <br>
                    Our businesses and local organizations enjoy the entrepreneurial freedom to serve their customers
                    and
                    markets in the best way possible, the structure is geared toward creating value for customers,
                    creating
                    technology with purpose and thus changing the lives for bi…</h3>
                <a href="" class="btn btn-story mt-4">Read More <i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="col-md-6">
                <div id="slider">
                    <a  class="control_next"><i class="bi bi-caret-right"></i></a>
                    <a  class="control_prev"><i class="bi bi-caret-left"></i></a>
                    <ul>
                      <li style="background-image: url(https://us.123rf.com/450wm/danymages/danymages1203/danymages120300033/12848030-potter-on-the-potters-wheel.jpg?ver=6)"></li>
                      <li style="background-image: url(https://img.okezone.com/content/2016/07/21/320/1443125/menengok-eksistensi-industri-keramik-rumahan-kiaracondong-sejak-1960-4ZHGfLDD6H.jpg)"></li>
                      <li style="background-image: url(https://www.marketeers.com/wp-content/uploads/2016/05/Pi1gt4_keramik-bna2.jpg)"></li>
                      <li style="background-image: url(https://awsimages.detik.net.id/community/media/visual/2021/02/17/perajin-gerabah-blitar.jpeg?w=700&q=90"></li>
                    </ul>  
                  </div>
            </div>
        </div>

    </div>
</section>

{{-- Available --}}
<section class="available">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Available in</h2>
                <hr class="m-auto">
            </div>
            <div class="col-md-12">
                <h3 class="text-center mt-5">You can purchase our products at your favorite Supermarkets and Grocery
                    Store.
                    You can also purchase our products at our Official Store on Tokopedia and Shoppe.</h3>
            </div>
            <div class="col-md-6  mt-5">
                <a href=""><img
                        src="https://cdn.dorangadget.com/wp-content/uploads/2021/08/Button-Logo-Tokopedia-baru-1400x485.png"
                        alt="" class="tokped"></a>
            </div>
            <div class="col-md-6 mt-5">
                <a href=""><img
                        src="https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-banner-pic/b61ed4ead2296f2695da4d16d4369a9a.png"
                        alt="" class="shoppe"></a>
            </div>
        </div>
    </div>
</section>

@endsection