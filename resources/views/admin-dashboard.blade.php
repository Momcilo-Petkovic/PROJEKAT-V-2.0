<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Tailwind Starter Template - Responsive Header : Tailwind Toolbox</title>
	<meta name="author" content="name">
  <meta name="description" content="description here">
	<meta name="keywords" content="keywords,here">
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->

</head>
<?php
  use App\Models\Place;
  use Illuminate\Support\Facades\Auth;
  
	$places = Place::all();
  
?>


<body class="bg-gray-400 font-sans leading-normal tracking-normal">

	<nav class="flex items-center justify-between flex-wrap bg-gray-800 p-6 fixed w-full z-10 top-0">
		<div class="flex items-center flex-shrink-0 text-white mr-6">
			<a class="text-white no-underline hover:text-white hover:no-underline" href="#">
				<span class="text-2xl pl-2"><i class="em em-grinning pr-20"></i>{{ $admin_name }}</span>
			</a>
		</div>

		<div class="block lg:hidden">
			<button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-white hover:border-white">
				<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
			</button>
		</div>

		<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block pt-6 lg:pt-0" id="nav-content">
			<ul class="list-reset lg:flex justify-end flex-1 items-center">
					<a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="{{ route('alogout') }}">Log out</a>
				</li>
			</ul>
		</div>
	</nav>

	<!--Container-->
	<div class="container shadow-lg mx-auto bg-white mt-24 md:mt-18">

	</div>

	<script>
		//Javascript to toggle the menu
		document.getElementById('nav-toggle').onclick = function(){
			document.getElementById("nav-content").classList.toggle("hidden");
		}
	</script>
















    {{-- Content --}}

    <div class="grid grid-cols-8 gap-4 p-4 pb-60">
      @foreach ($places as $place )
        <a href="/place/{{$place->id}}" >
          <div class="m-4 bg-white rounded shadow overflow-hidden text-center">
      
            <img class="object-cover" src="{{ asset($place->image_url) }}" alt="">
            <div class="p-4">
              <div class="text-sm font-semibold">{{ $place->p_name }}</div>
            </div>
          </div>
        </a>
      @endforeach
      </div>
      

      @if ($is_admin)
      <h1 class="text-6xl text-center justify-center">Unos podataka</h1>  


      {{-- INSERT PLACE --}}
      <div class="flex justify-center pt-16 ">
        <section class="border-4 p-20 border-gray-700">
          <h2 class="text-2xl text-center">Kreacija mesta</h2>
          <br>
          <form action="/insert-place" method="POST" class="grid grid-cols-3 gap-4" enctype="multipart/form-data">
                          @if (Session::has('success'))
                              <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                          @endif
                          @if (Session::has('fail'))
                              <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                          @endif
                          @csrf
            <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('adress') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('work_time') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('max_number_people') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('allowed_age') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('phone_number') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('image_url') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('about') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('prices') {{ $message }} @enderror</span>
            <input
              type="text"
              class="w-96 mb-2"
              id="p_name"
              name="p_name"
              placeholder="Name"
              value="{{ old('p_name') }}"
            />
            
            <input
              type="text"
              class="w-96 mb-2"
              id="adress"
              name="adress"
              placeholder="Adress"
              value="{{ old('adress') }}"
            />
            
            <input
              type="text"
              class="w-96 mb-2"
              id="work_time"
              name="work_time"
              placeholder="Work time | Example: 8h-24h ~ 0h-2h"
              value="{{ old('work_time') }}"
            />
            
            <input
              type="text"
              class="w-96 mb-2"
              id="max_number_people"
              name="max_number_people"
              placeholder="Maximum number of people"
              value="{{ old('max_number_people') }}"
            />
            
            <input
              type="text"
              class="w-96 mb-2"
              id="allowed_age"
              name="allowed_age"
              placeholder="Allowed age | Example: 18+"
              value="{{ old('allowed_age') }}"
            />
            
            <input
              type="text"
              class="w-96 mb-2"
              id="phone_number"
              name="phone_number"
              placeholder="Phone Number | Example: +381691234567"
              value="{{ old('phone_number') }}"
            />
            
            <input
              type="file"
              class="w-96 mb-2"
              id="image_url"
              name="image_url"
              placeholder="Image URL"
              value="{{ old('image_url') }}"
            /> 
            {{-- I'll try to make a image upload instead --}}
            
            <input
              type="text-area"
              class="w-96 h-32 mb-2 text-center"
              id="about"
              name="about"
              placeholder="About"
              value="{{ old('about') }}"
            />
            
            <input
              type="text-area"
              class="w-96 h-32 mb-2 text-center "
              id="prices"
              name="prices"
              placeholder="Prices"
              value="{{ old('prices') }}"
            />
  
            <select name="type_id" id="type_id">
              @foreach ($datat as $row)
                <option value="{{ $row->id }}">{{ $row->type_name }}</option>
              @endforeach
            </select>
            
            
  
            <button type="submit" class="bg-gray-500 rounded text-white p-2 mt-2 hover:bg-gray-700">Create</button>
          </form>
        </section>
  
      </div>
  
      {{-- INSERT PERFORMANCE --}}
      <div class="flex justify-center pt-16 ">
        <section class="border-4 p-20 border-gray-700">
          <h2 class="text-2xl text-center">Kreacija nastupa</h2>
          <br>
          <form action="{{ route('insert-performance') }}" method="POST" class="grid grid-cols-3 gap-4">
  
            @if (Session::has('success'))
                              <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                          @endif
                          @if (Session::has('fail'))
                              <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                          @endif
                          @csrf
            <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('date') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('starts_at') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('ends_at') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('place_id') {{ $message }} @enderror</span>
            <span class="text-danger text-bookmark-pink">@error('genre_id') {{ $message }} @enderror</span>
  
            <input
              type="text"
              class="w-96 mb-2"
              id="name"
              name="name"
              placeholder="Name"
              value="{{ old('name') }}"
            />
    
            <input
              type="date"
              class="w-96 mb-2"
              id="date"
              name="date"
              placeholder="{{ strtotime("today") }}"
              value="{{ old('date') }}"
            />
            <input
              type="text"
              class="w-96 mb-2"
              id="starts_at"
              name="starts_at"
              placeholder="Starts at | Examples: 8h , 16h, 23h, 0h"
              value="{{ old('starts_at') }}"
            />
            <input
              type="text"
              class="w-96 mb-2"
              id="ends_at"
              name="ends_at"
              placeholder="Ends at | Examples: 8h , 16h, 23h, 0h"
              value="{{ old('ends_at') }}"
            />
            {{-- <input
              type="text"
              class="w-96 mb-2"
              id="place_id"
              name="place_id"
              placeholder="Place ID"
              value="{{ old('place_id') }}"
            /> --}}
            
            <select name="place_id" id="place_id">
              @foreach ($datap as $row)
                <option value="{{ $row->id }}">{{ $row->p_name }}</option>
              @endforeach
            </select>
  
            <select name="genre_id" id="genre_id">
              @foreach ($data as $row)
                <option value="{{ $row->id }}">{{ $row->genre_name }}</option>
              @endforeach
            </select>
            
            
  
            <button type="submit" class="bg-gray-500 rounded text-white p-2 mt-2 hover:bg-gray-700">Create</button>
          </form>
        </section>
  
      </div>
  
  
      {{-- INSERT GENRE --}}
      <div class="flex justify-center pt-16 ">
        <section class="border-4 p-20 border-gray-700">
          <h2 class="text-2xl text-center">Kreacija zanra</h2>
          <br>
          <form action="{{ route('insert-genre') }}" method="POST" class="grid grid-cols-3 gap-4">
  
            @if (Session::has('success'))
                              <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                          @endif
                          @if (Session::has('fail'))
                              <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                          @endif
                          @csrf
            <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
  
            <input
              type="text"
              class="w-96 mb-2"
              id="genre_name"
              name="genre_name"
              placeholder="Genre name"
              value="{{ old('genre_name') }}"
            />
  
            </select>
            
            
  
            <button type="submit" class="bg-gray-500 rounded text-white p-2 mt-2 hover:bg-gray-700">Create</button>
          </form>
        </section>
  
      </div>
  
      {{-- INSERT TYPE --}}
      <div class="flex justify-center pt-16 ">
        <section class="border-4 p-20 border-gray-700">
          <h2 class="text-2xl text-center">Kreacija tipa</h2>
          <br>
          <form action="{{ route('insert-type') }}" method="POST" class="grid grid-cols-3 gap-4">
  
            @if (Session::has('success'))
                              <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                          @endif
                          @if (Session::has('fail'))
                              <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                          @endif
                          @csrf
            <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
  
            <input
              type="text"
              class="w-96 mb-2"
              id="type_name"
              name="type_name"
              placeholder="Type name"
              value="{{ old('type_name') }}"
            />
  
            </select>
            
            
  
            <button type="submit" class="bg-gray-500 rounded text-white p-2 mt-2 hover:bg-gray-700">Create</button>
          </form>
        </section>
  
      </div>
  
      {{-- Reservation Confirmations --}}
      
      <h1 class="m-auto text-6xl text-center my-12">Sve rezervacije</h1>
      <a href="{{ route('export-reservations-pdf') }}"><h3 class="m-auto rounded p-4 bg-green-600 text-white text-center hover:bg-green-700 w-2/6">Export PDF</h3></a>
      <table class="table-auto m-auto mt-10 mb-10">
        <thead>
          <tr class="border-2 p-6 text-center">
            <th class="border-2 p-6 text-center">Ime</th>
            <th class="border-2 p-6 text-center">Prezime</th>
            <th class="border-2 p-6 text-center">Telefon korisnika</th>
            <th class="border-2 p-6 text-center">Ime mesta</th>
            <th class="border-2 p-6 text-center">Telefon mesta</th>
            <th class="border-2 p-6 text-center">Status rezervacije</th>
            <th class="border-2 p-6 text-center">Potvrda <br> (0 da bi odbili / 1 da bi potvrdili)</th>
            <th class="p-6 text-center">Submit</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datar as $d)
          <form  action="{{ route('insert-confirmation') }}" method="POST" class="grid grid-cols-3 gap-4">
            @if (Session::has('success'))
                                  <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                              @endif
                              @if (Session::has('fail'))
                                  <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                              @endif
                              @csrf
                <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
  
              <tr class="border-2 p-6 text-center">
                <td class="border-2 p-6 text-center">{{ $d->first_name }}</td>
                <td class="border-2 p-6 text-center">{{ $d->last_name }}</td>
                <td class="border-2 p-6 text-center">{{ $d->user_phone }}</td>
                <td class="border-2 p-6 text-center">{{ $d->p_name }}</td>
                <td class="border-2 p-6 text-center">{{ $d->phone_number }}</td>
  
                <td class="border-2 p-6 text-center">
                @if ($d->reservation_confirmation === null)
                  Reservation jo?? uvek nije potvr??ena
                  @elseif ($d->reservation_confirmation == 1)
                  Rezervacija potvr??ena
                  @else
                  Rezervacija odbijena
                @endif
                </td>
                
                <td class="border-2 p-6 text-center"><input type="number" name="confirmation" id="confirmation"></td>
                <td class="p-6 text-center"><button type="submit" class="bg-gray-500 rounded text-white p-2 mt-2 hover:bg-gray-700">Submit</button></td>
                <td class=""><input type="hidden" name="res_id" id="res_id" value="{{ $d->res_id }}"></td>
              </tr>
  
          </form>
          @endforeach
        </tbody>
      </table>
  
  
  
      {{-- Place destroyer --}}
      <h1 class="m-auto text-6xl text-center my-12">Brisanje podataka</h1>
      <br><br>
      <h3 class="m-auto text-4xl text-center my-12">Brisanje mesta</h3>
      <p class="m-auto text-2xl text-center my-12">Brisanje mesta ce obrisati i sve nastupe i rezervacije u odabranom mestu</p>
      <table class="table-auto m-auto mt-10 mb-10">
        <thead>
          <tr class="border-2 p-6 text-center">
            <th class="border-2 p-6 text-center">ID mesta</th>
            <th class="border-2 p-6 text-center">Naziv mesta</th>
            <th class="p-6 text-center">Submit</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datap as $p)
          <form  action="/delete-place" method="POST" class="grid grid-cols-3 gap-4">
            @if (Session::has('success'))
                                  <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                              @endif
                              @if (Session::has('fail'))
                                  <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                              @endif
                              @csrf
                <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
  
              <tr class="border-2 p-6 text-center">
                <td class="border-2 p-6 text-center">{{ $p->id }}</td>
                <td class="border-2 p-6 text-center">{{ $p->p_name }}</td>
                <td class="border-2 p-6 text-center"><button type="submit" class="bg-red-600 rounded text-white p-2 mt-2 hover:bg-red-700">Delete</button></td>
                <input name="id" id="id" type="hidden" value="{{ $p->id }}">
              </tr>
  
          </form>
          @endforeach
        </tbody>
      </table>
  
      {{-- Performance destroyer --}}
      <br><br>
      <h3 class="m-auto text-4xl text-center my-12">Brisanje nastupa</h3>
      <p class="m-auto text-2xl text-center my-12">Brisanje nastupa ce obrisati i sve rezervacije za taj nastup</p>
      <table class="table-auto m-auto mt-10 mb-10">
        <thead>
          <tr class="border-2 p-6 text-center">
            <th class="border-2 p-6 text-center">ID nastupa</th>
            <th class="border-2 p-6 text-center">Naziv izvodjaca</th>
            <th class="border-2 p-6 text-center">Datum nastupa</th>
            <th class="p-6 text-center">Submit</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataper as $per)
          <form  action="/delete-performance" method="POST" class="grid grid-cols-3 gap-4">
            @if (Session::has('success'))
                                  <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                              @endif
                              @if (Session::has('fail'))
                                  <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                              @endif
                              @csrf
                <span class="text-danger text-bookmark-pink">@error('name') {{ $message }} @enderror</span>
  
              <tr class="border-2 p-6 text-center">
                <td class="border-2 p-6 text-center">{{ $per->per_id }}</td>
                <td class="border-2 p-6 text-center">{{ $per->performer_name }}</td>
                <td class="border-2 p-6 text-center">{{ $per->date }}</td>
                <td class="border-2 p-6 text-center"><button type="submit" class="bg-red-600 rounded text-white p-2 mt-2 hover:bg-red-700">Delete</button></td>
                <input name="id" id="id" type="hidden" value="{{ $per->per_id }}">
              </tr>
  
          </form>
          @endforeach
        </tbody>
      </table>
      
  
      {{-- Type destroyer --}}
  
      @endif


    


</body>
</html>



{{--  --}}
