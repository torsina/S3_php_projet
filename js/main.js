$('.carousel').carousel({
    interval: 2000000
});

$('#datepicker').datepicker({
    format: "yy-mm-dd",
    dateFormat: "yy-mm-dd",
    language: "fr",
    calendarWeeks: true,
    autoclose: true
});

function orderTravel(form) {
    form = $(form).parent();
    const data = getFormData(form);
    $.post("api/travel/order", data, function (result) {
        console.log(result);
    });
}

function createTravel() {
    const form = $("#createForm");
    const data = new FormData($('#createForm')[0]);
    console.log(data);
    $.ajax({
        url: 'api/travel/create',
        type: 'POST',
        enctype: 'multipart/form-data',
        data: new FormData($('#createForm')[0]), // The form with the file inputs.
        processData: false,
        contentType: false                    // Using FormData, no need to process data.
    }).done(function(){
        alert("done")
    }).fail(function(data){
        alert("error: " + data.toString());
    });
}

function deleteTravel(buttonInput) {
    const form = $(buttonInput).parent();
    const data = getFormData(form);

    $.post("api/travel/delete", data, function (result) {
        console.log(result);
    });
}

function editTravel(formId) {
    const form = $("#"+formId + " :input");
    const data = getFormData(form);
    console.log(data);
    data.edit_startDate = new Date(data.edit_startDate).toISOString();
    data.edit_endDate = new Date(data.edit_endDate).toISOString();
    console.log(data);
    $.post("api/travel/edit", data, function (result) {
        //location.reload();
    });
}

function test(something) {
    const foo = $(something);
    foo.preventDefault();

}

$(document).ready(function() {
    $('#createForm').on('submit', function(e){
        e.preventDefault();
    });
});

// source: https://www.quirksmode.org/js/cookies.html
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

// source: https://stackoverflow.com/a/11339012
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
