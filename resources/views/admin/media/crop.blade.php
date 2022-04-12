@extends('admin.layout.master')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.css"
          integrity="sha512-6QxSiaKfNSQmmqwqpTNyhHErr+Bbm8u8HHSiinMEz0uimy9nu7lc/2NaXJiUJj2y4BApd5vgDjSHyLzC8nP6Ng=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection

@section('content')

    <main role="main" class="container" style="padding-top: 10px;">
        <div class="row">

            <div class="col-md-6" style="height: 50%; margin: auto;">
                <div class="dropzone">
                    <form action="{{route('crop.download')}}" method="POST" enctype="multipart/form-data" id="post-form"
                          style="margin-bottom: 20px; border: 2px solid grey; padding: 30px 20px;">
                        @csrf
                        <fieldset class="form-group">

                            <label for="id_image">Image</label><br>
                            <input type="file" id="id_image" name="image" accept="image/*" ><br>

                        </fieldset>
                        <div class="form-group">
                            <div id="image-box" class="image-container"></div>
                            <button class="btn btn-outline-info" id="crop-btn"
                                    style="width: 100%; margin-top: 10px; display: none;" type="button">Crop
                            </button>
                            <button class="btn btn-outline-info" id="confirm-btn" style="width: 100%; margin-top: 10px;"
                                    type="submit">Post
                            </button>
                        </div>
                    </form>

                </div>

            </div>
            <div class="col-md-6">
                <div class="docs-data " id="docsData" style="display: none">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">X</span>
                        </div>
                        <input type="text" class="form-control" id="dataX" placeholder="x">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">px</span>
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Y</span>
                        </div>
                        <input type="text" class="form-control" id="dataY" placeholder="y">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">px</span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Width</span>
                        </div>
                        <input type="text" class="form-control" id="dataWidth" placeholder="width">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">px</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Height</span>
                        </div>
                        <input type="text" class="form-control" id="dataHeight" placeholder="height">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">px</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rotate</span>
                        </div>
                        <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">deg</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">scaleX</span>
                        </div>
                        <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">scaleY</span>
                        </div>
                        <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">

                    </div>


                </div>

                <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio"
                               value="1.7777777777777777">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9">
                            16:9
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio"
                               value="1.3333333333333333">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3">
                            4:3
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="1">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1">
                            1:1
                         </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio"
                               value="0.6666666666666666">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
                                2:3
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio5" name="aspectRatio" value="NaN">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN">
                                Free
                        </span>
                    </label>
                </div>

            </div>
        </div>
    </main>


@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.js"
            integrity="sha512-IlZV3863HqEgMeFLVllRjbNOoh8uVj0kgx0aYxgt4rdBABTZCl/h5MfshHD9BrnVs6Rs9yNN7kUQpzhcLkNmHw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        let dataX = document.getElementById('dataX');
        let dataY = document.getElementById('dataY');
        let dataHeight = document.getElementById('dataHeight');
        let dataWidth = document.getElementById('dataWidth');
        let dataRotate = document.getElementById('dataRotate');
        let dataScaleX = document.getElementById('dataScaleX');
        let dataScaleY = document.getElementById('dataScaleY');

        // image-box is the id of the div element that will store our cropping image preview
        const imagebox = document.getElementById('image-box')
        // crop-btn is the id of button that will trigger the event of change original file with cropped file.
        const crop_btn = document.getElementById('crop-btn')
        // id_image is the id of the input tag where we will upload the image
        const input = document.getElementById('id_image')

        // When user uploads the image this event will get triggered
        input.addEventListener('change', () => {
            // Getting image file object from the input variable
            const img_data = input.files[0]
            // createObjectURL() static method creates a DOMString containing a URL representing the object given in the parameter.
            // The new object URL represents the specified File object or Blob object.
            const url = URL.createObjectURL(img_data)

            // Creating a image tag inside imagebox which will hold the cropping view image(uploaded file) to it using the url created before.
            imagebox.innerHTML = `<img src="${url}" id="image" style="width:100%;">`

            // Storing that cropping view image in a variable
            const image = document.getElementById('image')

            // Displaying the image box
            document.getElementById('image-box').style.display = 'block'
            // Displaying the Crop buttton
            document.getElementById('crop-btn').style.display = 'block'
            // Hiding the Post button
            document.getElementById('confirm-btn').style.display = 'none'

            document.getElementById('docsData').style.display = 'block'

            const options = {
                aspectRatio: 3 / 2,
                preview: '.img-preview',
                ready: function (e) {
                    console.log(e.type);
                },
                cropstart: function (e) {
                    console.log(e.type, e.detail.action);
                },
                cropmove: function (e) {
                    console.log(e.type, e.detail.action);
                },
                cropend: function (e) {
                    console.log(e.type, e.detail.action);
                },
                crop: function (e) {
                    var data = e.detail;

                    console.log(e.type);
                    dataX.value = Math.round(data.x);
                    dataY.value = Math.round(data.y);
                    dataHeight.value = Math.round(data.height);
                    dataWidth.value = Math.round(data.width);
                    dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
                    dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
                    dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
                },
                zoom: function (e) {
                    console.log(e.type, e.detail.ratio);
                }
            };

            // Creating a croper object with the cropping view image
            // The new Cropper() method will do all the magic and diplay the cropping view and adding cropping functionality on the website
            // For more settings, check out their official documentation at https://github.com/fengyuanchen/cropperjs
            const cropper = new Cropper(image, options)

            // When crop button is clicked this event will get triggered
            crop_btn.addEventListener('click', () => {
                // This method coverts the selected cropped image on the cropper canvas into a blob object
                cropper.getCroppedCanvas().toBlob((blob) => {

                    // Gets the original image data
                    let fileInputElement = document.getElementById('id_image');
                    // Make a new cropped image file using that blob object, image_data.name will make the new file name same as original image
                    let file = new File([blob], img_data.name, {type: "image/*", lastModified: new Date().getTime()});
                    // Create a new container
                    let container = new DataTransfer();
                    // Add the cropped image file to the container
                    container.items.add(file);
                    // Replace the original image file with the new cropped image file
                    fileInputElement.files = container.files;

                    // Hide the cropper box
                    document.getElementById('image-box').style.display = 'none'
                    // Hide the crop button
                    document.getElementById('crop-btn').style.display = 'none'
                    // Display the Post button
                    document.getElementById('confirm-btn').style.display = 'block'

                });
            });
        });
    </script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const mediaIds = []
        var maxImageWidth = 1000, maxImageHeight = 1000;
        let counter = 0;
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("div.dropzone", {
            url: "",
            autoDiscover: false,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            // autoProcessQueue: false,
            maxFiles: 1,
            maxFilesize: 3,
            // dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"> <h4 class="display-inline"> برای آپلود عکس محصول فایل را اینجا بکشید یا کلیک کنید</h4></span>',
            // dictResponseError: 'خطایی در اپلود فایل رخ داده',
            // dictMaxFilesExceeded: 'امکان اپلود فایل دیگر وجود ندارد , فقط یک فایل مجاز است',

            // dictRemoveFile: 'Delete',

            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function () {
                let thisDropzone = this;

                var submitButton = document.querySelector("#submitButton");
                myDropzone = this;
                submitButton.addEventListener("click", function (e) {
                    if (counter < 1) {
                        e.preventDefault();
                        alert("Not enough files!");
                    }

                });

                this.on("thumbnail", function(file) {
                    if (file.width === 3/2 * file.height ) {
                        file.rejectDimensions()
                    }
                    else {
                        file.acceptDimensions();
                    }
                });

                this.on("removedfile", function (file) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                    $.ajax({
                        url: `/media/delete/${file.id}`,
                        method: "delete",
                        success: function (res) {
                            console.log(res)
                        }
                    })
                    counter--;

                });
            },
            success: function(file, response)
            {
                document.getElementById('submitButton').classList.remove('d-none')
                counter++;

                mediaIds.push(response.media_id)

            },

            error: function(file, message, xhr) {
                const error = document.querySelector('#error');
                error.innerHTML = ' <h3>an error occured your file will be deleted from the dropzone shortly </h3>';
                setTimeout(() => {
                    $(file.previewElement).remove();
                    console.log(counter);
                    error.innerHTML = '';
                    location.reload();
                }, 5000)
            },

            accept: function(file, done) {
                file.acceptDimensions = done;
                file.rejectDimensions = function() { done("Image width or height too big."); };
            }

        });
    </script>

@endsection
