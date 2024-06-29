@extends('layouts.template')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <div class="panel-header">
                <h5>Kategory</h5>
                <div class="btn-box">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalAddKategory" class="btn btn-sm btn-primary">
                        <i class="fa-light fa-plus"></i> Kategory Baru
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-dashed table-hover digi-dataTable table-striped" id="table-kategory">
                        <thead>
                            <tr>
                                <th>DateTime</th>
                                <th>Nama</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/kategory.js') }}"></script>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" id="modalAddKategory" aria-labelledby="label-modalAddKategory">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" aria-label="label-modalAddKategory">Tambah Kategory</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <form action="{{ url('/kategory/add') }}" method="post" id="form-tambah-kategory">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="add_name" class="form-label">Nama Kategory</label>
                            <input type="text" class="form-control" name="add_name" id="add_name" placeholder="TOPUP, PULSA, PRABAYAR, DLL">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalEditKategory" aria-labelledby="label-modalEditKategory">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" aria-label="label-modalEditKategory">Edit Kategory</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <form action="{{ url('/kategory/update') }}" method="post" id="form-update-kategory">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="edit_name" class="form-label">Nama Kategory</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="TOPUP, PULSA, PRABAYAR, DLL">
                            <input type="hidden" class="form-control" name="edit_id" id="edit_id" placeholder="TOPUP, PULSA, PRABAYAR, DLL">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection