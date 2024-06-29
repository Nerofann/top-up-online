@extends('layouts.template')
@section('content')
    <div class="panel">
        <div class="panel-header">
            <h5>Product Baru</h5>
        </div>
        <div class="panel-body">
            <form action="/product/add" method="post" id="add-product">
                <div class="row">
                    <div class="col-8">
                        <div class="profile-edit-tab-title">
                            <h6>Product Information</h6>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 mb-2">
                                <label for="vendor_id" class="form-label">Vendor</label>
                                <select name="vendor_id" id="vendor_id" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->v_name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-6 mb-2">
                                <label for="provider_id" class="form-label">Provider</label>
                                <select name="provider_id" id="provider_id" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($providers as $prov)
                                        <option value="{{ $prov->id }}">{{ $prov->pv_name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-6 mb-2">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($types as $t)
                                        <option value="{{ Str::lower($t->type) }}">{{ Str::ucfirst($t->type) }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-6 mb-2">
                                <label for="name" class="form-label">Product Name</label>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'text'" 
                                    :name="'name'" 
                                    :id="'name'" 
                                    :isRequired="true"
                                    :placeholder="'Ex: Diamond Mobile Legend (5)'"
                                    :error="$errors->get('name')">
                                </x-forms.input>
                            </div>
    
                            <div class="col-4 mb-2">
                                <label for="price_vendor" class="form-label">Price Vendor</label>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'number'" 
                                    :name="'price_vendor'" 
                                    :id="'price_vendor'" 
                                    :isRequired="true"
                                    :value="0"
                                    :error="$errors->get('price_vendor')">
                                </x-forms.input>
                            </div>
    
                            <div class="col-4 mb-2">
                                <label for="price_real" class="form-label">Price Real</label>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'number'" 
                                    :name="'price_real'" 
                                    :id="'price_real'" 
                                    :isRequired="true"
                                    :value="0"
                                    :error="$errors->get('price_real')">
                                </x-forms.input>
                            </div>
    
                            <div class="col-4 mb-2">
                                <label for="price_discount" class="form-label">Price Discount</label>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'number'" 
                                    :name="'price_discount'" 
                                    :id="'price_discount'" 
                                    :isRequired="true"
                                    :value="0"
                                    :error="$errors->get('price_discount')">
                                </x-forms.input>
                            </div>
    
                            <div class="col-6 mb-2">
                                <label for="code" class="form-label">Code</label>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'text'" 
                                    :name="'code'" 
                                    :id="'code'" 
                                    :isRequired="true"
                                    :error="$errors->get('code')">
                                </x-forms.input>
                            </div>
    
                            <div class="col-6 mb-2">
                                <label for="extra" class="form-label">Extra</label>
                                <x-forms.input
                                    :class="'mb-25'" 
                                    :type="'text'" 
                                    :name="'extra'" 
                                    :id="'extra'" 
                                    :isRequired="true"
                                    :error="$errors->get('extra')">
                                </x-forms.input>
                            </div>
    
                            <div class="col-12 mb-2">
                                <label for="instructions" class="form-label">Instructions</label>
                                <textarea name="instructions" id="instructions" class="form-control @if($errors->get('instructions')) is-invalid @endif" id="" rows="5" name="instructions"></textarea>
                                @if($errors->get('instructions'))
                                    <div class="invalid-feedback">
                                        @foreach ($error as $e)
                                            * <small>{{ $e }}</small><br>
                                        @endforeach
                                    </div> 
                                @endif
                            </div>
    
                            <div class="col-12 mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @if($errors->get('description')) is-invalid @endif" rows="5" ></textarea>
                                @if($errors->get('description'))
                                    <div class="invalid-feedback">
                                        @foreach ($error as $e)
                                            * <small>{{ $e }}</small><br>
                                        @endforeach
                                    </div> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="profile-edit-tab-title">
                            <h6>Image</h6>
                        </div>
    
                        <div class="row mt-3">
                            <div class="col-12 mb-2">
                                <label for="icon" class="form-label">Icon</label>
                                <select name="icon" id="icon" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($icons as $icon)
                                        <option value="{{ $icon }}">{{ $icon }}</option>
                                    @endforeach
                                    <option value="upload-baru">Upload Baru</option>
                                </select>

                                <div class="mt-2" id="upload" style="display: none">
                                    <input type="file" name="icon-baru" id="icon-baru" class="form-control dropify" data-allowed-file-extensions="png jpg jpeg svg" data-height="100" >
                                </div>
                            </div>
    
                            <div class="col-12 mb-2">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">Disable</option>
                                </select>
                            </div>
    
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('/assets/admin/products/list.js') }}"></script>
@endsection