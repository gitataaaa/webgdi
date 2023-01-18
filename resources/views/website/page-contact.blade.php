@extends('layout.layout-page', ['active' => $active])
@section('title', $pageTitle)

@section('style')
<style>
    .address__text{
        max-width: 200px;
        height: 6rem;
    }
</style>
@endsection

@section('breadcrumb')
<ul class="thm-breadcrumb list-unstyled">
    <li><a href="/">Beranda</a></li>
    @if(@$parent)
    <li><span>/</span></li>
    <li><a href="/">{{ @$parent }}</a></li>
    @endif
    <li><span>/</span></li>
    <li>{{ @$detail->title ? @$detail->title : $pageTitle }}</li>
</ul>
<h2>{{ @$detail->title ? @$detail->title : $pageTitle }}</h2>
@endsection

@section('pageContact')
@php
    $contact = App\Helper::displayContact();
@endphp
<section class="contact-one">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">Hubungi Kami</span>
            <h2 class="section-title__title">Jangan ragu untuk mengirimkan pesan kapanpun dan dimanapun</h2>
        </div>
        <div class="contact-one__form-box">
            <form action="assets/inc/sendemail.php" class="contact-one__form contact-form-validated"
                novalidate="novalidate">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="Nama Anda" name="name">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="contact-form__input-box">
                            <input type="email" placeholder="Email Anda" name="email">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="No. HP Anda" name="phone">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="Subjek Pesan" name="subject">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="contact-form__input-box text-message-box">
                            <textarea name="message" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        <div class="contact-form__btn-box">
                            <button type="submit" class="thm-btn contact-form__btn">Kirim Pesan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Contact One End-->

<!--Address Start-->
<section class="address">
    <div class="container">
        <div class="row">
            <!--Address Single Start-->
            <div class="col-xl-4 col-lg-4">
                <div class="address__single">
                    <div class="address__title-box">
                        <h4 class="address__title">Instansi</h4>
                        <div class="address__icon">
                            <span class="icon-entrepreneur-1"></span>
                        </div>
                    </div>
                    <p class="address__text">Yayasan Graha Dhuafa Indonesia</p>
                </div>
            </div>
            <!--Address Single End-->
            <!--Address Single Start-->
            <div class="col-xl-4 col-lg-4">
                <div class="address__single">
                    <div class="address__title-box">
                        <h4 class="address__title">Alamat</h4>
                        <div class="address__icon">
                            <span class="icon-location"></span>
                        </div>
                    </div>
                    <p class="address__text">{{ $contact['inst_addr'] }}</p>
                </div>
            </div>
            <!--Address Single End-->
            <!--Address Single Start-->
            <div class="col-xl-4 col-lg-4">
                <div class="address__single">
                    <div class="address__title-box">
                        <h4 class="address__title">Kontak</h4>
                        <div class="address__icon">
                            <span class="icon-contact"></span>
                        </div>
                    </div>
                    <p class="address__text">
                        <a href="tel:{{ $contact['inst_telp'] }}" class="address__number">{{ $contact['inst_telp'] }}</a>
                        <a href="mailto:{{ $contact['inst_email'] }}" class="address__email">{{ $contact['inst_email'] }}</a>
                    </p>
                </div>
            </div>
            <!--Address Single End-->
        </div>
    </div>
</section>
<!--Address End-->

<!--Google Map Start-->
<section class="google-map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"
        class="google-map__one" allowfullscreen></iframe>

</section>
@endsection