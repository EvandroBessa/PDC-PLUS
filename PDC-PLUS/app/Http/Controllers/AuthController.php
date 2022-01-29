<?php

namespace App\Http\Controllers;

use App\Amigos;
use App\Localizacao;
use App\Pais;
use App\Perfil;
use App\Provincia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //

    public function registo(){
        $pais= Pais::all();
        $provincia= Provincia::all();

        return view('auth.register',compact("pais","provincia"));
    }



    public function registar(Request $request){

     //   return $request; exit;
        $request->validate( [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user= new User();
        $perfil = new Perfil();
        $localizacao= new Localizacao();
        $pagamento= new PagamentoController();
        $publicacao = new PublicacaoController();
        $response= new Request();


        $localizacao->bairro= $request->bairro;
        $localizacao->cidade = $request->provincia;
        $localizacao->pais = $request->pais;
        $localizacao->save();

        $user->username= $request->username;
        $user->email= $request->email;
        $user->password=Hash::make($request->password);
        $user->telefone = $request->telefone;
        $user->tipo = $request->tipo;
        $user->localizacao_id = $localizacao->id;
        $user->save();

        $perfil->nome = $request->nome;
        $perfil->data_nascimento = $request->dataNascimento;
        $perfil->genero = $request->genero;
        ($request->nif) ? $perfil->nif= $request->nif:null;
        $perfil->permissao_id = $request->permissao;
        $perfil->permissaoAmizade=$request->permissao;
        $perfil->agente_id = $user->id;
        $perfil->fotoPerfil= $request->file('fotoPerfil')->store('perfil','public');
        $perfil->save();

        $response->request->add([
            'id'=>$user->id,
            'perfil'=>$perfil->id,
            'nome'=>$perfil->nome,
            'username'=>$perfil->username
        ]);
     
        $pagamento->criarConta($user->id);

        session()->put([
            'id'=>$user->id,
            'perfil'=>$perfil->id,
            'nome'=>$perfil->nome,
            'username'=>$user->username,
            'imagem'=>$perfil->fotoPerfil
        ]);


        return  redirect('/');

        






    }


    public function entrar(){
        return view('auth.login');
    }

    public function entrei(Request $request){
    
        $request->validate( [
          
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $publicacao = new PublicacaoController();
      

        $user = User::where('email',$request->email)->first();
        
        if($user and $user->estado!='eliminado'){
            if(Hash::check($request->password,$user->password)){
                $perfil = Perfil::where('agente_id',$user->id)->first();
                session()->put([
                    'id'=>$user->id,
                    'perfil'=>$perfil->id,
                    'nome'=>$perfil->nome,
                    'username'=>$user->username,
                    'imagem'=>$perfil->fotoPerfil,
                    'tipo'=>$user->tipo,
                    'amigos'=> Amigos::where('agenteSolicitado',$user->id)->orWhere('agenteSolicitante',$user->id)->where('estado','aceite')->count()
                ]);
              
                $user->estado='logado';
                $user->save();
               

        
                return  redirect('/');
            }
            return redirect()->back()->with('erro','Senha Inválida');
        }elseif($user->estado=='eliminado'){
            return redirect()->back()->with('eliminado','A Sua Conta foi eliminada, por favor tente recupera-la para ter acesso!');
        }

        return redirect()->back()->with('erro','Email Inválido');
        



       

    }


    public function sair(){
        if(session()->has('id')){
            $user= User::where('id',session()->get('id'))->first();
            $user->estado='nao logado';
            $user->save();
            session()->pull('id');
           // session()->flash('id');

            return redirect('entrar');
        }
    }
}
