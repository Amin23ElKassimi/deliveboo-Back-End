@extends('layouts.admin')

@section('head-title')
    @yield('page-title')
@endsection

@section('main-content')
  <section class="d-flex justify-content-center align-items-center container-big">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7" id="my_wrapper">
                {{-- Form Body --}}
                <form action="@yield('form-action')" method="POST" enctype="multipart/form-data">
                    @csrf
                    @yield('form-method')
                    <div class="form-row">
                        {{-- Name --}}
                        <div class="form-group col-md-9 m-2">
                          <label for="name">Nome Piatto:
                            <div class="container-span">
                              <span class="required-indicator">*</span>
                            </div>
                          </label>
                          <input type="text" class="form-control obligate  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $foodItem->name) }}">
                          @error('name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror 
                        </div>
                        
                        {{-- ingredienti --}}
                        <div class="form-group col-md-9 m-2">
                          <label for="ingredients">Ingredienti:
                            <div class="container-span">
                              <span class="required-indicator">*</span>
                            </div>  
                          </label>
                          <input type="text" class="form-control obligate  @error('ingredients') is-invalid @enderror" id="ingredients" minlength="9" name="ingredients" value="{{ old('ingredients', $foodItem->ingredients) }}">
                          @error('ingredients')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror 
                        </div>
                        {{-- Descrizione --}}
                        <div class="form-group col-md-9 m-2">
                          <label for="description">Descrizione:
                            <div class="container-span">
                              <span class="required-indicator">*</span>
                            </div>
                          </label>
                          <textarea class="form-control obligate @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $foodItem->description) }}</textarea>
                          @error('description')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror 
                        </div>
                        {{-- Prezzo --}}
                        <div class="form-group col-md-9 m-2">
                          <label for="price">Prezzo:
                            <div class="container-span">
                              <span class="required-indicator">*</span>
                            </div>
                          </label>
                          <input type="text" class="form-control obligate  @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $foodItem->price) }}">
                          @error('price')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror 
                        </div>
                        {{-- Disponibilità --}}
                        <div class="form-check col-md-9 m-2">
                          <input class="form-check-input" type="radio" name="available" id="not_available" value="0">
                          <label class="form-check-label" for="available">
                              Non Disponibile
                          </label>
                        </div>
                        <div class="form-check col-md-9 m-2">
                          <input class="form-check-input" type="radio" name="available" id="available" value="1" checked>
                          <label class="form-check-label" for="available">
                              Disponibile
                          </label>
                        </div>
                        {{-- Immagine --}}
                        <div class="form-row">
                          <div class="form-group col-md-9 m-2">
                            <label for="image_url">Inserire un'immagine del ristorante:
                              <div class="container-span">
                                <span class="required-indicator">*</span>
                              </div>
                            </label>
                            {{-- <input type="file" class="form-control @error('image_url') is-invalid @enderror" name="image_url" id="image_url" value="{{ str_starts_with(old('image_url', $foodItem->image_url), 'http') ? old('image_url', $foodItem->image_url) : '' }}"> --}}
                            <input type="file" class="form-control obligate @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $foodItem->image_url)}}">
                            @error('image_url')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror 
                          </div>
                          {{--Preview image: --}}
                        {{-- <div class="mb-3 input-group">
                          <img src="" alt="Image preview" class="d-none img-fluid" id="image-preview">
                        </div> --}}
                      </div>
                        {{-- Passare automaticamente resturant_id --}}
                        <div class="invisible">
                          <label for="restaurant_id"></label>
                          <input type="text" name="restaurant_id" value="{{  $restaurant ['id'] }} ">
                        </div>
                        {{-- Buttons --}}
                        <div class="mb-3 input-group m-2">
                          <button type="submit" class="btn btn-xl btn-primary">
                              @yield('page-title')
                          </button>
                      </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
  </section>
    {{-- Script for preview image url --}}
<script>
  document.getElementById('image_url').addEventListener('change', function(event){
  const imageElement = document.getElementById('image-preview');
  imageElement.classList.remove('d-none');
});
// --------------------   Script per evidenziare i campi obbligatori
// verifica che parte al caricamento del dom
document.addEventListener('DOMContentLoaded', function () {
  const inputFields = document.querySelectorAll('.obligate');
  const spanElements = document.querySelectorAll('.required-indicator');

// Nascondi gli asterischi solo se l'input è vuoto
  inputFields.forEach((inputField, index) => {
  if (inputField.value.trim() !== '') {
  spanElements[index].classList.add('invisible');
  }
});

// Aggiungi un listener di input per controllare quando l'utente immette dati
inputFields.forEach((inputField, index) => {
  inputField.addEventListener('input', () => {
  if (inputField.value.trim() !== '') {
  spanElements[index].classList.add('invisible');
  } else {
  spanElements[index].classList.remove('invisible');
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
    body{
      background-image: url('https://www.bhmpics.com/downloads/food-desktop-wallpapers/3.2b8d3481fd0855dfb0608f3198fd8adc.jpg');
      background-repeat: no-repeat; /* Impedisce la ripetizione dello sfondo */
      background-size: cover; /* Ridimensiona l'immagine per coprire l'intera area */
      background-position: center; /* Centra l'immagine */
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
    section.container-big{
      height: 93vh;
    }

</style>