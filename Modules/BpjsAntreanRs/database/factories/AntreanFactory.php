<?php

namespace Modules\BpjsAntreanRs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsAntreanRs\Models\Antrean;

class AntreanFactory extends Factory
{
    protected $model = Antrean::class;

    public function definition(): array
    {
        return [
            'kodebooking' => strtoupper(fake()->bothify('##########A###')),
            'visit_id' => null,
            'jenispasien' => 'JKN',
            'nomorkartu' => fake()->numerify('000###########'),
            'nik' => fake()->numerify('################'),
            'nohp' => fake()->numerify('08##########'),
            'kodepoli' => 'ANA',
            'namapoli' => 'Anak',
            'pasienbaru' => false,
            'norm' => fake()->numerify('######'),
            'tanggalperiksa' => now()->toDateString(),
            'kodedokter' => fake()->numberBetween(1, 99999),
            'namadokter' => 'Dr. Hendra',
            'jampraktek' => '08:00-16:00',
            'jeniskunjungan' => 1,
            'nomorreferensi' => fake()->numerify('0001R00401#######'),
            'nomorantrean' => 'A-'.fake()->numberBetween(1, 99),
            'angkaantrean' => fake()->numberBetween(1, 99),
            'estimasidilayani' => now()->addHour(),
            'sisakuotajkn' => 5,
            'kuotajkn' => 30,
            'sisakuotanonjkn' => 5,
            'kuotanonjkn' => 30,
            'keterangan' => 'Peserta harap 30 menit lebih awal guna pencatatan administrasi.',
            'status' => 'draft',
            'request_payload' => null,
            'bpjs_sync_status' => 'pending',
            'bpjs_error' => null,
            'created_by' => null,
        ];
    }
}
