<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('multi_images', function (Blueprint $table) {
        $table->unsignedBigInteger('rooms_id')->after('id'); // Adjust the position as needed
    });
}

public function down()
{
    Schema::table('multi_images', function (Blueprint $table) {
        $table->dropColumn('rooms_id');
    });
}
};
