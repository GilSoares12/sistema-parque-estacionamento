<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::create(['name' => 'SUPER ADMIN']);
        Role::create(['name' => 'ADMINISTRADOR']);
        Role::create(['name' => 'OPERADOR']);

        Permission::create(['name' => 'admin.ajustes.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.ajustes.create'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.roles.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.create'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.edit'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.update'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.destroy'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.permissoes'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.roles.update_permissoes'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.create'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.restore'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.show'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.update'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.espacos.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.espacos.create'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.espacos.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.espacos.edit'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.espacos.update'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.espacos.destroy'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.tarifas.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tarifas.create'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tarifas.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tarifas.edit'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tarifas.update'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tarifas.destroy'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.clientes.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.create'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.restore'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.show'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.edit'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.update'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.destroy'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.veiculos.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.veiculos.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.veiculos.update'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.clientes.veiculos.destroy'])->syncRoles($super_admin);
        
        Permission::create(['name' => 'admin.tickets.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.buscar_veiculo'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.store'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.imprimir_ticket'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.atualizar_tarifa'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.finalizar_ticket'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.calcular_valor'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.tickets.destroy'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.facturacao.imprimir_factura'])->syncRoles($super_admin);

        Permission::create(['name' => 'admin.relatorios.index'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.relatorio.relatorio_semanal'])->syncRoles($super_admin);
        Permission::create(['name' => 'admin.relatorio.relatorio_mensal'])->syncRoles($super_admin);
        
    }
}
