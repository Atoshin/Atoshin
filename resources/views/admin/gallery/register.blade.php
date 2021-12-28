<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>
<body style="background-color: #343a40;">

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9 mt-4 ">
                <img src="{{asset('admin/dist/img/Atoshinlogo.png')}}" alt="Atoshin Logo" class="mt-4" width="400"
                     height="100" style="filter: brightness(0) invert(1);">

                <h1 class="text-white my-4"></h1>

                <div class="card " style="">
                    <div class="card-body">
                        <form action="{{route('gallery.register')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Gallery name</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg" placeholder="Gallery name"
                                           name="name"/>
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Gallery Description</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <textarea class="form-control" rows="3" placeholder="Description"
                                              name="bio"></textarea>
                                    @error('bio')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Gallery website URL</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="url" class="form-control form-control-lg"
                                           placeholder="http(s)://example.com" name="website"/>
                                    @error('website')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Gallery Address</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg" placeholder="Gallery Address"
                                           name="address"/>
                                    @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Telephone</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="Gallery Telephone Number" name="telephone"/>
                                    @error('telephone')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>


                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Brochure</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="file" name="file" class="form-control form-control-lg"/>
                                    <small>Please upload your gallery brochure here</small>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <h5><b>Gallery Representative Contact Information</b></h5>

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Full Name</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="Gallery Representative Full Name" name="full_name"/>
                                    @error('full_name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Title</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="Gallery Representative Title" name="title"/>
                                    @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Telephone</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="Gallery Representative Telephone Number" name="rep_telephone"/>
                                    @error('rep_telephone')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>


                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Email</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="email" class="form-control form-control-lg"
                                           placeholder="Gallery Representative Email Address" name="rep_email"/>
                                    @error('rep_email')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">I am the owner</h6>

                                </div>
                                <div class="col-md-1 pe-5">

                                    <input type="checkbox" name="is_owner" class="form-control form-control-lg"
                                           placeholder="Gallery Representative Telephone Number"/>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="px-5 py-4">
                                <button type="submit" class="btn btn-primary btn-lg">Send application</button>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


</body>
</html>
