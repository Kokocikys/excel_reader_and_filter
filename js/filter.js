$(document).ready(function () {
    $('#filter').on('submit', function (event) {
        let minPrice = $('#minPrice').val();
        let maxPrice = $('#maxPrice').val();
        let selectedAmount = $('#selectedAmount').val();
        let typeOfPrice = $('#typeOfPrice').val();
        let amountNumber = $('#amountNumber').val();
        event.preventDefault();
        $.ajax({
            url: "filter.php",
            method: "POST",
            data: {
                minPrice: minPrice,
                maxPrice: maxPrice,
                selectedAmount: selectedAmount,
                typeOfPrice: typeOfPrice,
                amountNumber: amountNumber
            },
            success: function (data) {
                $('#tableArea').html(data);
            }
        });
    });
});
