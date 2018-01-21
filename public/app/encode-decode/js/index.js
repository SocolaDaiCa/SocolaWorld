'use strict';

function hexToString(string) {
    $('#output').val(string);
    console.log(string);
}
$(function() {
    $('button').click(function() {
        var input = $('#input').val();
        var action = $(this).attr('name');
        switch (action) {
            case 'hexToString':
                return hexToString(input);
        }
        let data = {
            a: action,
            d: input
        };
        $.post('', data, function(res) {
            $('#output').val(res);
        });
    });
});