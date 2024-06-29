@extends('layouts.template')
@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <div class="panel-header">
                <h5>All Provider</h5>
                <div class="btn-box">
                    <a href="{{ url('/provider/add') }}" class="btn btn-sm btn-primary"><i class="fa-light fa-plus"></i> Provider Baru</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-dashed table-hover digi-dataTable table-striped" id="table-provider">
                        <thead>
                            <tr>
                                <th>DateTime</th>
                                <th>Kategory</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Image</th>
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

<script src="{{ asset('assets/admin/provider.js') }}"></script>
@endsection