<!doctype html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<style>body { font-family:'Poppins', sans-serif; }</style>

</head>

<?php 

    use App\Models\Type;

    $types = Type::all();

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






@yield("content")




  {{-- CONTENT --}}
  <div class="grid grid-cols-8 gap-4 p-4">
  @foreach ($performances as $performance )
    <a href="/place/{{$performance->place_id}}" >
        <div class="m-4 bg-white rounded shadow overflow-hidden text-center">

            <img class="object-cover" src="{{ asset($performance->image_url) }}" alt="">
            <div class="p-4">
                <div class="text-sm font-semibold">{{ $performance->p_name }}</div>
                <div class="text-xs text-gray-500">{{ $performance->performer_name }}</div>
            </div>
                <div class="border-t px-4 py-2">{{ $performance->starts_at }} - {{ $performance->ends_at }}</div>
                <div class="border-t px-4 py-2">{{ $performance->date }}</div>
        </div>
    </a>
  @endforeach
</div>

 


  <script>
    function Menu(e){
      let list = document.querySelector('ul');
      e.name === 'menu' ? (e.name = "close",list.classList.add('top-[80px]') , list.classList.add('opacity-100')) :( e.name = "menu" ,list.classList.remove('top-[80px]'),list.classList.remove('opacity-100'))
    }
  </script>
</body>

</html>
