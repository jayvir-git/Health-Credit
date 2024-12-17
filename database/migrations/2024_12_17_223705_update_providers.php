<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('providers');
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialty');
            $table->string('address');
            $table->integer('lattitude');
            $table->integer('longitude');
            $table->string('zipcode');
            $table->string('city');
            $table->string('state');
            $table->timestamps();
        });

        DB::table('providers')->insert(
            array(
                'name' => 'Lifecycles Health Center and Services',
                'specialty' => 'Dental',
                'address' => '433 N 7th St, Camden, NJ 08102',
                'lattitude' => 39.95025454708687,
                'longitude' => -75.11707199084061,
                'zipcode' => '08102',
                'city' => 'Camden',
                'state' => 'NJ',
            ));
        DB::table('providers')->insert(array(
            'name' => 'Cooper University Hospital',
            'specialty' => 'Dental',
            'address' => '1 Cooper Plaza, Camden, NJ 08103',
            'lattitude' => 39.94198175323415,
            'longitude' => -75.11713675540761,
            'zipcode' => '08103',
            'city' => 'Camden',
            'state' => 'NJ',
        ));
        DB::table('providers')->insert(array(
            'name' => 'Broadway Community Health Care',
            'specialty' => 'Vision',
            'address' => '1 Cooper Plaza, Camden, NJ 08103',
            'lattitude' => 39.94033948069934,
            'longitude' => -75.11902022926732,
            'zipcode' => '08103',
            'city' => 'Camden',
            'state' => 'NJ',
        ));
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialty');
            $table->string('address');
            $table->timestamps();
        });
    }
};
