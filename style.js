
$('.shortlist-toggle').click(function () {
    var icon = $(this);
    var propertyId = icon.data('property-id');

    $.ajax({
        url: 'toggle_shortlist.php',
        method: 'POST',
        data: { property_id: propertyId },
        success: function (response) {
            if (response == 'added') {
                icon.removeClass('far fa-heart').addClass('fas fa-heart text-danger');
            } else if (response == 'removed') {
                icon.removeClass('fas fa-heart text-danger').addClass('far fa-heart');
            }
        }
    });
});

function applyFilters() {
    $.ajax({
        url: 'properties.php',
        type: 'GET',
        data: $('#filter-form').serialize(),
        success: function (data) {
            $('#property-list').html($(data).find('#property-list').html());
            bindShortlistToggle();
        }
    });
}

function bindShortlistToggle() {
    $('.shortlist-toggle').click(function () {
        var icon = $(this);
        var propertyId = icon.data('property-id');

        $.ajax({
            url: 'toggle_shortlist.php',
            method: 'POST',
            data: { property_id: propertyId },
            success: function (response) {
                if (response == 'added') {
                    icon.removeClass('far fa-heart').addClass('fas fa-heart text-danger');
                } else if (response == 'removed') {
                    icon.removeClass('fas fa-heart text-danger').addClass('far fa-heart');
                }
            }
        });
    });
}

$('#filter-form input, #filter-form select').on('change', function () {
    applyFilters();
});

// Update the displayed value for price ranges
$('#min_price').on('input', function () {
    $('#min_price_value').val($(this).val());
});
$('#max_price').on('input', function () {
    $('#max_price_value').val($(this).val());
});
$('#min_size').on('input', function () {
    $('#min_size_value').val($(this).val());
});
$('#max_size').on('input', function () {
    $('#max_size_value').val($(this).val());
});

// Update the range input when the number input changes
$('#min_price_value').on('input', function () {
    $('#min_price').val($(this).val());
    applyFilters();
});
$('#max_price_value').on('input', function () {
    $('#max_price').val($(this).val());
    applyFilters();
});
$('#min_size_value').on('input', function () {
    $('#min_size').val($(this).val());
    applyFilters();
});
$('#max_size_value').on('input', function () {
    $('#max_size').val($(this).val());
    applyFilters();
});

bindShortlistToggle();

$('.shortlist-toggle').click(function () {
    var icon = $(this);
    var propertyId = icon.data('property-id');

    $.ajax({
        url: 'toggle_shortlist.php',
        method: 'POST',
        data: { property_id: propertyId },
        success: function (response) {
            if (response == 'added') {
                icon.removeClass('far fa-heart').addClass('fas fa-heart text-danger');
            } else if (response == 'removed') {
                icon.removeClass('fas fa-heart text-danger').addClass('far fa-heart');
            }
        }
    });
});