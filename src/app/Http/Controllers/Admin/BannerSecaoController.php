<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BannerSecao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerSecaoController extends Controller 
{  
    public function index() { 
        $bannersSecao = BannerSecao::orderByDesc('id_banner_secao')
        ->get();
        

        return view('admin.bannerSecao.index', compact('bannersSecao')); 
    } 

    public function store(Request $request){

        //  VALIDAR DADOS
        $dados = $request->validate([
            'titulo_banner_secao' => 'required|string|max:50',
            'subtitulo_banner_secao' => 'required|string|max:35',
            'img_banner_secao' => 'required|required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_banner_secao' => 'required|in:ATIVO,INATIVO',            
        ]);

        // CADASTRAR

        $bannerSecao = BannerSecao::create([
            'titulo_banner_secao' => $dados['titulo_banner_secao'],
            'subtitulo_banner_secao' => $dados['subtitulo_banner_secao'],
            'img_banner_secao' => 'banner-secao/sem-imagem.jpg',
            'status_banner_secao' => $dados['status_banner_secao'],
        ]);

        // RECEBER A IMAGEM

        $imagem = $request->file('img_banner_secao');

        // CARREGAR NOVA IMAGEM

        $nomeImg = Str::slug($dados['img_banner_secao'], '_')
            . '_'
            . $bannerSecao->id_banner_secao
            . '.'
            . $imagem->extension();


        // ENCAMINHAR PARA PASTA

        $pastaBannerSecao = public_path('vs-cuidadora/assets/banner-secao');

        File::ensuredDirectoryExists($pastaBannerSecao);

        // SALVAR AS IMAGENS
        
        $imagem->move($pastaBannerSecao, $nomeImg);

        //  ATUALIZA O CAMINHO DA IMAGEM NO BANCO

        $bannerSecao->img_banner_secao = 'banner-secao/' . $nomeImg;
        $bannerSecao->save();

        return redirect()
        ->route('admin.bannerSecao.index')
        ->with('sucesso', 'Banner cadastrado com sucesso!');

    }


    // ATUALIZAR BANNER

    public function update(Request $request, int $id){
        //  VALIDAR DADOS
        $dados = $request->validate([
            'titulo_banner_secao' => 'required|string|max:50',
            'subtitulo_banner_secao' => 'required|string|max:35',
            'img_banner_secao' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_banner_secao' => 'required|in:ATIVO,INATIVO',            
        ]);

        // BUSCAR O BANNER

        $bannerSecao = BannerSecao::findOrfail($id);

        // MANTER A IMAGEM PADRÃO

        $caminhoImg = $bannerSecao->img_banner_secao;

        //  VERIFICAR SE ENVIOU UMA NOVA IMAGEM

        if($request->hasFile('img_banner_secao')){
            $imagem = $request->file('img_banner_secao');

            
            $nomeImg = Str::slug($dados['img_banner_secao'], '_')
                . '_'
                . $bannerSecao->id_banner_secao
                . '.'
                . $imagem->extension();

            $pastaBannerSecao = public_path('vs-cuidadora/assets/banner-secao');

            File::ensuredDirectoryExists($pastaBannerSecao);

            // CAMINHO ANTIGO

            $imagemAntiga = public_path('vs-cuiadadora/assets/banner-secao' . $bannerSecao->img_banner_secao);

            //  REMOVER A IMAGEM

            if(File::exists($imagemAntiga)){
                File::delete($imagemAntiga);
            }

            // SALVAR A IMAGEM NOVA

            $imagem->move($pastaBannerSecao, $nomeImg);

            $caminhoImg = 'banner-secao/' . $nomeImg;
        }

        // ATUALIZAR O REGISTRO

        $bannerSecao->update([
            'titulo_banner_secao' => $dados['titulo_banner_secao'],
            'subtitulo_banner_secao' => $dados['subtitulo_banner_secao'],
            'img_banner_secao' => $caminhoImg,
            'status_banner_secao' => $dados['status_banner_secao'],
        ]);

        return redirect()
        ->route('admin.bannerSecao.index')
        ->with('sucesso', 'Banner ataulizado com sucesso!');
        
    }


    // ATIVAR/DESATIVAR BANNER

    public function status(int $id){

        // BUSCAR O BANNER PELO ID

        $bannerSecao = BannerSecao::findOrfail($id);

        // TROCAR OS STATUS

        if($bannerSecao->status_banner_secao === 'ATIVO'){
            $bannerSecao->status_banner_secao = 'INATIVO';
            $mensagem = 'Banner desativado com sucesso';
        } else {
            $bannerSecao->status_banner_secao = 'ATIVO';
            $mensagem = 'Banner ativado com sucesso';
        }

        // SALVAR ALTERAÇÃO

        $bannerSecao->save();

    
        return redirect()
            ->route('admin.bannerSecao.index')
            ->with('sucesso', $mensagem);
    }
}
