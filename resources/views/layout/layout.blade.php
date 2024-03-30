<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('layout.part.head')
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

@include('layout.part.header')

<!-- Hero Section Begin -->
@include('layout.part.hero')
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @yield("breadcrumb")
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
@yield("main")
<!-- Product Section End -->

<!-- Footer Section Begin -->
@include('layout.part.footer')
<!-- Footer Section End -->
@if(session()->has("success"))
<div class="col-4 mt-4 ml-2 fixed-bottom alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get("success")}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>
