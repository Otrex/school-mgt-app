<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = 'Anambra';

        $aguata = [
            'Aguata', 'Aguluezechukwu',
            'Achina', 'Akpo', 'Amesi', 'Ekwulobia',
            'Ezinifite', 'Igbo-ukwu', 'Isuofia',
            'Uga', 'Umuchu', 'Nkpologwu', 'Oraeri',
            'Isuanaoma', 'Umuona', 'Ikenga'
        ];

        $anambra_east = [
            'Otuocha', 'Umeri', 'Aguleri',
            'Enugwu-Aguleri', 'Eziagulu-Otu',
            'Enugwu-Otu', 'Anam', 'Igbariam',
            'Nando', 'Nsugbe'
        ];

        $anambra_west = [
            'Ezianam', 'Ifite-Anam',
            'Nzam', 'Olumbanasa',
            'Oroma-Etiti', 'Umueze-Anam',
            'Umuenwelum-Anam'
        ];

        $anaocha = [
            'Neni', 'Adazi-Enu',
            'Adazi-Nnukwu', 'Aguluzigbo',
            'Ichida', 'Obeledu', 'Nri'
        ];

        $awka_north = [
            'Achalla', 'Amansea', 'Amanuke',
            'Ebenebe', 'Isu-Aniocha', 'Mgbakwu',
            'Ugbene', 'Ugbu-enu', 'Ukum'
        ];

        $awka_south = [
            'Awka', 'Amawbia', 'Ifite-Awka',
            'Ezinato', 'Ishiagu', 'Mbaukwu',
            'Nibo', 'Nise', 'Okpuno', 'Umuawulu'
        ];

        $ayamelum = [
            'Anaku', 'Omor', 'Omasi',
            'Igbakwu', 'Umueje',
            'Umumbo', 'Ifite Ogwari',
            'Umuerum'
        ];

        $dunukofia = [
            'Ukpo', 'Nawgu', 'Ifite-Dunu', 'Ukwulu', 'Umudioka', 'Umunachi'
        ];

        $ekwusigo = [
            'Ozubulu', 'Oraifite', 'Ichi', 'Ihembosi'
        ];

        $idemili_north = [
            'Ogidi', 'Abacha', 'Abatete',
            'Eziowelle', 'ideani', 'Nkpor',
            'Obosi', 'Oraukwu', 'Uke', 'Umuoji'
        ];

        $idemili_south = [
            'Ojoto', 'Alor', 'Akwa-Ukwu',
            'Awka-Etiti', 'Nnobi',
            'Nnokwa', 'Umunachi', 'Oba'
        ];

        $ihiala = [
            'Azia', 'Okija', 'Mbosi',
            'Amorka', 'Isseke', 'Orsumoghu',
            'Ubuluisiuzor', 'Uli', 'Lilu'
        ];

        $njikoka = [
            'Abagana', 'Enugwu-Ukwu',
            'Nimo', 'Enugwu-Agidi',
            'Nawfia', 'Abba'
        ];

        $nnewi_north = [
            'Otolo', 'Uruagu', 'Umudim', 'Nnewi-Ichi'
        ];

        $nnewi_south = [
            'Ukpor', 'Ekwulumili', 'Amichi',
            'Azigbo', 'Unubi', 'Osumenyi',
            'Ogbodi', 'Ebenator', 'Utuh',
            'Akwaihedi'
        ];

        $ogbaru = [
            'Akili Ogidi', 'Atani', 'Akili Ozizor',
            'Amiyi', 'Mputu', 'Obeagwe', 'Ohita',
            'Odekpe', 'Ogbakugba', 'Ochuche Umuodu',
            'Ossomala', 'Ogwu-Aniocha', 'Umunankwo',
            'Umuzu', 'Okpoko', 'Ogwu Ikpere'
        ];

        $onisha_north = ['Onitsha'];

        $onisha_south = [
            'Iweka', 'Fegge', 'Odoakpu', 'Woliwo', 'Awada', 'Ochanja'
        ];

        $orumba_north = [
            'Akpu', 'Ajalli', 'Amaokpalla', 'Amaetiti', 'Ndiokpalaeke',
            'Awa', 'Nanka', 'Ndikelionwu', 'Ndiokolo', 'Oko',
            'Ndiowu', 'Ndiukwue', 'Okpoeze', 'Omogho', 'Ufuma'
        ];

        $orumba_south = [
            'Agbudu', 'Ezira', 'Eziagu',
            'Enugwu-Umuonyia Ihite', 'Isulo',
            'Ndiokpoleze', 'Nkerechi', 'Ogboji',
            'Ogbunka', 'Onneh', 'Owerre-Ezuakala',
            'Umunzem', 'Umuomoku'
        ];

        $oyi = [
            'Ogbunnike', 'Awkuzu',
            'Nkwelle-Ezuanaka', 'Nteje',
            'Umunebe', 'Umunya'
        ];

        // Aguata
        foreach ($aguata as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 1,
                'name' => $value
            ]);
        }

        // Anambra East
        foreach ($anambra_east as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 2,
                'name' => $value
            ]);
        }

        // Anambra West
        foreach ($anambra_west as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 3,
                'name' => $value
            ]);
        }

        // Anaocha
        foreach ($anaocha as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 4,
                'name' => $value
            ]);
        }

        // Awka North
        foreach ($awka_north as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 5,
                'name' => $value
            ]);
        }

        // Awka South
        foreach ($awka_south as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 6,
                'name' => $value
            ]);
        }

        // Ayamelum
        foreach ($ayamelum as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 7,
                'name' => $value
            ]);
        }

        // Dunukofia
        foreach ($dunukofia as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 8,
                'name' => $value
            ]);
        }

        // Ekwusigo
        foreach ($ekwusigo as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 9,
                'name' => $value
            ]);
        }

        // Idemili North
        foreach ($idemili_north as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 10,
                'name' => $value
            ]);
        }

        // Idemili South
        foreach ($idemili_south as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 11,
                'name' => $value
            ]);
        }

        // Ihiala
        foreach ($ihiala as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 12,
                'name' => $value
            ]);
        }

        // Njikoka
        foreach ($njikoka as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 13,
                'name' => $value
            ]);
        }

        // Nnewi North
        foreach ($nnewi_north as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 14,
                'name' => $value
            ]);
        }

        // Nnewi South
        foreach ($nnewi_south as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 15,
                'name' => $value
            ]);
        }

        // Ogbaru
        foreach ($ogbaru as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 16,
                'name' => $value
            ]);
        }

        // Onitsha North
        foreach ($onisha_north as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 17,
                'name' => $value
            ]);
        }

        // Onitsha South
        foreach ($onisha_south as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 18,
                'name' => $value
            ]);
        }

        // Orumba North
        foreach ($orumba_north as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 19,
                'name' => $value
            ]);
        }

        // Orumba South
        foreach ($orumba_south as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 20,
                'name' => $value
            ]);
        }

        // Oyi
        foreach ($oyi as $value) {
            Town::create([
                'state' => $state,
                'local_government_id' => 21,
                'name' => $value
            ]);
        }
    }
}
