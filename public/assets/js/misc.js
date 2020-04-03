var test = 'assets/img/avatars/sunny.png';
var notifHeader = "";
$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
    _title : function(title) {
        if (!this.options.title) {
            title.html("&#160;");
        } else {
            title.html(this.options.title);
        }
    }
}));

// $('#btnSave').click(function() {
//     $('#saveModal').dialog('open');
//     return false;
// });

$('#lookupNarration').click(function() {
    $('#lookupModal').dialog('open');
    return false;

});

function openImage(imgParam){
    var host = 'assets/img';
    test = host+imgParam;
    console.log(test);
    $('#img_modal').dialog('open');
    return false;
}

$('#img_modal').dialog({
    autoOpen : false,
    width : 600,
    resizable : false,
    modal : true,
    title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Are you sure want to save this setup?</h4></div>",
    open: function(){
        $("#contentholder").html("");
        $("#contentholder").append("<img src='"+test+"' alt='' style='width:100%'>");
    },
    buttons : [{
        html : "<i class='fa fa-trash-o'></i>&nbsp; No, Cancel",
        "class" : "btn btn-warning",
        click : function() {
            $(this).dialog("close");
        }
    }, {
        html : "<i class='fa fa-times'></i>&nbsp; Yes, Save",
        "class" : "btn btn-primary",
        click : function() {
            $(this).dialog("close");
        }
    }]
});

$('#notif_modal').dialog({
    autoOpen : false,
    width : 600,
    resizable : false,
    modal : true,
    title : "<div class='widget-header warning'><h4><i class='fa fa-warning'></i> Information</h4></div>",
    buttons : [{
        html : "<a href='?#ajax/narration/narration-inquiry.blade.php'><i class='fa fa-times'></i>&nbsp; OK </a>",
        "class" : "btn btn-warning",
    }]
});

// OPEN MODAL
$('#saveModal').dialog({
    autoOpen : false,
    width : 600,
    resizable : false,
    modal : true,
    title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Are you sure want to save this setup?</h4></div>",
    buttons : [{
        html : "<i class='fa fa-times'></i>&nbsp; Yes, Save",
        "class" : "btn btn-primary",
        click : function() {
            var myContent = CKEDITOR.instances.narrationText.getData();
            var method = 'post';
            var values =
            {
                "narrationId" : $('#narrationId').val(),
                "narrationName" : $('#narrationName').val(),
                "narrationText": myContent
            };
            if($('#narrationId').val() != null || $('#narrationId').val() != ''){
                method = 'put';
            }
            saveNarration(values, method);
            $(this).dialog("close");
        }
    },
    {
        html : "<i class='fa fa-trash-o'></i>&nbsp; NO",
        "class" : "btn btn-primary",
        click : function() {
            $(this).dialog("close");
        },
    }]
});


// LOOK UP
$('#lookupModal').dialog({
    autoOpen : false,
    width : 600,
    resizable : true,
    modal : true,
    title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Are you sure want to save this setup?</h4></div>",
    html : "<div class='widget-body no-padding'>"+
    "<table id='dt_basic' class='table table-striped table-bordered table-hover' width='100%'>"+
        "<thead>"+
            "<tr>"+
                "<th data-hide='phone'>Sub Category Name</th>"+
                "<th data-class='expand'> Question Text</th>"+
                "<th data-hide='phone'> Question Image</th>"+
                "<th>Is Active </th>"+
                "<th data-hide='phone,tablet'>Is Example</th>"+
            "</tr>"+
        "</thead>"+
        "<tbody>"+
            "<tr>"+
                "<td>1</td>"+
                "<td>Jennifer</td>"+
                "<td>1-342-463-8341</td>"+
                "<td>Et Rutrum Non Associates</td>"+
                "<td>35728</td>"+
            "</tr>"+
        "</tbody>"+
    "</table>"+
"</div>",
    buttons : [{
        html : "<i class='fa fa-trash-o'></i>&nbsp; No, Cancel",
        "class" : "btn btn-warning",
        click : function() {
            $(this).dialog("close");
        }
    }, {
        html : "<i class='fa fa-times'></i>&nbsp; Yes, Save",
        "class" : "btn btn-primary",
        click : function() {
            $(this).dialog("close");
        }
    }]
});

function saveNarration(values, method){
    console.log(values);
    $.ajax({
        url: '/api/narration',
        dataType: 'JSON',
        type: method,
        contentType: 'application/x-www-form-urlencoded',
        data: values,
        success: function( data, textStatus, jQxhr ){

            $("#notif_contentholder").html("");
            if(jQxhr.status == 200){
                notifHeader = 'SUCCESS';
                $("#notif_contentholder").append("<p> Data has been saved.");
                $('#notif_modal').dialog('close');
                return false;
            }else{
                notifHeader = 'ERROR';
                console.log(notifHeader);
                $("#notif_contentholder").append("<p> Data with Name "+values.narrationName+" already exist!");
                $('#notif_modal').dialog('open');
                return false;
            }
        },
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        }
    });

}
// validate NULL VALUE
function inputCheckNull(vals){
    var error = "";
    var results = [];
    var seq = 0;
    $.each(vals, function( index, value ) {
        if(value.fieldVal == null || value.fieldVal ==''){
            console.log("ERROR COY");
            seq =seq + 1;
            if(value.fieldName == 'name_error'){
                $('#name_error').html("");
                $('#name_error').append("<i class='fa fa-warning'></i> This field cannot be empty!");
            }else{
                $('#text_error').html("");
                $('#text_error').append("<i class='fa fa-warning'></i> This field cannot be empty!");
            }
        }

        if(value.fieldName == 'name_error' && value.fieldVal.length <= 8){
            $('#name_error').html("");
            $('#name_error').append("<i class='fa fa-warning'></i> Please fill miniimum 8 characters!");
        }else if(value.fieldName == 'text_error' && value.fieldVal.length <= 40){
            $('#text_error').html("");
            $('#text_error').append("<i class='fa fa-warning'></i> Please fill miniimum 40 characters!");
        }
    });
    if(seq == 0){
        $('#text_error').html("");
        $('#name_error').html("");
        return "OK";

    }else{
        return "false";
    }
}

