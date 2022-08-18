<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
// use Laravel\Fortify\Contracts\LoginResponse;         Meni pravi problem jer ima 2 Login Response na use, a njemu to ne podvlaci
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Http\Responses\LoginResponse;

use App\Models\Place;
use App\Models\Genre;
use App\Models\Type;
use App\Models\Performance;



class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function loginForm(){
        return view('auth.login', ['guard' => 'admin']);
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }





    

    public function returnData(){
        $data = Genre::all();   
        $datap = Place::all();  
        $datat = Type::all();
        // return view('admin-dashboard', ['data'=>$data], ['datap'=>$datap], ['datat'=>$datat]);
        return view('admin-dashboard', compact('data', 'datap', 'datat'));
    }


    // DASHBOARD FUNCTIONS

    public function insertPlace(Request $request){
        echo "Upalo u INSER PLACE";

        $request->validate([
            'name'=>'required|unique:places',
            'adress' => 'required|unique:places',
            'work_time' => ['required','regex:/^(\d|1\d|2[0-3])(\.\d{1,2})?h-(\d|1\d|2[0-3])(\.\d{1,2})?h$/'],
            'max_number_people' => 'required|numeric',
            'allowed_age' => 'required|regex:/[0-9]{1,2}\+$/',
            'phone_number'=> 'required|unique:places|regex: /^\+[0-9]{9,15}$/',
            'image_url' => 'required',
            'about' => 'required',
            'prices' => 'required',
            'type_id' => 'required'
        ]);

        $path = $request->file('image_url')->store('place_images');

        $place = new Place();
        $place->name = $request->name;
        $place->adress = $request->adress;
        $place->work_time = $request->work_time;
        $place->max_number_people = $request->max_number_people;
        $place->allowed_age = $request->allowed_age;
        $place->phone_number = $request->phone_number;
        $place->image_url = $path;
        $place->about = $request->about;
        $place->prices = $request->prices;
        $place->type_id = $request->type_id;


        $res = $place->save();

        if($res){
            return back()->with('success','You have created a place successfuly');
        }else {
            return back()->with('fail', 'Something went wrong when creating a place');
        }
    }

    
    




    public function insertPerformance(Request $request){



        $request->validate([
            'name'=>'required|unique:performances',
            'date' => 'required|unique:performances',
            'starts_at' => ['required','regex:/^(\d|1\d|2[0-3])(\.\d{1,2})?h$/'],
            'ends_at' => ['required','regex:/^(\d|1\d|2[0-3])(\.\d{1,2})?h$/'],
        ]);

        $performance = new Performance();
        $performance->name = $request->name;
        $performance->date = $request->date;
        $performance->starts_at = $request->starts_at;
        $performance->ends_at = $request->ends_at;
        $performance->place_id = $request->place_id;
        $performance->genre_id = $request->genre_id;

        $res = $performance->save();

        if($res){
            return back()->with('success','You have created a performance successfuly');
        }else {
            return back()->with('fail', 'Something went wrong when creating a performance');
        }
    }




    public function insertGenre(Request $request){
        $genre = new Genre();
        
        $genre->name = $request->name;
        ucwords($genre->name);
        $res = $genre->save();
        if($res){
            return back()->with('success','You have created a genre successfuly');
        }else {
            return back()->with('fail', 'Something went wrong when creating a genre');
        }
    }

    public function insertType(Request $request){
        $type = new Type();
        
        $type->type_name = $request->type_name;
        ucwords($type->type_name);
        $res = $type->save();
        if($res){
            return back()->with('success','You have created a type successfuly');
        }else {
            return back()->with('fail', 'Something went wrong when creating a type');
        }
    }
}


