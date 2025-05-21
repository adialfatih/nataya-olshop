<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row" style="display:flex;justify-content:space-between;">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Data Pengeluaran Stok Gudang</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?=base_url('beranda');?>">Home</a>
										</li>
                                        <li class="breadcrumb-item">
											<a href="#">Stok</a>
										</li>
                                        <li class="breadcrumb-item">
											<a href="javascript:;">Keluar</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
                                            Semua Data
										</li>
									</ol>
								</nav>
							</div>
                            <div style="display:flex;align-items:center;gap:10px;margin-right:15px;">
                                 <a class="btn btn-success" href="javscript:void(0);" data-toggle="modal" data-target="#modals2311">
                                    <i class="icon-copy bi bi-search"></i>&nbsp; Rekap Data
                                </a>
                            </div>
						</div>
					</div>
                     
                        <?php
							if (!empty($this->session->flashdata('update'))) {
                                echo "<div class='alert alert-warning ' role='alert'>
                                        ".$this->session->flashdata('update').
                                        "</div>";
                            }
                            if (!empty($this->session->flashdata('gagal'))) {
                                echo "<div class='alert alert-danger ' role='alert'>
                                        ".$this->session->flashdata('gagal').
                                        "</div>";
                            }
                            if (!empty($this->session->flashdata('sukses'))) {
                                echo "<div class='alert alert-success ' role='alert'>
                                        ".$this->session->flashdata('sukses').
                                        "</div>";
                            }
                        ?>
					<!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20 table-responsive">
                            <table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
                                        <th>SJ</th>
										<th>TUJUAN</th>
										<th>NAMA PENERIMA</th>
										<th>TANGGAL KIRIM</th>
										<th>JUMLAH KIRIM</th>
										<th>TOTAL HARGA</th>
										<th>Lunas</th>
										<th></th>
                                        <th>#</th>
									</tr>
								</thead>
								<tbody>
                                    <?php
                                    if($inData->num_rows()>0){
                                        $no=1;
                                        foreach($inData->result() as $val){ 
                                        $printTgl = date('d M Y', strtotime($val->tgl_out));
                                        $sendCode = $val->send_code;
                                        $jml = $this->data_model->get_byid('stok_produk_keluar_barang', ['send_code'=>$sendCode])->num_rows();
                                        if($val->tujuan == "Reseller"){
                                            $urltolink = "".base_url()."stok/kirim/reseller/".$sendCode."";
                                        } elseif($val->tujuan == "Agen"){
                                            $urltolink = "".base_url()."stok/kirim/agen/".$sendCode."";
                                        } else {
                                            $urltolink = "".base_url()."stok/kirim/customer/".$sendCode."";
                                        }
                                            ?>
                                    <tr>
                                        <td><?=$val->no_sj;?></td>
                                        <td><?=$val->tujuan;?></td>
                                        <td><?=$val->nama_tujuan;?></td>
                                        <td><?=$printTgl;?></td>
                                        <td><?=number_format($jml,0,',','.');?></td>
                                        <td>Rp.<?=number_format($val->nilai_tagihan,0,',','.');?></td>
                                        <td>
                                            <?php if($val->status_lunas == 'Belum Lunas'){?>
                                                <span class="badge badge-danger">Belum</span>
                                            <?php } elseif($val->status_lunas == 'Lunas'){?>
                                                <span class="badge badge-success">Lunas</span>    
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($val->status_kirim == "kirim"){
                                                echo '<i class="icon-copy bi bi-check-circle-fill" style="color:#389c03;" title="Terkirim"></i>';
                                            } else {
                                                echo '<i class="icon-copy bi bi-bootstrap-reboot" style="color:#e30031;" title="Retur"></i>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
											    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="<?=$urltolink;?>"><i class="dw dw-eye"></i> Lihat Selengkapnya</a>
													<a class="dropdown-item" href="#"><i class="bi bi-bootstrap-reboot"></i> Retur Barang</a>
												</div>
											</div>
                                        </td>
                                    </tr>
                                            <?php
                                            $no++;
                                        } //enf foreach
                                    } //end if 
                                    ?>
								</tbody>
							</table>
						</div>
					</div>
                    <!-- tampilan jika pengiriman keluar -->
                                <div class="modal fade" id="modals2311" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel2311">
													Lihat Rekap Data
												</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													×
												</button>
											</div>
                                            <?php echo form_open_multipart('data-stok/keluar/rekap'); ?>
											<div class="modal-body" id="modalBodyid2311">
                                                <label for="kode_bar456">Tanggal</label>
                                                <input class="form-control" name="dates" id="kode_bar456" type="text" placeholder="Masukan tanggal rekap..." />
												<label for="modelwarna233" style="margin-top:5px;">Penjualan</label>
                                                <select name="tipejual" id="tipejual" class="form-control">
                                                    <option value="all">--Semua Penjualan--</option>
                                                    <option value="Customer">Customer</option>
                                                    <option value="Reseller">Reseller</option>
                                                    <option value="Agen">Agen</option>
                                                </select>
                                                <label for="ukuran244" style="margin-top:5px;">Nama</label>
                                                <input class="form-control" name="nama" id="ukuran244" type="text" placeholder="Masukan nama (opsional)" />
                                            </div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">
													Close
												</button>
                                                <button type="submit" class="btn btn-primary" id="tombolSubmit">
                                                    <i class="icon-copy bi bi-search"></i>&nbsp; Submit
												</button>
                                                <span class="loader" id="thisLoader" style="display:none;"></span>
											</div>
                                            <?php echo form_close(); ?>
										</div>
									</div>
								</div>
					<!-- Simple Datatable End -->
                                
                </div>
				
			</div>
		</div>