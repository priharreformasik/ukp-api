<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Klien;
use App\Psikolog;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class UserController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    // public function login(){
    //     if(Auth::attempt([
    //         'username' => request('username'),
    //         'password' => request('password')
    //     ])){
    //         $user = Auth::user();
    //         $success['token'] =  $user->createToken('MyApp')-> accessToken;
    //         return response()->json(['success' => $success], $this-> successStatus);
    //     }
    //     else{
    //         return response()->json(['error'=>'Unauthorised'], 401);
    //     }
    // }


    public function loginKlien(Request $request){
        if(Auth::attempt([
            'email' => request('email'),
            'password' => request('password'),
            'level' => 'Klien'
        ])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json($success, $this-> successStatus);
        }
        else{
            $success['error'] = 'Unauthorised';
            $success['message'] = 'You username or password incorrect!';
            return response()->json([$success],401);
        }
    }


    public function loginPsikolog(Request $request){
        if(Auth::attempt([
            'email' => request('email'),
            'password' => request('password'),
            'level' => 'Psikolog'
        ])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json($success, $this-> successStatus);
        }
        else{
            $success['error'] = 'Unauthorised';
            $success['message'] = 'You username or password incorrect!';
            return response()->json([$success],401);
        }
    }


    public function login(Request $request){
        if(Auth::attempt([
            'username' => request('username'),
            'password' => request('password')
        ])){
            $user = Auth::user();
            $username = $request->get('username');
            $password = $request->get('password');
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['username'] = $username;
            $success['password'] = $password;
            return response()->json(['sukses'=> $success], $this-> successStatus);
        }
        else{
            $success['error'] = 'Unauthorised';
            $success['message'] = 'You username or password incorrect!';
            return response()->json([$success],401);
        }
    }
    // public function login(Request $request)
    // {
    //     $hasher = app()->make('hash');
    //     $username = $request->input('username');
    //     $password = $request->input('password');
    //     $login = User::where('username', $username)->first();
    //     if (!$login) {
    //         $success['success'] = false;
    //         $success['message'] = 'Your username or password incorrect!';
    //         return response()->json([$success], $this-> successStatus);
    //     }else{
    //         if ($hasher->check($password, $login->password)) {
    //             $api_token = sha1(time());
    //             $create_token = User::where('id', $login->id);
    //             if ($create_token) {
    //                 $success['success'] = true;
    //                 $success['api_token'] = $api_token;
    //                 $success['username'] = $username;
    //                 $success['password'] = $password;
    //                 return response($success);
    //             }
    //         }else{
    //             $success['success'] = false;
    //             $success['message'] = 'You username or password incorrect!';
    //             return response()->json([$success], $this-> successStatus);
    //         }
    //     }
    // }

/**
     * details api
     *
     * @return \Illuminate\Http\Response
     */

     public function update_password_api(Request $request){

     $ubahPassword = User::find(Auth::user()->id);
     if(Hash::check($request->password_lama,$ubahPassword->password)){
       if($request->password_baru == $request->konfirmasi){
         $ubahPassword->password = bcrypt($request->konfirmasi);
         $ubahPassword->save();
         //$status=='success';
         $status['status'] = 'sukses';
         return response()->json(['password'=>$status]);
       }
     }else{
        $status['status'] = 'Password Lama Yang Anda Masukkan Tidak Benar!';
         return response()->json(['password'=>$status]);
     }
   }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


   public function update_token(Request $request, $id){
		 $data= User::find($id);
		 $data->fcm_token = $request->get('fcm_token', $data->fcm_token);
		 $data->save();
		 return response()->json($data);
	}

  public function updateStatusAktif(Request $request, $id){
    $data= User::find($id);
    $data->isActive = $request->get('isActive', $data->isActive);
    $data->save();
    return response()->json($data);
 }


        public function details()
        {
            $user = Auth::user();
            return response()->json(['details' => $user], $this-> successStatus);
        }


    public function destroy($id)
    {
      $klien_id = Klien::where('user_id',$id)->delete();
      $data = User::find($id)->delete();
      return response()->json(['success' => 'Data berhasil dihapus!']);

    }

}
