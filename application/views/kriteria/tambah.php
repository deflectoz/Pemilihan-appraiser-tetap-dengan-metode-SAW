<style>
	.btn {
		padding-top: 10px;
		margin: 23px 10px;
	}

</style>
<div class="card">
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
		<?php echo form_open('',array('class' => 'form-horizontal'))?>
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<?php echo form_label('Kriteria :', '',array('for' => 'inputKriteria', 'class' => 'control-label')) ?>
					<?php echo form_input('kriteria', set_value('kriteria'), array('id' => 'inputKriteria', 'class' =>'form-control', 'placeholder' => 'Inputkan Nama Kriteria' )) ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<?php echo form_label('Sifat :', '',array('for' => 'inputSifat', 'class' => 'control-label')) ?>
					<label class="radio-inline">
						<?php echo form_radio('sifat','B', true )?> Benefit
					</label>
					<label class="radio-inline">
						<?php echo form_radio('sifat','C' )?> Cost
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<?php echo form_label('Bobot :', '',array('for' => 'inputBobot', 'class' => 'control-label')) ?>
					<?php echo form_input('bobot', set_value('bobot'), array('id' => 'inputBobot', 'class' =>'form-control', 'placeholder' => 'Inputkan Bobot' )) ?>
				</div>
			</div>
		</div>
		<div id="dynamic_field">
			<div class="row" id="row1">
				<div class="col-md-11 pr-1">
					<div class="form-group">
						<label class="control-label" for="">Komponen Kriteria: 1 Dengan Value: 1</label>
						<input type="text" class="form-control" id="itemKriteria" placeholder="Inputkan Kriteria"
							name="itemKriteria[]" autocomplete="off">
                            <input type="hidden" name="value[]" value="1">
					</div>
				</div>
				<div class="col-md-1 pl-1">
					<button type="button" name="add" id="add" id="btn" class="btn btn-success">+</button>
				</div>
				
			</div>
		</div>
	</div>
    <div class="card-footer">
    <?php echo form_submit('simpan', 'Simpan', array('class' => 'btn btn-success btn-block')) ?>
	<br>
	<a class="btn btn-danger btn-block" href="<?= base_url('kriteria') ?>" role="button">Batal</a>
    <?php echo form_close()?>
    </div>
</div>
</div>
