<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = 'Anambra';

        $lga = 'Aguata';

        $ekwulobia = [
            "Maduka Memoral Secondary School, Ekwulobia",
            "First Hill Secondary School, Ekwulobia",
            "Goodness Secondary School, Ekwulobia",
            "Living Stone Secondary School, Ekwulobia",
            "Greenfield Secondary School, Ekwulobia",
            "New Generation Secondary School, Ekwulobia",
            "All Saint Seminary Secondary School, Ekwulobia",
        ];

        $isuofia = [
            "Community  Secondary School, Isuofia",
            "Holy Child, Isuofia",
            "Unity Comprehensive School, Isuofia",
            "Unique Secondary School, Isuofia",
            "Model Comprehensive School, Isuofia",
        ];

        $igboukwu = [
            "Girls Secondary School, Igboukwu",
            "Community Secondary School",
            "Holy Family Secondary School",
            "Christ The King Secondary School",
        ];

        $ezinifite = [
            "Community Secondary School, Ezinifite",
            "Amazing Grace Comprehensive College, Ezinifite",
            "Ezinifite High School",
            "Mother Of Christ Secondary School, Ezinifite",
        ];

        $ora_eri = [
            "Community Secondary School, Ora-Eri",
            "St. Joseph Secondary School",
        ];

        $aguluezechukwu = [
            "Community Secondary School, Aguluezechukwu"
        ];

        $ikenga = ['St. Anthony Secondary School, Ikenga'];

        $umuchu = [
            "Holy Name Secondary School Umuchu",
            "Pioneer Secondary Umuchu",
            "Umuchu High School",
            "God's Own   Secondary School Umuchu",
            "G. T. C.  Umuchu",
            "Community Secondary School Umuchu",
            "Convenant  Children Of God Secondary School Umuchu",
            "Assured Secondary School Umuchu",
        ];

        $amesi = ['C. R. C.  AMESI'];

        $akpo = [
            "Academy Secondary School, Akpo",
            "St Francis Secondary School, Akpo",
            "Pullers Technical Secondary School",
            "Our Lady's Comprehensive College, Akpọ",
            "Community Secondary School, Akpo",
        ];

        $achina = [
            "Community Secondary School Achina",
            "St Peter's Secondary School Achina",
        ];

        $uga = [
            "Girls High School, Uga",
            "K. F. C. Uga",
            "Excellent Bridge Academy, Uga",
            "Immaculate Heart Secondary School, Uga",
            "Uga Boys Secondary School",
            "St Augustine Secondary School, Uga",
            "Madona Secondary School, Uga",
            "Community Secondary School, Uga",
        ];

        $nkpologwu = [
            "Community Secondary School, Nkpologwu",
            "Great Genius  Discovery Secondary, Nkpologwu",
            "Premier Comprehensive Secondary School, Nkpologwu",
        ];

        // ekwulobia
        foreach ($ekwulobia as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Ekwulobia'
            ]);
        }

        // Isuofia
        foreach ($isuofia as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Isuofia'
            ]);
        }

        // Igboukwu
        foreach ($igboukwu as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Igbo-ukwu'
            ]);
        }

        // Ezinifite
        foreach ($ezinifite as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Ezinifite'
            ]);
        }

        // Ora Eri
        foreach ($ora_eri as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Oraeri'
            ]);
        }

        // Aguluezechukwu
        foreach ($aguluezechukwu as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Aguluezechukwu'
            ]);
        }

        // Ikenga
        foreach ($ikenga as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Ikenga'
            ]);
        }

        // Umuchu
        foreach ($umuchu as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Umuchu'
            ]);
        }

        // Amesi
        foreach ($amesi as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Amesi'
            ]);
        }

        // Akpo
        foreach ($akpo as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Akpo'
            ]);
        }

        // Achina
        foreach ($achina as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Achina'
            ]);
        }

        // Uga
        foreach ($uga as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Uga'
            ]);
        }

        // Nkpologwu
        foreach ($nkpologwu as $name) {
            School::create([
                'name' => $name,
                'state' => $state,
                'local_government' => $lga,
                'town' => 'Nkpologwu'
            ]);
        }
    }
}
