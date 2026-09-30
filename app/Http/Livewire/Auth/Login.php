<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Parroquia;
use App\Models\Comuna;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;


use Illuminate\Support\Facades\Mail;

use App\Mail\UserCreated;
use App\Mail\resetMail;

class Login extends Component
{
    public $estatus, $pertenece_al_psuv, $cargo_popular= false;
    public $estados, $municipios, $parroquias, $comunas, $nivelesAcademicos, $profesiones, $niveles, $avanzadas, $responsabilidades = null;
    public $cedula, $nacionalidadId, $correo, $direccion, $fechaNacimiento, $nombre, $apellido = null;
    public $generos, $cargo, $vocero = null;
    public $telefono, $edad, $inactivo, $id = null;
    public $paisId, $estadoId, $municipioId, $parroquiaId, $comunaId, $nivelAcademicoId, $profesionId, $responsabilidadId, $avanzadaId, $generoId, $nivelId = null; //Id que recibo de los campos


    public $email, $modalReset = null;
    public $password = null;
    public $remember_me = false;  
    public $showSuccesNotification, $showFailureNotification, $showFailureLogin = false;

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required',
    ];

    public function mount() 
    {
        if(auth()->user()){
            redirect('/dashboard');
        }
    }
    public function login() 
    {    
        $user = User::where('email', '=', $this->email)->first();
        
        if(isset($user)){
            if($user->email == $this->email and password_verify($this->password, $user->password)) 
            {
                auth()->login($user, $this->remember_me);
                return redirect()->intended('/dashboard'); 
            }else
            {
                $this->showFailureLogin = true;
            }
        }else
        {
            $this->showFailureLogin = true;
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
    public function resetPassword()
    {
        $this->modalReset = true;
    }
    public function recoverPassword()
    {
        $user = User::where('email', '=', $this->email)->first();
        
        //dd($user);

        if(isset($user))
        {
            //dd($user->email);
            //return view('livewire.auth.reset');
            Mail::to($user->email)->send(new resetMail());
            $this->showSuccesNotification = true;
        }
        else
        {
            $this->showFailureNotification = true;
        }
    }
}
