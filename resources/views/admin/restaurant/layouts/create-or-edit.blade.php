@extends('layouts.admin')

@section('head-title')
    @yield('page-title')
@endsection

@section('main-content')
<section class="cater3-movingBG d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row justify-content-center my_card">
      <div class="col-7" id="my_wrapper">
      {{-- Form --}}
        <form method="POST" action="@yield('form-action')" enctype="multipart/form-data" >
        @csrf
        @yield('form-method')
          <div class="form-row my_card">
            <div class="form-group col-md-9 m-2">
              <label for="name">Nome Ristorante:
                <div class="container-span">
                  <span class="required-indicator">*</span>
                </div>  
              </label>
              <input type="text" class="form-control obligate inline @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$restaurant->name) }}" >
              @error('name')
              <span class="text-danger">{{ $message }}</span>
              @enderror 
            </div>
            <div class="form-group col-md-9 m-2">
              <label for="piva">Partita Iva: 
                <div class="container-span">
                  <span class="required-indicator">*</span>
                </div>
              </label>
              <input type="text" class="form-control obligate @error('vat') is-invalid @enderror" id="vat" name="vat" value="{{ old('vat',$restaurant->vat) }}" >
              @error('vat')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group col-md-9 m-2">
            <label for="address">Indirizzo:
              <div class="container-span">
                <span class="required-indicator">*</span>
              </div>
            </label>
            <input type="text" class="form-control obligate @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address',$restaurant->address) }}" >
            @error('address')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group col-md-9 m-2">
            <label for="phone_number">Numero di telefono:
              <div class="container-span">
                <span class="required-indicator">*</span>
              </div>
            </label>
            <input type="tel" class="form-control obligate @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number',$restaurant->phone_number) }}" >
            @error('phone_number')
              <span class="text-danger">{{ $message }}</span>
             @enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-9 m-2">
              <label for="inputCity">Email:
                <div class="container-span">
                  <span class="required-indicator">*</span>
                </div> 
              </label>
              <input type="email" class="form-control obligate @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$restaurant->email) }}" >
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror 
            </div>
            {{-- image --}}
            <div class="input-group col-md-9 m-2">
              <div class="form-group">
                <label for="image_url">Inserire un'immagine del ristorante:
                  <div class="container-span">
                    <span class="required-indicator">*</span>
                  </div> 
                </label>
                <input type="file" class="form-control obligate @error('image_url') is-invalid @enderror" id="image_url" name="image_url">
               
                @if ($restaurant->image_url)
                    <!-- Anteprima dell'immagine -->
                    <h4>Image Selected</h4>
                <div id="imagePreview"></div>
                @endif

                @error('image_url')
                  <span class="text-danger">{{ $message }}</span>
                @enderror 
                <h4>Current Image</h4>
                @if ($restaurant->image_url)
                    <img src="{{ asset('storage/' . $restaurant->image_url) }}" alt="Anteprima immagine" style="object-fit:contain;  width: 180px;
                    height: auto; ">
                @endif
              </div>
            </div>
            <div>
            </div>
            <div class="container">
              <label for="categories">Categorie:</label>
              <ul class="ks-cboxtags">
                @foreach ($categories as $category)
                <li>
                  <input type="checkbox" id="categories-{{ $category->id }}" value="{{ $category->id }}" class="obligate"
                  name="categories[]" {{ in_array($category->id, old('categories', $restaurant->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                  <label for="categories-{{ $category->id }}">{{ $category->name }}</label>
                </li>
                @endforeach
                @error('categories')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </ul>
            </div>
            <div class="col-md-6">
              <span class="indicator">* campi obbligatori</span>
            </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-success p-3 mt-3" id="button-go">@yield('page-title')
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>

{{-- @foreach ($categories as $category)
<input type="checkbox" class="obligate" name="categories[]" id="categories-{{ $category->id }}" value="{{ $category->id }}" >
<label class="me-2" for="categories-{{ $category->id }}">{{ $category->name }}
</label>
@endforeach --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputFields = document.querySelectorAll('.obligate');
    const spanElements = document.querySelectorAll('.required-indicator');

    // Funzione per controllare se un campo di input è vuoto
    function checkInputEmpty(inputField, spanElement) {
        if (inputField.value.trim() !== '') {
            spanElement.classList.add('invisible');
        } else {
            spanElement.classList.remove('invisible');
        }
    }

    // Controlla lo stato iniziale dei campi di input
    inputFields.forEach((inputField, index) => {
        checkInputEmpty(inputField, spanElements[index]);

        // Aggiungi un listener di input per i campi di input
        inputField.addEventListener('input', () => {
            checkInputEmpty(inputField, spanElements[index]);
        });
    });
});

document.getElementById('image_url').addEventListener('change', function(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var dataURL = reader.result;
        var imagePreview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            imagePreview.innerHTML = '<img src="' + dataURL + '" style="max-width: 300px; max-height: 300px;" />';
        } else {
            imagePreview.innerHTML = ''; // Rimuovi l'anteprima se non è stata selezionata alcuna immagine
        }
    };

    reader.readAsDataURL(input.files[0]);
});


</script>

@endsection

  
<style>

#anteprima{
  width: 80px;
  height: 100px;
  object-fit:cover;
}
    .required-indicator {
      color: red;
      font-weight: bold;
      margin-right: 5px;
      width: 10px;
    }
    span.indicator{
      color: red;
      font-weight: bold;

    }
    .invisible{
      display: none
    }
    div.container-span{
        /* height: 20px; */
        width: 20px;
        display:inline-block;
    }
label{
  font-weight: bold;
}
/* Animation property */
#button-go {
  animation: wiggle 2s linear infinite;
}

/* Keyframes */
@keyframes wiggle {
  0%, 7% {
    transform: rotateZ(0);
  }
  15% {
    transform: rotateZ(-15deg);
  }
  20% {
    transform: rotateZ(10deg);
  }
  25% {
    transform: rotateZ(-10deg);
  }
  30% {
    transform: rotateZ(6deg);
  }
  35% {
    transform: rotateZ(-4deg);
  }
  40%, 100% {
    transform: rotateZ(0);
  }
}

button.go {
  /* position: absolute;
  left: calc(50%);
  top: calc(50%); */
  height: 4em;
  width: 7em;
  background: #444;
  background: linear-gradient(top, #555, #333);
  border: none;
  border-top: 3px solid orange;
  border-radius: 0 0 0.2em 0.2em;
  color: #fff;
  font-family: Helvetica, Arial, Sans-serif;
  font-size: 1em;
  transform-origin: 50% 5em;
}

ul.ks-cboxtags {
    list-style: none;
    padding-left: 0px;
}
ul.ks-cboxtags li{
  display: inline;
}
ul.ks-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 3px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ks-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ks-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\0271A";
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label::before {
  content: "\2714";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ks-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ks-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ks-cboxtags li input[type="checkbox"]:focus + label {
  border: 2px solid #e9a1ff;
}

#my_wrapper {
    min-width: 300px;
    border: 5px solid rgb(206, 206, 206);
    background-color: rgb(228, 228, 228);
    border-radius: 10px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
    /* transition: all 0.3s ease;  */
    }

    #my_wrapper:hover {
    /* transform: scale(1.05);  */
    box-shadow: 40px 40px 80px rgba(0, 0, 0, 0.3);   
    }

/* Background */

body {
  background:#000;
}
.cater3-movingBG {
    height: 94vh;
    width: 100%;
    background-image: url(http://salsaritas.johngroupinteractive.com/wp-content/uploads/2017/06/enchilada-bg.jpg);
    background-size: 125%;
    background-repeat: repeat-x;
    animation: animatedBackground 15s linear alternate infinite;
}

@keyframes animatedBackground {
    0% { background-position: 0 0; }
    50% { background-position: 50% 0; }
    100% { background-position: 0 0; }
}
@media screen and (max-width: 880px) {
    .cater3-movingBG {
        background-size: 250%;
        background-position: center;
    }
}
@media screen and (max-width: 550px) {
    .cater3-movingBG {
        background-size: 450%;
        background-position: center;
    }
}

.flyinTxtCont {
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding-bottom: 10%;
      margin-left: 2em;
}
.flyIn {
    color:#fff;
    font-family:'Raleway';
    text-transform:uppercase;
    line-height:1.2em;
    position:relative;
  text-shadow: 2px 2px 40px rgba(0,0,0,0.7);
}
.lineOne {
  transition-delay:.2s; 
  transition:.4s ease in;
  animation: txtFlyIn .3s linear;
}
.lineTwo {
    transition-delay:.4s; 
    transition:.6s ease in;
    animation: txtFlyIn .6s linear;
}
.lineThree {
    transition-delay:.6s; 
    transition:.8s ease in;
    animation: txtFlyIn .9s linear;
}
.lineOne, .lineTwo, .lineThree {
    font-size:110px;
    font-weight: bold;
    letter-spacing: 3px;
  }
.lineFour {
    transition-delay:2s; 
    transition:2s ease in;
    animation: fadeIn 2s linear;
    width: 100%;
    background-color:rgba(255,255,255,0.9);
    display:inline-block;
    color:#000;
    box-size:border-box;
    max-width:63%;
    max-width: 22em;
    font-size: 32px;
    padding: .2em .5em;
    margin-top: 30px;
}
@keyframes fadeIn{
    0% { opacity:0;}
    100% { opacity:1;}
}
@keyframes txtFlyIn{
    0% { transform:translateX(-100%); }
    100% { transform:translateX(0%); }
}
</style>

