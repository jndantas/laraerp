$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // process the form
    $('#btncadastrar').click(function(event) {

        $.ajax({
            type: 'POST',
            url: $(".urlcadastro").val(),
            data: $('.formulariocadastro').serialize(),
            success: function(data) {
                if (data.code != 200) {
                    $('#msgs').html("<div class='alert alert-danger'>" + data.msg + "</div>");
                } else {
                    $('.formulariocadastro')[0].reset();
                    $('.modalcadastro').modal('hide');
                    location.reload();
                }
            },
            error: function(msg) {
                $.each(msg.responseJSON, function(key, value) {
                    console.log(value);
                    $("#" + key).attr('data-toggle', 'tooltip');
                    $("#" + key).css("border-color", "red");
                    setTimeout(function() {
                        $("#" + key).tooltip({
                            title: value[0],
                            trigger: "manual",
                            placement: "top"
                        }).tooltip("show");
                    }, 500)
                });

            }
        });
    });
});
