<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register Akun Baru</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    {{-- <script src="{{asset('vendor/js/helpers.js')}}"></script> --}}
    {{-- <script src="{{asset('vendor/js/bootstrap.js')}}"></script> --}}
    {{-- <script src="{{asset('js/config.js')}}"></script> --}}
    {{-- <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js','resources/js/helpers.js', 'resources/js/menu.js', 'resources/js/apexcharts.js', 'resources/js/dashboards-analytics.js', 'resources/js/main.js', 'resources/js/masonry.js',  'resources/js/perfect-scrollbar.js', 'resources/js/popper.js'])
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
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Register</h5>
            </div>
            <div class="card-body">
                @error('error')
                <div class="alert alert-danger alert-dismissible" role="alert">
                   Sudah Terdaftar
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
              <form action="{{ route('createUser') }}" method="POST">
                @csrf
                <div class="mb-6">
                  <label class="form-label" for="basic-icon-default-fullname">First Name</label>
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="first_name" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" required>
                  </div>
                </div>
                <div class="mb-6">
                  <label class="form-label" for="basic-icon-default-fullname">Last Name</label>
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class=""></i></span>
                    <input name="last_name" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" required>
                  </div>
                </div>
                <div class="mb-6">
                  <label class="form-label" for="formtabs-birthdate">Birth Date</label>
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class=""></i></span>
                    <input name="tanggal_lahir" type="date" id="formtabs-birthdate" class="form-control" placeholder="YYYY-MM-DD" required>
                  </div>
                </div>
                <div class="mb-6">
                    <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                      <input name="phone_number" type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" required>
                    </div>
                  </div>
                  <div class="mb-6">
                    <label class="form-label" for="basic-icon-default-phone">Gender</label>
                    <div class="input-group input-group-merge justify-content-center">
                        <div class="form-check mx-3">
                          <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required>
                          <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check mx-3">
                          <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required>
                          <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>
                  </div>
                <div class="mb-6">
                  <label class="form-label" for="basic-icon-default-fullname">Username</label>
                  <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="username" type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" required>
                  </div>
                </div>
                <div class="mb-6">
                  <label class="form-label" for="basic-icon-default-email">Email</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                    <input name="email" type="email" id="basic-icon-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2" required>
                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                  </div>
                  <div class="form-text"> You can use letters, numbers &amp; periods </div>
                </div>
                <div class="mb-6">
                  <label class="form-label" for="basic-icon-default-fullname">Password</label>
                    <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-key"></i></span>
                        <input name="password" type="password" class="form-control" id="password" oninput="checkPassword()">
                    </div>
                    <div id="result" class="form-text strength"></div>
                    <div class="form-text meter">
                        <div id="meterFill" class="fill"></div>
                    </div>
                    <div id="tips" class="form-text tips"></div>
                </div>
                <button type="submit" id="submit-register" class="btn btn-primary waves-effect waves-light mt-3 disabled">Register</button>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->



    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
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
                    document.getElementById('submit-register').classList.add('disabled');
                    break;
                case 2:
                    strength = 'Weak';
                    resultDiv.className = 'strength weak';
                    meterFill.style.width = '30%';
                    meterFill.style.backgroundColor = 'red';
                    tips.push('Weak! Consider adding more unique characters.');
                    document.getElementById('submit-register').classList.add('disabled');
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
                    document.getElementById('submit-register').classList.remove('disabled');
                    break;
                case 5:
                    strength = 'Very Strong';
                    resultDiv.className = 'strength strong';
                    meterFill.style.width = '100%';
                    meterFill.style.backgroundColor = 'blue';
                    tips.push('Amazing! Your password is very strong.');
                    document.getElementById('submit-register').classList.remove('disabled');
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
  </body>
</html>
