<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            $table->string('business_license')->nullable();
            $table->enum('business_license_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->string('rcic_license')->nullable();
            $table->enum('rcic_license_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->string('pmr_course_certificate')->nullable();
            $table->enum('pmr_course_certificate_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->json('client_review_links')->nullable();
            $table->enum('client_review_links_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->json('reference_details')->nullable();
            $table->enum('reference_details_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->json('physical_office')->nullable();
            $table->enum('physical_office_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->json('previous_client_details')->nullable();
            $table->enum('previous_client_details_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->json('social_score')->nullable();
            $table->integer('social_score_value')->default(0);
            $table->enum('social_score_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->json('case_approval')->nullable();
            $table->string('case_approval_rate')->default(0);
            $table->enum('case_approval_status', ['pending' ,'approved', 'rejected'])->default('pending');;

            $table->string('trust_score')->default(0);

            $table->foreign('user_id')->references('id')->on('users') ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('documents');
    }
}
