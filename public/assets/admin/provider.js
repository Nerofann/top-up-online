$(document).ready(function() {
    CKEDITOR.replace('editor');
    infoAkunSelect2 = $('#requirement').select2();
    serverSelect2 = $('#server').select2();
    let select2Val = serverSelect2.val();


    let table_provider = $('#table-provider').DataTable({
        processing: true,
        order: [[0, 'desc']],
        ajax: {
            url: '/provider/data',
            type: "GET",
            dataType: "JSON",
        },
        columns: [
            {data: "created_at"},
            {data: "kategory"},
            {data: "pv_code"},
            {data: "pv_name"},
            {data: "pv_image"},
            {data: "pv_slug"},
        ],
        columnDefs: [
            {
                targets: 4,
                orderable: false,
                render: function(pv_image) {
                    return `<a target="blank" href="${pv_image}"><i>open</i></a>`
                }
            },
            {
                targets: 5,
                orderable: false,
                render: function(pv_slug) {
                    return `
                        <a class="btn btn-sm btn-success" href="/provider/edit/${pv_slug}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger btn-delete" data-url='/provider/delete/${pv_slug}' href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                    `;
                }
            }
        ],
        drawCallback: function() {
            $('.btn-delete').on('click', function(btn) {
                Swal.fire("Konfirmasi", "Apa anda yakin menghapus provider ini?", 'question').then(function(result) {
                    if(result.value) {
                        $.ajax({
                            url: $(btn.currentTarget).data('url'),
                            type: "POST",
                            dataType: "JSON",
                        })
                        .done(function(resp) {
                            if(!resp.success) {
                                Swal.fire("Gagal", resp.message || "Gagal Menghapus", "error")
                                return false
                            }

                            Swal.fire("Berhasil", resp.message, "success").then(function() {
                                table_provider.ajax.reload()
                            })
                        })
                    }
                })
            })
        }
    })


    // Submit Form add provider
    $('#form-submit-add').on('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(this);
        formData.append('prov_desc', CKEDITOR.instances['editor'].getData() || "");

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            data: formData
        })
        .done(function(resp) {
            if(!resp.success) {
                let error = '';
                jQuery.each(resp.errors, function(key, val) {
                    error += val
                });

                Swal.fire('Gagal', error || resp?.message || "Invalid Response", 'error')
                return false
            }

            Swal.fire('Berhasil', resp?.message || "success", 'success').then(() => location.href = '/provider')
        })
        .catch(function(err) {
            Swal.fire('Error', err, 'error')
            throw err
        })
    })  

    $('#form-submit-update').on('submit', function(event) {
        event.preventDefault()

        let formData = new FormData(this);
        formData.append('prov_desc', CKEDITOR.instances['editor'].getData() || "");

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            data: formData
        })
        .done(function(resp) {
            if(!resp.success) {
                let error = '';
                jQuery.each(resp.errors, function(key, val) {
                    error += val
                });

                Swal.fire('Gagal', error || resp?.message || "Invalid Response", 'error')
                return false
            }

            Swal.fire('Berhasil', resp?.message || "success", 'success').then(() => location.href = '/provider')
        })
        .catch(function(err) {
            Swal.fire('Error', err, 'error')
            throw err
        })
    })

    $('#create-server').on('click', function(event) {
        Swal.fire({
            text: "Masukkan Nama Server",
            input: "text",
            inputAttributes: {
                autoCapitalize: false
            },
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Tambah",
            preConfirm: async(server) => {
                try {
                    let result = false;
                    await $.ajax({
                        url: "/provider/addServer",
                        type: "post",
                        dataType: "json",
                        data: {
                            provider_id: $(event.currentTarget).data('id'), 
                            server: server,
                        }
                    }).done(function(resp) {
                        if(!resp.success) {
                            let error = '';
                            jQuery.each(resp.error, function(key, val) {
                                error += val
                            });
                            
                            Swal.showValidationMessage(error || resp.message)
                            return false;   
                        }

                        result = true;
                        select2Val.push(server);
                        serverSelect2
                            .append(new Option(server, server, false, false))
                            .val(select2Val)
                            .trigger('change')

                    })

                    if(result) {
                        return server;
                    }
                    

                } catch (error) {
                    Swal.showValidationMessage(`Request failed: ${error}`)
                }
            }
        })
    })
})