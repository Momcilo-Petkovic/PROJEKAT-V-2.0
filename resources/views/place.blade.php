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
        
        $types = Type::all();
        
        $id = 0;
        foreach ($about as $a) {
          $id = $a->id;
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


      

{{--  --}}
      {{-- @foreach ($performances as $performance )
      <a href="/place/{{$performance->place_id}}" >
          <div class="m-4 bg-white rounded shadow overflow-hidden text-center">
  
              <img class="object-cover" src="{{ asset($performance->image_url) }}" alt="">
              <div class="p-4">
                  <div class="text-sm font-semibold">{{ $performance->name }}</div>
                  <div class="text-xs text-gray-500">{{ $performance->performer_name }}</div>
              </div>
                  <div class="border-t px-4 py-2">{{ $performance->starts_at }} - {{ $performance->ends_at }}</div>
                  <div class="border-t px-4 py-2">{{ $performance->date }}</div>
          </div>
      </a>
    @endforeach --}}
{{--  --}}

<div>
 
    <div class="grid mb-8  md:mb-12 md:grid-cols-1 w-2/6 ml-24 mt-12 float-left">

        <h1 class="mb-6 text-7xl">Performances</h1>

        @foreach ($performances as $performance )
        <figure class="flex flex-col justify-center items-center p-8 text-center bg-white dark:bg-cyan-900 rounded dark:border-gray-700">
            <blockquote class="mx-auto mb-4 max-w-2xl text-gray-500 lg:mb-8 dark:text-gray-400">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $performance->performer_name }}</h3>
                <p class="my-4 font-light">{{ $performance->starts_at }} - {{ $performance->ends_at }}</p>
                <p class="my-4 font-light">{{ $performance->date}}</p>
                <p class="my-4 font-light">{{ $performance->genre_name}}</p>
            </blockquote>
            <figcaption class="flex justify-center items-center space-x-3">
                <div class="space-y-0.5 font-medium dark:text-white text-left">
                    <a href="/reservation/{{ $performance->per_id }}" class="flex bg-cyan-400 text-white font-[Poppins] duration-500 px-6 py-2 mx-4 hover:bg-cyan-500 rounded md:text-xl">Make a reservation</a>
        
                </div>
                
            </figcaption>    
        </figure>

        <div class="mb-12"></div>
        @endforeach
    </div>

    <div class="grid mb-8 md:mb-12 md:grid-cols-1 w-2/6 mr-24 mt-12 float-right">
        <h1 class="mb-6 text-7xl">Description</h1>
        @foreach ($about as $a )
            <h3 class="text-4xl">{{ $a->about }}</h3>
        @endforeach
        

        {{-- COMMENT SECTION --}}
        <div class="max-w-lg rounded-lg shadow-md shadow-blue-600/50 bg-cyan-900 mt-12">

          @if (session('message'))
            <h6 class="alert alert-warning mt-3 text-white ml-4 pt-2">{{ session('message') }}</h6>
          @endif

          <form action="{{ route('comments') }}" method="POST" class="w-full p-4">
            @csrf
            <div class="mb-2">
              <input type="hidden" name="post_slug" value="{{ $id }}">
              <label for="comment_body" class="text-lg text-white">Add a comment</label>
              <textarea
                class="w-full h-20 p-2 border rounded focus:outline-none focus:ring-gray-300 focus:ring-1"
                name="comment_body"
                placeholder=""></textarea>
            </div>
            <div>
              <button type="submit" class="px-3 py-2 text-sm text-blue-100 bg-blue-600 rounded">
                Comment
              </button>
            </div>
          </form>
        </div>

        {{-- <div class="max-w-lg rounded-lg shadow-md shadow-blue-600/50 bg-cyan-900 mt-12 p-6 text-white">
            <div class="detail-area pb-4 mt-4 mb-4">
              <h6 class="user-name m-4 px-4 py-3">
                User One
                <small class="ms-3 text-primary">Commented on: 3-8-2022</small>
              </h6>
              <p class="user-comment mb-1 m-4 px-4 py-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem in inventore quisquam molestias quia corrupti illo ducimus labore accusamus consequatur.
              </p>
            </div>
            <div class="pb-4 mt-4 mb-4 ml-4">
              <a href="" class="m-4 px-4 py-3 text-sm text-blue-100 bg-blue-600 rounded">Edit</a>
              <a href="" class="m-4 px-4 py-3 text-sm text-blue-100 bg-red-600 rounded">Delete</a>
            </div>
        </div> --}}

        @foreach ($comments as $comment)
          <div class="max-w-lg rounded-lg shadow-md shadow-blue-600/50 bg-cyan-900 mt-12 p-6 text-white">
          <div class="detail-area pb-4 mt-4 mb-4">
            <h6 class="user-name m-4 px-4 py-3">
              {{ $comment->name }}
            </h6>
            <p class="user-comment mb-1 m-4 px-4 py-3">
               {{ $comment->comment_body }}
            </p>
          </div>
          
          @if (Auth::check())
            @if ($comment->c_user_id == Auth::user()->id)
            <div class="pb-4 mt-4 mb-4 ml-4">
              
                <a href="/delete_comment/{{ $comment->c_id }}"   class="m-4 px-4 py-3 text-sm text-blue-100 bg-red-600 rounded">Delete</a>
              

            </div>
            @endif
          @endif
            
            
        </div>
        @endforeach
        
    </div>

    
</div>



<script>
    function Menu(e){
      let list = document.querySelector('ul');
      e.name === 'menu' ? (e.name = "close",list.classList.add('top-[80px]') , list.classList.add('opacity-100')) :( e.name = "menu" ,list.classList.remove('top-[80px]'),list.classList.remove('opacity-100'))
    }
  </script>


</body>
</html>