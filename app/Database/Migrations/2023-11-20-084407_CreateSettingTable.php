<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned'=>true,
                'auto_increment'=>true,
            ],
            'blog_title'=>[
                'type'=> 'VARCHAR',
                'constraint'=> '255',
            ],
            'blog_email' => [
                'type' => 'VARCHAR',
                'constraint'=> '255'
            ],
            'blog_phone'=>[
                'type'=> 'VARCHAR',
                'constraint'=> '255',
                'null'=>true,
            ],
            'blog_meta_keywords'=>[
                'type'=>'VARCHAR',
                'constraint'=>'255',
                'null'=> true,
            ],
            'blog_meta_description'=>[
                'type'=>'TEXT',
                'null'=> true,
            ],
            'blog_logo'=>[
                'type'=>'VARCHAR',
                'constraint'=>'255',
                'null'=>true
            ],
            'blog_favicon'=>[
                'type'=>'VARCHAR',
                'constraint'=>'255',
                'null'=>true
            ],
            'create_at timestamp default current_timestamp',
            'update_at timestamp default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
