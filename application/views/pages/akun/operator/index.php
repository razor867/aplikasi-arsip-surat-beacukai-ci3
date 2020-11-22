<article style="height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="konten-table bg-light p-5 mt-4">
                    <h4 class="text-center title-table"><?= $title_table ?></h4>
                    <table class="table table-hover table-striped table-bordered data">
                        <thead class="bg-warning">
                            <tr>
                                <th>No Surat</th>
                                <th>Tanggal</th>
                                <th>Agenda</th>
                                <th class="asal-tujuan"></th>
                                <th>Perihal</th>
                                <th>File Surat</th>
                                <th class="text-center"><a href="#" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" onclick="tambah()">Tambah User</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_table as $d) {
                            ?>
                                <tr>
                                    <td><?= $d->nomor_srt ?></td>
                                    <td><?= $d->tanggal ?></td>
                                    <td><?= $d->agenda ?></td>
                                    <td>
                                        <?php
                                        if ($title_table == 'Daftar Surat Masuk' || $title_table == 'Daftar ND Masuk') {
                                            echo $d->asal;
                                        } else {
                                            echo $d->tujuan;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $d->perihal ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('uploads/' . $folder . '/' . $d->nama_file_srt) ?>" class="btn btn-info" target="blank">File</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="edit(<?= $d->id ?>)">Edit</a> |
                                        <a href="#" class="btn btn-danger" onclick="hapus(<?= $d->id ?>)">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</article>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-modal" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nosurat">No Surat</label>
                            <input class="form-control" type="text" name="nosurat" id="nosurat" required autocomplete="off" placeholder="No Surat">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="agenda">Agenda</label>
                            <input class="form-control" type="text" name="agenda" id="agenda" required autocomplete="off" placeholder="Agenda">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="asaltujuan" class="asal-tujuan">Asal</label>
                            <select class="form-control" name="asaltujuan" id="asaltujuan" required>
                                <option value="">Departemen</option>
                                <option value="PDAD">PDAD</option>
                                <option value="PLI">PLI</option>
                                <option value="KI">KI</option>
                                <option value="PERBEN">PERBEN</option>
                                <option value="P2">P2</option>
                                <option value="PKC">PKC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="perihal">Perihal</label>
                            <input class="form-control" type="text" name="perihal" id="perihal" required autocomplete="off" placeholder="Perihal">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="filesurat">Upload Surat</label>
                            <input class="form-control" type="file" name="filesurat" id="filesurat" required>
                        </div>
                    </div>
                    <div class="form-group info">
                        <label class="text-secondary" for=""><i>File yang diupload sebelumnya</i></label>
                        <input class="form-control" type="text" id="info" name="info" readonly>
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>