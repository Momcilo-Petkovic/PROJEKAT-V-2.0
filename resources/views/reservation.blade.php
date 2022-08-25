<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>body { font-family:'Poppins', sans-serif; }</style>
</head>

<?php 
        use App\Models\Type;
        use App\Models\Place;
        use App\Models\Reservation;
        $types = Type::all();
        // $reservations = Reservation::all();    
        $rid = 0;
        foreach ($performances as $performance) {
            $rid = $performance->per_id;
        }
?>





<body class="bg-cyan-400 w-full">
    <nav class="p-5 bg-white shadow md:flex md:items-center md:justify-between">
        <a href="{{ url('') }}" class="flex justify-between items-center ">
          <span class="text-2xl font-[Poppins] cursor-pointer">
            <img class="h-10 inline"
              src="https://tailwindcss.com/_next/static/media/social-square.b622e290e82093c36cca57092ffe494f.jpg">
            Events Niš
          </span>
    
          <span class="text-3xl cursor-pointer mx-2 md:hidden block">
            <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
          </span>
        </a>
    
            @foreach ($types as $type)
                <a href="/filter/type/{{$type->id}}" >{{ $type->type_name }}</a>
            @endforeach
    
        <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-white w-full left-0 md:w-auto md:py-0 py-4 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
            @if (Route::has('login'))
            @auth
          <li class="mx-4 my-6 md:my-0">
            <a href="{{ url('/dashboard') }}" class="bg-cyan-400 text-white font-[Poppins] duration-500 px-6 py-2 mx-4 hover:bg-cyan-500 rounded ">Dashboard</a>
          </li>
            @else
          <li class="mx-4 my-6 md:my-0">
            <a href="{{ route('login') }}" class="text-xl hover:text-cyan-500 duration-500">Log In</a>
          </li>
          @if (Route::has('register'))
          <li class="mx-4 my-6 md:my-0">
            <a href="{{ route('register') }}" class="text-xl hover:text-cyan-500 duration-500">Register</a>
          </li>
          @endif
          @endauth
          @endif
    
        </ul>
      </nav>

      
<form action="{{ route('make-reservation') }}" method="POST" class="m-auto w-2/6 mt-24 bg-white p-6 rounded">

                        @if (Session::has('success'))
                            <div class="alert alert-success text-black">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger text-black">{{ Session::get('fail') }}</div>
                        @endif
                        @csrf
          <span class="text-danger text-red m-auto text-center my-6 pb-4">@error('firstname') {{ $message }} @enderror</span>
          <span class="text-danger text-red">@error('lastname') {{ $message }} @enderror</span>
          <span class="text-danger text-red">@error('phone') {{ $message }} @enderror</span>



    <div class="mb-6">
      <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">First name</label>
      <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
    <div class="mb-6">
      <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Last name</label>
      <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
    <div class="mb-6">
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Phone number</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>

    <input type="hidden" id="rid" name="rid" value="{{ $rid }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
  </form>
  


<script>
    function Menu(e){
      let list = document.querySelector('ul');
      e.name === 'menu' ? (e.name = "close",list.classList.add('top-[80px]') , list.classList.add('opacity-100')) :( e.name = "menu" ,list.classList.remove('top-[80px]'),list.classList.remove('opacity-100'))
    }
  </script>


</body>
</html>