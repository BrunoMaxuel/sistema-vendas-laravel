<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clientes;
class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clientes::create(
            [
            'nome' => 'NÃO IDENTIFICADO',
            'CPF' => '000.000.000-00',
            'sexo' => 'I',
            'telefone' => '(00)000000321',
            ],
        );
        Clientes::create(
            [
                'nome' => 'bruno',
                'CPF' => '000.000.000-02',
                'sexo' => 'M',
                'telefone' => '(00)000000021',
            ],
        );
        Clientes::create(
            [
            'nome' => 'lar',
            'CPF' => '000.000.000-12',
            'sexo' => 'I',
            'telefone' => '(00)000000012',
            ],
        );
       
      
    }
}
