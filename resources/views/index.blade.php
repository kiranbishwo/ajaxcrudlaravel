@extends('app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-10">
       <span class="error_list text-danger col-12"></span>
        <span class="success_list text-success col-12"></span>
        <h1 class=""> Laravel Ajax Crud <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary ml-auto">Add Data</button></h1>
        <div class="table">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">course</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>

{{-- Add Model --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addStudent"  action="javascript:void(0)"  method="POST">
      <div class="modal-body">
        
          <div class="">
            
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
          </div>
          <div class="">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
          </div>
          <div class="">
            <label for="contact" class="form-label">Contact </label>
            <input type="text" name="contact" class="form-control" id="contact">
          </div>
          <div class="">
            <label for="contact" class="form-label">Course </label>
            <select name="cource" class="form-control" id="course">
              <option value="BBA">BBA</option>
              <option value="BIIS">BCIS</option>
              <option value="BIT">BIT</option>
            </select>
           
          </div>
          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-submit">Add Student</button>
      </div>
    </form>
    </div>
  </div>
</div>
{{-- End Add Model --}}
{{-- Edit Model --}}
<div class="modal fade" id="editstudentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editStudent"  action="javascript:void(0)"  method="POST">
      <div class="modal-body">
        
          <div class="">
            <input type="hidden" name="id" class="form-control" id="edit_id" aria-describedby="emailHelp">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="edit_name" aria-describedby="emailHelp">
          </div>
          <div class="">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="edit_email" aria-describedby="emailHelp">
          </div>
          <div class="">
            <label for="contact" class="form-label">Contact </label>
            <input type="text" name="contact" class="form-control" id="edit_contact">
          </div>
          <div class="">
            <label for="contact" class="form-label">Course </label>
            <select name="cource" class="form-control" id="edit_cource">
              <option value="BBA">BBA</option>
              <option value="BIIS">BCIS</option>
              <option value="BIT">BIT</option>
            </select>
           
          </div>
          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-edit">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>
{{-- End Edit Model --}}
@endsection

@section('script')

<script>
$(document).ready(function(){
  loadtable();
    
    
    // load table
    function loadtable()
    {
      $.ajax({
        type:"POST",
        url : "{{ url('loadtable') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: "json",
        success: function(response){
          $('tbody').html('');
          $.each(response.students, function(key,item){
            $('tbody').append(
             ` <tr>
                <th scope="row">${item.id}</th>
                <th scope="row">${item.name}</th>
                <th scope="row">${item.email}</th>
                <th scope="row">${item.phone}</th>
                <th scope="row">${item.cource}</th>
                <td><button value="${item.id}" class="btn btn-sm btn-warning edit-btn">Edit</button></td>
                <td><button data-id="${item.id}" class="btn btn-sm btn-danger delete_btn">Delete</button></td>
              </tr>`
            )
          })
        }

      });
    }
    // edit data
    $(document).on('click', '.edit-btn', function(e){
    e.preventDefault();
      var std_id = $(this).val();
      
      $("#editstudentmodal").modal('show');
      $.ajax({
        type:'GET',
        url:"/edit/"+std_id,
        success:function(data){
          console.log(data);
          $('#edit_id').val(data.message.id);
          $('#edit_name').val(data.message.name);
          $('#edit_email').val(data.message.email);
          $('#edit_contact').val(data.message.phone);
          $('#edit_cource').val(data.message.cource);

        }
      });
    })
  // add student model
  // $(".btn-submit").click(function(e){
    
  //   e.preventDefault();
 
  //   var name = $("#name").val();
  //   var email = $("#email").val();
  //   var contact = $("#contact").val();
  //   var cource = $("#course").val();
 
  //   $.ajax({
  //      type:'POST',
  //      url:"{{ url('add') }}",
  //      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  //      data:{name:name, email:email, contact:contact, cource:cource},
  //      dataType:'json',
  //      success:function(data){
  //       loadtable();
  //           if(data.status ==200){
  //             $('.success_list').text('Student Added Sucessfully')
  //           }else{
  //             $('.error_list').text('error occurs.')
  //           }
  //           $("#exampleModal").modal('hide');
  //      }
  //   });
  $("#addStudent").on("submit", function(e){
    e.preventDefault();
    
    var formData = new FormData(this);
 
    $.ajax({
       type:'POST',
       url:"{{ url('add') }}",
       cache:false,
      data :formData,
      contentType : false, // you can also use multipart/form-data replace of false
      processData: false,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //  data:{name:name, email:email, contact:contact, cource:cource},
       dataType:'json',
       success:function(data){
        loadtable();
            if(data.status ==200){
              $('.success_list').text('Student Added Sucessfully')
            }else{
              $('.error_list').text('error occurs.')
            }
            $("#exampleModal").modal('hide');
       }
    });

});

$("#editStudent").on("submit", function(e){
    e.preventDefault();
    
    var formData = new FormData(this);
 
    $.ajax({
       type:'POST',
       url:"{{ url('update') }}",
       cache:false,
      data :formData,
      contentType : false, // you can also use multipart/form-data replace of false
      processData: false,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //  data:{name:name, email:email, contact:contact, cource:cource},
       dataType:'json',
       success:function(data){
        loadtable();
            if(data.status ==200){
              $('.success_list').text('Student Added Sucessfully')
            }else{
              $('.error_list').text('error occurs.')
            }
            $("#exampleModal").modal('hide');
       }
    });

});


$(document).on("click",".delete_btn", function(){
    var delId = $(this).data("id");
    console.log(delId);
    $.ajax({
      url: "{{ url('delete') }}",
      type : "POST",
      data : {id : delId},
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType:'json',
      success : function(data){
        loadtable();
        if(data.status ==200){
              // $('.success_list').text('Student Added Sucessfully')
              console.log("Student Deleted Sucessfully");
            }else{
              // $('.error_list').text('error occurs.')
              console.log("Unable to delete");
            }
      }
    });
});
})
</script>


@endsection