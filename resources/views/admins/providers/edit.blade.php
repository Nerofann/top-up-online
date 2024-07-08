@extends('layouts.template')
@section('content')
    <div class="panel">
        <div class="panel-header">
            <h5></h5>
        </div>
        <div class="panel-body">
            <form action="{{ route('adminProviderUpdate_post', ['slug' => $provider->pv_slug]) }}" method="post" id="form-submit-update" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="profile-edit-tab-title mb-3">
                            <h6>Informasi Provider</h6>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="prov_kategory" class="form-label">Kategory</label>
                            <select name="prov_kategory" id="prov_kategory" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($kategory as $kat)
                                    <option value="{{ $kat->id }}" @selected(($kat->id == ($provider->pv_kategoryid ?? old('prov_kategory'))))>{{ $kat->kt_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="prov_dev" class="form-label">Developer</label>
                            <x-forms.input
                                :class="'mb-25'" 
                                :type="'text'" 
                                :name="'prov_dev'" 
                                :id="'prov_dev'" 
                                :isRequired="true"
                                :placeholder="'Ex: Moonton'"
                                :value="$provider->pv_dev"
                                :error="$errors->get('prov_dev')">
                            </x-forms.input>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="prov_code" class="form-label">Kode</label>
                            <x-forms.input
                                :class="'mb-25'" 
                                :type="'text'" 
                                :name="'prov_code'" 
                                :id="'prov_code'" 
                                :isRequired="true"
                                :value="$provider->pv_code"
                                :error="$errors->get('prov_code')">
                            </x-forms.input>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="prov_nama" class="form-label">Nama</label>
                            <x-forms.input
                                :class="'mb-25'" 
                                :type="'text'" 
                                :name="'prov_nama'" 
                                :id="'prov_nama'" 
                                :isRequired="true"
                                :value="$provider->pv_name"
                                :error="$errors->get('prov_nama')">
                            </x-forms.input>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="editor" class="form-label">Deskripsi</label>
                            <textarea id="editor" class="form-control">{{ $provider->pv_desc ?? "" }}</textarea>
                        </div>

                        <div class="profile-edit-tab-title mb-3">
                            <h6>Gambar</h6>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="prov_image" class="form-label">Logo</label>
                            <input type="file" name="prov_image" id="prov_image" data-default-file="{{ Storage::url($provider->pv_image) }}" class="form-control dropify" data-height="300" >
                        </div>

                        <div class="col-6 mb-2">
                            <label for="prov_banner" class="form-label">Banner</label>
                            <input type="file" name="prov_banner" id="prov_banner" data-default-file="{{ Storage::url($provider->pv_banner) }}" class="form-control dropify" data-height="300" >
                        </div>

                        <div class="profile-edit-tab-title mb-2">
                            <h6>Data Topup</h6>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="requirement" class="form-label">Info Akun</label>
                            <select class="select2-multiple text-dark" name="prov_req[]" id="requirement" multiple="multiple">
                                @foreach ($infoakun as $in => $fo)
                                    <option @selected(in_array($in, (explode(",", $provider->pv_req)))) class="text-dark" value="{{ $in }}">{{ $fo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="server" class="form-label">Server <a id="create-server" data-id="{{ $provider->id }}" class=""><i class="fas fa-plus"></i></a></label>
                            <select class="select2-multiple text-dark" id="server" name="server[]" multiple="multiple">
                                @foreach ($server as $s)
                                    <option @selected((in_array("server", explode(",", $provider->pv_req)) && $s->status == 1)) class="text-dark" value="{{ $s->server }}">{{ $s->server }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12">
                            <button type="button" type="reset" name="reset" class="btn btn-sm btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/admin/provider.js') }}"></script>
@endsection