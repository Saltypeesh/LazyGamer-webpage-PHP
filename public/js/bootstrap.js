$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            420: {
                autoWidth: true
            }
        }
    })

    $('#multiple-select-field').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
    });

    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

    // Submit all (hidden) forms
    $(function () {
        $("#allsubmit").click(function () {
            $('.allforms').each(function () {
                valuesToSend = $(this).serialize();
                $.ajax($(this).attr('action'),
                    {
                        method: $(this).attr('method'),
                        data: valuesToSend
                    }
                )
            });
        });
    });

    $(".edit-feedback").click(function () {
        // var id = $(this).attr('id');
        var id = $(this).data('feedback');

        console.log(id);
        
        $('#feedback-action_' + id).hide(300);
        $('#feedback-action_edit_'+id).show(300);
        $('#p_feedback_' + id).hide(300);
        $('#textarea_feedback_' + id).show(300).focus();
    });

    $(".cancel-feedback").click(function () {
        var id = $(this).data('feedback');
        $('#feedback-action_' + id).show(300);
        $('#feedback-action_edit_'+id).hide(300);
        $('#p_feedback_' + id).show(300);
        $('#textarea_feedback_' + id).hide(300).focus();
    });
});
