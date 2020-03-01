$(document).ready(function () {

    //Első motor gyártmánylista betöltése
    loadMakeList('motor-1-make');

    // Add new motor
    $("#add-motor").click(function () {

        var element = ".motor";
        // Finding total number of elements added
        var total_element = $(element).length;

        // last <div> with element class id
        var lastid = $(element+":last").attr("id");
        var split_id = lastid.split("-");
        var nextindex = Number(split_id[1]) + 1;

        const motor = /*html*/`
<div class="form-inline mt-2 motor" id="motor-${nextindex}">

    <div class="form-group">
        <select name="motor-${nextindex}-make" id="motor-${nextindex}-make" class="form-control make-select">
            <option value="-1"> - Válassz gyártmányt - </option>
        </select>
    </div>

    <div class="form-group mx-sm-2">
        <!-- <label for="motor-${nextindex}-tipus">Motor típus: </label> -->
        <select name="motor-${nextindex}-type" id="motor-${nextindex}-type" class="form-control model-select">
            <option value="-1"> - Válassz modellt - </option>
        </select>
    </div>

    <!-- Remove motor -->
    <button type="button" class="btn btn-danger remove-motor" id="remove-${nextindex}">
        <i class="fa fa-remove" aria-hidden="true"></i>
    </button>

</div>
        `;

        var max = 5;
        // Check total number of elements
        if (total_element < max) {
            $(element+":last").after(motor);
        }

        //Hozzáadott motor gyártmánylista feltölése
        loadMakeList('motor-'+nextindex+'make');

    });

    // Remove motor
    $('.container').on('click', '.remove-motor', function () {

        var id = this.id;
        var split_id = id.split("-");
        var deleteindex = split_id[1];

        // Remove <div> with id
        $("#motor-" + deleteindex).remove();

    });

    //Populate model on makes change
    $('.make-select').change(function(){
        var make_id = $(this).val();
        var motor_num = $(this).attr('id').split('-')[1];

        $.ajax({
            url: 'getModel.php',
            type: 'post',
            data: {make_id: make_id},
            dataType: 'json',
            success: function (response) {
                $('#motor-'+motor_num+'-model option').not(':first').remove();
                response.forEach(element => {
                    $('#motor-'+motor_num+'-model').append('<option>'+element.model+'</option>');
                });                
            }
        });
    });

});

function loadMakeList(select_id) {

}