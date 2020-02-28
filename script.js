$(document).ready(function () {

    // Add new motor
    $("#add-motor").click(function () {

        var element = ".motor";
        // Finding total number of elements added
        var total_element = $(element).length;

        // last <div> with element class id
        var lastid = $(element+":last").attr("id");
        var split_id = lastid.split("-");
        var nextindex = Number(split_id[1]) + 1;

        const motor = `
<div class="form-inline mt-2 motor" id="motor-${nextindex}">

    <div class="form-group">
        <!-- <label for="motor-${nextindex}-marka">Motor márka: </label> -->
        <input type="text" id="motor-${nextindex}-make" name="motor-${nextindex}-make" class="form-control"
            placeholder="Márka">
    </div>

    <div class="form-group mx-sm-2">
        <!-- <label for="motor-${nextindex}-tipus">Motor típus: </label> -->
        <input type="text" id="motor-${nextindex}-type" name="motor-${nextindex}-type" class="form-control"
            placeholder="Típus">
    </div>

    <!-- Remove motor -->
    <button type="button" class="btn btn-danger remove-motor" id="remove-${nextindex}">
        <i class="fa fa-remove" aria-hidden="true"></i>
    </button>

</div>
        `;

        var max = 5;
        // Check total number elements
        if (total_element < max) {
            $(element+":last").after(motor);
        }

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

            }
        });
    });

});