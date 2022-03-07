<?php $this->load->view('guest/_/header'); ?>

<!-- <section class="page-banner-section pt-75 pb-75 img-bg" style="background-image: url('<?php echo FRONT_ASSETS ?>img/bg/common-bg.svg')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="banner-content">
                    <h2 class="text-white">Contact US</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="contact-section pt-130 mt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="contact-item-wrapper">
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="lni lni-map-marker"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Alamat Kantor Pusat Sarlemjus</h4>
                                    <a href="#">
                                    <p>Perumahan Griya Ciledug<br>Jl Anggrek 2 Blok K, No.1</p>
                                    <p>Ciledug Tangerang Banten 15151</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="lni lni-envelope"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Alamat Email</h4>
                                    <a href="#"><p>halo@sarlemjus.com</p></a>
                                    <a href="#"><p>sarlemjusplus@gmail.com</p></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-12">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="lni lni-phone"></i>
                                </div>
                                <div class="contact-content">
                                    <h4>Whatsapp</h4>
                                    <a href="https://api.whatsapp.com/send/?phone=6281321351753"><p>Admin 1 : 081321351753</p></a>
                                    <a href="https://api.whatsapp.com/send/?phone=6282123602448"><p>Admin 2 : 082123602448</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="contact-form-wrapper">
                    <div class="row">
                        <div class="col-xl-10 col-lg-8 mx-auto">
                            <div class="section-title text-center mb-50">
                                <!-- <span class="wow fadeInDown" data-wow-delay=".2s">Get in Touch</span> -->
                                <h3 class="wow fadeInUp" data-wow-delay=".4s">Ingin Tau Soal Dropship di Sarlemjus?</h3>
                                <!-- <p class="wow fadeInUp" data-wow-delay=".6s">At vero eos et accusamus et iusto odio dignissimos ducimus quiblanditiis praesentium</p> -->
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo FRONT_ASSETS ?>php/mail.php" class="contact-form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="name" id="name" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" id="phone" placeholder="Whatsapp" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <textarea name="message" id="message" placeholder="Pertanyaan" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="button text-center">
                                    <button type="submit" class="theme-btn">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="map-container">
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1815574813136!2d106.7011355147691!3d-6.239786195483275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fa14e4da7391%3A0x6d5d57577b48ff57!2sJendelaSastraPendidikan!5e0!3m2!1sen!2sid!4v1640235103448!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
        <object style="border:0; height: 690px; width: 100%;" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.330614610915!2d106.70226471419367!3d-6.239656562836384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fba704a520dd%3A0x730928d07fca0a60!2sKantor%20Sarlemjus%20Pusat!5e1!3m2!1sen!2sid!4v1640393941784!5m2!1sen!2sid"></object>
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.330614610915!2d106.70226471419367!3d-6.239656562836384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fba704a520dd%3A0x730928d07fca0a60!2sKantor%20Sarlemjus%20Pusat!5e1!3m2!1sen!2sid!4v1640393941784!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
    </div>
    </div>
</section>

<!-- <section id="contact" class="contact-section cta-bg img-bg pt-110 pb-100" style="background-image: url('<?php echo FRONT_ASSETS ?>img/cta-bg.jpg');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-5 col-lg-7">
				<div class="section-title mb-60">
					<h2 class="text-white wow fadeInUp" data-wow-delay=".4s">YUK.. Gabung Jadi Dropshiper SARLEMJUS !!</h2>
					<span class="text-white wow fadeInDown" data-wow-delay=".2s">BISNIS MUDAH BERSAMA Sarlemjus & dapatkan BANYAK Keuntungan nya !!!</span>
				</div>
			</div>
			<div class="col-xl-7 col-lg-5">
				<div class="contact-btn text-start text-lg-end">
					<a href="contact.html" class="theme-btn">DAFTAR DROPSHIP !</a>
				</div>
			</div>
		</div>
	</div>
</section> -->

<?php $this->load->view('guest/_/footer'); ?>