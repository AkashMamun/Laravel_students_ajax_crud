<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <section style="margin-top:60px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>Student <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#studentModal">Add new student</a></h1>
                        </div>
                        <div class="card-body">
                            <table id="studentTabel" class="table">
                                <thead>
                                    <tr>
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
                                            <td>{{ $student->id}}</td>
                                            <td>{{ $student->firstname}}</td>
                                            <td>{{ $student->lastname }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-info">Edit</a>
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
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" id="studentForm">
                @csrf
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" class="form-control" placeholder="Enter your first name">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname"class="form-control" placeholder="Enter your last name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group mt-3">
                    <label for="phone_no">Phone No. </label>
                    <input type="text" id="phone" class="form-control" placeholder="Enter your phone no">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit student Modal -->
  <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" id="studentEditForm">
                @csrf
                <input type="hidden" id="id" name="id">
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
                    <input type="text" id="phone2 " class="form-control" placeholder="Enter your phone no">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

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
                }
            });
        });
    </script>
    <script>
        function editStudent()
    </script>
  </body>
</html>
