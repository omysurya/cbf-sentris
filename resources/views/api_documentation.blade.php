<!DOCTYPE html>
<html>
<head>
	<title>API DOCUMENTATION</title>
	<style type="text/css">
		ul {
			padding: 0 0 0 0;
			margin: 0 0 0 0;
			margin-left: 20px;
		}
		ul ul {
			margin-left:20px;
		}
		code {
			padding:0 0 0 0;
		}
		.form-control {
			padding: 5px;
			width: 100%;
		}
		table tbody tr:hover td {
			background: #eeeeee
		}
	</style>
</head>
<body>
	<p><strong>API BASE URL : <input type='text' class="form-control" readonly value='{{url('api/')}}'/></strong></p>
	<table style="border-collapse: collapse;" border="1" cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th width="180px">API Name</th>
				<th width="290px">End Point</th>
				<th width="65px">Type</th>
				<th width="300px">Parameter</th>
				<th width="300px">Responses</th>
			</tr> 
		</thead>
		<tbody>
			<tr>
				<td>Default</td>
				<td><code>/default</code></td>
				<td>GET</td>
				<td></td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
							<li>item (object)
								<ul>
									<li>banner (url)</li>
									<li>list_am_mr (array)
										<ul>
											<li>id (int)</li>
											<li>karyawan_nama (string)</li>
										</ul>
									</li>
									<li>list_provinsi (array) 
										<ul>
											<li>id (int)</li>
											<li>nama (string)</li>
										</ul>
									</li> 
									<li>list_instansi_praktik (array)
										<ul>
											<li>id (int)</li>
											<li>nama (string)</li>
										</ul>
									</li>
									<li>list_produk (array)
										<ul>
											<li>id (int)</li>
											<li>kode (string)</li>
											<li>nama (string)</li>
										</ul>
									</li>
									<li>list_area (array)
										<ul>
											<li>id (int)</li>
											<li>nama (string)</li>
										</ul>
									</li>
									<li>
										list_spesialis_dokter (array)
										<ul>
											<li>id (int)</li>
											<li>kode (string)</li>
											<li>keterangan (string)</li>
										</ul>
									</li>

									<li>
										list_jenis_instansi (array)
										<ul>
											<li>id (int)</li>
											<li>nama (string)</li>
										</ul>
									</li>
									<li>
										list_berita_kategori (array)
										<ul>
											<li>id (int)</li>
											<li>nama (string)</li>
										</ul>
									</li>

									<li>
										list_devisi (array)
										<ul>
											<li>id (int)</li>
											<li>nama (string)</li>
										</ul>
									</li>

									<li>
										list_kftd (array)
										<ul>
											<li>id (int)</li>
											<li>kode (string)</li>
											<li>nama (string)</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</code>
				</td>
			</tr>
			<tr>
				<td>Login</td>
				<td><code>/login</code></td>
				<td>POST</td>
				<td>
					<code>						
						username (required|string)<br/>
						password (required|string)<br/>
						regid (required)
					</code>
				</td>
				<td>
					<code>	
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>sessionID (string)</li>
						<li>role (SUPERADMIN,MR,AM,SM,NSM,PM,GPM)</li>
					</ul>					
					</code>
				</td>
			</tr>

			<tr>
				<td>Detail Profile</td>
				<td><code>/user/profile</code></td>
				<td>GET</td>
				<td>
					<code>
						sessionID (required|string)
					</code>
				</td>
				<td>
					<code>		
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
							<li>item (object)
							<ul>
								<li>nama_lengkap (string)</li>
								<li>no_telp (string)</li>
								<li>alamat (string)</li>
								<li>email (string)</li>
								<li>username (string)</li>
								<li>foto (url)</li>
							</ul>
							</li>
						</ul>			
						
					</code>
				</td>
			</tr>

			<tr>
				<td>Update Profile</td>
				<td><code>/user/update-profile</code></td>
				<td>POST</td>
				<td>
					<code>
						sessionID (required|stirng)<br/>
						nama_lengkap (required|string)<br/>
						foto (optional|image)<br/>
						no_telp (required|numeric)<br/>
						alamat (required|string)<br/>
						email (required|string)<br/>
						username (required|string)<br/>
						password (optional|string)
					</code>
				</td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
						</ul>						
					</code>
				</td>
			</tr>

			<tr>
				<td>Forgot Password</td>
				<td><code>/api/forgot</code></td>
				<td>POST</td>
				<td>
					<code>
						username (required|string)
					</code>
				</td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
						</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Update Password</td>
				<td><code>/api/user/update-password</code></td>
				<td>POST</td>
				<td>
					<code>
						<ul>
							<li>sessionID (required)</li>
							<li>password (required)</li>
						</ul>
					</code>
				</td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
						</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>Logout</td>
				<td><code>/api/logout</code></td>
				<td>POST</td>
				<td>
					<code>
						sessionID (required|string)
					</code>
				</td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
						</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>E-Brosure</td>
				<td><code>/api/e-brosure</code></td>
				<td>GET</td> 
				<td>
					<code>
						sessionID (required|string)<br/>
						id_produk (optional|integer)<br/>
						offset (optional|integer)<br/>
						q (optional|string)
					</code>
				</td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>
							<li>items (array)
								<ul>
									<li>id (integer)</li>
									<li>kode (string)</li>
									<li>nama (string)</li>
									<li>produk_kode (string)</li>
									<li>produk_nama (string)</li>
									<li>produk_harga (double)</li>
									<li>produk_group_nama (string)</li>
									<li>isi (string)</li>
									<li>isi_raw (string)</li>
									<li>hit (int)</li>
									<li>attachments (json_array)</li>									
								</ul>
							</li>
						</ul>						
					</code>
				</td>
			</tr>

			<tr>
				<td>E Brosure Hit</td>
				<td><code>/api/e-brosure/hit/{id_brosure}</code></td>
				<td>GET</td> 
				<td>
					<code>
						sessionID (required|string)
					</code>
				</td>
				<td>
					<code>
						<ul>
							<li>api_status (integer)</li>
							<li>api_message (string)</li>							
						</ul>						
					</code>
				</td>
			</tr>			

			<tr>
				<td>List Berita</td>
				<td><code>/api/berita</code></td>
				<td>GET</td> 
				<td>
					<code>
						sessionID (required|string)<br/>	
						offset (optional|integer)					
					</code>
				</td>
				<td>
					<code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>
							items (array)
							<ul>
								<li>created_at (dateTime)</li>								
								<li>judul (string)</li>
								<li>isi (string)</li>
								<li>isi_raw (string)</li>
								<li>berita_kategori_nama (string)</li>								
								<li>distribution (string)</li>
								<li>status (string)</li>
								<li>devisi_nama (string)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>		

			<tr>
				<td>List Absensi</td>
				<td><code>/api/absensi</code></td>
				<td>GET</td> 
				<td>
					<code>
						<ul>
							<li>sessionID (required|string)</li>												
						</ul>									
					</code>
				</td>
				<td>
					<code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>
							items (array)
							<ul>
								<li>id (int)</li>
								<li>tanggal_mulai (date)</li>								
								<li>tanggal_selesai (date)</li>
								<li>jenis (string)</li>								
								<li>alasan (string)</li>								
								<li>durasi (string)</li>								
								<li>status (string)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Add Absensi</td>
				<td><code>/api/absensi/add</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>created_at (required|datetime)</li>
						<li>tanggal_mulai (required|date)</li>
						<li>tanggal_selesai (required|date)</li>
						<li>durasi (required|integer)</li>
						<li>jenis (required|string:IJIN,SAKIT,TUGAS,CUTI)</li>
						<li>alasan (required|string)</li>
						<li>attachment (optional|file|jpg,png,gif,pdf|max:3MB)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
					</ul>
					</code>
				</td>
			</tr>	


			<tr>
				<td>Approval Absensi</td>
				<td><code>/api/approval-absensi</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>jenis (required|in:thismonth,lastmonth)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>tanggal_dibuat (date)</li>
								<li>perihal (string)</li>
								<li>diajukan_oleh (string)</li>
								<li>jabatan (string)</li>
								<li>tanggal_mulai (date)</li>
								<li>tanggal_masuk (date)</li>
								<li>jenis_absensi (string)</li>
								<li>attachment (url)</li>
								<li>durasi_absensi (string)</li>								
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Setujui Absensi</td>
				<td><code>/api/approval-absensi/approve/{id}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>alasan (required)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
					</ul>
					</code>
				</td>
			</tr> 
 
			<tr>
				<td>Tolak Absensi</td>
				<td><code>/api/approval-absensi/decline/{id}</code></td>
				<td>GET</td>
				<td><code> 
					<ul>
						<li>sessionID (required|string)</li>
						<li>alasan (required)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
					</ul>
					</code>
				</td>
			</tr>			

			<tr>
				<td>Visit Plan Outlet</td>
				<td><code>/api/visit-outlet</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>tipe (required|string:today,thismonth)</li>
						<li>id_user (optional|integer)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id_visit_plan_outlet (int)</li>	
								<li>id_trx_visit_outlet (int)</li>
								<li>outlet_nama (string)</li>
								<li>outlet_kode (string)</li>
								<li>outlet_alamat (string)</li>
								<li>kelas_outlet_nama (string)</li>
								<li>visit_plan_kode (string)</li>
								<li>target (int)</li>
								<li>realisasi (int)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>	


			<tr>
				<td>Detail Visit Plan Outlet</td>
				<td><code>/api/visit-outlet/detail/{id_trx_visit_outlet}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>item (object)
							<ul>
								<li>hasil_survei (string)</li>	
								<li>tindak_lanjut (string)</li>
								<li>join_visit (string)</li>
								<li>catatan (string)</li>
								<li>penerima (string)</li>
								<li>jabatan_penerima (string)</li>
								<li>telp_penerima (string)</li>
								<li>ttd_image (url)</li>
								<li>attachments (array)
									<ul>
										<li>url (url)</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>	


			<tr>
				<td>History Visit Plan Outlet</td>
				<td><code>/api/visit-outlet/history/{id_visit_plan_outlet}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>	
								<li>created_at (datetime)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Add Visit Plan Outlet</td>
				<td><code>/api/visit-outlet/add-visit/{id_visit_plan_outlet}</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>created_at (required|datetime)</li>	
						<li>latitude (required|string)</li>
						<li>longitude (required|string)</li>
						<li>join_visit (optional|string)</li>
						<li>hasil_survei (required|string)</li>
						<li>tindak_lanjut (required|string)</li>
						<li>catatan (required|string)</li>
						<li>penerima (required|string)</li>
						<li>jabatan_penerima (required|string)</li>
						<li>no_telp (required|string)</li>
						<li>ttd_image (required|image:jpg,png,gif)</li>				
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>id_trx_visit_outlet (int)</li>
					</ul>
					</code>
				</td>
			</tr>
			<tr>
				<td>Add Attachment Visit Outlet</td>
				<td><code>/api/visit-outlet/add-attachment</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>id_trx_visit_outlet (required|int)</li>
						<li>attachment (required|image)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>						
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>Ping Koordinat</td>
				<td><code>/api/user/ping</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>latitude (required)</li>
						<li>longitude (required)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>
					</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>List Outlet</td>
				<td><code>/api/outlet</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>offset (optional|integer)</li>
						<li>is_mcl (optional|boolean_integer)</li>
						<li>id_provinsi (optional|integer)</li>
						<li>id_area (optional|integer)</li>
						<li>q (optional|string)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
								<li>alamat (string)</li>
								<li>id_provinsi (int)</li>
								<li>id_kota (int)</li>
								<li>id_area (int)</li>
								<li>provinsi_nama (string)</li>								
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>Tambah Outlet Baru</td>
				<td><code>/api/outlet/add</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>foto (required|image)</li>
						<li>nama (required)</li>
						<li>alamat (required)</li>
						<li>id_provinsi (required)</li>
						<li>id_kota (required)</li>
						<li>nama_penanggung_jawab (required)</li>
						<li>jabatan_penanggung_jawab (required)</li>
						<li>nomor_kontak (required)</li>
						<li>catatan (string)</li>
						<li>waktu_kunjungan (required|in:Pagi,Siang)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>id_outlet (integer)</li>
					</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>Tambah Visit Outlet Extra Call</td>
				<td><code>/api/visit-outlet-extra-call/add</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>created_at (required|datetime)</li>	
						<li>id_outlet (required|integer)</li>
						<li>latitude (required|string)</li>
						<li>longitude (required|string)</li>
						<li>join_visit (optional|string)</li>
						<li>hasil_survei (required|string)</li>
						<li>tindak_lanjut (required|string)</li>
						<li>catatan (required|string)</li>
						<li>penerima (required|string)</li>
						<li>jabatan_penerima (required|string)</li>
						<li>no_telp (required|string)</li>
						<li>ttd_image (required|image:jpg,png,gif)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>id_trx_visit_outlet_extracall (int)</li>						
					</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>Add Attachment Visit Outlet ExtraCall</td>
				<td><code>/api/visit-outlet-extra-call/add-attachment</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>id_trx_visit_outlet_extracall (required|int)</li>
						<li>attachment (required|image)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>						
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>List Visit Outlet Extra Call</td>
				<td><code>/api/visit-outlet-extra-call</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>offset (optional|integer)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id_trx_visit_outlet_extracall (int)</li>
								<li>created_at (datetime)</li>
								<li>outlet_nama (string)</li>
								<li>outlet_alamat (string)</li>
								<li>outlet_kode (string)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Detail Visit Plan Outlet Extra Call</td>
				<td><code>/api/visit-outlet-extra-call/detail/{id_trx_visit_outlet_extracall}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>item (object)
							<ul>
								<li>hasil_survei (string)</li>	
								<li>tindak_lanjut (string)</li>
								<li>join_visit (string)</li>
								<li>catatan (string)</li>
								<li>penerima (string)</li>
								<li>jabatan_penerima (string)</li>
								<li>no_telp (string)</li>
								<li>ttd_image (url)</li>
								<li>attachments (array)
									<ul>
										<li>url (url)</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>			


			<tr>
				<td>List Dokter</td>
				<td><code>/api/dokter</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>offset (optional|integer)</li>
						<li>is_mcl (optional|boolean_integer)</li>
						<li>id_provinsi (optional|integer)</li>
						<li>id_kota_reguler (optional|integer)</li>
						<li>id_spesialis_dokter (optional|integer)</li>
						<li>id_produk (optional|integer)</li>
						<li>q (optional|string)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
								<li>alamat_rumah (string)</li>
								<li>kode (string)</li>
								<li>gelar (string)</li>
								<li>agama (string)</li>
								<li>nomor_kontak (string)</li>
								<li>jenis_kelamin (string)</li>
								<li>tempat_lahir (string)</li>
								<li>tanggal_lahir (string)</li>
								<li>telp_rumah (string)</li>
								<li>provinsi_nama (string)</li>								
								<li>kota_nama (string)</li>								
								<li>waktu_kunjungan (string)</li>								
								<li>spesialis_dokter_nama (string)</li>								
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Tempat Praktik Dokter</td>
				<td><code>/api/dokter/tempat-praktik/{id_dokter}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
								<li>alamat (string)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>


			<tr>
				<td>Kelas Dokter</td>
				<td><code>/api/dokter/kelas-dokter</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>								
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Tambah Dokter</td>
				<td><code>/api/visit-dokter-extra-call/add-dokter</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>nama (required)</li>
						<li>id_kelas_dokter_outlet (required)</li>
						<li>gelar (required)</li>
						<li>nomor_kontak (required)</li>
						<li>jenis_kelamin (required)</li>
						<li>tempat_lahir (string)</li>
						<li>tanggal_lahir (string)</li>
						<li>alamat_rumah (string)</li>
						<li>telp_rumah (string)</li>
						<li>agama (required)</li>
						<li>email (optional)</li>
						<li>id_spesialis_dokter (required)</li>						
						<li>id_provinsi (required)</li>
						<li>id_kota (required)</li>						
						<li>tempat_praktik (array)
							<ul>
								<li>id (required 0 or integer)</li>
								<li>nama (required)</li>
								<li>alamat (required)</li>
								<li>id_jenis_instansi (required)</li>
								<li>id_provinsi (required)</li>
								<li>id_kota_reguler (required)</li>
							</ul>
						</li>
						<li>catatan (optional|string)</li>
					</ul> 
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>id_dokter (int)</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Visit Plan Dokter</td>
				<td><code>/api/visit-dokter</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>tipe (required|string:today,thismonth)</li>
						<li>id_user (optional|integer)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id_visit_plan_dokter (int)</li>	
								<li>id_trx_visit_dokter (int)</li>
								<li>dokter_nama (string)</li>
								<li>dokter_kode (string)</li>
								<li>dokter_alamat (string)</li>
								<li>spesialis_dokter_nama (string)</li>								
								<li>instansi_praktik_nama (string)</li>
								<li>kelas_dokter_outlet_nama (string)</li>
								<li>visit_plan_kode (string)</li>
								<li>target (int)</li>
								<li>realisasi (int)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>	


			<tr>
				<td>Detail Visit Plan Dokter</td>
				<td><code>/api/visit-dokter/detail/{id_trx_visit_dokter}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>item (object)
							<ul>
								<li>id (int)</li>
								<li>dokter_id (int)</li>
								<li>dokter_nama (string)</li>
								<li>instansi_praktik_nama (string)</li>
								<li>kelas_dokter_outlet_nama (string)</li>
								<li>dokter_kode (string)</li>
								<li>spesialis_dokter_nama (string)</li>
								<li>produk_nama (string)</li>
								<li>join_visit (string)</li>
								<li>respon_dokter (string)</li>
								<li>catatan (string)</li>
								<li>ttd_image (url)</li>								
								<li>attachments (array)
									<ul>
										<li>url (url)</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>	


			<tr>
				<td>History Visit Plan Dokter</td>
				<td><code>/api/visit-dokter/history/{id_visit_plan_dokter}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>	
								<li>created_at (datetime)</li>
								<li>respon_dokter (string)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Tambah Kunjungan Dokter</td>
				<td><code>/api/visit-dokter/add-visit</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_visit_plan_dokter (required|integer)</li>						
						<li>created_at (required|datetime)</li>	
						<li>latitude (required|string)</li>
						<li>longitude (required|string)</li>
						<li>join_visit (optional|string)</li>
						<li>id_produk (required|integer)</li>
						<li>respon_dokter (string)</li>						
						<li>catatan (string)</li>											
						<li>ttd_image (image:jpg,png,gif)</li>				
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>id_trx_visit_dokter (int)</li>
					</ul>
					</code>
				</td>
			</tr>
			<tr>
				<td>Add Attachment Visit Dokter</td>
				<td><code>/api/visit-dokter/add-attachment</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>id_trx_visit_dokter (required|int)</li>
						<li>attachment (required|image)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>						
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>Tambah respon kunjungan dokter</td>
				<td><code>/api/visit-dokter/add-respon-visit-dokter</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>id_trx_visit_dokter (required|int)</li>
						<li>respon_dokter (required|string)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_messase (string)</li>						
					</ul>
				</code></td>
			</tr>


			<tr>
				<td>Tambah Kunjungan Dokter (Extracall)</td>
				<td><code>/api/visit-dokter-extra-call/add</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_dokter (required|integer)</li>	
						<li>id_instansi_praktik (required|integer)</li>
						<li>created_at (required|datetime)</li>	
						<li>latitude (required|string)</li>
						<li>longitude (required|string)</li>
						<li>join_visit (optional|string)</li>
						<li>id_produk (required|integer)</li>
						<li>respon_dokter (string)</li>						
						<li>catatan (string)</li>											
						<li>ttd_image (image:jpg,png,gif)</li>				
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>id_trx_visit_dokter_extracall (int)</li>
					</ul>
					</code>
				</td>
			</tr>
			<tr>
				<td>Tambah Attach Kunjungan Dokter (Extra Call)</td>
				<td><code>/api/visit-dokter-extra-call/add-attachment</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>id_trx_visit_dokter_extracall (required|int)</li>
						<li>attachment (required|image)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>						
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>Tambah respon kunjungan dokter extracall</td>
				<td><code>/api/visit-dokter-extra-call/add-respon</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>id_trx_visit_dokter_extracall (required|int)</li>
						<li>respon_dokter (required|string)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_messase (string)</li>						
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>List Kunjungan Dokter (Extra Call)</td>
				<td><code>/api/visit-dokter-extra-call</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>offset (optional|integer)</li>
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id_trx_visit_dokter_extracall (int)</li>
								<li>created_at (datetime)</li>
								<li>dokter_nama (string)</li>
								<li>dokter_alamat (string)</li>
								<li>dokter_kode (string)</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>Detail Kunjungan Dokter (Extra Call)</td>
				<td><code>/api/visit-dokter-extra-call/detail/{id_trx_visit_dokter_extracall}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
					</ul>
					</code>
				</td>
				<td><code>
					<ul>
						<li>api_status (integer)</li>
						<li>api_message (string)</li>
						<li>item (object)
							<ul>
								<li>id (int)</li>
								<li>dokter_id (int)</li>
								<li>dokter_nama (string)</li>
								<li>instansi_praktik_nama (string)</li>
								<li>kelas_dokter_outlet_nama (string)</li>
								<li>dokter_kode (string)</li>
								<li>spesialis_dokter_nama (string)</li>
								<li>produk_nama (string)</li>
								<li>join_visit (string)</li>
								<li>respon_dokter (string)</li>
								<li>catatan (string)</li>
								<li>ttd_image (url)</li>								
								<li>attachments (array)
									<ul>
										<li>url (url)</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
					</code>
				</td>
			</tr>

			<tr>
				<td>List Kota Reguler</td>
				<td><code>/api/kota</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>						
						<li>id_provinsi (required)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
								<li>id_provinsi (int)</li>
							</ul>
						</li>				
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>List Log Visit</td>
				<td><code>/api/log/visit</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>periode (required|in:thismonth,lastmonth)</li>												
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>created_at (string)</li>
								<li>title (string)</li>
								<li>sub_title (string)</li>
								<li>status (string)</li>
								<li>type (string)</li>
							</ul>
						</li>				
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>List Log Absensi</td>
				<td><code>/api/log/absensi</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>periode (required|in:thismonth,lastmonth)</li>						
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>created_at (string)</li>
								<li>title (string)</li>
								<li>sub_title (string)</li>
								<li>status (string)</li>
								<li>type (string)</li>
							</ul>
						</li>				
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>List Log Sales</td>
				<td><code>/api/log/sales</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>periode (required|in:thismonth,lastmonth)</li>											
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>created_at (string)</li>
								<li>title (string)</li>
								<li>sub_title (string)</li>
								<li>status (string)</li>
								<li>type (string)</li>
							</ul>
						</li>				
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>Check Visit Plan</td>
				<td><code>/api/check-visit-plan</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																	
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>id_visit_plan (int)</li>								
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>My Statistic Sales</td>
				<td><code>/api/my-month-statistic</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																	
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>item (object)
						<ul>
							<li>me_target (int)</li>
							<li>me_real (int)</li>
							<li>area_target (int)</li>
							<li>area_real (int)</li>
							<li>regional_target (int)</li>
							<li>regional_real (int)</li>
							<li>nasional_target (int)</li>
							<li>nasional_real (int)</li>
						</ul>
						</li>								
					</ul>
				</code></td>
			</tr>


			<tr>
				<td>Monitoring</td>
				<td><code>/api/monitoring</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																	
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>items (array)
						<ul>
							<li>id_user (int)</li>
							<li>karyawan_nama (int)</li>
							<li>last_latitude</li>
							<li>last_longitude</li>
							<li>last_visit_time (datetime)</li>
							<li>last_visit_nama (string)</li>	
							<li>role_nama</li>	
							<li>jenis_visit</li>					
						</ul>
						</li>								
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>Monitoring Today Visit</td>
				<td><code>/api/monitoring/today-visit/{id_user}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																	
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>		
						<li>items (array)
						<ul>
							<li>id (string)</li>
							<li>created_at (datetime)</li>
							<li>nama (string)</li>
							<li>kode (string)</li>
							<li>latitude (string)</li>							
							<li>longitude (string)</li>
							<li>id_user (int)</li>
						</ul>
						</li>								
					</ul>
				</code></td>
			</tr>

			<tr>
				<td>Monitoring Month Performance</td>
				<td><code>/api/monitoring/month-performance/{id_user}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>periode (optional|in:thismonth,lastmonth)</li>																	
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>	
						<li>tanggal (string)</li>
						<li>rencana_kunjungan (string)</li>
						<li>items (array)
						<ul>
							<li>id (string)</li>
							<li>label (string)</li>
							<li>id_user (int)</li>
							<li>target (int)</li>
							<li>realisasi (int)</li>
							<li>selisih (int)</li>														
						</ul>
						</li>
						<li>persetujuan_oleh (string)</li>								
						<li>tanggal_status (string)</li>
						<li>catatan (string)</li>
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>List Approval Sales Plan</td>
				<td><code>/api/approval-sales-plan</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																	
						<li>offset (optional|integer)</li>
						<li>jenis (in:thismonth,lastmonth)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>items (array)
						<ul>
							<li>id (int)</li>							
							<li>created_at (datetime)</li>
							<li>target_penjualan (int)</li>
							<li>total_target_unit (int)</li>
							<li>total_target_value (int)</li>
							<li>bulan_plan (string)</li>
							<li>tahun_plan (int)</li>
							<li>diajukan_oleh (string)</li>							
						</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Approve -> Approval Sales Plan</td>
				<td><code>/api/approval-sales-plan/approve/{id}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>alasan (required)</li>																							
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>							
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Decline -> Approval Sales Plan</td>
				<td><code>/api/approval-sales-plan/decline/{id}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>
						<li>alasan (required)</li>																							
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>							
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>List Approval Visit Plan</td>
				<td><code>/api/approval-visit-plan</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																	
						<li>offset (optional|integer)</li>
						<li>jenis (in:thismonth,lastmonth)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>items (array)
						<ul>
							<li>id (int)</li>							
							<li>created_at (datetime)</li>
							<li>target_dokter (int)</li>
							<li>target_outlet (int)</li>
							<li>bulan_plan (string)</li>
							<li>tahun_plan (int)</li>
							<li>diajukan_oleh (string)</li>							
						</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Approve -> Approval Visit Plan</td>
				<td><code>/api/approval-visit-plan/approve/{id}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>alasan (required)</li>																						
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>							
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Decline -> Approval Visit Plan</td>
				<td><code>/api/approval-visit-plan/decline/{id}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>alasan (required)</li>																																												
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>							
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Performance: By Sales SM</td>
				<td><code>/api/performance/sales-list-sm</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>								
						<li>periode (optional|in:lastmonth,thismonth)</li>																				
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>
						<li>tanggal (string)</li>
						<li>items (array)
								<ul>
									<li>id (int)</li>
									<li>karyawan_nama (string)</li>
									<li>target (int)</li>
									<li>realisasi (int)</li>
									<li>goal (float)</li>
									<li>bawahan (array)
										<ul>
											<li>id (int)</li>
											<li>karyawan_nama (string)</li>
											<li>target (int)</li>
											<li>realisasi (int)</li>
											<li>goal (float)</li>
											<li>bawahan (array)
												<ul>
													<li>id (int)</li>
													<li>karyawan_nama (string)</li>
													<li>target (int)</li>
													<li>realisasi (int)</li>
													<li>goal (float)</li>	
												</ul>
											</li>
										</ul>
									</li>
								</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Performance: By Sales AM</td>
				<td><code>/api/performance/sales-list-am/{id_sm}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>								
						<li>periode (optional|in:lastmonth,thismonth)</li>																				
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>
						<li>tanggal (string)</li>
						<li>items (array)
								<ul>
									<li>id (int)</li>
									<li>karyawan_nama (string)</li>
									<li>target (int)</li>
									<li>realisasi (int)</li>
									<li>goal (float)</li>
									<li>bawahan (array)
										<ul>
											<li>id (int)</li>
											<li>karyawan_nama (string)</li>
											<li>target (int)</li>
											<li>realisasi (int)</li>
											<li>goal (float)</li>											
										</ul>
									</li>
								</ul>
						</li>						
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Performance: By Sales MR</td>
				<td><code>/api/performance/sales-list-mr/{id_am}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>								
						<li>periode (optional|in:lastmonth,thismonth)</li>																				
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>
						<li>tanggal (string)</li>
						<li>items (array)
								<ul>
									<li>id (int)</li>
									<li>karyawan_nama (string)</li>
									<li>target (int)</li>
									<li>realisasi (int)</li>
									<li>goal (float)</li>									
								</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Performance: Sales By Product</td>
				<td><code>/api/performance/sales-by-product</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_user (optional|integer)</li>		
						<li>periode (optional|in:lastmonth,thismonth)</li>																				
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>
						<li>tanggal (string)</li>
						<li>items (array)
								<ul>
									<li>id (int)</li>
									<li>produk_nama (string)</li>
									<li>target (int)</li>
									<li>realisasi (int)</li>
									<li>goal (float)</li>
									<li>is_group (int)</li>
								</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Performance: By Sales MR By Product</td>
				<td><code>/api/performance/sales-list-mr-by-product/{id_produk}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>								
						<li>periode (optional|in:lastmonth,thismonth)</li>																				
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>
						<li>tanggal (string)</li>
						<li>items (array)
								<ul>
									<li>id (int)</li>
									<li>karyawan_nama (string)</li>
									<li>target (int)</li>
									<li>realisasi (int)</li>
									<li>goal (float)</li>									
								</ul>
						</li>						
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Performance: Resume Sales</td>
				<td><code>/api/performance/resume-sales</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_user (optional|integer)</li>		
						<li>periode (optional|in:lastmonth,thismonth)</li>																				
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>
						<li>tanggal (string)</li>
						<li>items (array)
								<ul>
									<li>id (int)</li>
									<li>produk_nama (string)</li>
									<li>target (int)</li>
									<li>realisasi (int)</li>
									<li>goal (float)</li>
								</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Sales: List Sales Plan Produk</td>
				<td><code>/api/sales</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																							
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>periode (string)</li>						
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>id_sales_plan (int)</li>
								<li>id_produk (int)</li>
								<li>produk_nama (string)</li>
								<li>produk_harga (int)</li>
								<li>produk_kode (string)</li>
								<li>produk_group_nama (string)</li>									
							</ul>
						</li>						
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Sales: Check Invoice Number</td>
				<td><code>/api/sales/check-invoice-number</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>invoice_number (required)</li>																						
						<li>id_produk (required|int)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>												
						<li>item (object)
							<ul>
								<li>id_invoice_detail (int)</li>
								<li>invoice (string)</li>
								<li>customer_name (string)</li>
								<li>qty (int)</li>	
								<li>qty_claimed (int)</li>														
								<li>qty_sisa (int)</li>								
							</ul>
						</li>						
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Sales: Claim</td>
				<td><code>/api/sales/claim</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_sales_plan_produk (required)</li>																						
						<li>claim (required)</li>
						<li>invoice (required)</li>
						<li>id_invoice_detail (required)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>																		
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Berita: Create</td>
				<td><code>/api/berita/create</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_devisi (required)</li>																						
						<li>judul (required)</li>
						<li>isi (required)</li>
						<li>id_kategori_berita (required)</li>
						<li>distribution (required|in:all)</li>
						<li>status (required|in:publish,pending)</li>						
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>id_berita  (int)</li>																	
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Berita: Update</td>
				<td><code>/api/berita/update</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id (required)</li>
						<li>id_devisi (required)</li>																						
						<li>judul (required)</li>
						<li>isi (required)</li>
						<li>id_kategori_berita (required)</li>
						<li>distribution (required|in:all)</li>
						<li>status (required|in:publish,pending)</li>						
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>id_berita  (int)</li>																																		
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>Berita: Delete</td>
				<td><code>/api/berita/delete</code></td>
				<td>POST</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id (required)</li>					
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>id_berita  (int)</li>																																		
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>List Karyawan Bawahan</td>
				<td><code>/api/bawahan</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>offset (optional)</li>									
						<li>limit (optional)</li>
						<li>q (string|optional)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>	
						<li>items  (array)
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
								<li>id_user (int)</li>
								<li>role_nama (string)</li>
							</ul>
						</li>																																		
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Produk Berdasar User</td>
				<td><code>/api/produk/by-user</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_user (required)</li>																																												
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>kode (string)</li>
								<li>nama (string)</li>
							</ul>
						</li>							
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>List Invoice</td>
				<td><code>/api/sales/list-invoice</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>id_kftd (required)</li>	
						<li>id_customer (required)</li>																																											
						<li>id_produk (required)</li>
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>desc_sales_office (string)</li>
								<li>invoice (string)</li>
							</ul>
						</li>							
					</ul>
				</code></td>
			</tr>

			<tr> 
				<td>List Join Visit</td>
				<td><code>/api/karyawan/list-join-visit</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																																																
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>
						<li>items (array)	
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
								<li>role (string)</li>
							</ul>
						</li>							
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Delete Absensi</td>
				<td><code>/api/absensi/delete/{id}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																																																
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>							
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>Customer By KFTD</td>
				<td><code>/api/sales/customer-by-kftd/{id_kftd}</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>																																																
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>nama (string)</li>
							</ul>
						</li>							
					</ul>
				</code></td>
			</tr>


			<tr> 
				<td>List AM - MR</td>
				<td><code>/api/karyawan/list-am-mr</code></td>
				<td>GET</td>
				<td><code>
					<ul>
						<li>sessionID (required|string)</li>	
						<li>limit (optional|int)</li>																																															
						<li>offset (optional|int)</li>																																															
						<li>q (optional|string)</li>																																															
					</ul>
				</code>					
				</td>
				<td><code>
					<ul>
						<li>api_status (int)</li>
						<li>api_message (string)</li>
						<li>items (array)
							<ul>
								<li>id (int)</li>
								<li>role (string)</li>
								<li>nama (string)</li>
							</ul>
						</li>							
					</ul>
				</code></td>
			</tr>



		</tbody>
	</table>




	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
	integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>