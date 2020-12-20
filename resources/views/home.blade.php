




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple crud</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <section>
        <div class="p-5">
            <h2 class="text-center">Semple CRUD Applilcation with AJAX</h2>
        </div>
        <div class="container">

            <div class="row">
                <div class="col">
                    <div class="card text-white bg-primary">
                        <div class="card-header d-flex">
                            <h2>All Users</h2> 
                            
                            {{-- <!-- Button trigger modal --> --}}
                            <button style="border: 2px solid #fff" type="button" class="btn btn-primary ml-auto " data-toggle="modal" data-target="#add_user_modal">
                                Add Member
                              </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Cell</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="member_list">
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<!--add user Modal -->
<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card text-white bg-primary">
           
            <div class="card-body">
                <form id="creat_user_form">
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control"
                             placeholder="Enter User Name">
                            <span id="name_error" class="text-warning"></span>
                        
                    </div>
                    <div class="form-group">
                        <label for="email">User Email</label>
                        <input type="text" name="email" id="email"
                            class="form-control"
                            placeholder="Enter User Email">
                            <span id="email_error" class="text-warning"></span>
                    </div>
                    <div class="form-group">
                        <label for="cell">User Cell</label>
                        <input type="text" name="cell" id="cell"
                            class="form-control"
                            placeholder="Enter User Cell">
                            <span id="cell_error" class="text-warning"></span>
                    </div>
                    <div class="form-group">
                        <label for="role">User Role</label>
                        <select class="form-control" name="role" id="role">
                            <option>Admin</option>
                            <option>Manager</option>
                            <option>Sales Man</option>
                            <option>Editor</option>
                            <option selected >Subscriber</option>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="address">User Address</label>
                        <input type="text" name="address" id="address"
                            class="form-control"
                            placeholder="Enter User Address">
                            <span id="address_error" class="text-warning"></span>
                    </div>
                    <input class="btn btn-block btn-dark" type="submit" value="Add User">
                </form>


            </div>
        </div>


      </div>
    </div>
  </div>
</div>

<!--edit user Modal -->
<div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <div class="card text-white bg-primary">
            
            <div class="card-body">
                <form id="edit_user_form">

                    <input type="hidden" id="id" name="id">
                    
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') {{'border-danger'}}  @enderror"
                             placeholder="Enter User Name">
                        @error('name')
                        <p class=" text-warning">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">User Email</label>
                        <input type="text" name="email" id="email"
                            class="form-control @error('email') {{'border-danger'}}  @enderror"
                            placeholder="Enter User Email">
                        @error('email')
                        <p class=" text-warning">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cell">User Cell</label>
                        <input type="text" name="cell" id="cell"
                            class="form-control @error('cell') {{'border-danger'}}  @enderror"
                            placeholder="Enter User Cell">
                        @error('cell')
                        <p class=" text-warning">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">User Role</label>
                        <select class="form-control" name="role" id="role">
                            <option>Admin</option>
                            <option>Manager</option>
                            <option>Sales Man</option>
                            <option>Editor</option>
                            <option selected >Subscriber</option>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="address">User Address</label>
                        <input type="text" name="address" id="address"
                            class="form-control @error('address') {{'border-danger'}}  @enderror"
                            placeholder="Enter User Address">
                        @error('address')
                        <p class=" text-warning">{{$message}}</p>
                        @enderror
                    </div>
                    <input class="btn btn-block btn-dark" type="submit" value="Add User">
                </form>


            </div>
        </div>


      </div>
    </div>
  </div>
</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{asset('js/ajax.js')}}"></script>


</body>

</html>
