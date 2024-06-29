@extends('layouts.template')
@section('content')
    <div class="panel">
        <div class="panel-header">
            <h5>Add New Vendor</h5>
        </div>
        <div class="panel-body">
            <form action="/vendor/add" method="post" id="add-vendor">
                <div class="row">
                    <div class="col-6 mb-2">
                        <label for="name" class="form-label">Name</label>
                        <x-forms.input
                            :class="'mb-25'" 
                            :type="'text'" 
                            :name="'name'" 
                            :id="'name'" 
                            :isRequired="true"
                            :error="$errors->get('name')">
                        </x-forms.input>
                    </div>
    
                    <div class="col-6 mb-2">
                        <label for="endpoint" class="form-label">Endpoint</label>
                        <x-forms.input
                            :class="'mb-25'" 
                            :type="'text'" 
                            :name="'endpoint'" 
                            :id="'endpoint'" 
                            :isRequired="true"
                            :error="$errors->get('endpoint')">
                        </x-forms.input>
                    </div>
    
                    <div class="col-6 mb-2">
                        <label for="api_key" class="form-label">Api Key</label>
                        <x-forms.input
                            :class="'mb-25'" 
                            :type="'text'" 
                            :name="'api_key'" 
                            :id="'api_key'" 
                            :isRequired="true"
                            :error="$errors->get('api_key')">
                        </x-forms.input>
                    </div>
    
                    <div class="col-6 mb-2">
                        <label for="private_key" class="form-label">Private Key</label>
                        <x-forms.input
                            :class="'mb-25'" 
                            :type="'text'" 
                            :name="'private_key'" 
                            :id="'private_key'" 
                            :isRequired="true"
                            :error="$errors->get('private_key')">
                        </x-forms.input>
                    </div>
    
                    <div class="col-12 mb-2">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control @if($errors->get('description')) is-invalid @endif" rows="5">-</textarea>
                        @if($errors->get('description'))
                            <div class="invalid-feedback">
                                @foreach ($error as $e)
                                    * <small>{{ $e }}</small><br>
                                @endforeach
                            </div> 
                        @endif
                    </div>
    
                    <div class="col-12 mb-2">
                        <div class="d-flex gap-2 float-end">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/admin/vendor.js') }}"></script>
@endsection