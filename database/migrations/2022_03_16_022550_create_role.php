<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

class CreateRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id_role');
            $table->string('role');
        });

        $roleData = array(
            [
                'role' => 'Admin',
            ],
            [
                'role' => 'User',
            ],
        );

        foreach ($roleData as $data){
            $roles = new Role();
            $roles->role =$data['role'];
            $roles->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
