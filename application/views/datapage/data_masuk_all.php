<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row" style="display:flex;justify-content:space-between;">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Data Pemasukan Stok Gudang</h4>
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
											<a href="javascript:;">Masuk</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
                                            Semua Data
										</li>
									</ol>
								</nav>
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
										<th>PENGIRIM</th>
										<th>TANGGAL DITERIMA</th>
										<th>JUMLAH DITERIMA</th>
										<th>TOTAL HARGA</th>
										<th>DITERIMA OLEH</th>
                                        <th>#</th>
									</tr>
								</thead>
								<tbody>
                                    <?php
                                    if($inData->num_rows()>0){
                                        $no=1;
                                        foreach($inData->result() as $val){ 
                                        $printTgl = date('d M Y', strtotime($val->tgl_masuk));
                                        $sendCode = $val->codeinput;
                                        $jml = $this->db->query("SELECT SUM(jumlah) AS jml FROM data_produk_stok_masuk_notes WHERE codeinput='$sendCode'")->row('jml');
                                        $idprodusen = $val->id_produsen;
                                        $nm_produsen = $this->data_model->get_byid('data_produsen', ['id_produsen'=>$idprodusen])->row('nama_produsen');
                                    ?>
                                    <tr>
                                        <td><?=strtoupper($val->suratjalan);?></td>
                                        <td><?=$nm_produsen;?></td>
                                        <td><?=$printTgl;?></td>
                                        <td><?=number_format($jml,0,',','.');?></td>
                                        <td>Rp.<?=number_format($val->total_nilai_barang,0,',','.');?></td>
                                        <td><?=strtoupper($val->yg_input);?></td>
                                        
                                        <td>
                                            <div class="dropdown">
											    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="<?=base_url('data-stok/masuk/');?><?=$sendCode;?>"><i class="dw dw-eye"></i> Lihat Selengkapnya</a>
													<a class="dropdown-item" href="#"><i class="bi bi-trash" style="color:red;"></i> Hapus Data</a>
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
                    
					<!-- Simple Datatable End -->
                                
                </div>
				
			</div>
		</div>