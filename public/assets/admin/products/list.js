(function($) {
    'use strict';
    let listProductTable;

    $(document).ready(function() {
        listProductTable = refreshTable()

        $('#list-product-table_filter input').addClass('form-control').attr("placeholder", "Search...").addClass('form-control-sm');
        $('#list-product-table_length').prependTo('#productTableLength').find('select').addClass('form-control form-control-sm px-3');
        $('#list-product-table_filter').prependTo('#tableSearch');
        $('#list-product-table_info, #list-product-table_paginate').prependTo('.table-bottom-control');
    })

    async function refreshTable() {
        return await $('#list-product-table').DataTable({
            processing: true,
            ajax: {
                url: "/product/list",
                type: "GET",
                dataType: "JSON",
            },
            scrollX: true,
            columns: [
                {data: "provider"},
                {data: "code"},
                {data: "type"},
                {data: "product"},
                {data: {price_vendor: "price_vendor", price_real: "price_real", price_discount: "price_discount"}},
                {data: "published"},
                {data: "id"}
            ],
            columnDefs: [
                {
                    "targets": 'no-sort',
                    "orderable": false
                },
                {
                    targets: 4,
                    render: function(data) {
                        return `
                            <div class="text-start">
                                <b>vendor:</b> ${data.price_vendor} </br>
                                <b>real:</b> ${data.price_real} </br>
                                <b>discount:</b> ${data.price_discount}
                            </div>
                        `
                    }
                },
                {
                    targets: 6,
                    render: function(id) {
                        return `
                            <div class="w-100 gap-2 text-center">
                                <button class="btn btn-sm btn-success"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        `
                    }
                }
            ]
        })
    }

    $('#icon').on('change', function() {
        if(this.value == "upload-baru") {
            $('#upload').removeAttr('style')
        
        }else {
            $('#upload').attr('style', 'display: none')
        }
    })

    $('#add-product').on('submit', function(event) {    
        event.preventDefault();

        $.ajax({
            url: "/product/add",
            type: "post",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        }).done(function(resp) {
            if(!resp.success) {
                let error = '';
                jQuery.each(resp.errors, function(key, val) {
                    error += "<div>" + val + "</div>" 
                });

                Swal.fire('Gagal', error || resp?.message || "Invalid Response", 'error')
                return false
            }

            Swal.fire('Berhasil', resp?.message, 'success').then(() => location.href = '/product')
        })
    })

})(jQuery);