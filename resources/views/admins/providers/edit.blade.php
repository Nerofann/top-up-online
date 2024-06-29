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
                        <div class="col-6">
                            <label for="prov_kategory" class="form-label">Kategory</label>
                            <select name="prov_kategory" id="prov_kategory" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($kategory as $kat)
                                    <option value="{{ $kat->id }}" @selected(($kat->id == ($provider->pv_kategoryid ?? old('prov_kategory'))))>{{ $kat->kt_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
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

                        <div class="col-6">
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

                        <div class="col-6">
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

                        <div class="col-6">
                            <label for="prov_image" class="form-label">Gambar</label>
                            <input type="file" name="prov_image" id="prov_image" data-default-file="{{ Storage::url($provider->pv_image) }}" class="form-control dropify" data-height="300" >
                        </div>

                        <div class="col-6">
                            <label for="prov_banner" class="form-label">Banner</label>
                            <input type="file" name="prov_banner" id="prov_banner" data-default-file="{{ Storage::url($provider->pv_banner) }}" class="form-control dropify" data-height="300" >
                        </div>

                        <div class="col-12">
                            <button type="button" type="reset" name="reset" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/admin/provider.js') }}"></script>
@endsection