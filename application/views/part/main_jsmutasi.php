<script src="<?=base_url('assets/');?>vendors/scripts/core.js"></script>
		<script src="<?=base_url('assets/');?>vendors/scripts/script.min.js"></script>
		<script src="<?=base_url('assets/');?>vendors/scripts/process.js"></script>
		<script src="<?=base_url('assets/');?>vendors/scripts/layout-settings.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js" integrity="sha256-IW9RTty6djbi3+dyypxajC14pE6ZrP53DLfY9w40Xn4=" crossorigin="anonymous"></script>
		<?php  if(!empty($autocomplet)) { 
			$ar = array();
			foreach($produk->result() as $kd){
				$ds = '"'.$kd->nama_produk.'"';
				$ar[] = $ds;
			}
			$stok_im = implode(",",$ar);
			
		?>
		<script src="<?=base_url('assets2/');?>/autoComplete.min.js"></script>
		<script>
			const autoCompleteJS = new autoComplete({
                placeHolder: "Ketik nama produk",
                data: {
                    src: [<?=$stok_im;?>],
                    cache: true,
                },
                resultItem: {
                    highlight: true
                },
                events: {
                    input: {
                        selection: (event) => {
                            const selection = event.detail.selection.value;
                            autoCompleteJS.input.value = selection;
							$('#model').empty();
							$('#model').append('<option value="">Loading...</option>');
							$('#ukr').empty();
							$('#ukr').attr('disabled', true);
							$('#ukr').append('<option value="">Silahkan pilih model</option>');
                            $.ajax({
								url:"<?=base_url();?>proses2/cekkodeProduk2",
								type: "POST",
								data: {"id" : selection},
									cache: false,
									success: function(dataResult){
										var dataResult = JSON.parse(dataResult);
										if(dataResult.statusCode == 200){
                                            $('#model').attr('disabled', false);
											$('#model').empty();
											$('#model').append('<option value="">Pilih Model Produk</option>');
                                            dataResult.model.forEach(item => {
                                                console.log(item.kode_bar); // atau item.nama_produk dll.
                                                $('#model').append('<option value="' + item.kode_bar + '">' + item.warna_model + '</option>');
                                            });
											$('#load1').html('');
										} else {
											$('#load1').html('<font style="color:red;">'+dataResult.psn+'</font>');
										}
									}
							});
                        }
                    }
                }
            });
			$('#model').on('change', function() {
				var model = $('#model').val();
				$('#ukr').empty();
				$('#ukr').append('<option value="">Loading...</option>');
				$.ajax({
					url:"<?=base_url();?>proses2/cekmodel2",
					type: "POST",
					data: {"kodebar" : model},
						cache: false,
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode == 200){
								$('#ukr').attr('disabled', false);
								$('#ukr').empty();
								$('#ukr').append('<option value="">Pilih Ukuran Produk</option>');
                                dataResult.model2.forEach(item => {
                                    console.log(item.kode_bar1); // atau item.nama_produk dll.
                                    $('#ukr').append('<option value="' + item.kode_bar1 + '">' + item.ukuran + '</option>');
                                });
							} else {
								$('#load2').html(''+dataResult.psn);
							}
						}
				});
			});
		</script>
		<?php } ?>
		
		
		<script>
			function formatAngka(input) {
				let value = input.value.replace(/\D/g, '');
				value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
				input.value = value;
			}
		</script>
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>