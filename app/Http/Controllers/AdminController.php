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
use Illuminate\Support\Facades\Auth;

use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Http\Responses\LoginResponse;

use App\Models\Place;
use App\Models\Genre;
use App\Models\Type;
use App\Models\Performance;
use App\Models\Reservation;
use PDF;

use DB;



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




    

    public function returnData(Request $request){
        $data = Genre::all();   
        $datap = Place::all();  
        $datat = Type::all();
        $dataper = Performance::all();
        
        $datar = DB::table('reservations')
        ->join('performances','performance_id', '=', 'performances.per_id')
        ->join('places','performances.place_id', '=', 'places.id')
        ->get();

        
        $is_admin = \Auth::guard('admin')->user()->is_admin;
        $admin_name = \Auth::guard('admin')->user()->name;
  


        $datar = $datar->sortBy('res_id');
        // return view('admin-dashboard', ['data'=>$data], ['datap'=>$datap], ['datat'=>$datat]);
        return view('admin-dashboard', compact('data', 'datap', 'datat', 'datar', 'dataper', 'is_admin', 'admin_name'));
    }


    // DASHBOARD FUNCTIONS

    public function insertPlace(Request $request){
        echo "Upalo u INSER PLACE";

        $request->validate([
            'p_name'=>'required|unique:places',
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
        $place->p_name = $request->p_name;
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
            return redirect()->back()->with('success','You have created a place successfuly');
        }else {
            return redirect()->back()->with('fail', 'Something went wrong when creating a place');
        }
    }

    
    




    public function insertPerformance(Request $request){



        $request->validate([
            'name'=>'required:performances',
            'date' => 'required:performances',
            'starts_at' => ['required','regex:/^(\d|1\d|2[0-3])(\.\d{1,2})?h$/'],
            'ends_at' => ['required','regex:/^(\d|1\d|2[0-3])(\.\d{1,2})?h$/'],
        ]);



        $performance = new Performance();
        $performance->performer_name = $request->name;
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
        
        $genre->genre_name = $request->genre_name;
        ucwords($genre->genre_name);
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


    public function confirmReservation(Request $request){

        $request->validate([
            'confirmation'=>'required'
        ]);

        $reservation = DB::table('reservations')
        ->where('res_id', $request->res_id)
        ->get();


        $reservation->confirmation = $request->confirmation;

        $res = DB::update('update reservations set reservation_confirmation = ? where res_id = ?', [$reservation->confirmation, $request->res_id]);

        if($res){
            return back()->with('success','You have changed the reservation status');
        }else {
            return back()->with('fail', 'Something went wrong when changing the reservation status');
        }
    }




    public function deletePlace(Request $request){
        $perid = DB::table('performances')->select('per_id')->where('place_id', '=', $request->id)->get();
        foreach($perid as $id){
            $deletedreservations = DB::table('reservations')->where('performance_id', '=', $id->per_id)->delete();
        }
        
        $deletedperformance = DB::table('performances')->where('place_id', '=', $request->id)->delete();
        $deletedplace = DB::table('places')->where('id', '=', $request->id)->delete();
     


        if($deletedplace){
            return redirect()->back()->with('success','You have deleted a place');
        }else {
            return redirect()->back()->with('fail', 'Something went wrong when deleting a place');
        }
    }

    public function deletePerformance(Request $request){


        $deletedreservations = DB::table('reservations')->where('performance_id', '=', $request->id)->delete();
        $deletedperformance = DB::table('performances')->where('per_id', '=', $request->id)->delete();
     


        if($deletedperformance){
            return redirect()->back()->with('success','You have deleted a performance');
        }else {
            return redirect()->back()->with('fail', 'Something went wrong when deleting a performance');
        }
    }


    public function exportReservations(){
        $reservations = Reservation::get();

        $pdf = Pdf::loadView('pdf.reservations', [
            'reservations' => $reservations
        ]);
        return $pdf->download('reservations.pdf');
    }
}


