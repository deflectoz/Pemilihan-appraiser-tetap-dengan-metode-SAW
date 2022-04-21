<div class="card">
	<?php echo form_open() ?>
	<div class="card-body">
		<div class="errors">
			<?php
            $errors = $this->session->flashdata('errors');
            if (isset($errors)) {
                foreach ($errors as $error) {
                    ?>
			<div class="alert alert-danger alert-dismissable">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<?php echo $error; ?>
			</div>
			<?php
                }
            }
            ?>
		</div>
		<div class="form-group">
			<label for="calon">Nama Calon</label>
			<input name="calon" type="text" class="form-control" id="universitas"
				value="<?php echo isset($nilaiCalon[0]->calon) ? $nilaiCalon[0]->calon : ''?>" placeholder="Nama Calon">
		</div>


		<div class="table-responsive">
			<table class="table table-borderless">
				<thead>
					<tr>
						<th class="col-md-3">Kriteria</th>
						<th colspan="5" class="text-center col-md-9">Nilai</th>
					</tr>
				</thead>

				<?php
                    foreach ($dataView as $item) {
                    ?>
				<tr>
					<td><?php echo $item['nama']; ?></td>
					<?php
                        $no = 1;
                        $bool = FALSE;
                        foreach ($item['data'] as $dataItem) {
                            ?>
					<td>
						<?php 
                                echo form_checkbox("nilai[$dataItem->kdKriteria]", "$dataItem->value", $bool);
                                ?> <?php echo $dataItem->subKriteria;
                            ?>
					</td>
					<?php
                        }
                        echo '</tr>';
                        }
                        ?>
			</table>
		</div>
	</div>
    <div class="card-footer">
    <?php echo form_submit('simpan', 'Simpan', array('class' => 'btn btn-success btn-block')) ?>
    <br>
    <a class="btn btn-danger btn-block" href="<?= base_url('kriteria') ?>" role="button">Batal</a>
    </div>
	<?php echo form_close() ?>
</div>
