<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cardboards', function (Blueprint $table){
            if (!Schema::hasColumn('cardboards', 'Categoria_Principal__c')) {
                $table->string('Categoria_Principal__c')->after('document_number')->nullable()->default(null)->comment = 'Salesforce Categoria_Principal__c';
            }

            if (!Schema::hasColumn('cardboards', 'Categoria__c')) {
                $table->string('Categoria__c')->after('Categoria_Principal__c')->nullable()->default(null)->comment = 'Salesforce Categoria__c';
            }

            if (!Schema::hasColumn('cardboards', 'Categoria_Administrativo__c')) {
                $table->string('Categoria_Administrativo__c')->after('Categoria__c')->nullable()->default(null)->comment = 'Salesforce Categoria_Administrativo__c';
            }

            if (!Schema::hasColumn('cardboards', 'FirstName')) {
                $table->string('FirstName')->after('Categoria_Administrativo__c')->nullable()->default(null)->comment = 'Salesforce FirstName';
            }

            if (!Schema::hasColumn('cardboards', 'LastName')) {
                $table->string('LastName')->after('FirstName')->nullable()->default(null)->comment = 'Salesforce LastName';
            }

            if (!Schema::hasColumn('cardboards', 'Email')) {
                $table->string('Email')->after('LastName')->nullable()->default(null)->comment = 'Salesforce Email';
            }

            if (!Schema::hasColumn('cardboards', 'generoEmail__c')) {
                $table->string('generoEmail__c')->after('Email')->nullable()->default(null)->comment = 'Salesforce generoEmail__c';
            }

            if (!Schema::hasColumn('cardboards', 'Tipo_identificaci_n__c')) {
                $table->string('Tipo_identificaci_n__c')->after('generoEmail__c')->nullable()->default(null)->comment = 'Salesforce Tipo_identificaci_n__c';
            }

            if (!Schema::hasColumn('cardboards', 'N_mero_de_Identificaci_n__c')) {
                $table->string('N_mero_de_Identificaci_n__c')->after('Tipo_identificaci_n__c')->nullable()->default(null)->comment = 'Salesforce N_mero_de_Identificaci_n__c';
            }

            if (!Schema::hasColumn('cardboards', 'Tel_fono_celular_1__c')) {
                $table->string('Tel_fono_celular_1__c')->after('N_mero_de_Identificaci_n__c')->nullable()->default(null)->comment = 'Salesforce Tel_fono_celular_1__c';
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
