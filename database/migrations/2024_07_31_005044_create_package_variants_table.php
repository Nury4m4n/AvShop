<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant');
            $table->decimal('price', 20, 2);
            $table->integer('stock');
            $table->integer('stock_taken')->default(0);
            $table->text('description');
            $table->string('variant_image');
            $table->unsignedBigInteger('umrah_package_id');
            $table->timestamps();
            $table->foreign('umrah_package_id')->references('id')->on('umrah_packages')->onDelete('cascade'); // Linking to the umrah_packages table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_variants');
    }
}
