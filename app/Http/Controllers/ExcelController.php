<?php

namespace App\Http\Controllers;

header('Content-Type: text/html; charset=utf-8');

use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Bom;

class ExcelController extends Controller
{
    public function convertToUTF8($data)
    {
        if (is_null($data)) {
            return $data;
        }

        $encoding = mb_detect_encoding($data, mb_detect_order(), true);

        if ($encoding === false) {
            $encoding = 'ISO-8859-1';
        }

        return mb_convert_encoding($data, 'Windows-1252', $encoding);
    }

    public function index()
    {
        $reader = Reader::createFromPath('./teste/LISTA.csv', 'r');
        $reader->setHeaderOffset(0);

        $headers = array_unique($reader->getHeader());

        $writer1 = Writer::createFromPath('./teste/novo1.csv', 'w+');
        $writer2 = Writer::createFromPath('./teste/novo2.csv', 'w+');

        $writer1->setOutputBOM(Writer::BOM_UTF8);
        $writer2->setOutputBOM(Writer::BOM_UTF8);

        $l1 = array_values(array_intersect($headers, [
            'CodigoImovel', 'TituloImovel', 'TipoImovel', 'SubTipoImovel', 'CategoriaImovel', 'UnidadeMetrica', 'Ativo', 'Publicado', 'UF', 'Cidade', 'Bairro', 'Endereco', 'Complemento', 'Condominio', 'QtdVagas', 'AreaUtil', 'AreaTotal', 'QtdDormitorios', 'QtdSuites', 'QtdBanheiros', 'QtdSalas', 'PrecoLocacao', 'PrecoCondominio', 'ValorIPTU', 'Churrasqueira', 'Sauna', 'Brinquedoteca', 'Playground', 'SalaoFestas', 'Varanda', 'Interfone', 'Portaria24Horas', 'Academia', 'Piscinas', 'Portaria24h', 'Esgoto', 'PiscinaRaia', 'CircuitoTV', 'Pavimentacao', 'AreaDeLazer', 'ProximoAoMetro', 'Condominios', 'Nome', 'Ano', 'Cep', 'Estado', 'Numero', 'Latitude', 'Longitude', 'Logradouro', 'Descricao', 'Fotos', 'Observacao', 'CEP', 'LocalChave', 'AnoConstrucao', 'PrecoVenda', 'Zelador', 'Guarita', 'Corretor', 'Email', 'Telefone', 'Proprietario', 'ObservacoesInternas', 'Granito', 'Blindex', 'Quintal', 'SemCondominio', 'Bicicletario', 'SalaoJogos', 'PisoPorcelanato', 'VarandaGourmet', 'Lavabo', 'AreaDeServico', 'Cerca', 'VentiladorDeTeto', 'QuadraDeEsportes', 'Sacada', 'ArCondicionado', 'Lavanderia', 'Semimobiliado', 'CozinhaAmericana', 'Fogao', 'Geladeira', 'Bar', 'CampoDeFutebol', 'EntradaServico', 'Closet', 'AndarAlto', 'Hidromassagem', 'SPA', 'Deck', 'Fitness', 'DeckMolhado', 'Hall', 'Jardim', 'JardimInverno', 'SalaTV', 'Marina', 'CondominioFechado', 'SalaoDeFesta', 'PiscinaInfantil', 'Aquecedor', 'Forro', 'Ofuro', 'Solarium', 'Gourmet', 'ArmarioSala', 'ServicoCozinha', 'PisoCeramica', 'PiscinaInfantil', 'PortaoEletronico', 'ArmarioCozinha', 'ArmarioQuarto', 'ArmarioBanheiro', 'AquecimentoGas', 'Churrasqueiras', 'ArmarioSuite', 'PiscinaComHidromassagem', 'Piscina', 'sauna_umida', 'sistema_seguranca', 'Duplex', 'Cobertura', 'FornoDePizza', 'ArmarioEmbutido', 'SolManha', 'GaragemCoberta', 'PisoLaminado', 'SalaDeGinastica', 'VistaMar', 'Banheira', 'Adega', 'SalaMassagem', 'CozinhaGourmet', 'Lounge', 'Massagem', 'Coworking', 'FechaduraBiometrica', 'Terraco', 'Escritorio', 'QuadraPoliEsportiva', 'Horta', 'EspacoPet', 'AreaVerde', 'Alarme', 'SalaConvivencia', 'SalaJantar', 'SalaEstar', 'GuaritaDeSeguranca', 'Vazio', 'Mobiliado', 'Telefone', 'GaragemDescoberta', 'VentiladoresTeto', 'Deposito', 'pista_skate', 'PistaSkate', 'EspacoZen', 'AquecimentoEletrico', 'QuartoServico', 'SolTarde', 'PisoTacoMadeira', 'ArmarioAreaDeServico', 'SalaFitness', 'salao_jogos', 'ArmarioDormitorioEmpregada', 'PisoArdosia', 'EscritorioArmario', 'guarita_seguranca', 'ArmarioEscritorio', 'ArmarioHomeTheater', 'Decorado', 'Anexos', 'Anexo', 'Despensa', 'pista_cooper', 'Copa', 'entrada_lateral', 'sauna_seca', 'PeDireitoDuplo', 'RestaurantePrivado', 'ContraPiso', 'salao_video_cinema', 'SalaDePilates', 'EspacoLeitura', 'ElevadorComGerador', 'elevador', 'PisoMarmore', 'ArmarioCloset', 'quadra_tenis', 'Murado', 'Edicula', 'Patio', 'Marmore', 'Lago', 'Geminada', 'ArCondicionadoSplit', 'Madeira', 'QuadraMar', 'Mezanino', 'Carpete', 'aquecimento_solar', 'videoURL', 'ar_condicionado', 'Divisoria', 'CircuitoInternoTV', 'SalaReuniao', 'ChurrasqueiraGourmet', 'Internet', 'Recepcao', 'ArCondicionadoCentral', 'Vestiarios', 'Luminaria', 'ArmarioCorredor', 'vestiario_diaristas', 'auditorio', 'portal_eletronico', 'restaurante', 'GuaritaSeguranca', 'Refeitorio', 'ElevadorGerador'
        ]));

        $l2 = array_values(array_intersect($headers, ['CodigoImovel', 'NomeArquivo', 'URLArquivo', 'Order', 'Principal']));

        $l1_utf8 = array_map([$this, 'convertToUTF8'], $l1);
        $l2_utf8 = array_map([$this, 'convertToUTF8'], $l2);

        $writer1->insertOne($l1_utf8);

        $writer2->insertOne($l2_utf8);

        $codImovel = '';

        // dd($reader);
        foreach ($reader as $record) {
            $data1 = [];
            $data2 = [];
            foreach ($headers as $header) {
                if (in_array($header, $l1)) {
                    $data1[] = $this->convertToUTF8($record[$header]);
                }

                if (in_array($header, $l2)) {
                    if (!empty($record['CodigoImovel'])) {
                        $codImovel = $this->convertToUTF8($record['CodigoImovel']);
                    }
                    $data2 = [
                        $codImovel,
                        $this->convertToUTF8($record['NomeArquivo']),
                        $this->convertToUTF8($record['URLArquivo']),
                        $this->convertToUTF8($record['Order']),
                        $this->convertToUTF8($record['Principal']),
                    ];
                }
            }
            // Escrever dados no arquivo 1
            $writer1->insertOne($data1);

            // Escrever dados no arquivo 2
            $writer2->insertOne($data2);
        }
        // dd($writer1);
        // die;
    }
}
