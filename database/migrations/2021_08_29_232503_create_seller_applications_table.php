<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('shop_category');
            $table->string('portfolio_url');
            $table->boolean('owns_content_confirmed');
            $table->json('meta');
            $table->timestamps();

            // Used in look ups for preventing duplicate urls.
            $table->index('portfolio_url');

            // These indexes should make future application filtering more responsive.
            $table->index('shop_category');
            $table->index(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_applications');
    }
}
