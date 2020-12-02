<div id="flash" data-flashData="<?= $flashdata ?>"></div>
<article style="height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="konten-table bg-light p-5 mt-4">
                    <h4 class="text-center title-table"><?= $title_table ?></h4>
                    <table class="table table-striped table-bordered dt-responsive nowrap data">
                        <thead class="bg-warning">
                            <tr>
                                <th>Username</th>
                                <th>Departemen</th>
                                <th class="text-center"><a href="#" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" onclick="tambah()"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Tambah User</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_table as $d) {
                            ?>
                                <tr>
                                    <td><?= $d->user ?></td>
                                    <td><?= $d->cat ?></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="edit('<?= $d->id ?>')"><i class="fa fa-edit fa-fw"></i>&nbsp;Edit</a> |
                                        <a href="#" class="btn btn-danger" onclick="hapus('<?= $d->id ?>')"><i class="fa fa-trash-alt fa-fw"></i>&nbsp;Hapus</a>
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
                <form action="" method="post" id="form-modal">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required autocomplete="off" placeholder="Username">
                        <span class="text-secondary"><i>(Tidak boleh lebih dari 20 karakter)</i></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required autocomplete="off" placeholder="Password">
                        <span class="text-secondary"><i>(Password minimal 8 karakter max 15 karakter dan harus mengandung huruf besar dan kecil disertai angka)</i></span>
                    </div>
                    <div class="form-group">
                        <label for="departemen">Departemen</label>
                        <select class="form-control" name="departemen" id="departemen" required>
                            <option value="">Departemen</option>
                            <option value="Admin">Admin</option>
                            <option value="PDAD">PDAD</option>
                            <option value="PLI">PLI</option>
                            <option value="KI">KI</option>
                            <option value="PERBEN">PERBEN</option>
                            <option value="P2">P2</option>
                            <option value="PKC">PKC</option>
                        </select>
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