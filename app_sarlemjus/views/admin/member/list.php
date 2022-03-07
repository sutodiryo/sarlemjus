<?php $this->load->view('admin/_/header'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?php echo $title;
                                                if ($title2 != '') {
                                                    echo " $title2->name";
                                                } ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Member</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- <?php
                    foreach ($member_stat as $ms) {

                        echo "<div class='col-lg-3 col-md-6'>
                <a href='" . base_url('admin/member/list/') . "$ms->id' class='card'>
                    <div class='card-body'>
                        <div class='row align-items-center'>
                            <div class='col-12'>
                                <h4 class='text-c-default'>$ms->total $ms->name</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>";
                    }
                    ?> -->

            <div class="col-md-12">
                <div class="card">

                    <?php echo $this->session->flashdata('report'); ?>

                    <div class="card-body">
                        <div class="row align-items-center m-l-1 mb-3">
                            <div class="col-sm-6">
                                <?php echo "<button type='button' class='btn btn-sm btn-secondary has-ripple'>Total Member : <span class='badge badge-light'>20</span><span class='ripple ripple-animate'></span></button>"; ?>
                                <!-- <button class="btn btn-secondary btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_tambah_member"><i class="feather icon-filter"></i> Filter</button> -->
                            </div>
                            <div class="col-sm-6 text-right ">
                                <a class="btn btn-info btn-sm btn-round has-ripple" href="<?php echo base_url('admin/member/add/new') ?>"><i class="feather icon-plus"></i> Tambah Member</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table_member" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="20%" class="text-center">Nama Lengkap</th>
                                        <th width="40%" class="text-center">Alamat</th>
                                        <th width="10%" class="text-center">Email</th>
                                        <th width="10%" class="text-center">No HP</th>
                                        <th width="5%" class="text-center">Level</th>
                                        <th width="10%" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- <td><img src='" . base_url() . "public/upload/member/$m->img' class='img-radius' width='30px' height='30px'> " . substr($m->name, 0, 30) . "</td> -->

                                    <?php
                                    foreach ($member as $m) {
                                        echo "<tr>
                                        <td><a href='" . base_url('admin/member/detail/') . "$m->id' target='_blank'>#$m->id</a></td>
                                        <td><a href='" . base_url('admin/member/detail/') . "$m->id' target='_blank'>" . substr($m->name, 0, 30) . "</a></td>
                                        <td><textarea class='form-control' disabled  style='font-size:80%;'>$m->address</textarea></td>
                                        <td class='text-center'><a href='mailto:$m->email' class='badge badge-pill badge-light-dark'>$m->email</a></td>
                                        <td class='text-center'><a href='https://api.whatsapp.com/send/?phone=62$m->phone&text=Halo' class='badge badge-pill badge-light-dark'>$m->phone</a></td>
                                        <td class='text-center'><span class='badge badge-pill badge-dark'>$m->level_name</span></td>
                                        <td class='text-center'>
                                            <div class='btn-group mb-2 mr-2'>
                                                <button class='btn btn-outline-secondary dropdown-toggle btn-sm has-ripple' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action<span class='ripple ripple-animate' style='height: 118.875px; width: 118.875px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -31.8125px; left: -7.5px;'></span></button>
                                                <div class='dropdown-menu' style=''>
                                                    <a class='dropdown-item' href='" . base_url('admin/member/detail/') . "$m->id' target='_blank'><i class='feather icon-eye'></i> Detail</a>
                                                    <div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='" . base_url('admin/member/del/') . "$m->id' onclick=\"return confirm('Anda yakin ingin menghapus data ini ?');\" ><i class='feather icon-trash-2'></i> Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/_/footer'); ?>