<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("slug");
            $table->string("title");
            $table->string("mainImage", 500);
            $table->text("shortDesc");
            $table->text("desc");
            $table->json("overview");
            $table->json("features");
            $table->json("technical");
            $table->json("challenge");
            $table->text("outcome");
            $table->text("conclusion");
            $table->json('reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
