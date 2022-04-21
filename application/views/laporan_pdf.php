<style>
	body {
		font-size: 13px;
        font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
	}

	.page_break {
		page-break-before: always;
	}
    .col-lg-12 {
    width: 100%;
}

.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

.text-danger {
  color: red;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

/* The alert message box */
.alert {
  padding: 20px;
  background-color: #66c4de; /* Red */
  color: white;
  border: 0;
    border-radius: $border-radius-small;
    position: relative;
}



</style>

<body>
    <div class="text-center">
        <h2>Hasil Perhitungan Calon Appraiser Tetap</h2>
        <h2>Menggunakan Metode SAW</h2>
    </div>
	<div class="table-1">
		<h4>Tabel 1 - Tampilan Nilai Awal </h4>

		<div class="table-responsive">
			<table >
				<tr class="active">
					<th class="text-center">No</th>
					<?php
                            $no = 1;
                            $table = $this->page->getData('table1');
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
					<th class="text-center"><?php echo ucfirst($heading) ?></th>
					<?php
                                }
                                break;
                            }
                            ?>
				</tr>
				<?php
                        foreach ($table as $item => $value) {
                            ?>
				<tr>
					<td class="text-center"><?php echo $no ?></td>
					<?php
                                foreach ($value as $itemValue) {
                                    ?>
					<td><?php echo $itemValue ?></td>
					<?php
                                }
                                ?>
				</tr>
				<?php
                            $no++;
                        }
                        ?>

			</table>
		</div>
	</div>
	<div class="table-2">
		<h4>Tabel 2 - Dihitung Sesuai Cost / Benefit</h4>
		<div class="table-responsive">
			<table>
				<tr class="active">
					<th class="text-center">No</th>
					<?php
                            $no = 1;
                            $table = $this->page->getData('table2');
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
					<th class="text-center"><?php echo ucfirst($heading) ?></th>
					<?php
                                }
                                break;
                            }
                            ?>
				</tr>
				<?php
                        foreach ($table as $item => $value) {
                            ?>
				<tr>
					<td class="text-center"><?php echo $no ?></td>
					<?php
                                foreach ($value as $itemValue) {
                                    ?>
					<td><?php echo $itemValue ?></td>
					<?php
                                }
                                ?>
				</tr>
				<?php
                            $no++;
                        }
                        ?>
			</table>
		</div>
		<h4>Nilai Min / Max</h4>
		<table class="table table-bordered">
			<tr class="active">
				<th class="text-center">No</th>
				<th class="text-center">Kriteria</th>
				<th class="text-center">Sifat</th>
				<th class="text-center">Nilai min /max</th>
			</tr>
			<?php
                        $dataSifat = $this->page->getData('dataSifat');
                        $no = 1;
                        foreach ($dataSifat as $item => $value) {
                            ?>
			<tr>
				<td class="text-center"><?php echo $no ?></td>
				<td><?php echo $item ?></td>
				<td><?php echo $value->sifat ?></td>
				<td>
					<?php
                                    $valueMinMax = $dataSifat = $this->page->getData('valueMinMax');
                                    if (isset($valueMinMax['min' . $item])) {
                                        echo $valueMinMax['min' . $item] . ' - Minimal';
                                    }
                                    if (isset($valueMinMax['max' . $item])) {
                                        echo $valueMinMax['max' . $item] . ' - Maksimal';
                                    }
                                    ?>
				</td>
			</tr>
			<?php
                            $no++;
                        }
                        ?>
		</table>
	</div>
	<div class="page_break"></div>
	<div class="table-3">
		<h4>Tabel 3 - Perkalian Bobot</h4>
		<div class="table-responsive">
			<table >
				<tr class="active">
					<th class="text-center">No</th>
					<?php
                            $no = 1;
                            $table = $this->page->getData('table3');
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
					<th class="text-center"><?php echo ucfirst($heading) ?></th>
					<?php
                                }
                                break;
                            }
                            ?>
				</tr>
				<?php
                        foreach ($table as $item => $value) {
                            ?>
				<tr>
					<td class="text-center"><?php echo $no ?></td>
					<?php
                                foreach ($value as $itemValue) {
                                    ?>
					<td><?php echo $itemValue ?></td>
					<?php
                                }
                                ?>
				</tr>
				<?php
                            $no++;
                        }
                        ?>
			</table>
		</div>
	</div>
    <div class="div-table-4">
    <h4>Tabel 4 - Hasil Rangking</h4>
						<div class="table-responsive">
							<table >
								<tr class="active">
									<th class="text-center">No</th>
									<?php
                            $no = 1;
                            $table = $this->page->getData('tableFinal');
							$array = json_decode(json_encode($table), true);
							usort($array, function ($a, $b) {
								return $a["Rangking"] - $b["Rangking"];
							});
							
							// print_r($array);

                            foreach ($array as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
									<th class="text-center"><?php echo ucfirst($heading) ?></th>
									<?php
                                }
                                break;
                            }
                            ?>
								</tr>
								<?php
                        foreach ($array as $item => $value) {
                            ?>
								<tr>
									<td class="text-center"><?php echo $no ?></td>
									<?php
                                foreach ($value as $itemValue) {
                                    ?>
									<td><?php echo $itemValue ?></td>
									<?php
                                }
                                ?>
								</tr>
								<?php
                            $no++;
                        }
                        ?>
							</table>
    </div>
    <div class="div-final-res">
    <div class="col-md-12">
						<br>
								<?php
						$table = $this->page->getData('tableFinal');
						foreach ($table as $item => $value) {
							if ($value->Rangking == 1) {
								?>
								<div class="alert">
									<h4><b>Kesimpulan : </b> Dari hasil perhitungan metode SAW
										calon appraiser terbaik untuk di angkat menjadi tetap adalah
										<b class="text-danger"><?php echo $value->calon ?></b> dengan nilai <b
											class="text-danger"><?php echo $value->Total ?></b>.
									</h4>
								</div>
								<?php
							}
						}
						?>
					</div>
    </div>
</body>
