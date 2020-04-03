pageSetUp();
$('#name').click(function(){
    $('#myModal').modal('show');
});

$('#btnFind').click(function(){
    var nameLookup = $('#nameLookup').val();
    var textLookup = $('#textLookup').val();
    var url = $('#url').val();

    // if((nameLookup == null || nameLookup == '') && (textLookup == null || textLookup == '') ){
    //     alert('empty ');
    // }

    var table = $('#lookupTbl').DataTable({
        "bDestroy": true,
        "searching": false,
        "ajax":{
            "method":"GET",
            "dataType" :"JSON",
            "url":"/api/lookup/sub-category",
            "data" : {
                "q":nameLookup
            },
        },
        "columns":[
            {
                "data": "subCategoryName",
                "render": function (data, type, row) {
                    return "<span style='cursor: pointer;'> "+data+"</span>"; //onClick='clicki('"+data+"')'
                }
            }
            // {
            //     "data": "id",
            //     "render": function (data, type, row) {
            //         return "data";
            //     }
            // },
            // {
            //     "data": "subCategoryName",
            //     "render": function (data, type, row) {
            //         return "<p onClick='clicki()'> "+data+"</p>";
            //     }
            // }
        ]
    });
});

$( "#lookupTbl tbody" ).on( "click", "tr", function() {
    $('#name').val($( this ).index());
    $('#myModal').modal('hide');
  });



