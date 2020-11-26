<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11);
            $table->integer('city_id')->length(11)->default(0);
            $table->string('urgent');
            $table->string('job_name');
            $table->string('job_slug')->nullable();
            $table->string('job_type');
            $table->string('job_purpose');
            $table->string('sale_price')->nullable();
            $table->string('rent_price')->nullable();
            $table->text('address');
            $table->string('map_latitude')->nullable();
            $table->string('map_longitude')->nullable();
            $table->string('bathrooms');
            $table->string('bedrooms');
            $table->string('area')->nullable();
            $table->longtext('description')->nullable();
            $table->text('job_features')->nullable();
            $table->string('featured_image');
            $table->string('job_images1')->nullable();
            $table->string('job_images2')->nullable();
            $table->string('job_images3')->nullable();
            $table->string('job_images4')->nullable();
            $table->string('job_images5')->nullable();
            $table->integer('status')->length(1)->default(1);
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
        Schema::dropIfExists('jobs');
    }
}
