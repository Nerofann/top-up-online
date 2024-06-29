$(document).ready(function() {
    let table_kategory = $('#table-kategory').DataTable({
        processing: true,
        order: [[0, 'desc']],
        ajax: {
            url: '/kategory/data',
            type: "GET",
            dataType: "JSON",
        },
        columns: [
            {data: "created_at"},
            {data: "name"},
            {data: "code"},
            {data: "id"},
        ],
        columnDefs: [
            {
                targets: 3,
                orderable: false,
                render: function(id) {
                    return `
                        <a class="btn btn-sm btn-success btn-edit" data-id="${id}" data-url='/kategory/edit/${id}' href="javascript:void(0)"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger btn-delete" data-url='/kategory/delete/${id}' href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                    `;
                }
            }
        ],
        drawCallback: function() {
            $('.btn-edit').on('click', function(btnEdit) {
                let id = $(btnEdit.currentTarget).data('id');
                if(!id) {
                    Swal.fire("Gagal", "ID Kategory tidak ditemukan / valid", "error")
                    return false
                }

                $.get(`/kategory/edit/${id}`, 'json', function(resp) {
                    if(!resp.success) {
                        Swal.fire("Error", resp.message || "Invalid Response")
                        return false
                    }

                    $('#edit_name').val(resp?.message?.name)
                    $('#edit_id').val(id)
                    $('#modalEditKategory').modal('show')
                })
            })

            $('.btn-delete').on('click', function(btn) {
                Swal.fire("Konfirmasi", "Apa anda yakin menghapus kategory ini?", 'question').then(function(result) {
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
                                table_kategory.ajax.reload()
                            })
                        })
                    }
                })
            })
        }
    })


    // Submit Form add Kategory
    $('#form-tambah-kategory').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            dataType: "JSON",
            data: $(this).serialize()
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

            Swal.fire('Berhasil', resp?.message || "success", 'success').then(() => table_kategory.ajax.reload())
        })
        .catch(function(err) {
            Swal.fire('Error', err, 'error')
            throw err
        })
    })  


    $('#form-update-kategory').on('submit', function(event) {
        event.preventDefault()

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            dataType: "JSON",
            data: $(this).serialize()
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

            $('#modalEditKategory').modal('hide')
            Swal.fire('Berhasil', resp?.message || "success", 'success').then(() => table_kategory.ajax.reload())
        })
        .catch(function(err) {
            Swal.fire('Error', err, 'error')
            throw err
        })
    })
})