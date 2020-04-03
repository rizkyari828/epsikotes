@foreach ($valeInput as $index => $item)
                                        <option value="{{$item['PERSON_ID']}}/{{$item['BIRTH_DATE']}}">{{$item['USER_NUMBER']}} - {{$item['FULL_NAME']}} </option>
                                    @endforeach



 
                var personId = $( "input[name='person_id']" ).val(),
                url = 'findUserNumber';



                // Send the data using post
                var search = $.post( url, { _token : $('input[name="_token"]').val(),personId: personId } );
                 
                  // Put the results in a div
                search.done(function( data ) {
                    console.log(data);
                });




                var arrayList = [
                    {"Id": 100, "Name": "Abc"}, 
                    {"Id": 200, "Name": "XYZ"}
                ];

                $("#initializeDuallistbox").children().remove();

                for (var i = 0; i < arrayList.length; i++) {
                    $('<option>').val(arrayList[i].Id).text(arrayList[i].Name).appendTo("#initializeDuallistbox");
                }

                $(".passwordPeople").bootstrapDualListbox('refresh', true);