<?php $this->load->view('guest/_/header'); ?>

<section class="contact-section pt-130 mt-50">
    <div class="container">
        <div class="row">

            <div class="col-xl-7">
                <div class="contact-form-wrapper">
                    <div class="row">
                        <div class="col-xl-10 col-lg-8 mx-auto">
                            <div class="section-title text-center mb-50">
                                <h3 class="wow fadeInUp" data-wow-delay=".4s">Form Pendaftaran Mitra</span> Sarlemjus</h3>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo FRONT_ASSETS ?>php/mail.php" class="contact-form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="name" id="name" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="phone" id="phone" placeholder="Whatsapp" required>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12">
                                <textarea name="message" id="message" placeholder="Pertanyaan" rows="5"></textarea>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="button text-center">
                                    <button type="submit" class="theme-btn">Daftar Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="contact-item-wrapper">
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="contact-item" style="float: left;">

                                <img src="<?php echo FRONT_ASSETS ?>img/logo-1.svg" alt="">
                                <!-- <div class="contact-icon">
                                    <i class="lni lni-map-marker"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Alamat Kantor Pusat Sarlemjus</h4>
                                    <a href="#">
                                        <p>Perumahan Griya Ciledug<br>Jl Anggrek 2 Blok K, No.1</p>
                                        <p>Ciledug Tangerang Banten 15151</p>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('guest/_/footer'); ?>