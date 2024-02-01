// public/js/auto-save.js

$(document).ready(function () {
    $('.uid-input').on('input', function () {
        var inputValue = $(this).val();
        var iteration = $(this).closest('tr').find('td:first').text(); // Mengambil nomor iterasi

        // Mengirim data ke server menggunakan AJAX
        $.ajax({
            url: '/auto-save', // Sesuaikan dengan URL yang sesuai
            type: 'POST',
            data: {
                iteration: iteration,
                value: inputValue
            },
            success: function (response) {
                console.log('Data disimpan:', response);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});
