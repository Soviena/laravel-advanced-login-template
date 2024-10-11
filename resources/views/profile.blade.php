@extends('layout.layout')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .strength {
        margin-top: 10px;
        font-weight: bold;
    }
    .weak { color: red; }
    .medium { color: orange; }
    .strong { color: green; }
    .meter {
        height: 10px;
        width: 100%;
        background: #e0e0e0;
        border-radius: 5px;
        margin-top: 10px;
        overflow: hidden;
    }
    .fill {
        height: 100%;
        border-radius: 5px;
        transition: width 0.3s;
    }
    .tips { margin-top: 10px; font-size: 0.9em; color: #333; }
    .eye-icon {
        cursor: pointer;
        margin-left: 5px;
        font-size: 1.2em;
        vertical-align: middle;
    }
</style>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          {{-- <h5 class="card-header">Profile Details</h5> --}}
          <!-- Account -->
          <form action="{{route('editUserData',Auth::user()->id)}}" method="POST" enctype="multipart/form-data" id="formSubmit">
            @method('PUT')
            @csrf
            <div class="card-body py-1" id="coverPic" style="background-image: url({{asset('storage/uploaded/user/')}}@if($user->user_data->cover_picture == "")/default_cover.png  @else/{{$user->user_data->cover_picture}} @endif); background-size:cover">
              <div class="d-flex justify-content-between mb-4" style="margin-top: 15%;">
                <div class="d-flex">
                    <div class="d-block" style="position: relative; display: inline-block;">
                        <img class="rounded-circle" src="{{asset('storage/uploaded/user/')}}@if($user->user_data->profile_picture == "")/default.jpeg @else/{{$user->user_data->profile_picture}} @endif" id="profilePic" alt="user-avatar" height="100" width="100" id="uploadedAvatar" style="box-shadow: 5px 10px 30px -3px rgba(0,0,0,0.81);">
                        <button type="button" id="btnUpload" onclick="document.getElementById('upload').click();" disabled hidden style="position: absolute; right: 2%; bottom: 0; background-color: white; border:0; border-radius: 50%;  width: 30px; height:30px; cursor: not-allowed; box-shadow: 5px 10px 30px -3px rgba(0,0,0,0.81);">
                          <span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 -0.5 25 25">
                                <path xmlns="http://www.w3.org/2000/svg" d="M13.2942 7.95881C13.5533 7.63559 13.5013 7.16358 13.178 6.90453C12.8548 6.64549 12.3828 6.6975 12.1238 7.02072L13.2942 7.95881ZM6.811 14.8488L7.37903 15.3385C7.38489 15.3317 7.39062 15.3248 7.39623 15.3178L6.811 14.8488ZM6.64 15.2668L5.89146 15.2179L5.8908 15.2321L6.64 15.2668ZM6.5 18.2898L5.7508 18.2551C5.74908 18.2923 5.75013 18.3296 5.75396 18.3667L6.5 18.2898ZM7.287 18.9768L7.31152 19.7264C7.36154 19.7247 7.41126 19.7181 7.45996 19.7065L7.287 18.9768ZM10.287 18.2658L10.46 18.9956L10.4716 18.9927L10.287 18.2658ZM10.672 18.0218L11.2506 18.4991L11.2571 18.491L10.672 18.0218ZM17.2971 10.959C17.5562 10.6358 17.5043 10.1638 17.1812 9.90466C16.8581 9.64552 16.386 9.69742 16.1269 10.0206L17.2971 10.959ZM12.1269 7.02052C11.8678 7.34365 11.9196 7.81568 12.2428 8.07484C12.5659 8.33399 13.0379 8.28213 13.2971 7.95901L12.1269 7.02052ZM14.3 5.50976L14.8851 5.97901C14.8949 5.96672 14.9044 5.95412 14.9135 5.94123L14.3 5.50976ZM15.929 5.18976L16.4088 4.61332C16.3849 4.59344 16.3598 4.57507 16.3337 4.5583L15.929 5.18976ZM18.166 7.05176L18.6968 6.52192C18.6805 6.50561 18.6635 6.49007 18.6458 6.47532L18.166 7.05176ZM18.5029 7.87264L19.2529 7.87676V7.87676L18.5029 7.87264ZM18.157 8.68976L17.632 8.15412C17.6108 8.17496 17.5908 8.19704 17.5721 8.22025L18.157 8.68976ZM16.1271 10.0203C15.8678 10.3433 15.9195 10.8153 16.2425 11.0746C16.5655 11.3339 17.0376 11.2823 17.2969 10.9593L16.1271 10.0203ZM13.4537 7.37862C13.3923 6.96898 13.0105 6.68666 12.6009 6.74805C12.1912 6.80943 11.9089 7.19127 11.9703 7.60091L13.4537 7.37862ZM16.813 11.2329C17.2234 11.1772 17.5109 10.7992 17.4552 10.3888C17.3994 9.97834 17.0215 9.69082 16.611 9.74659L16.813 11.2329ZM12.1238 7.02072L6.22577 14.3797L7.39623 15.3178L13.2942 7.95881L12.1238 7.02072ZM6.24297 14.359C6.03561 14.5995 5.91226 14.9011 5.89159 15.218L7.38841 15.3156C7.38786 15.324 7.38457 15.3321 7.37903 15.3385L6.24297 14.359ZM5.8908 15.2321L5.7508 18.2551L7.2492 18.3245L7.3892 15.3015L5.8908 15.2321ZM5.75396 18.3667C5.83563 19.1586 6.51588 19.7524 7.31152 19.7264L7.26248 18.2272C7.25928 18.2273 7.25771 18.2268 7.25669 18.2264C7.25526 18.2259 7.25337 18.2249 7.25144 18.2232C7.2495 18.2215 7.24825 18.2198 7.24754 18.2185C7.24703 18.2175 7.24637 18.216 7.24604 18.2128L5.75396 18.3667ZM7.45996 19.7065L10.46 18.9955L10.114 17.536L7.11404 18.247L7.45996 19.7065ZM10.4716 18.9927C10.7771 18.9151 11.05 18.7422 11.2506 18.499L10.0934 17.5445C10.0958 17.5417 10.0989 17.5397 10.1024 17.5388L10.4716 18.9927ZM11.2571 18.491L17.2971 10.959L16.1269 10.0206L10.0869 17.5526L11.2571 18.491ZM13.2971 7.95901L14.8851 5.97901L13.7149 5.04052L12.1269 7.02052L13.2971 7.95901ZM14.9135 5.94123C15.0521 5.74411 15.3214 5.6912 15.5243 5.82123L16.3337 4.5583C15.4544 3.99484 14.2873 4.2241 13.6865 5.0783L14.9135 5.94123ZM15.4492 5.7662L17.6862 7.6282L18.6458 6.47532L16.4088 4.61332L15.4492 5.7662ZM17.6352 7.58161C17.7111 7.6577 17.7535 7.761 17.7529 7.86852L19.2529 7.87676C19.2557 7.36905 19.0555 6.88127 18.6968 6.52192L17.6352 7.58161ZM17.7529 7.86852C17.7524 7.97604 17.7088 8.07886 17.632 8.15412L18.682 9.22541C19.0446 8.87002 19.2501 8.38447 19.2529 7.87676L17.7529 7.86852ZM17.5721 8.22025L16.1271 10.0203L17.2969 10.9593L18.7419 9.15928L17.5721 8.22025ZM11.9703 7.60091C12.3196 9.93221 14.4771 11.5503 16.813 11.2329L16.611 9.74659C15.0881 9.95352 13.6815 8.89855 13.4537 7.37862L11.9703 7.60091Z" fill="#000000"/>
                              </svg>
                              <input type="file" id="upload" name="file_profile" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                          </span>
                        </button>
                      <!-- X Button -->
                      <button type="button" id="resetPicButton" onclick="resetImage()" disabled hidden style="position: absolute; top: 0; right: 2%; background-color: white; border: 0; border-radius: 50%; width: 30px; height:30px; cursor: not-allowed; box-shadow: 5px 10px 30px -3px rgba(0,0,0,0.81);">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                      </button>
                    </div>
                    <div class="d-flex align-items-end">
                        <h3 class="ms-3" style="color: white; text-shadow: 4px 4px 14px black; ">{{$user->user_data->first_name}} {{$user->user_data->last_name}}</h3>
                    </div>
                </div>
                <div class="d-flex align-items-end" w="30px" h="30px">
                  <button type="button" id="btnUploadCover" onclick="document.getElementById('uploadCover').click();" disabled hidden style="background-color: white; border:0; border-radius: 50%;  width: 30px; height:30px; cursor: not-allowed; box-shadow: 5px 10px 30px -3px rgba(0,0,0,0.81);">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 -0.5 25 25">
                          <path xmlns="http://www.w3.org/2000/svg" d="M13.2942 7.95881C13.5533 7.63559 13.5013 7.16358 13.178 6.90453C12.8548 6.64549 12.3828 6.6975 12.1238 7.02072L13.2942 7.95881ZM6.811 14.8488L7.37903 15.3385C7.38489 15.3317 7.39062 15.3248 7.39623 15.3178L6.811 14.8488ZM6.64 15.2668L5.89146 15.2179L5.8908 15.2321L6.64 15.2668ZM6.5 18.2898L5.7508 18.2551C5.74908 18.2923 5.75013 18.3296 5.75396 18.3667L6.5 18.2898ZM7.287 18.9768L7.31152 19.7264C7.36154 19.7247 7.41126 19.7181 7.45996 19.7065L7.287 18.9768ZM10.287 18.2658L10.46 18.9956L10.4716 18.9927L10.287 18.2658ZM10.672 18.0218L11.2506 18.4991L11.2571 18.491L10.672 18.0218ZM17.2971 10.959C17.5562 10.6358 17.5043 10.1638 17.1812 9.90466C16.8581 9.64552 16.386 9.69742 16.1269 10.0206L17.2971 10.959ZM12.1269 7.02052C11.8678 7.34365 11.9196 7.81568 12.2428 8.07484C12.5659 8.33399 13.0379 8.28213 13.2971 7.95901L12.1269 7.02052ZM14.3 5.50976L14.8851 5.97901C14.8949 5.96672 14.9044 5.95412 14.9135 5.94123L14.3 5.50976ZM15.929 5.18976L16.4088 4.61332C16.3849 4.59344 16.3598 4.57507 16.3337 4.5583L15.929 5.18976ZM18.166 7.05176L18.6968 6.52192C18.6805 6.50561 18.6635 6.49007 18.6458 6.47532L18.166 7.05176ZM18.5029 7.87264L19.2529 7.87676V7.87676L18.5029 7.87264ZM18.157 8.68976L17.632 8.15412C17.6108 8.17496 17.5908 8.19704 17.5721 8.22025L18.157 8.68976ZM16.1271 10.0203C15.8678 10.3433 15.9195 10.8153 16.2425 11.0746C16.5655 11.3339 17.0376 11.2823 17.2969 10.9593L16.1271 10.0203ZM13.4537 7.37862C13.3923 6.96898 13.0105 6.68666 12.6009 6.74805C12.1912 6.80943 11.9089 7.19127 11.9703 7.60091L13.4537 7.37862ZM16.813 11.2329C17.2234 11.1772 17.5109 10.7992 17.4552 10.3888C17.3994 9.97834 17.0215 9.69082 16.611 9.74659L16.813 11.2329ZM12.1238 7.02072L6.22577 14.3797L7.39623 15.3178L13.2942 7.95881L12.1238 7.02072ZM6.24297 14.359C6.03561 14.5995 5.91226 14.9011 5.89159 15.218L7.38841 15.3156C7.38786 15.324 7.38457 15.3321 7.37903 15.3385L6.24297 14.359ZM5.8908 15.2321L5.7508 18.2551L7.2492 18.3245L7.3892 15.3015L5.8908 15.2321ZM5.75396 18.3667C5.83563 19.1586 6.51588 19.7524 7.31152 19.7264L7.26248 18.2272C7.25928 18.2273 7.25771 18.2268 7.25669 18.2264C7.25526 18.2259 7.25337 18.2249 7.25144 18.2232C7.2495 18.2215 7.24825 18.2198 7.24754 18.2185C7.24703 18.2175 7.24637 18.216 7.24604 18.2128L5.75396 18.3667ZM7.45996 19.7065L10.46 18.9955L10.114 17.536L7.11404 18.247L7.45996 19.7065ZM10.4716 18.9927C10.7771 18.9151 11.05 18.7422 11.2506 18.499L10.0934 17.5445C10.0958 17.5417 10.0989 17.5397 10.1024 17.5388L10.4716 18.9927ZM11.2571 18.491L17.2971 10.959L16.1269 10.0206L10.0869 17.5526L11.2571 18.491ZM13.2971 7.95901L14.8851 5.97901L13.7149 5.04052L12.1269 7.02052L13.2971 7.95901ZM14.9135 5.94123C15.0521 5.74411 15.3214 5.6912 15.5243 5.82123L16.3337 4.5583C15.4544 3.99484 14.2873 4.2241 13.6865 5.0783L14.9135 5.94123ZM15.4492 5.7662L17.6862 7.6282L18.6458 6.47532L16.4088 4.61332L15.4492 5.7662ZM17.6352 7.58161C17.7111 7.6577 17.7535 7.761 17.7529 7.86852L19.2529 7.87676C19.2557 7.36905 19.0555 6.88127 18.6968 6.52192L17.6352 7.58161ZM17.7529 7.86852C17.7524 7.97604 17.7088 8.07886 17.632 8.15412L18.682 9.22541C19.0446 8.87002 19.2501 8.38447 19.2529 7.87676L17.7529 7.86852ZM17.5721 8.22025L16.1271 10.0203L17.2969 10.9593L18.7419 9.15928L17.5721 8.22025ZM11.9703 7.60091C12.3196 9.93221 14.4771 11.5503 16.813 11.2329L16.611 9.74659C15.0881 9.95352 13.6815 8.89855 13.4537 7.37862L11.9703 7.60091Z" fill="#000000"/>
                        </svg>
                        <input type="file" id="uploadCover" name="cover_picture" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                    </span>
                  </button>
                  <button class="ms-3" type="button" id="resetPicButtonCover" onclick="resetImageCover()" disabled hidden style="background-color: white; border: 0; border-radius: 50%; width: 30px; height:30px; cursor: not-allowed; box-shadow: 5px 10px 30px -3px rgba(0,0,0,0.81);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
                </div>
              </div>
            </div>
            <hr class="my-0">
            <div class="card-body" >
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="firstName" class="form-label">First Name</label>
                  <input class="form-control inputControll" readonly type="text" id="firstName" name="first_name" value="{{$user->user_data->first_name}}" autofocus="">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="firstName" class="form-label">Last Name</label>
                  <input class="form-control inputControll" readonly type="text" id="lastname" name="last_name" value="{{$user->user_data->last_name}}" autofocus="">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="dob" class="form-label">Date Of Birth</label>
                  <input class="form-control inputControll" readonly type="date" name="tanggal_lahir" id="dob" value="{{$user->user_data->date_of_birth}}">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="dob" class="form-label">Phone Number</label>
                  <input class="form-control inputControll" readonly type="number" name="phone_number" id="phone" value="{{$user->user_data->phone_number}}">
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

        <div class="card mb-4">
          <h5 class="card-header">Credential Details</h5>
          <!-- Account -->
          <form action="{{route('editUser',Auth::user()->id)}}" method="POST" enctype="multipart/form-data" id="formSubmit-credential">
            @method('PUT')
            @csrf
            <div class="card-body">
            <hr class="my-0">
            <div class="card-body">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="username" class="form-label">Username</label>
                  <input class="form-control inputControll-credential" readonly type="text" id="username" name="username" value="{{Auth::user()->username}}" placeholder="john.doe@example.com">
                  @error('username')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">E-mail</label>
                  <div class="input-group">
                    <input class="form-control inputControll-credential" readonly type="email" id="email" name="email" value="{{Auth::user()->email}}" placeholder="john.doe@example.com">
                    @if (!Auth::user()->email_verified_at)
                        <a href="{{route('resendVerify',Auth::user()->id)}}" class="btn btn-outline-warning">Send Verification Link</a>
                    @endif
                  </div>
                  @if (!Auth::user()->email_verified_at)
                    <div class="form-text">
                    Email Is Not Verified!
                    </div>
                  @endif
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="new-password" class="form-label">New Password</label>
                  <input class="form-control inputControll-credential" readonly type="password" id="password" name="password" oninput="checkPassword()">
                  @error('new-password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <div id="result" class="strength">Strength: none</div>
                  <div class="form-text meter">
                      <div id="meterFill" class="fill"></div>
                  </div>
                  <div id="tips" class="form-text tips">No tips</div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="old-password" class="form-label">Old Password*</label>
                  <input class="form-control inputControll-credential" readonly required type="password" id="old_password" name="old_password">
                  @error('old-password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="d-flex row mt-2 justify-content-between">
                {{-- @if(Auth::user()->email_verified_at == '')
                  <a type="button" id="verifButton" class="btn btn-warning me-2" href="{{route('resendVerify',Auth::user()->id)}}" onclick="this.classlist.add('disabled')">Kirim Ulang verifikasi email</a>
                @endif --}}
                <div class="col-4 ">
                    <button type="button" id="editButton-credential" class="btn btn-primary me-2" onclick="editCredential()">Edit</button>
                    <button type="reset" id="cancelButton-credential" class="btn btn-outline-secondary disabled" onclick="cancelEditCredential()">Cancel</button>
                </div>
                <div class="col-4">
                    <button type="button" id="deleteButton-credential" class="btn btn-danger me-2" onclick="">Delete Account</button>
                </div>
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
  class="bs-toast toast fade bg-danger bottom-0 end-0 position-absolute m-5"
  role="alert"
  aria-live="assertive"
  aria-atomic="true"
  id="generalError"
>
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <div class="me-auto fw-semibold">Error</div>
    <small></small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{session('error')}}
  </div>
</div>

<div
  class="bs-toast toast fade bg-danger bottom-0 end-0 position-absolute m-5"
  role="alert"
  aria-live="assertive"
  aria-atomic="true"
  id="passwordError"
>
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <div class="me-auto fw-semibold">Error</div>
    <small></small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    You need to confirm your old password
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
            <img id="cropperImage" class="" src="{{asset('storage/uploaded/user/')}}@if($user->user_data->profile_picture == "")/default.jpeg  @else/{{$user->user_data->profile_picture}} @endif" style="max-width: 100%; display: block;">
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

<div class="modal fade" id="CropperModalCover" tabindex="-1" aria-hidden="true" data-backdrop="static" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Crop Gambar</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            onclick="closeModalCover()"
          ></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
          <div class="mb-3 d-flex justify-content-center">
            <img id="cropperImageCover" class="" src="{{asset('storage/uploaded/user/')}}@if($user->user_data->profile_picture == "")/default_cover.png  @else/{{$user->user_data->cover_picture}} @endif" style="max-width: 100%; display: block;">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModalCover()" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="submit" id="okButtonCover" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>



{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script> --}}
{{-- @vite(['resources/js/cropper.min.js']) --}}
<script>
  // Get references to the input and image elements
  const imageInput = document.getElementById('upload');
  const previewImage = document.getElementById('profilePic');
  const coverInput = document.getElementById('uploadCover');
  const previewCover = document.getElementById('coverPic');

  // Add an event listener to the input element to handle file selection

  function resetImage() {
    previewImage.src = "{{asset('storage/uploaded/user')}}@if($user->user_data->profile_picture == "")/default.jpeg @else/{{$user->user_data->profile_picture}} @endif";
    imageInput.value = "";
    document.getElementById('resetPicButton').setAttribute('disabled',"disabled");
    document.getElementById('resetPicButton').setAttribute('hidden',"hidden");
    document.getElementById('resetPicButton').style.cursor = 'disabled';
  }
  function resetImageCover() {
    previewCover.style.backgroundImage = 'url("{{asset('storage/uploaded/user')}}@if($user->user_data->cover_picture == "")/default_cover.png @else/{{$user->user_data->cover_picture}} @endif")';
    coverInput.value = "";
    document.getElementById('resetPicButtonCover').setAttribute('disabled',"disabled");
    document.getElementById('resetPicButtonCover').setAttribute('hidden',"hidden");
    document.getElementById('resetPicButtonCover').style.cursor = 'disabled';
  }

  function cancelEdit(){
    document.getElementById('btnUpload').setAttribute('disabled',"disabled");
    document.getElementById('btnUpload').setAttribute('hidden',"hidden");
    document.getElementById('btnUploadCover').setAttribute('disabled',"disabled");
    document.getElementById('btnUploadCover').setAttribute('hidden',"hidden");
    document.getElementById('cancelButton').classList.add('disabled');
    document.getElementById('resetPicButton').click();
    document.getElementById('resetPicButtonCover').click();
    document.getElementById('editButton').innerHTML = "Edit";
    input = document.getElementsByClassName('inputControll');
    for (let index = 0; index < input.length; index++) {
      input[index].readOnly = true;
    }
    document.getElementById('editButton').type = "button"
  }

  function cancelEditCredential(){
    document.getElementById('cancelButton-credential').classList.add('disabled');
    document.getElementById('editButton-credential').innerHTML = "Edit";
    input = document.getElementsByClassName('inputControll-credential');
    for (let index = 0; index < input.length; index++) {
      input[index].readOnly = true;
    }
    document.getElementById('editButton-credential').type = "button"
    document.getElementById('editButton-credential').classList.remove('disabled');
    const resultDiv = document.getElementById('result');
    const meterFill = document.getElementById('meterFill');
    const tipsDiv = document.getElementById('tips');
    strength = 'none';
    resultDiv.className = 'strength';
    meterFill.style.width = '0%';
    meterFill.style.backgroundColor = 'grey';
    resultDiv.textContent = `Strength: ${strength}`;
    tipsDiv.innerHTML = 'no tips';
  }

  function editCredential(){
    event.preventDefault();
    if (document.getElementById('editButton-credential').type == 'submit') {
      let old_password = document.getElementById('old_password');
      if (old_password.value == '') {
        successToast = new bootstrap.Toast(document.getElementById('passwordError'));
        successToast.show();
        return;
      }
      document.getElementById('formSubmit-credential').submit();
      return;
    }
    document.getElementById('cancelButton-credential').classList.remove('disabled');
    document.getElementById('editButton-credential').innerHTML = "Simpan";
    input = document.getElementsByClassName('inputControll-credential');
    for (let index = 0; index < input.length; index++) {
      input[index].readOnly = false;
    }
    document.getElementById('editButton-credential').type = "submit";
  }

  function editProfil() {
    event.preventDefault();
    if (document.getElementById('editButton').type == 'submit') {
      document.getElementById('formSubmit').submit();
      return;
    }
    document.getElementById('btnUpload').removeAttribute('disabled');
    document.getElementById('btnUpload').removeAttribute('hidden');
    document.getElementById('btnUpload').style.cursor = "pointer";
    document.getElementById('btnUploadCover').removeAttribute('disabled');
    document.getElementById('btnUploadCover').removeAttribute('hidden');
    document.getElementById('btnUploadCover').style.cursor = "pointer";
    document.getElementById('cancelButton').classList.remove('disabled');
    document.getElementById('editButton').innerHTML = "Simpan";
    input = document.getElementsByClassName('inputControll');
    for (let index = 0; index < input.length; index++) {
      input[index].readOnly = false;
    }
    document.getElementById('editButton').type = "submit";
  }

  const cropperImage = document.getElementById('cropperImage');
  const cropperImageCover = document.getElementById('cropperImageCover');
  const okButton = document.getElementById('okButton');
  const okButtonCover = document.getElementById('okButtonCover');
  const options = {
    backdrop: 'static',   // Set backdrop option to 'static' to prevent closing on backdrop click
    keyboard: false       // Set keyboard option to false to prevent closing on Escape key press
  };
  var modal;
  var modalCover;
  let cropper;
  let cropperCover;
  function checkFileSize(input) {
      const maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
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
      cropperImage.src = "{{asset('storage/uploaded/user')}}@if($user->user_data->profile_picture == "")/default_cover.png @else/{{$user->user_data->profile_picture}} @endif";
      if (cropper) {
        cropper.destroy();
      }
    }
  });

  coverInput.addEventListener('change', function (event) {
    if (checkFileSize(coverInput)) {
      return;
    }
    modalCover.show();
    const file = event.target.files[0];

    // Ensure that a file was selected
    if (file) {
      // Create a FileReader to read the image file
      const reader = new FileReader();

      // Set up the FileReader onload event to display the image and initialize the cropper
      reader.onload = function (e) {
        const imageUrl = e.target.result;
        cropperImageCover.src = imageUrl;

        // Initialize Cropper.js with the image
        cropperCover = new Cropper(cropperImageCover, {
          aspectRatio: 4 / 1, // Change this value to set the aspect ratio (e.g., 16/9, 4/3, 1, etc.)
          viewMode: 1,
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
      cropperImageCover.src = "{{asset('storage/uploaded/user')}}@if($user->user_data->cover_picture == "")/default_cover.png @else {{$user->user_data->cover_picture}} @endif";
      if (cropperCover) {
        cropperCover.destroy();
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
      loadURLToInputFiled(croppedImageDataURL,"#upload");

      // Destroy the cropper instance
      cropper.destroy();
      document.getElementById('resetPicButton').removeAttribute('disabled');
      document.getElementById('resetPicButton').removeAttribute('hidden');
      document.getElementById('resetPicButton').style.cursor = 'pointer';
    }
  });

  okButtonCover.addEventListener('click', function () {
    if (cropperCover) {
      modalCover.hide();
      // Get the cropped image as a data URL
      const croppedImageDataURL = cropperCover.getCroppedCanvas().toDataURL();

      // Display the cropped image or do something else with the data URL
      // For example, you can set it as the source of another image element:
      previewCover.style.backgroundImage = `url('${croppedImageDataURL}'`;
      loadURLToInputFiled(croppedImageDataURL,"#uploadCover");

      // Destroy the cropper instance
      cropperCover.destroy();
      document.getElementById('resetPicButtonCover').removeAttribute('disabled');
      document.getElementById('resetPicButtonCover').removeAttribute('hidden');
      document.getElementById('resetPicButtonCover').style.cursor = 'pointer';
    }
  });

  function loadURLToInputFiled(url, id) {
  getImgURL(url, (imgBlob) => {
    // Load img blob to input
    // WIP: UTF8 character error
    let fileName = 'pic';
    let file = new File([imgBlob], fileName, { type: "image/png, image/jpeg", lastModified: new Date().getTime() }, 'utf-8');
    let container = new DataTransfer();
    container.items.add(file);
    document.querySelector(id).files = container.files;
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

  function closeModalCover() {
    coverInput.value = "";
    modalCover.hide();
    cropperCover.destroy();
  }

  function initializeModal() {
    modal =  new bootstrap.Modal(document.getElementById('CropperModal'),options);
    modalCover =  new bootstrap.Modal(document.getElementById('CropperModalCover'),options);
    @if(session('EditSuccess'))
      successToast = new bootstrap.Toast(document.getElementById('editSuccessToast'));
      successToast.show();
    @endif
    @if(session('errorVerify'))
      successToast = new bootstrap.Toast(document.getElementById('errorVerify'));
      successToast.show();
    @endif
    @if(session('error'))
      successToast = new bootstrap.Toast(document.getElementById('generalError'));
      successToast.show();
    @endif
    @if(session('resendSuccess'))
      successToast = new bootstrap.Toast(document.getElementById('resendSuccess'));
      successToast.show();
    @endif
  }

  (function() {
    setTimeout(initializeModal, 500);
})();

  const commonPasswords = ["123456", "password", "123456789", "12345678", "12345", "qwerty", "abc123", "letmein", "monkey", "iloveyou"];
        const commonWords = ["the", "of", "and", "to", "a", "in", "is", "you", "that", "it"]; // Add more common words as needed

        function calculateEntropy(password) {
            const uniqueChars = new Set(password);
            const base = uniqueChars.size;
            return Math.log2(Math.pow(base, password.length));
        }

        function hasSequentialChars(password) {
            return /(.)\1{2,}|012|123|234|345|456|567|678|789|abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz/i.test(password);
        }

        function containsLeetSpeak(password) {
            const leetSpeakPatterns = {
                'a': '4', 'e': '3', 'i': '1', 'o': '0', 's': '5', 't': '7', 'g': '9'
            };
            return Object.keys(leetSpeakPatterns).some(char => password.includes(leetSpeakPatterns[char]));
        }

        function containsCommonWords(password) {
            return commonWords.some(word => password.toLowerCase().includes(word));
        }

        function checkPassword() {
            const password = document.getElementById('password').value;
            const resultDiv = document.getElementById('result');
            const meterFill = document.getElementById('meterFill');
            const tipsDiv = document.getElementById('tips');
            let strength = '';
            let score = 0;
            let tips = [];

            // Resetting meter and feedback
            meterFill.style.width = '0%';
            tipsDiv.innerHTML = '';

            // Check length
            if (password.length >= 12) score++;
            else if (password.length >= 8) score++;

            // Check for character types
            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[\W_]/.test(password)) score++;

            // Check against common passwords
            if (commonPasswords.includes(password)) {
                score = 0;
                tips.push('Avoid using common passwords.');
            }

            // Check for sequential characters
            if (hasSequentialChars(password)) {
                score--;
                tips.push('Avoid using sequential characters.');
            }

            // Check for leet speak
            if (containsLeetSpeak(password)) {
                score--;
                tips.push('Avoid using leet speak; it does not significantly increase security.');
            }

            // Check for common words
            if (containsCommonWords(password)) {
                score--;
                tips.push('Avoid using common words or phrases in your password.');
            }

            // Calculate entropy
            const entropy = calculateEntropy(password);
            if (entropy < 40) {
                score--;
                tips.push('Consider using a more varied character set for better security.');
            }

            // Determine strength based on score
            switch (score) {
                case 0:
                case 1:
                    strength = 'Very Weak';
                    resultDiv.className = 'strength weak';
                    meterFill.style.width = '10%';
                    meterFill.style.backgroundColor = 'purple';
                    tips.push('Very weak! Use at least 12 characters with a mix of letters, numbers, and symbols.');
                    document.getElementById('editButton-credential').classList.add('disabled');
                    break;
                case 2:
                    strength = 'Weak';
                    resultDiv.className = 'strength weak';
                    meterFill.style.width = '30%';
                    meterFill.style.backgroundColor = 'red';
                    tips.push('Weak! Consider adding more unique characters.');
                    document.getElementById('editButton-credential').classList.add('disabled');
                    break;
                case 3:
                    strength = 'Medium';
                    resultDiv.className = 'strength medium';
                    meterFill.style.width = '60%';
                    meterFill.style.backgroundColor = 'yellow';
                    tips.push('Medium! Aim for a stronger password with more complexity.');
                    document.getElementById('submit-register').classList.add('disabled');
                    break;
                case 4:
                    strength = 'Strong';
                    resultDiv.className = 'strength strong';
                    meterFill.style.width = '80%';
                    meterFill.style.backgroundColor = 'lightgreen';
                    tips.push('Strong! Good job, but you can still improve.');
                    document.getElementById('editButton-credential').classList.remove('disabled');
                    break;
                case 5:
                    strength = 'Very Strong';
                    resultDiv.className = 'strength strong';
                    meterFill.style.width = '100%';
                    meterFill.style.backgroundColor = 'blue';
                    tips.push('Amazing! Your password is very strong.');
                    document.getElementById('editButton-credential').classList.remove('disabled');
                    break;
            }

            resultDiv.textContent = `Strength: ${strength}`;
            tipsDiv.innerHTML = tips.join('<br/>');
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleVisibility = document.getElementById('toggleVisibility');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleVisibility.textContent = "👁️‍🗨️"; // Change icon to indicate password is visible
            } else {
                passwordInput.type = "password";
                toggleVisibility.textContent = "👁️"; // Change icon back to indicate password is hidden
            }
        }
</script>

@endsection
