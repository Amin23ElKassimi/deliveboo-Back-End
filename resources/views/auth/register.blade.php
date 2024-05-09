@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrazione') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf
                        {{-- name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }} 
                                <div class="container-span">
                                    <span class="required-indicator">*</span>
                                </div>
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control obligate @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        
                        {{-- Last Name  --}}
                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Cognome') }}
                                <div class="container-span">
                                    <span class="required-indicator">*</span>
                                </div>
                            </label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control obligate @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Indirizzo Email') }}
                                <div class="container-span">
                                    <span class="required-indicator">*</span>
                                </div>
                            </label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control obligate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- password --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}
                                <div class="container-span">
                                    <span class="required-indicator">*</span>
                                </div>
                            </label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control obligate @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                <div class="password-strength-meter">
                                    <div class="strength-bar text-center text-white" id="bar-1">Debole</div>
                                    <div class="strength-bar text-center text-white" id="bar-2">Media</div>
                                    <div class="strength-bar text-center text-white" id="bar-3">Forte</div>
                                </div>
                                <i class="fa-solid fa-eye"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- confirm_password --}}
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Conferma Password') }}
                                <div class="container-span">
                                    <span class="required-indicator">*</span>
                                </div>
                            </label>
                            <div class="col-md-6 mb-4">
                                <input id="password-confirm" type="password" class="form-control obligate" name="password_confirmation"  autocomplete="new-password">
                                <span id="password-match-error" class="text-danger invisible"><strong>Le password non coincidono</strong></span>
                            </div>
                            <div class="col-md-6 text-center">
                                <span class="required-indicator">* campi obbligatori</span>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit">{{ __('Registrati') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ---------------- FUNCTION ------------------
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password-confirm').value;
    if (password !== confirmPassword) {
    // Se non coincidono
    event.preventDefault();
    document.getElementById('password-match-error').classList.remove('invisible');
    }
});
// --------------------   CAMPI OBBLIGATORI 
// verifica che parte al caricamento del dom
document.addEventListener('DOMContentLoaded', function () {
    const inputFields = document.querySelectorAll('.obligate');
    const spanElements = document.querySelectorAll('.required-indicator');
    const passwordMeter = document.querySelector('.password-strength-meter');

    // Nascondi gli asterischi e le barre di visualizzazione della password se i campi sono vuoti
    inputFields.forEach((inputField, index) => {
        if (inputField.value.trim() !== '') {
            spanElements[index].classList.add('invisible');
        } else {
            spanElements[index].classList.remove('invisible');
            if (inputField.id === 'password') {
                passwordMeter.style.display = 'none';
            }
        }
    });

    // Funzione per calcolare la complessità della password
    function checkPasswordStrength(password) {
        let strength = 0;

        // Lunghezza della password
        // if (password.length >= 8) {
        //     strength += 1;
        // }

        // Presenza di numeri
        if (/\d/.test(password)) {
            strength += 1;
        }

        // Presenza di caratteri speciali
        if (/[$-/:-?{-~!"^_`\[\]]/.test(password)) {
            strength += 1;
        }

        // Presenza di lettere maiuscole
        if (/[a-z,A-Z]/.test(password)) {
            strength += 1;
        }

        return strength;
    }

    // Aggiorna la visualizzazione della forza della password quando l'utente immette dati
    document.getElementById('password').addEventListener('input', function () {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        const strengthBars = document.querySelectorAll('.strength-bar');

        // Aggiorna la visualizzazione delle barre di forza della password
        strengthBars.forEach((bar, index) => {
            if (index < strength) {
                bar.style.opacity = 1;
            } else {
                bar.style.opacity = 0;
            }
        });

        // Mostra le barre di forza della password
        passwordMeter.style.display = 'flex';
    });

    // Aggiungi un listener di input per controllare quando l'utente immette dati
    inputFields.forEach((inputField, index) => {
        inputField.addEventListener('input', () => {
            if (inputField.value.trim() !== '') {
                spanElements[index].classList.add('invisible');
                if (inputField.id === 'password') {
                    passwordMeter.style.display = 'flex';
                }
            } else {
                spanElements[index].classList.remove('invisible');
                if (inputField.id === 'password') {
                    passwordMeter.style.display = 'none';
                }
            }
        });
    });
});
</script>
@endsection
<style>
.required-indicator {
  color: red;
  font-weight: bold;
  margin-right: 5px;
  width: 10px;
}
.invisible{
  display: none
}
div.container-span{
  /* height: 20px; */
  width: 20px;
  display:inline-block;
}
.password-strength-meter {
        display: flex;
        height: 20px;
        margin-top: 5px;
    }

    .strength-bar {
        margin-top: 2px;
        flex-grow: 1;
        height: 100%;
        margin-right: 2px;
        border-radius: 5rem
    }

    #bar-1 {
        background-color: red;
    }

    #bar-2 {
        background-color: orange;
    }

    #bar-3 {
        background-color: green;
    }

</style>
