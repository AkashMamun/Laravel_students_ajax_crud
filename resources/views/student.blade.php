<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <title>Hello, world!</title>
  </head>
  <body>
    <section style="margin-top:60px">
        <div class="container">
            <div class="row">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mb-4">
                <div class="col-md-3"></div>
                   <div class="col-md-6">
                       <strong>Select Language: </strong>
                       <select class="form-control lang-change">
                           <option value="en" {{ session()->get('lang_code')=='en' ? 'selected' : ''}}>English</option>
                           <option value="sp" {{ session()->get('lang_code')=='sp' ? 'selected' : ''}}>Spanish</option>
                           <option value="bn" {{ session()->get('lang_code')=='bn' ? 'selected' : ''}}>Bengali</option>
                       </select>
                   </div>
               </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            
                            <h1>{{ __('text.content') }}
                                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentModal">{{ __('text.addNew')}} </a>
                                <a href="" class="btn btn-danger" id="deleteAllSelectedRecord">Delete Selected</a>
                            </h1>
                        </div>
                        <div class="card-body">
                            <table id="studentTabel" class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="chkCheckAll"></th>
                                        <th>Id</th>
                                        <th>FirstName</th>
                                        <th>LastName</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student )                                   
                                        <tr id="sid{{ $student->id }}">
                                            <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $student->id }}"></td>
                                            <td>{{ $student->id}}</td>
                                            <td>{{ $student->firstname}}</td>
                                            <td>{{ $student->lastname }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="editStudent({{ $student->id }})" class="btn btn-info"> Edit </a>
                                                <a href="javascript:void(0)" onclick="deleteStudent({{ $student->id }})" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  
  <!-- Add student Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new student </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" id="studentForm">
                @csrf
                <div class="errMsgContainer">

                </div>
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your first name">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your last name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group mt-3">
                    <label for="phone_no">Phone No. </label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone no">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit student Modal -->
  <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit student </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" id="studentEditForm">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="errMsgContainer">

                </div>
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname2" class="form-control" placeholder="Enter your first name">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname2"class="form-control" placeholder="Enter your last name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email2" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group mt-3">
                    <label for="phone_no">Phone No. </label>
                    <input type="text" id="phone2" class="form-control" placeholder="Enter your phone no">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable('#myTable', {
    responsive: true
});
</script>
    <script>
        // alert('helo');
        $("#studentForm").submit(function(e){
            e.preventDefault();

            let firstname = $("#firstname").val();
            let lastname = $("#lastname").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let _token = $("input[name = _token]").val();

            $.ajax({
                url: "{{ route('student.add') }}",
                type : "POST",
                data : {
                    firstname: firstname,
                    lastname : lastname,
                    email : email,
                    phone : phone,
                    _token : _token
                },
                success:function(response){
                    if(response){
                        $("#stduentTable tbody").prepend('<tr><td>'+response.id+'</td><td>'+response.firstname+'</td><td>'+response.lastname+'</td><td>'+response.email+'</td><td>'+response.phone +'</td></tr>');
                        $("#studentForm")[0].reset();
                        $("#studentForm").modal('hide');

                    }
                },
            });
        });
    </script>
    <script>
        function editStudent(id){
            $.get('/student/'+id,function(student){
                $("#id").val(student.id);
                $("#firstname2").val(student.firstname);
                $("#lastname2").val(student.lastname);
                $("#email2").val(student.email);
                $("#phone2").val(student.phone);
                $("#studentEditModal").modal('toggle');

            });
        }
        $("#studentEditForm").submit(function(e){ 
            e.preventDefault();
            let id  = $("#id").val(); 
            let firstname = $("#firstname2").val();
            let lastname = $("#lastname2").val();
            let email = $("#email2").val();
            let phone = $("#phone2").val();
            let _token = $("input[name = _token]").val();

            $.ajax({
                url:"{{ route('student.update') }}",
                type: "PUT",
                data: {
                    id : id,
                    firstname : firstname,
                    lastname : lastname,
                    email : email ,
                    phone : phone,
                    _token : _token
                },
                success:function(response){
                    $('#sid' + response.id + ' td:nth-child(2)').text(response.firstname);
                    $('#sid' + response.id + ' td:nth-child(3)').text(response.lastname);
                    $('#sid' + response.id + ' td:nth-child(4)').text(response.email);
                    $('#sid' + response.id + ' td:nth-child(5)').text(response.phone);
                    $("studentEditModal").modal('toggle');
                    $('#studentEditForm')[0].reset();
                }
            });
        });
    </script>
    <script>
        function deleteStudent(id){
            if(confirm("Dou you really want to delete this record?")){
                $.ajax({
                    //url:'/student/'+id,
                    url: "{{ route('student.delete',['id' => $student->id ])}}",
                    type: 'DELETE',
                    data: {
                        _token : $("input[name = _token]").val()
                    },
                    success:function(response){
                        $("#sid"+id).remove();

                    }
                });
            }
        }
    </script>
    <script>
        $(function(e){
            $("#chkCheckAll").click(function(){
                $(".checkBoxClass").prop('checked',$(this).prop('checked'));
            });

            $("#deleteAllSelectedRecord").click(function(e){
                e.preventDefault();
                var allids = [];

                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url:"{{ route('student.deleteSelected')}}",
                    type:"DELETE",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids: allids
                    },
                    success:function(response){
                        $.each(allids,function(key,val){
                            $("#sid"+val).remove();
                        });
                    
                    }
                });
            });
        }); 
    </script>
    
    <script type="text/javascript">
     
      var url = "{{ route('lang.change') }}";
    
        $('.lang-change').change(function(){
         let lang_code = $(this).val();
          window.location.href = url + "?lang="+ lang_code;
        });
    
    </script>
  </body>
</html>
