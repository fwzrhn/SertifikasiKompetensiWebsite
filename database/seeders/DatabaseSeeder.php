<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\SchoolProfile;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===============================
        // USERS
        // ===============================
        User::insert([
            [
                'name'       => 'Administrator',
                'username'   => 'admin',
                'password'   => Hash::make('password123'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Operator Sekolah',
                'username'   => 'operator',
                'password'   => Hash::make('operator123'),
                'role'       => 'operator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'User Satu',
                'username'   => 'user1',
                'password'   => Hash::make('user123'),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ===============================
        // SCHOOL PROFILE
        // ===============================
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

        // ===============================
        // STUDENTS
        // ===============================
        DB::table('students')->insert([
            [
                'nisn'          => '1000000001',
                'nama_siswa'    => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => '2021',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000002',
                'nama_siswa'    => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => '2020',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000003',
                'nama_siswa'    => 'Citra Dewi',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2022',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000004',
                'nama_siswa'    => 'Dian Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2023',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000005',
                'nama_siswa'    => 'Eko Prasetyo',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => '2021',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000006',
                'nama_siswa'    => 'Fitri Handayani',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2020',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000007',
                'nama_siswa'    => 'Gilang Saputra',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => '2022',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000008',
                'nama_siswa'    => 'Hana Kartika',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => '2021',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000009',
                'nama_siswa'    => 'Indra Lesmana',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => '2023',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nisn'          => '1000000010',
                'nama_siswa'    => 'Joko Susilo',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => '2020',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);

        // ===============================
        // TEACHERS
        // ===============================
        DB::table('teachers')->insert([
            [
                'nama_guru' => 'Guru 1',
                'nip'       => '1980010101',
                'mapel'     => 'Matematika',
                'foto'      => 'guru1.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'nama_guru' => 'Guru 2',
                'nip'       => '1980010102',
                'mapel'     => 'IPA',
                'foto'      => 'guru2.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'nama_guru' => 'Guru 3',
                'nip'       => '1980010103',
                'mapel'     => 'IPS',
                'foto'      => 'guru3.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'nama_guru' => 'Guru 4',
                'nip'       => '1980010104',
                'mapel'     => 'Bahasa Indonesia',
                'foto'      => 'guru4.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'nama_guru' => 'Guru 5',
                'nip'       => '1980010105',
                'mapel'     => 'Bahasa Inggris',
                'foto'      => 'guru5.jpg',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);

        // ===============================
        // EXTRACURRICULARS
        // ===============================
        DB::table('extracurriculars')->insert([
            [
                'nama_ekskul'     => 'Pramuka',
                'pembina'         => 'Pak Dedi',
                'jadwal_latihan'  => 'Setiap Jumat, 14.00 - 16.00',
                'deskripsi'       => 'Kegiatan pramuka untuk membentuk karakter disiplin dan tanggung jawab.',
                'gambar'          => 'pramuka.jpg',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'nama_ekskul'     => 'Paskibra',
                'pembina'         => 'Bu Ratna',
                'jadwal_latihan'  => 'Setiap Sabtu, 08.00 - 10.00',
                'deskripsi'       => 'Kegiatan baris-berbaris dan upacara bendera.',
                'gambar'          => 'paskibra.jpg',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'nama_ekskul'     => 'Futsal',
                'pembina'         => 'Pak Rudi',
                'jadwal_latihan'  => 'Setiap Rabu, 15.00 - 17.00',
                'deskripsi'       => 'Ekstrakurikuler olahraga futsal untuk menyalurkan bakat siswa.',
                'gambar'          => 'futsal.jpg',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);

        // ===============================
        // GALLERIES
        // ===============================
        DB::table('galleries')->insert([
            [
                'judul'      => 'Kegiatan Pramuka',
                'keterangan' => 'Dokumentasi kegiatan pramuka di lapangan.',
                'file'       => 'galeri1.jpg',
                'kategori'   => 'Foto',
                'tanggal'    => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Lomba Futsal',
                'keterangan' => 'Tim futsal MTsN 10 mengikuti lomba antar sekolah.',
                'file'       => 'galeri2.jpg',
                'kategori'   => 'Foto',
                'tanggal'    => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Upacara Bendera',
                'keterangan' => 'Suasana upacara setiap hari Senin.',
                'file'       => 'galeri3.jpg',
                'kategori'   => 'Foto',
                'tanggal'    => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ===============================
        // NEWS
        // ===============================
        DB::table('news')->insert([
            [
                'judul'      => 'Siswa MTsN 10 Raih Juara 1 Lomba Sains',
                'isi'        => 'Salah satu siswa MTsN 10 Tasikmalaya berhasil meraih juara pertama dalam lomba sains tingkat kabupaten.',
                'tanggal'    => now(),
                'gambar'     => 'berita1.jpg',
                'id_user'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Kegiatan Donor Darah di Sekolah',
                'isi'        => 'MTsN 10 Tasikmalaya bekerja sama dengan PMI mengadakan kegiatan donor darah.',
                'tanggal'    => now(),
                'gambar'     => 'berita2.jpg',
                'id_user'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
