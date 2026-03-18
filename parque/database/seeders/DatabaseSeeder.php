<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tarifa;
use App\Models\Cliente;
use App\Models\Espaco;
use App\Models\Ajuste;
use App\Models\Veiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);

        //usuario super-admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'nomes' => 'Super',
            'apelidos' => 'Admin',
            'tipo_documento' => 'BI',
            'numero_documento' => '004915537LA045',
            'celular' => '942355790',
            'data_nascimento' => '1997-01-06',
            'genero' => 'Masculino',
            'direcao' => 'Direção do supr Admin',
            'contacto_nome' => 'Contacto do Super Admin',
            'contacto_telefone' => '912087836',
            'contacto_parentesco' => 'Mãe',
            'estado' => true,
        ])->assignRole('SUPER ADMIN');

        User::create([
            'name' => 'Lucrecia de Sousa Dias',
            'email' => 'administradir@gmail.com',
            'password' => Hash::make('12345678'),
            'nomes' => 'Lucrecia d Sousa',
            'apelidos' => 'Dias',
            'tipo_documento' => 'BI',
            'numero_documento' => '003846787LA045',
            'celular' => '933555800',
            'data_nascimento' => '1993-07-06',
            'genero' => 'Femenino',
            'direcao' => 'Av. Principal #456, Vila-Alice',
            'contacto_nome' => 'Delfina Dias',
            'contacto_telefone' => '912087836',
            'contacto_parentesco' => 'Irmã',
            'estado' => true,
        ])->assignRole('ADMINISTRADOR');

        User::create([
            'name' => 'Carlos Mendes da Silva',
            'email' => 'operador@gmail.com',
            'password' => Hash::make('12345678'),
            'nomes' => 'Carlos',
            'apelidos' => 'Mendes da Silva',
            'tipo_documento' => 'BI',
            'numero_documento' => '003357727LA021',
            'celular' => '954321290',
            'data_nascimento' => '1990-04-06',
            'genero' => 'Masculino',
            'direcao' => 'Rangel - C9',
            'contacto_nome' => 'Rosa Mendes',
            'contacto_telefone' => '945667890',
            'contacto_parentesco' => 'Mãe',
            'estado' => true,
        ])->assignRole('OPERADOR');

        //espaços do  parque
        Espaco::create(['numero'=> '1', 'estado'=>'livre']);
        Espaco::create(['numero'=> '2', 'estado'=>'livre']);
        Espaco::create(['numero'=> '3', 'estado'=>'livre']);
        Espaco::create(['numero'=> '4', 'estado'=>'livre']);
        Espaco::create(['numero'=> '5', 'estado'=>'livre']);
        Espaco::create(['numero'=> '6', 'estado'=>'livre']);
        Espaco::create(['numero'=> '7', 'estado'=>'livre']);
        Espaco::create(['numero'=> '8', 'estado'=>'livre']);
        Espaco::create(['numero'=> '9', 'estado'=>'livre']);
        Espaco::create(['numero'=> '10', 'estado'=>'livre']);
        Espaco::create(['numero'=> '11', 'estado'=>'livre']);
        Espaco::create(['numero'=> '12', 'estado'=>'livre']);
        Espaco::create(['numero'=> '13', 'estado'=>'livre']);
        Espaco::create(['numero'=> '14', 'estado'=>'livre']);
        Espaco::create(['numero'=> '15', 'estado'=>'livre']);
        Espaco::create(['numero'=> '16', 'estado'=>'livre']);
        Espaco::create(['numero'=> '17', 'estado'=>'livre']);
        Espaco::create(['numero'=> '18', 'estado'=>'livre']);
        Espaco::create(['numero'=> '19', 'estado'=>'livre']);
        Espaco::create(['numero'=> '20', 'estado'=>'livre']);
        Espaco::create(['numero'=> '21', 'estado'=>'livre']);
        Espaco::create(['numero'=> '22', 'estado'=>'livre']);
        Espaco::create(['numero'=> '23', 'estado'=>'livre']);
        Espaco::create(['numero'=> '24', 'estado'=>'livre']);
        Espaco::create(['numero'=> '25', 'estado'=>'livre']);
        Espaco::create(['numero'=> '26', 'estado'=>'livre']);
        Espaco::create(['numero'=> '27', 'estado'=>'livre']);
        Espaco::create(['numero'=> '28', 'estado'=>'livre']);
        Espaco::create(['numero'=> '29', 'estado'=>'livre']);
        Espaco::create(['numero'=> '30', 'estado'=>'livre']);
        Espaco::create(['numero'=> '31', 'estado'=>'livre']);
        Espaco::create(['numero'=> '32', 'estado'=>'livre']);
        Espaco::create(['numero'=> '33', 'estado'=>'livre']);
        Espaco::create(['numero'=> '34', 'estado'=>'livre']);
        Espaco::create(['numero'=> '35', 'estado'=>'livre']);
        Espaco::create(['numero'=> '36', 'estado'=>'livre']);
        Espaco::create(['numero'=> '37', 'estado'=>'livre']);
        Espaco::create(['numero'=> '38', 'estado'=>'livre']);
        Espaco::create(['numero'=> '39', 'estado'=>'livre']);
        Espaco::create(['numero'=> '40', 'estado'=>'livre']);
        Espaco::create(['numero'=> '41', 'estado'=>'livre']);
        Espaco::create(['numero'=> '42', 'estado'=>'livre']);
        Espaco::create(['numero'=> '43', 'estado'=>'livre']);
        Espaco::create(['numero'=> '44', 'estado'=>'livre']);
        Espaco::create(['numero'=> '45', 'estado'=>'livre']);
        Espaco::create(['numero'=> '46', 'estado'=>'livre']);
        Espaco::create(['numero'=> '47', 'estado'=>'livre']);
        Espaco::create(['numero'=> '48', 'estado'=>'livre']);
        Espaco::create(['numero'=> '49', 'estado'=>'livre']);
        Espaco::create(['numero'=> '50', 'estado'=>'livre']);

        //tarifa regular

        Tarifa::create(['nome'=>'regular', 'tipo'=>'por_hora','quantidade'=>'1','custo'=>'0', 'minutos_de_graca'=>'30']);
        

        //tarifa por dia
        Tarifa::create(['nome'=>'regular', 'tipo'=>'por_dia','quantidade'=>'1','custo'=>'0', 'minutos_de_graca'=>'720']);
        

        //cliente 1 e seu veiculo
        Cliente::create([
            'nomes' => 'Maria Helena Domingos',
            'numero_documento' => '003321568LA045',
            'email' => 'maria.helena@gmail.com',            
            'contacto' => '912334433',
            'tipo_cliente' => 'Professor',
            'genero' => 'Femenino',
            'estado' => true,
        ]);

        Veiculo::create([
            'cliente_id' => 1,
            'placa' => 'LD-45-23-AB',
            'marca' => 'Toyota',
            'modelo' => 'Hilux',
            'cor' => 'Branco',
            'tipo' => 'auto',
        ]);

        //cliente 2 e seu veiculo
        Cliente::create([
            'nomes' => 'João da Costa Domingos',
            'numero_documento' => '003256788LA045',
            'email' => 'joao.domingos@gmail.com',            
            'contacto' => '934332230',
            'tipo_cliente' => 'Estudante',
            'genero' => 'Masculino',
            'estado' => true,
        ]);

        Veiculo::create([
            'cliente_id' => 2,
            'placa' => 'LD-78-90-CD',
            'marca' => 'Hyundai',
            'modelo' => 'Elantra',
            'cor' => 'Preto',
            'tipo' => 'auto',
        ]);

        //cliente3 e seu veiculo
        Cliente::create([
            'nomes' => 'Pedro Duarte Soares',
            'numero_documento' => '212345670LA045',
            'email' => 'pedro.soares@gmail.com',            
            'contacto' => '933443322',
            'tipo_cliente' => 'Professor',
            'genero' => 'Masculino',
            'estado' => true,
        ]);

        Veiculo::create([
            'cliente_id' => 3,
            'placa' => 'LD-23-67-EF',
            'marca' => 'Kia',
            'modelo' => 'Rio',
            'cor' => 'Vermelho',
            'tipo' => 'auto',
        ]);

        //cliente4 e seu veiculo
        Cliente::create([
            'nomes' => 'Joana Domingos',
            'numero_documento' => '126532348LA045',
            'email' => 'maria.domingos@gmail.com',            
            'contacto' => '934231122',
            'tipo_cliente' => 'Funcionario',
            'genero' => 'Femenino',
            'estado' => true,
        ]);
        Veiculo::create([
            'cliente_id' => 4,
            'placa' => 'LD-54-81-GH',
            'marca' => 'Nissan',
            'modelo' => 'Patrol',
            'cor' => 'Cinza',
            'tipo' => 'auto',
        ]);

        //cliente5 e seu veiculo
        Cliente::create([
            'nomes' => 'Nelson Fernandes',
            'numero_documento' => '015427890LA045',
            'email' => 'nelson.fernandes@gmail.com',            
            'contacto' => '933412230',
            'tipo_cliente' => 'Funcionario',
            'genero' => 'Masculino',
            'estado' => true,
        ]);

        Veiculo::create([
            'cliente_id' => 5,
            'placa' => 'LD-90-12-IJ',
            'marca' => 'Toyota',
            'modelo' => 'Land Cruiser',
            'cor' => 'Preto',
            'tipo' => 'auto',
        ]);

        Ajuste::create([
            'nome' => 'Sis_Parque_Instic',
            'descricao' => 'Sistema de Gestão de Parque de Estacionamento',
            'filial' => 'Universidade de Luanda',
            'direcao' => 'Bairro Range - CTT',
            'telefone' => '921324567',
            'logo' => 'wWIPf4td2RFMMLNgqJYJuTlDGml3upin6yspszYi.png',
            'logo_auto' => 'mP4YYnZX1ywjauSJiHc6J4KTDJAJMgz0XQiv8ZXs.png',
            'divisa' => 'KZ',
            'correio' => 'instic@gmail.com',
            'pagina_web' => 'https://uniluanda.ao/',
          
        ]);
    }
}
