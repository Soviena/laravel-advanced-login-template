@extends('layout.layout')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <form action="{{route('editUser',Auth::user()->id)}}" method="put" enctype="multipart/form-data" id="formSubmit">
            @csrf
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{asset('storage/uploaded/user/')}}@if($user->user_data->profile_picture == "")/default.jpeg @endif" id="profilePic" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4 disabled" id="btnUpload" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" name="file_profile" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4 disabled" id="resetPicButton" onclick="resetImage()">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>

                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
              </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="firstName" class="form-label">Nama</label>
                  <input class="form-control inputControll" readonly type="text" id="firstName" name="name" value="{{Auth::user()->name}}" autofocus="">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">E-mail</label>
                  <input class="form-control inputControll" readonly type="email" id="email" name="email" value="{{Auth::user()->email}}" placeholder="john.doe@example.com">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="lastName" class="form-label">Tanggal Lahir</label>
                  <input class="form-control inputControll" readonly type="date" name="tanggal_lahir" id="lastName" value="{{Auth::user()->tanggal_lahir}}">
                </div>
              </div>
              <div class="mt-2">
                {{-- @if(Auth::user()->email_verified_at == '')
                  <a type="button" id="verifButton" class="btn btn-warning me-2" href="{{route('resendVerify',Auth::user()->id)}}" onclick="this.classlist.add('disabled')">Kirim Ulang verifikasi email</a>
                @endif --}}
                <button type="button" id="editButton" class="btn btn-primary me-2" onclick="editProfil()">Edit</button>
                <button type="reset" id="cancelButton" class="btn btn-outline-secondary disabled" onclick="cancelEdit()">Cancel</button>
              </div>
            </div>
          </form>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>
  <div
    class="bs-toast toast fade bg-primary bottom-0 end-0 position-absolute m-5"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    id="editSuccessToast"
  >
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-semibold">Edit berhasil</div>
      <small></small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Data telah di update
    </div>
  </div>
  <div
    class="bs-toast toast fade bg-danger bottom-0 end-0 position-absolute m-5"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    id="errorVerify"
  >
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-semibold">Email Sudah Diverifikasi</div>
      <small></small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Email telah diverif
    </div>
  </div>
  <div
    class="bs-toast toast fade bg-success bottom-0 end-0 position-absolute m-5"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    id="resendSuccess"
  >
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-semibold">Berhasil</div>
      <small></small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Cek email anda untuk link verifikasi terbaru
    </div>
  </div>
</div>

<div class="modal fade" id="CropperModal" tabindex="-1" aria-hidden="true" data-backdrop="static" data-bs-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Crop Gambar</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            onclick="closeModal()"
          ></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="mb-3">
            <img id="cropperImage" class="" src="{{asset('storage/uploaded/user')}}@if($user->user_data->profile_picture == "")/default.jpeg @endif" style="max-width: 100%; display: block;">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal()" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="submit" id="okButton" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
<script>
  // Get references to the input and image elements
  const imageInput = document.getElementById('upload');
  const previewImage = document.getElementById('profilePic');

  // Add an event listener to the input element to handle file selection

  function resetImage() {
    previewImage.src = "{{asset('storage/uploaded/user/'.Auth::user()->profilepic)}}";
    imageInput.value = "";
    document.getElementById('resetPicButton').classList.add('disabled');
  }

  function cancelEdit(){
    document.getElementById('btnUpload').classList.add('disabled');
    document.getElementById('cancelButton').classList.add('disabled');
    document.getElementById('editButton').innerHTML = "Edit";
    input = document.getElementsByClassName('inputControll');
    for (let index = 0; index < input.length; index++) {
      input[index].readOnly = true;
    }
    document.getElementById('editButton').type = "button"
  }

  function editProfil() {
    event.preventDefault();
    if (document.getElementById('editButton').type == 'submit') {
      document.getElementById('formSubmit').submit();
      return;
    }
    document.getElementById('btnUpload').classList.remove('disabled');
    document.getElementById('cancelButton').classList.remove('disabled');
    document.getElementById('editButton').innerHTML = "Simpan";
    input = document.getElementsByClassName('inputControll');
    for (let index = 0; index < input.length; index++) {
      input[index].readOnly = false;
    }
    document.getElementById('editButton').type = "submit";
  }

  const cropperImage = document.getElementById('cropperImage');
  const okButton = document.getElementById('okButton');
  const options = {
    backdrop: 'static',   // Set backdrop option to 'static' to prevent closing on backdrop click
    keyboard: false       // Set keyboard option to false to prevent closing on Escape key press
  };
  const modal = new bootstrap.Modal(document.getElementById('CropperModal'),options);
  let cropper;
  function checkFileSize(input) {
      const maxFileSize = 7 * 1024 * 1024; // 10MB in bytes
      if (input.files.length > 0) {
          const fileSize = input.files[0].size;
          if (fileSize > maxFileSize) {
              alert("File size exceeds the maximum allowed limit of 7MB.");
              input.value = ''; // Clear the input
              return true;
          }else{
            return false;
          }
      }
  }
  // Add an event listener to the input element to handle file selection
  imageInput.addEventListener('change', function (event) {
    if (checkFileSize(imageInput)) {
      return;
    }
    modal.show();
    const file = event.target.files[0];

    // Ensure that a file was selected
    if (file) {
      // Create a FileReader to read the image file
      const reader = new FileReader();

      // Set up the FileReader onload event to display the image and initialize the cropper
      reader.onload = function (e) {
        const imageUrl = e.target.result;
        cropperImage.src = imageUrl;

        // Initialize Cropper.js with the image
        cropper = new Cropper(cropperImage, {
          aspectRatio: 1, // Change this value to set the aspect ratio (e.g., 16/9, 4/3, 1, etc.)
          viewMode: 2,
          minContainerWidth: 500,
          minContainerHeight: 500,
          minCanvasWidth: 100,
          minCanvasHeight: 100,    // Set the crop box to be within the container
        });
      };

      // Read the image file as a data URL
      reader.readAsDataURL(file);
    } else {
      // If no file was selected, reset the cropper and image source
      cropperImage.src = "{{asset('storage/uploaded/user/'.Auth::user()->profilepic)}}";
      if (cropper) {
        cropper.destroy();
      }
    }
  });

  // Add an event listener to the "OK" button to handle image cropping confirmation
  okButton.addEventListener('click', function () {
    if (cropper) {
      modal.hide();
      // Get the cropped image as a data URL
      const croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();

      // Display the cropped image or do something else with the data URL
      // For example, you can set it as the source of another image element:
      previewImage.src = croppedImageDataURL;
      loadURLToInputFiled(croppedImageDataURL);

      // Destroy the cropper instance
      cropper.destroy();
      document.getElementById('resetPicButton').classList.remove('disabled');
    }
  });

  function loadURLToInputFiled(url) {
  getImgURL(url, (imgBlob) => {
    // Load img blob to input
    // WIP: UTF8 character error
    let fileName = 'pic';
    let file = new File([imgBlob], fileName, { type: "image/jpeg", lastModified: new Date().getTime() }, 'utf-8');
    let container = new DataTransfer();
    container.items.add(file);
    document.querySelector('#upload').files = container.files;
  });
}
function getImgURL(url, callback){
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
      callback(xhr.response);
  };
  xhr.open('GET', url);
  xhr.responseType = 'blob';
  xhr.send();
}

  function closeModal() {
    imageInput.value = "";
    modal.hide();
    cropper.destroy();
  }

  $(document).ready(function () {
    @if(session('EditSuccess'))
      successToast = new bootstrap.Toast(document.getElementById('editSuccessToast'));
      successToast.show();
    @endif
    @if(session('errorVerify'))
      successToast = new bootstrap.Toast(document.getElementById('errorVerify'));
      successToast.show();
    @endif
    @if(session('resendSuccess'))
      successToast = new bootstrap.Toast(document.getElementById('resendSuccess'));
      successToast.show();
    @endif
  });
</script>

@endsection
