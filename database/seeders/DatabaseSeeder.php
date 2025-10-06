<?php

namespace Database\Seeders;

use App\Models\SchoolProfile;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::firstOrCreate(
            ['username' => 'admin'], 
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Buat user biasa
        User::firstOrCreate(
            ['username' => 'user1'],
            [
                'name' => 'User Satu',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );

        // Buat akun operator default
        User::firstOrCreate(
            ['username' => 'operator'], 
            [
                'name' => 'Operator Sekolah',
                'password' => Hash::make('operator123'),
                'role' => 'operator',
            ]
        );


        SchoolProfile::create([
            'nama_sekolah'   => 'MTsN 10 Tasikmalaya',
            'kepala_sekolah' => 'Drs. H. Ahmad Fauzi, M.Pd',
            'foto'           => 'default-foto.jpg',   
            'logo'           => 'default-logo.png',   
            'npsn'           => '12345678',
            'alamat'         => 'Jl. Pendidikan No. 10, Tasikmalaya',
            'kontak'         => '081234567890',
            'visi_misi'      => 'Menjadi madrasah unggul dalam prestasi dan berakhlak mulia.',
            'tahun_berdiri'  => 1990,
            'deskripsi'      => 'MTsN 10 Tasikmalaya merupakan madrasah tsanawiyah negeri dengan komitmen mencetak generasi Islami berprestasi.',
        ]);

        // Tambah 30 siswa
        DB::table('students')->insert([
            [
                'nisn' => '1000000001',
                'nama_siswa' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000002',
                'nama_siswa' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000003',
                'nama_siswa' => 'Citra Dewi',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000004',
                'nama_siswa' => 'Dian Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000005',
                'nama_siswa' => 'Eko Prasetyo',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000006',
                'nama_siswa' => 'Fitri Handayani',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000007',
                'nama_siswa' => 'Gilang Saputra',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000008',
                'nama_siswa' => 'Hana Kartika',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000009',
                'nama_siswa' => 'Indra Lesmana',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000010',
                'nama_siswa' => 'Joko Susilo',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nisn' => '1000000011',
                'nama_siswa' => 'Kartini Ayu',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000012',
                'nama_siswa' => 'Lukman Hakim',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000013',
                'nama_siswa' => 'Maya Sari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000014',
                'nama_siswa' => 'Nanda Pratama',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000015',
                'nama_siswa' => 'Olivia Putri',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000016',
                'nama_siswa' => 'Putra Aditya',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000017',
                'nama_siswa' => 'Qori Azzahra',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000018',
                'nama_siswa' => 'Rizky Ramadhan',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000019',
                'nama_siswa' => 'Siti Aminah',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000020',
                'nama_siswa' => 'Taufik Hidayat',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nisn' => '1000000021',
                'nama_siswa' => 'Umar Zain',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000022',
                'nama_siswa' => 'Vina Marlina',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000023',
                'nama_siswa' => 'Wahyu Firmansyah',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000024',
                'nama_siswa' => 'Xaviera Putri',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000025',
                'nama_siswa' => 'Yoga Prabowo',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000026',
                'nama_siswa' => 'Zahra Anindya',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000027',
                'nama_siswa' => 'Andi Saputra',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000028',
                'nama_siswa' => 'Bella Safira',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2022',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000029',
                'nama_siswa' => 'Charlie Wijaya',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk' => '2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nisn' => '1000000030',
                'nama_siswa' => 'Dewi Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2021',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
