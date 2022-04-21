<style>
	.form-control+.input-group-append .input-group-text,
	.form-control+.input-group-prepend .input-group-text {
		background-color: #dee2e6;
	}
</style>
<div class="card">
	<!-- Default panel contents -->
	<div class="card-body">
		<?php
            $msg = $this->session->flashdata('message');
            if (isset($msg)) {
                ?>
		<div class="alert alert-success alert-dismissable">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			<?php echo $msg; ?>
		</div>
		<?php
            }
            ?>
		<div class="table-responsive">
			<div class="form-group">
				<a href="<?php echo site_url('kriteria/tambah') ?>" type="button" class="btn btn-primary"><i
						class="fa fa-plus" aria-hidden="true"></i> Tambah
					Kriteria</a>
			</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Kriteria</th>
						<th>Sifat</th>
						<th>Bobot</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
                        $no = 1;
                        if (isset($kriteria)) {
                            if(count($kriteria) == 0){
                                echo '<tr><td colspan="3" class="text-center"><h3>No Data Input</h3></td></tr>';
                            }
                        foreach ($kriteria as $item) {
                            

                            ?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $item->kriteria ?></td>
						<td><?php echo $item->sifat ?></td>
						<td><?php echo $item->bobot ?></td>
						<td>

							<!-- Contextual button for informational alert messages -->
							<button type="button" class="btn btn-info btn-xs"
								onclick="lihat_kriteria(<?php echo $item->kdKriteria; ?>)">
								<i class="fa fa-eye" aria-hidden="true"></i> Lihat
							</button>

							<!-- Indicates caution should be taken with this action -->
							<button type="button" class="btn btn-warning btn-xs"
								onclick="edit_kriteria(<?php echo $item->kdKriteria; ?>)">
								<i class="fa fa-edit" aria-hidden="true"></i> Ubah Kriteria
							</button>

							<button type="button" class="btn btn-primary btn-xs"
								onclick="edit_item_kriteria(<?php echo $item->kdKriteria; ?>)">
								<i class="fa fa-edit" aria-hidden="true"></i> Ubah Item
								Kriteria
							</button>

							<!-- Indicates a dangerous or potentially negative action -->
							<button type="button" data-toggle="modal" class="btn btn-danger btn-xs"
								data-target="#modalDelete">
								<i class="fa fa-remove" aria-hidden="true"></i> Hapus
							</button>

						</td>
					</tr>
					<?php } 
                        }
                        ?>
				</tbody>
			</table>

		</div>
	</div>
</div>



<!-- Bootstrap modal -->
<div class="modal fade" tabindex="-1" id="form_kriteria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Ubah Kriteria Form</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body form">
				<form action="#" id="formKriteria">
					<div id="errors">
					</div>
					<div class="form-body">
						<input name="kdKriteria" placeholder="Kode Kriteria" class="form-control" type="hidden">

						<div class="form-group">
							<label class="control-label col-md-3">Kriteria</label>
							<div class="col-md-12">
								<input name="kriteria" placeholder="Kriteria" class="form-control" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="inputSifat" class="control-label col-md-3">Sifat </label>
							<div class="col-sm-12">
								<label class="radio-inline">
									<input type="radio" name="sifat" id="benefit" value="B" checked="checked" />
									Benefit
								</label>
								<label class="radio-inline">
									<input type="radio" name="sifat" id="cost" value="C" />
									Cost
								</label>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Bobot</label>
							<div class="col-md-12">
								<input name="bobot" placeholder="Bobot" class="form-control" type="text">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save_kriteria()" class="btn btn-primary"><i
						class="fa fa-floppy-o" aria-hidden="true"></i>
					Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"
						aria-hidden="true"></i> Cancel</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="form_item_kriteria" role="dialog">
	<div class="modal-dialog modal-item-kriteria">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Ubah Item Kriteria Form</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form action="#" id="formItemKriteria" class="form-horizontal">
					<div class="form-body">
						<input id="kdKriteriaSub" name="kdKriteria" placeholder="Kode Kriteria" class="form-control"
							type="hidden">
						<div class="form-group list_item_modal"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save_item_kriteria()" class="btn btn-primary"><i
						class="fa fa-floppy-o" aria-hidden="true"></i>
					Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"
						aria-hidden="true"></i> Cancel</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Konfirmasi hapus data</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>

			</div>
			<div class="modal-body">
				<p>Apakah anda yakin menghapus data ini ? </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger" onclick="hapus_kriteria(<?php echo $item->kdKriteria; ?>)">
					<i class="fa fa-remove" aria-hidden="true"></i> Hapus
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Bootstrap modal -->
<div class="modal fade" id="view_kriteria" role="dialog">
	<div class="modal-dialog view-detail-kriteria">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">Konfirmasi hapus data</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<div class="panel panel-default">
					<div class="panel-heading">
					</div>
					<h5 class="panel-title">Data Kriteria</h5>
					<hr>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Kode Kriteria</label>
									<input id="viewKodeKriteria" type="text" class="form-control" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Kriteria</label>
									<input id="viewKriteria" type="text" class="form-control" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Sifat</label>
									<input id="viewSifat" type="text" class="form-control" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Bobot</label>
									<input id="viewBobot" type="text" class="form-control" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
					</div>
					<h5 class="panel-title">Data Kriteria</h5>
					<hr>
					<div class="panel-body">
						<div class="item-krit">

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-remove"
						aria-hidden="true"></i> Close</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
