$(function() {
    'use strict'

    $('#add-vendor').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: '/vendor/add',
            type: 'post',
            dataType: 'json',
            data: $(this).serialize()
        }).done(function(resp) {
            if(!resp.success) {
                let error = '';
                jQuery.each(resp.errors, function(key, val) {
                    error += val
                });

                Swal.fire('Gagal', error || resp?.message || "Invalid Response", 'error')
                return false
            }
            
            Swal.fire('Berhasil', resp.message, 'success').then(() => location.reload())
        })
    });

    $('#update-vendor').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action') ?? '/vendor/update',
            type: 'post',
            dataType: 'json',
            data: $(this).serialize()
        }).done(function(resp) {
            if(!resp.success) {
                let error = '';
                jQuery.each(resp.errors, function(key, val) {
                    error += val
                });

                Swal.fire('Gagal', error || resp?.message || "Invalid Response", 'error')
                return false
            }
            
            Swal.fire('Berhasil', resp.message, 'success').then(() => location.reload())
        })
    });

    $('#delete').on('click', function() {
        let url = $(this).attr('action') ?? false;
        Swal.fire({
            title: "Confirmation",
            text: "Hapus vendor ini?",
            showCancelButton: true,
            icon: 'question'
        })
        .then(function(result) {
            if(result.value) {
                if(!url) {
                    Swal.fire("Gagal", "ID Vendor tidak valid", "error");
                    return false;
                }

                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "json",
                }).done(function(resp) {
                    if(!resp.success) {
                        Swal.fire("Gagal", resp?.message ?? "Gagal menghapus" , "error");
                        return false;
                    }

                    Swal.fire('Berhasil', resp.message, 'success').then(() => location.href = '/vendor/add');
                })
            }
        })
    })
})