 	
    // DO NOT REMOVE : GLOBAL FUNCTIONS!

 $(document).ready(function() {
    	$('#effectiveStartDate').datepicker({ 
            defaultDate: "+1d", 
            minDate:0,
            dateFormat : 'yy-mm-dd',
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>'
        });
        $('#effectiveEndDate').datepicker({
            dateFormat : 'yy-mm-dd', 
            minDate:0,
            defaultDate: "+1d", 
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>'
        });
        CKEDITOR.replace( 'workInst', { height: '200px', startupFocus : true} ); 

        var indexQue = 0; 
        var formQue = 0;

        formQue = $("#wizards").children(); 
        var totalQue = 0;

        addActionQuestionForm();
        $("#wizards > div:nth-child(1) .listSubCat").trigger("change");
        for (var i = 0; i < formQue.length; i++) {
            totalQue++;
            if(totalQue > 1){ 
                if(i == 0){
                    $("#wizards > div:nth-child(" + (i+1) + ")").show(); 
                    console.log("trigger");
                }else{
                    $("#wizards > div:nth-child(" + (i+1) + ")").hide(); 
                }
            }
            
        }
        $("#queNumber h4").html(indexQue+1); 

        if(indexQue < 1){
            document.getElementById("prev").disabled = true; 
        }
        $("#next").click(function(){
            var validate = validateQuestion(); 
            // var validate = true;  
            if(validate){  
                $("#wizards > div:nth-child(" + (indexQue+1) + ")").hide("slow");   
               
                var question = $("#wizards").children();
                var totalQuestion = question.length;
                var countQue = formQue.length;
                //create new question 
                indexQue++; 

                if(indexQue == totalQuestion){
                    createQuestionFrom();
                }else{

                    addActionQuestionForm();
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .listSubCat").trigger("change");
                }
                $("#wizards > div:nth-child(" + (indexQue+1) + ")").show("slow"); 
                



                $("#queNumber h4").html(indexQue+1);
                // $( "#wizards" ).hide( "slow");
                // $( "#wizards" ).show( "slow");
                document.getElementById("prev").disabled = false;
                if(indexQue < countQue){
                    // setVal();
                }
            }else{
                alert('Ada data Question yg belum di isi');
            }
        });
        $("#prev").click(function(){  
            $("#wizards > div:nth-child(" + (indexQue+1) + ")").hide("slow");
            // getValFormQuestion();
            // resetFormQuestion();
            var countQue = formQue.length;
            indexQue--;
            $("#wizards > div:nth-child(" + (indexQue+1) + ")").show("slow");
            $("#queNumber h4").html(indexQue+1);
            // $( "#wizards" ).hide( "slow");
            // $( "#wizards" ).show( "slow");
            if(indexQue < countQue){
                // setVal();
            }
            if(indexQue < 1)
                document.getElementById("prev").disabled = true;
        
        });

        $("#delete-question").click(function(){
             $("#wizards > div:nth-child(" + (indexQue+1) + ")").remove();

             indexQue--;
             $("#queNumber h4").html(indexQue+1);
             $("#wizards > div:nth-child(" + (indexQue+1) + ")").show("slow");

             if(indexQue < 1)
                document.getElementById("prev").disabled = true;
        });

        function createQuestionFrom(){  
            var createQuestionElement = $(".default-question-form").clone(); 
            $("#wizards").append("<div id='"+indexQue+"' class='questionForm' >"+$(createQuestionElement).html()+"</>"); 
            renameNameQuestionForm();
            addActionQuestionForm();
        }

        function renameNameQuestionForm(){
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .listSubCat").attr("name","listSubCat["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .isActive").attr("name","isActive["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .duration").attr("name","duration["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .isExample").attr("name","isExample["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkTxtHint").attr("name","chkTxtHint["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtareaHint").attr("name","txtareaHint["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkImgHint").attr("name","chkImgHint["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgHint").attr("name","imgHint["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgHintText").attr("name","imgHintText["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .naration_id").attr("name","naration_id["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkQueTxt").attr("name","chkQueTxt["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtAreaQue").attr("name","txtAreaQue["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkQueImg").attr("name","chkQueImg["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgQue").attr("name","imgQue["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgQueText").attr("name","imgQueText["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .randomCha").attr("name","randomCha["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .queCharacter").attr("name","queCharacter["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").attr("name","listTypeOfAnswer["+(indexQue)+"]");
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .randomAnswer").attr("name","randomAnswer["+(indexQue)+"]"); 
        }

        function dialogSuccess(responseText){
            $('.message_dialog').html(responseText);
            $('#dialog_simple').dialog({
                autoOpen : false,
                width : 600,
                resizable : false,
                modal : true,
                title : "<div class='widget-header'><h4><i class='fa fa-warning'></i>Information</h4></div>",
                buttons : [{
                    html : "<i class='fa fa-check'></i>&nbsp; Ok",
                    "class" : "btn btn-success",
                    click : function() {
                        $(this).dialog("close");
                        if (responseText.contains("Success")) {
                            location.href = "#subcategory";
                        }
                    }
                } ]
            });
            $('#dialog_simple').dialog('open');
        }
        

        $("#btnSaves").click(function (e) {
            e.preventDefault();
            var validateHeaders = validateHeader();
            var validate = validateQuestion();
            if(validateHeaders){
                if(validate){  
                    $("#form-subCat").submit();
                }else{
                    alert('Ada data Question yg belum di isi');
                }
            }else{
                alert('Ada data yg belum di isi');
            }
        }); 

        function validateHeader(){
            var validate = true;
            var names = document.getElementById('names').value;
            var desc = document.getElementById('subCateDesc').value;
            var inst = CKEDITOR.instances.workInst.getData();
            var startDate = document.getElementById('effectiveStartDate').value;
            var EndDate = document.getElementById('effectiveEndDate').value;

            if(names == ''){
                document.getElementById("errorSubCatName").style.display = 'block';
                var validate = false;
            }else{
                document.getElementById("errorSubCatName").style.display = 'none';
            }
            if(desc == ''){
                document.getElementById("errorsubCateDesc").style.display = 'block';
                var validate = false;
            }else{
                document.getElementById("errorsubCateDesc").style.display = 'none';
            }
            if(inst == ''){
                document.getElementById("errorSubCatWOrkIns").style.display = 'block';
                var validate = false;
            }else{
                document.getElementById("errorSubCatWOrkIns").style.display = 'none';
            }
            if(startDate == ''){
                document.getElementById("errorSubCatStartDate").style.display = 'block';
                var validate = false;
            }else{
                document.getElementById("errorSubCatStartDate").style.display = 'none';
            } 
            if(validate){
                return true;
            }else{
                return false;
            }
        }
        function validateQuestion(){
            var validate = true;
            var listSubCat = $("#wizards > div:nth-child(" + (indexQue+1) + ") .listSubCat").val();
            var b = document.getElementById("isActive").checked; 
            var duration = $("#wizards > div:nth-child(" + (indexQue+1) + ") .duration").val()
            var d = document.getElementById("isExample").checked;
            var e = document.getElementById("txtareaHint").value;
            var f = document.getElementById("imgHint").value;
            var g = document.getElementById("narName").value;
            var h = document.getElementById("txtAreaQue").value;
            var txtAreaQue = $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtAreaQue").val();
            
            var imgQue = $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgQue").val();
            var imgQueText = $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgQueText").val(); 
            var listTypeOfAnswer = $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").val();
            var k = document.getElementById("randomAnswer").checked;
            var l = document.getElementById("queCharacter").value;
            var m = document.getElementById("randomCha").checked;
            if(listSubCat == '-'){ 
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorTypeSubCategory").css({'display':"block"});
                validate = false;
            }else if(listSubCat != 'MEMORY'){ 
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorTypeSubCategory").css({'display':"none"});
                console.log(txtAreaQue,imgQue,imgQueText);
                if(txtAreaQue == '' && imgQue == '' && imgQueText == ''){ 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorQuestion").css({'display':"block"});
                    validate = false;
                }else{ 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorQuestion").css({'display':"none"});
                }
                if(listTypeOfAnswer == '-'){ 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorTypeAnswer").css({'display':"block"});
                    validate = false;
                }else{ 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorTypeAnswer").css({'display':"none"}); 
                } 
            }
            if(d){
                if(e == '' && f == ''){
                    document.getElementById("errorIsExample").style.display = 'block';
                    validate = false;
                }else{
                    document.getElementById("errorIsExample").style.display = 'none';
                }
            }else{
                document.getElementById("errorIsExample").style.display = 'none';
            }
            if(duration == ''){ 
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorDuration").css({'display':"block"}); 
                validate = false;
            }else{ 
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .errorDuration").css({'display':"none"}); 
            }

            if(validate){
                return true;
            }else{
                return false;
            }

        } 

        function addActionQuestionForm(){ 
            var multi_choice_body ="<tr>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-8'>"+
                            "<input class='form-control' placeholder='Choice Text' name='multChoiceTxt["+indexQue+"][]' type='text'>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-4'>"+
                            "<input type='file' id='exampleInputFile1' name='multChoiceImg["+indexQue+"][]' style='border: solid 1px #ccc; padding: 5px 10px;'>"+
                            "<input type='hidden' name='multChoiceImgText["+indexQue+"][]' value=''>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td align='center'>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12' >"+
                            "<input type='checkbox' class='btn btn-default' id='' name='multChoiceCorrect["+indexQue+"][]'>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-1'>"+
                            "<button class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></button>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
            "</tr>";
            var multi_choice_head = "<thead><tr>"+
                "<th class='col-lg-6'>Choice Text</th>"+
                "<th class='col-lg-2'>Choice Image</th>"+
                "<th class='col-lg-2'>Correct Answer</th> "+
                "<th class='col-lg-1'>Action</th> "+
                "</tr></thead>";

            var txt_series_head = "<thead>"+
                            "<tr>"+
                                "<th class='.col-lg-9'>Correct Answer</th>"+
                                "<th class='.col-lg-2'>Action</th>"+
                            "</tr>"+
                        "</thead>";
            var txt_series_body = "<tr>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<input class='form-control' name='txtSeriesChoices["+indexQue+"][]' placeholder='Correct Answer' id='txtSeries' type='text'>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-2'>"+
                            "<a class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></a>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
            "</tr>";

            var multi_group_head = "<thead><tr>"+
                "<th class='.col-lg-7'>Image Question Sequence</th>"+
                "<th class='.col-lg-4'>Group</th>"+
                "<th class='.col-lg-1'>Action</th> "+
            "</tr></thead>";
            var multi_group_body = "<tr>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<input class='form-control' name='ansMultGroupImgSeq["+indexQue+"][]' placeholder='Image Sequence' type='text'>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-12'>"+
                            "<input class='form-control' name='ansMultGroupImg["+indexQue+"][]' placeholder='Group Image' type='text'>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<div class='form-group'>"+
                        "<div class='col-md-1'>"+
                            "<a class='btnDelete btn btn-warning'><i class='fa fa-trash-o'></i></a>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
            "</tr>"; 
            if ($("#wizards > div:nth-child(" + (indexQue+1) + ") .isExample").is(':checked')) {
                 console.log("CHECK");
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkImgHint").prop("disabled",false);
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkTxtHint").prop("disabled",false);
                 
            }
            $(".isExample").click(function(){ 
                var checked = $(this).is(":checked"); 
                console.log(checked);
                if(checked){  
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkImgHint").prop("disabled",false);
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkTxtHint").prop("disabled",false);
                }else{
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkImgHint").prop("disabled",true);
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .chkTxtHint").prop("disabled",true); 
                }
            });
            if ($("#wizards > div:nth-child(" + (indexQue+1) + ") .chkTxtHint").is(':checked')) {
               $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtareaHint").prop("disabled",false); 
                 
            }
            $(".chkTxtHint").click(function(){
                var checked = $(this).is(":checked"); 
                if(checked){  
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtareaHint").prop("disabled",false); 
                }else{
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtareaHint").prop("disabled",true);
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtareaHint").text(""); 
                } 
                
            });

            if ($("#wizards > div:nth-child(" + (indexQue+1) + ") .chkImgHint").is(':checked')) { 
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgHint").prop("disabled",false); 
                 
            }
            $(".chkImgHint").click(function(){
                var checked = $(this).is(":checked"); 
                if(checked){ 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgHint").prop("disabled",false); 
                }else{
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgHint").prop("disabled",true);
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgHint").val(""); 
                } 
            });

            if ($("#wizards > div:nth-child(" + (indexQue+1) + ") .chkQueTxt").is(':checked')) {  
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtAreaQue").prop("disabled",false);  
            }
            $(".chkQueTxt").click(function(){ 
                var checked = $(this).is(":checked"); 
                if(checked){ 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtAreaQue").prop("disabled",false); 
                }else{
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtAreaQue").prop("disabled",true);
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .txtAreaQue").text(""); 
                } 
            });
            if ($("#wizards > div:nth-child(" + (indexQue+1) + ") .chkQueImg").is(':checked')) {  
                var element = $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgQue");

                    element.prop("disabled",false); 
            }
            $(".chkQueImg").click(function(){ 
                var checked = $(this).is(":checked"); 
                var element = $("#wizards > div:nth-child(" + (indexQue+1) + ") .imgQue");
                if(checked){ 
                    element.prop("disabled",false); 
                }else{
                    element.prop("disabled",true);
                    element.val(""); 
                } 
            });  

            // SUB CATEGORY EVENT
            $("#wizards > div:nth-child(" + (indexQue+1) + ") .listSubCat").on("change",function(){  
                 
                var listSubCat = $("#wizards > div:nth-child(" + (indexQue+1) + ") .listSubCat").val();
                console.log(listSubCat,indexQue);
                if(listSubCat != '-' && listSubCat != 'MEMORY'){ 
                    console.log("NOT MEMORY");
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .randomCha").prop("checked",false); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .queCharacter").val("");

                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .randomCha").prop("disabled",true); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .queCharacter").prop("disabled",true); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").removeAttr('readonly');  
                    // $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").val("-");  
                }
                if(listSubCat == 'MEMORY'){
                    var table = $("#wizards > div:nth-child(" + (indexQue+1) + ") .questionAnswerTbl");
                    var returnTHead = "";
                    var returnTBody = "";
                    var tblHead_4 = "";
                    var tblBody_4 = ""; 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .randomCha").prop("disabled",false); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .queCharacter").prop("disabled",false); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").attr("readonly",true); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").val('MEMORY'); 
                    returnTHead = tblHead_4;
                    returnTBody = tblBody_4;

                    table.find("thead").remove();
                    table.find("tr").remove();
                    table.append(returnTHead);
                    table.append(returnTBody);
                }
                if(listSubCat == '-'){
                    var table = $("#wizards > div:nth-child(" + (indexQue+1) + ") .questionAnswerTbl");
                    // var table = $("#questionAnswerTbl");
                    var returnTHead = "";
                    var returnTBody = "";
                    var tblHead_4 = "";
                    var tblBody_4 = ""; 

                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .randomCha").prop("disabled",true); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .queCharacter").prop("disabled",true); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").prop("disabled",true); 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").val('-'); 
                    returnTHead = tblHead_4;
                    returnTBody = tblBody_4;

                    table.find("thead").remove();
                    table.find("tr").remove();
                    table.append(returnTHead);
                    table.append(returnTBody);
                } 
            });
            
            // TYPE OF ANSWER EVENT
            $( ".listTypeOfAnswer" ).change(function(e) {
                // var selected = $('#listTypeOfAnswer').val();
                // var table = $("#questionAnswerTbl");
                console.log($(this).prop('readonly'));
                if($(this).prop('readonly')){ return e.preventDefault();}
                var selected = $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer").val();
                var table = $("#wizards > div:nth-child(" + (indexQue+1) + ") .questionAnswerTbl");
                var returnTHead = "";
                var returnTBody = "";

                var tblHead_4 = "";
                var tblBody_4 = "";
 
                $("#wizards > div:nth-child(" + (indexQue+1) + ") .btnAddAnswer").show();
                
                if(selected == 'MULTIPLE_CHOICE'){
                    returnTHead = multi_choice_head;
                    returnTBody = multi_choice_body;
                }else if(selected == 'TEXT_SERIES'){
                    returnTHead = txt_series_head;
                    returnTBody = txt_series_body;
                }else if(selected == 'MULTIPLE_GROUP'){
                    returnTHead = multi_group_head;
                    returnTBody = multi_group_body;
                }else{
                    returnTHead = tblHead_4;
                    returnTBody = tblBody_4; 
                    $("#wizards > div:nth-child(" + (indexQue+1) + ") .btnAddAnswer").hide();
                }

                table.find("thead").remove();
                table.find("tr").remove();
                table.append(returnTHead);
                table.append(returnTBody);
            });  

            $("#wizards > div:nth-child(" + (indexQue+1) + ") .btnAddAnswer").on("click",function(e){
                e.preventDefault();
                console.log("click");
                var typeAnswerElement = $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer");
                var tableAnswer = $("#wizards > div:nth-child(" + (indexQue+1) + ") .questionAnswerTbl tbody");
                var typeAnswerVal = typeAnswerElement.val();  
                console.log(typeAnswerVal);
                if(typeAnswerVal == 'MULTIPLE_CHOICE'){
                    tableAnswer.append(multi_choice_body);
                }else if(typeAnswerVal == 'TEXT_SERIES'){
                    tableAnswer.append(txt_series_body);
                }else if(typeAnswerVal == 'MULTIPLE_GROUP'){
                    tableAnswer.append(multi_group_body);
                }

                $("#wizards > div:nth-child(" + (indexQue+1) + ") .btnDelete").on("click",function(){ 
                    var typeAnswerElement = $("#wizards > div:nth-child(" + (indexQue+1) + ") .listTypeOfAnswer");
                    var tableAnswer = $("#wizards > div:nth-child(" + (indexQue+1) + ") .questionAnswerTbl tbody");
                    var typeAnswerVal = typeAnswerElement.val(); 
                    console.log(typeAnswerVal); 
                    if(typeAnswerVal == 'MULTIPLE_CHOICE'){
                        $(this).closest("tr").remove(); 
                    }else if(typeAnswerVal == 'TEXT_SERIES'){
                        $(this).closest("tr").remove(); 
                    }else if(typeAnswerVal == 'MULTIPLE_GROUP'){
                        $(this).closest("tr").remove(); 
                    }
                }); 
            }); 
        }

        

 });
