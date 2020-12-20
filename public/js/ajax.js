
$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});



function all_users(){
    $.ajax({
        type: "GET",
        url: "/members_data",
        dataType: "json",
        success: function (response) {
            
            var data= "";

            var sl= 1;
            $.each(response, function( k, v ) {
                
                data= data + "<tr>"


                data= data + "<th scope='row'>"+(sl++)+"</th>"
                data= data + "<td>"+v.name+"</td>"
                data= data + "<td>"+v.email+"</td>"
                data= data + "<td>"+v.cell+"</td>"
                data= data + "<td>"+v.role+"</td>"
                data= data + "<td>"+v.address+"</td>"


                data= data + "<td class='d-flex'>"

                    data= data + "<span>"
                            data= data + "<button class='btn btn-link' onclick='edit_data("+v.id+")' data-toggle='modal' data-target='#edit_user_modal'>"
                            data= data + "<i class='fa fa-pencil-square-o text-info' aria-hidden='true'></i>"
                            data= data + "</button>"
                    data= data + "</span>"


                    data= data + "<span>"
                            data= data + "<button class='btn btn-link' onclick='deleteData("+v.id+")'>"
                                data= data + "<i class='fa fa-trash text-danger' aria-hidden='true'></i>"
                            data= data + "</button>"
                    data= data + "</span>"

                data= data + "</td>"


                data= data + "</tr>"

              });

              $("#member_list").html(data);
        },
        
        error: function(error){
            alert(error)
        }

        
    });
}
all_users();


function creat_user(){

    $('#creat_user_form').submit(function (e) { 
        e.preventDefault();

        var form_data = {
            'name' : $('input[name=name]').val(),
            'email' : $('input[name=email]').val(),
            'cell' : $('input[name=cell]').val(),
            'role' : $('select[name=role]').val(),
            'address' : $('input[name=address]').val()
        }

        $.ajax({
            type: "POST",
            url: "/create-user",
            data: form_data,
            success: function (response) {



                let timerInterval
                Swal.fire({

                  title: 'User adder successfully',
                  timer: 1000,
                  
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })

                $('input[name=name]').val('');
                $('input[name=email]').val('');
                $('input[name=cell]').val('');
                $('select[name=role]').val('Subscriber');
                $('input[name=address]').val('');

                $('#name_error').text('');
                $('#email_error').text('');
                $('#cell_error').text('');
                $('#address_error').text('');






            },
            error: function(error){
                $('#name_error').text(error.responseJSON.errors.name);
                $('#email_error').text(error.responseJSON.errors.email);
                $('#cell_error').text(error.responseJSON.errors.cell);
                $('#address_error').text(error.responseJSON.errors.address);

            },


            



        }); 

        
        

        all_users();
       

    });

}

creat_user();


// for edit
function edit_data(id){

        $.ajax({
            type: "GET",
            url: "/edit-form/"+id,
            success: function (response) {
                $('#edit_user_form #id').val(response.id),
                $('#edit_user_form #name').val(response.name),
                $('#edit_user_form #email').val(response.email),
                $('#edit_user_form #cell').val(response.cell),
                $('#edit_user_form #role').val(response.role),
                $('#edit_user_form #address').val(response.address)

            },
            error: function(error){
                console.log(error);
            },
        });

}

// UPDATE USER DATA
$('#edit_user_form').submit(function (e) { 
    e.preventDefault();

    var update_data= {
        'id': $('#edit_user_form #id').val(),
        'name': $('#edit_user_form #name').val(),
        'email': $('#edit_user_form #email').val(),
        'cell': $('#edit_user_form #cell').val(),
        'role': $('#edit_user_form #role').val(),
        'address': $('#edit_user_form #address').val(),
    };
    console.log(update_data);
    $.ajax({
        type: "post",
        url: "/update-user",
        data: update_data,
        dataType: "json",
        success: function (response) {
            

            let timerInterval
                Swal.fire({

                  title: 'User update successfully',
                  timer: 1000,
                  
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })



        }
    });
    all_users();
    
});



// for delete
function deleteData(id){

        $.ajax({
            type: "POST",
            url: "/delete_user/"+id,

            success: function (response) {
                let timerInterval
                Swal.fire({

                  title: 'User delete successfully',
                  timer: 1000,
                  
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
            },
            error: function(error){
                console.log(error);
            },
        });
        all_users();

}
