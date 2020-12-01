$(document).ready(function () {
    $('#importExcelForm').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "tableImport.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#import').attr('disabled', 'disabled').val('Загрузка...');
            },
            success: function (data) {
                $('#importExcelForm')[0].reset();
                $('#import').attr('disabled', false).val('Загрузить');
                $('#message').html(data).addClass('alert alert-info');
            }
        })
    });
});