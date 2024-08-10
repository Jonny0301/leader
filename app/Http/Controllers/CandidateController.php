<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Candidate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Illuminate\Support\Facades\DB;


class CandidateController extends Controller
{
    public function index()
    {
        return view('barang.barang-add');
    }

    public function show()
    {
        
        $candidates = Candidate::where('process', false)
        ->with('barangs')
        ->get();
        return view('candidate.candidate', compact('candidates'));
    }

    public function result()
    {
        
        $candidates = Candidate::where('process', true)
        ->with('barangs')
        ->get();
        return view('candidate.result', compact('candidates'));
    }

    public function destroy($id_barang)
    {
        try {
            $deletedbarang = Barang::findOrFail($id_barang);

            $deletedbarang->delete();

            Alert::error('Success', 'Barang has been deleted !');
            return redirect('/barang');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Barang already used !');
            return redirect('/barang');
        }
    }

    public function add_candidate($id)
    {
        
        $barang = Barang::findOrFail($id);
        $pending = Candidate::where('process',false)
        ->where('leader_id',$id)
        ->select('leader_id', DB::raw('count(*) as total_count'))
        ->groupBy('leader_id')
        ->get()
        ->sum('total_count');
        $approve = Candidate::where('process',true)
        ->where('leader_id',$id)
        ->select('leader_id', DB::raw('count(*) as total_count'))
        ->groupBy('leader_id')
        ->get()
        ->sum('total_count');

    

        $neighbours =
        [
            "ACAMPAMENTO TERRA E LIBERDADE",
            "ACAMPAMENTO VIVIAN OLIVEIRA",
            "ÁGUAS LINDAS",
            "Aldeia Kateté",
            "ALTAMIRA",
            "ALTO BONITO",
            "ALVORA",
            "AMAZONAS",
            "AMEC VILLE",
            "APOEMA",
            "ASSENTAMENTO FAZENDINHA",
            "Bairro da Fap",
            "BAIRRO DA PAZ",
            "BEIRA RIO 1",
            "BELA VISTA",
            "BETANIA",
            "Bom Jardim",
            "Bom Jesus",
            "CAETANOPOLIS",
            "Califórnia",
            "Casa Branca",
            "CEDERE I",
            "Céu Azul",
            "Chácara da Lua",
            "CHACARA DO SOL",
            "CIDADE JARDIM",
            "CIDADE NOVA",
            "Cinco Estrelas",
            "Comunidade Campo Livre",
            "COMUNIDADE UNIAO",
            "Esperança",
            "Esplanada",
            "GUANABARA",
            "HABITAR FELIZ",
            "IPIRANGA",
            "JARDIM AMERICA",
            "JARDIM CANADA",
            "Jardim Eldorado",
            "Jardim Planalto",
            "Karajás Sul",
            "LIBERDADE 1",
            "Liberdade I",
            "LIBERDADE II",
            "Linha Verde",
            "MARANHÃO",
            "Maranhãozinho",
            "MINÉRIOS",
            "MONTES CLAROS",
            "MORADA NOVA",
            "NOVA CARAJÁS",
            "NOVA CONQUISTA",
            "NOVA ESPERANÇA I",
            "NOVA ESPERANÇA II",
            "NOVA PARAUAPEBAS",
            "NOVA VIDA I",
            "NOVA VIDA II",
            "NOVA VITORIA",
            "Novo Brasil",
            "Novo Horizonte",
            "Novo Tempo",
            "Novo Viver",
            "Núcleo Urbano de Carajás",
            "PALMARES 2",
            "PALMARES SUL",
            "Panorama",
            "PARAISO",
            "PARQUE DAS NAÇÕES 1",
            "PARQUE DOS CARAJAS 1",
            "PARQUE DOS CARAJÁS 2",
            "PARQUE SAO LUIZ",
            "PARQUE VERDE",
            "PAULO FONTELES",
            "Polo Moveleiro",
            "POPULAR 1",
            "POPULAR 2",
            "PRIMAVERA",
            "RAIO DE SOL",
            "RENASCENCA",
            "Residencial Alto Boa Vista",
            "RESIDENCIAL AMAZÔNIA",
            "Residencial Bambuí",
            "Residencial Brasília",
            "RESIDENCIAL MARTINE",
            "Residencial Porto Seguro",
            "Residencial Vista do Vale",
            "RIO VERDE",
            "SANTA LUZIA",
            "São José",
            "SAO LUCAS",
            "São Luíz",
            "Serra Azul",
            "Talismã",
            "TAPETE VERDE",
            "TROPICAL 1",
            "TROPICAL 2",
            "UNIÃO",
            "VALE DO SOL",
            "Vale dos Carajás",
            "Vida Nova",
            "VILA NOVA",
            "VILA RICA",
            "VILA SANSAO",
            "vila vale da serra",
            "Zona Rural"
        ];
        return view('candidate.candidate-add',[
            'barang' => $barang,
            'neighbours' => $neighbours,
            'pending' => $pending,
            'approve' => $approve,
        ]);
    }

    public function store_candidate(Request $request)
    {
        $validated = $request->validate([
            'leader_id' => 'required',
            'fullname' => 'required|max:100|unique:candidates',
            'nickname' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'mail' => 'required',
            'birthday' => 'required',
            'neighbour' => 'required',
            'address' => 'required',
        ]);

 

        $candidatePhone = $validated['phone'];
        $id = $validated['leader_id'];


        $candidate = Candidate::where('phone',$candidatePhone)
        ->first();

        

        if($candidate){
            Alert::success('alert', 'Candidate has already exists!');
            return redirect()->route('candidate.add_candidate', ['id' => $id]);
        }else{

            $add_candidate = Candidate::create($request->all());
            Alert::success('Success', 'Candidate has been saved !');
            return redirect('/candidate/show');
        }

        // $leader_id = $request->input('leader_id');

        // dump($leader_id);


      
    }


    public function approve($id)
    {
     
        $candidate = Candidate::find($id);

        // Check if candidate exists
        if (!$candidate) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }

        $candidate->process = true;
        $candidate->save();
        Alert::info('Success', 'Successfully approved !');
        return redirect('/candidate/show');
    }

}
