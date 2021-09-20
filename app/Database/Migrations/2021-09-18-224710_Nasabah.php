<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nasabah extends Migration
{
    public function up()
    {
        // Mysql
        $this->forge->addField([
            'id' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false,
            ],
            'id_nasabah' => [
                'type' => 'varchar',
                'constraint' => 10,
                'null' => false,
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 30,
                'null' => false,
            ],
            'username' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false,
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false,
            ],
            'nama_lengkap' => [
                'type' => 'varchar',
                'constraint' => 40,
                'null' => false,
            ],
            'notelp' => [
                'type' => 'varchar',
                'constraint' => 12,
                'null' => false,
            ],
            'alamat' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false,
            ],
            'tgl_lahir' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false,
                'default' => '03-oktober-2000',
            ],
            'kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['laki-laki','perempuan'],
                'null' => false,
            ],
            'token' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'is_verify' => [
                'type' => 'ENUM',
                'constraint' => ['yes','no'],
                'null' => false,
                'default' => 'no',
            ],
            'otp' => [
                'type' => 'varchar',
                'constraint' => 6,
                'null' => true,
            ],
        ]);

        // Postgre
        // $this->forge->addField([
        //     'id' => [
        //         'type' => 'character varying',
        //         'constraint' => 20,
        //         'null' => false,
        //     ],
        //     'id_nasabah' => [
        //         'type' => 'character varying',
        //         'constraint' => 10,
        //         'null' => false,
        //     ],
        //     'email' => [
        //         'type' => 'character varying',
        //         'constraint' => 30,
        //         'null' => false,
        //     ],
        //     'username' => [
        //         'type' => 'character varying',
        //         'constraint' => 20,
        //         'null' => false,
        //     ],
        //     'password' => [
        //         'type' => 'character varying',
        //         'constraint' => 20,
        //         'null' => false,
        //     ],
        //     'nama_lengkap' => [
        //         'type' => 'character varying',
        //         'constraint' => 40,
        //         'null' => false,
        //     ],
        //     'notelp' => [
        //         'type' => 'character varying',
        //         'constraint' => 12,
        //         'null' => false,
        //     ],
        //     'alamat' => [
        //         'type' => 'character varying',
        //         'constraint' => 255,
        //         'null' => false,
        //     ],
        //     'tgl_lahir' => [
        //         'type' => 'character varying',
        //         'constraint' => 20,
        //         'null' => false,
        //         'default' => '03-oktober-2000',
        //     ],
        //     'kelamin' => [
        //         'type' => 'character varying',
        //         'constraint' => 10,
        //         'default' => 'laki-laki',
        //         'null' => false,
        //     ],
        //     'token' => [
        //         'type' => 'character varying',
        //         'constraint' => 255,
        //         'null' => true,
        //     ],
        //     'created_at' => [
        //         'type' => 'character varying',
        //         'constraint' => 255,
        //         'null' => false,
        //         'default' => 'CURRENT_TIMESTAMP',
        //     ],
        // ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('id_nasabah');
        $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('nasabah');
    }

    public function down()
    {
        //
    }
}
