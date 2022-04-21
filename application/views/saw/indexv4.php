	<div class="card">
		<div class="card-body">
			<a class="btn btn-info" href="<?= base_url('rangking/laporan_pdf')?>" target="_blank"><i class="fa fa-print"
					aria-hidden="true"></i> Cetak PDF</a>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Tabel 1 - Tampilan Nilai Awal</h2>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr class="active">
									<th class="text-center">No</th>
									<?php
                            $no = 1;
                            $table = $this->page->getData('table1');
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
									<th class="text-center"><?php echo $heading ?></th>
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
					<div class="col-md-12">
						<br>
						<h2>Tabel 2 - Dihitung Sesuai Cost / Benefit</h2>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr class="active">
									<th class="col-md-1 text-center">No</th>
									<?php
                            $no = 1;
                            $table = $this->page->getData('table2');
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
									<th class="text-center"><?php echo $heading ?></th>
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
						<hr>
						<br>
						<h2>Nilai Min / Max</h2>
						<table class="table table-bordered">
							<tr class="active">
								<th class="col-md-1 text-center">No</th>
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
					<div class="col-md-12">
						<br>
						<h2>Tabel 3 - Perkalian Bobot</h2>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr class="active">
									<th class="col-md-1 text-center">No</th>
									<?php
                            $no = 1;
                            $table = $this->page->getData('table3');
                            foreach ($table as $item => $value) {
                                foreach ($value as $heading => $itemValue) {
                                    ?>
									<th class="text-center"><?php echo $heading ?></th>
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
					<div class="col-md-12">
						<br>
						<h2>Tabel 4 - Hasil Rangking</h2>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr class="active">
									<th class="col-md-1 text-center">No</th>
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
									<th class="text-center"><?php echo $heading ?></th>
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
					</div>
					<div class="col-md-12">
						<br>
								<?php
						$table = $this->page->getData('tableFinal');
						foreach ($table as $item => $value) {
							if ($value->Rangking == 1) {
								?>
								<div class="alert alert-info" role="alert">
									<h6><b>Kesimpulan : </b> Dari hasil perhitungan metode SAW
										calon appraiser terbaik untuk di angkat menjadi tetap adalah
										<b class="text-danger"><?php echo $value->calon ?></b> dengan nilai <b
											class="text-danger"><?php echo $value->Total ?></b>.
									</h6>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
