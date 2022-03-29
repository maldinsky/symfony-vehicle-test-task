const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
    $('.js-get-vehicle-model').on('click', function (){
        var jsGetVehicleModel = $(this),
            blockToggle = $(jsGetVehicleModel.data('toggle')),
            vehicleType = jsGetVehicleModel.data('vehicle-type'),
            vehicleMake = jsGetVehicleModel.data('vehicle-make');
        $.ajax({
            url: '/makes/' + vehicleType + '/' + vehicleMake,
            dataType: 'json',
        })
        .done(function(response) {
            let result = '';

            for (let vehicleModelKey in response) {
                if (response.hasOwnProperty(vehicleModelKey)) {
                    const vehicleModel = response[vehicleModelKey];

                    result += '<li>' + vehicleModel.code + ' - ' + vehicleModel.description + '</li>';
                }
            }

            if(result) {
                blockToggle.find('.js-response-list-vehicle-model').html('<ul>' + result + '</ul>');
            } else {
                blockToggle.find('.js-response-list-vehicle-model').html('<p class="text-center">Not found</p>');
            }
        })
        .fail(function() {
            blockToggle.find('.js-response-list-vehicle-model').html('<p class="text-center">Error, please try again later</p>');
        })
        .always(function (){
            blockToggle.removeClass('d-none');
        });
    });
});
