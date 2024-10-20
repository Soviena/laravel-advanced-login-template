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
    @vite(['resources/js/app.js'])
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Reset Password</title>

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
    <script src="{{asset('vendor/js/helpers.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('vendor/libs/jquery/jquery.js')}}"></script>
    @vite(['resources/js/app.js'])
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
  <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-header"><strong>{{ __('Reset Password') }}</strong></div>
            <div class="card-body">

                <form method="POST" action="{{ route('password.update') }}">
                  @csrf

                  <input type="hidden" name="token" value="{{ $token }}">
                  <div class="form-group row my-2">
                      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                      <div class="col-md-8">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" readonly name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row my-2">
                      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                      <div class="col-md-8">
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" oninput="checkPassword()">
                          <div id="result" class="form-text strength"></div>
                          <div class="form-text meter">
                              <div id="meterFill" class="fill"></div>
                          </div>
                          <div id="tips" class="form-text tips"></div>
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row my-2">
                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                      <div class="col-md-8">
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" id="submit" class="btn btn-primary disabled">
                              {{ __('Reset Password') }}
                          </button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>
  </body>
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
                document.getElementById('submit').classList.add('disabled');
                break;
            case 2:
                strength = 'Weak';
                resultDiv.className = 'strength weak';
                meterFill.style.width = '30%';
                meterFill.style.backgroundColor = 'red';
                tips.push('Weak! Consider adding more unique characters.');
                document.getElementById('submit').classList.add('disabled');
                break;
            case 3:
                strength = 'Medium';
                resultDiv.className = 'strength medium';
                meterFill.style.width = '60%';
                meterFill.style.backgroundColor = 'yellow';
                tips.push('Medium! Aim for a stronger password with more complexity.');
                document.getElementById('submit').classList.add('disabled');
                break;
            case 4:
                strength = 'Strong';
                resultDiv.className = 'strength strong';
                meterFill.style.width = '80%';
                meterFill.style.backgroundColor = 'lightgreen';
                tips.push('Strong! Good job, but you can still improve.');
                document.getElementById('submit').classList.remove('disabled');
                break;
            case 5:
                strength = 'Very Strong';
                resultDiv.className = 'strength strong';
                meterFill.style.width = '100%';
                meterFill.style.backgroundColor = 'blue';
                tips.push('Amazing! Your password is very strong.');
                document.getElementById('submit').classList.remove('disabled');
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
