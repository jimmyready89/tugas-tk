<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsData = [
            [
                'title' => 'Inovasi AI di Tahun 2025 Dari Chatbot hingga Asisten Medis Digital',
                'body' => "Tahun 2025 jadi era emas bagi kecerdasan buatan. Chatbot bukan lagi sekadar menjawab pertanyaan sederhana, tapi sudah mampu memberikan solusi medis hingga membantu diagnosa pasien. Teknologi ini membuka peluang besar bagi efisiensi pelayanan kesehatan dan otomatisasi bisnis di berbagai sektor.",
            ],
            [
                'title' => 'Langkah Mudah Membangun Website Portofolio dengan Laravel 11',
                'body' => "Laravel 11 hadir dengan fitur yang makin memudahkan developer, terutama bagi kamu yang ingin membuat website portofolio profesional. Cukup dengan beberapa command artisan, kamu sudah bisa punya struktur project yang rapi dan siap dipublikasikan di hosting mana pun.",
            ],
            [
                'title' => 'Cloud Computing Solusi Efisien untuk Startup Modern',
                'body' => "Banyak startup kini beralih ke cloud karena lebih fleksibel dan hemat biaya. Tanpa perlu beli server mahal, tim bisa fokus pada pengembangan produk. Cloud juga bikin kolaborasi antar anggota tim jadi jauh lebih mudah.",
            ],
            [
                'title' => 'Lima Tren Teknologi yang Akan Mengubah Dunia Pendidikan',
                'body' => "Mulai dari AI tutor, kelas virtual, hingga gamifikasi, teknologi benar-benar mengubah cara belajar siswa. Sekolah dan kampus sekarang berlomba mengadopsi platform digital agar pembelajaran lebih interaktif dan menarik.",
            ],
            [
                'title' => 'Peran Data Analyst dalam Pengambilan Keputusan Bisnis',
                'body' => "Data analyst kini jadi ujung tombak dalam menentukan strategi bisnis. Dengan data yang akurat, perusahaan bisa memahami perilaku pelanggan dan mengambil keputusan yang lebih tepat serta efisien.",
            ],
            [
                'title' => 'Strategi UMKM Bertahan di Era Digitalisasi',
                'body' => "UMKM tak lagi bisa mengandalkan cara konvensional. Dengan digitalisasi, pelaku usaha kini bisa menjangkau pelanggan lewat media sosial dan marketplace. Adaptasi jadi kunci agar bisa terus bersaing.",
            ],
            [
                'title' => 'Investasi Kripto Kian Populer Tapi Apa Risikonya',
                'body' => "Investasi kripto makin digemari generasi muda karena potensi keuntungannya tinggi. Tapi jangan lupa, volatilitas pasar juga tinggi. Pahami dulu risikonya sebelum terjun biar nggak menyesal di kemudian hari.",
            ],
            [
                'title' => 'Bagaimana E Commerce Meningkatkan Peluang Wirausaha Lokal',
                'body' => "Platform e-commerce membuka pintu besar bagi pelaku usaha kecil di daerah. Kini produk lokal bisa dijual ke seluruh Indonesia, bahkan ke luar negeri. Kuncinya adalah strategi pemasaran dan layanan pelanggan yang baik.",
            ],
            [
                'title' => 'Manajemen Keuangan Pribadi untuk Generasi Z',
                'body' => "Anak muda zaman sekarang perlu melek finansial sejak dini. Dengan manajemen keuangan yang baik, gaji bulanan bisa digunakan secara efektif tanpa harus hidup pas-pasan di akhir bulan.",
            ],
            [
                'title' => 'Startup Indonesia yang Sukses Menarik Investor Asing',
                'body' => "Beberapa startup Indonesia berhasil mencuri perhatian investor luar negeri berkat inovasi dan potensi pasar yang besar. Hal ini menunjukkan bahwa ekosistem digital di Indonesia makin matang dan menarik untuk dikembangkan.",
            ],
            [
                'title' => 'Gaya Hidup Minimalis Tren Baru Generasi Milenial',
                'body' => "Gaya hidup minimalis bukan berarti pelit, tapi lebih ke fokus pada hal yang benar-benar penting. Banyak milenial mulai meninggalkan kebiasaan konsumtif dan beralih ke hidup yang lebih sederhana dan bermakna.",
            ],
            [
                'title' => 'Menjaga Lingkungan dengan Gerakan Tanpa Plastik',
                'body' => "Gerakan tanpa plastik makin banyak diikuti masyarakat. Mulai dari membawa tumbler sendiri sampai menggunakan kantong kain, langkah kecil ini bisa berdampak besar bagi kelestarian lingkungan.",
            ],
            [
                'title' => 'Tips Produktif di Rumah Tanpa Burnout',
                'body' => "Kerja dari rumah memang nyaman, tapi kalau nggak diatur bisa bikin burnout. Coba buat jadwal tetap, istirahat cukup, dan pastikan kamu punya waktu untuk diri sendiri setiap harinya.",
            ],
            [
                'title' => 'Tren Fashion Ramah Lingkungan Tahun Ini',
                'body' => "Brand-brand fashion mulai beralih ke bahan daur ulang dan proses produksi berkelanjutan. Konsumen pun semakin sadar pentingnya memilih pakaian yang tidak merusak lingkungan.",
            ],
            [
                'title' => 'Mengenal Konsep Slow Living di Tengah Dunia Serba Cepat',
                'body' => "Slow living mengajak kita untuk menikmati hidup lebih pelan dan sadar. Di tengah dunia yang serba instan, konsep ini jadi pengingat agar kita tidak terus terburu-buru dan kehilangan makna.",
            ],
            [
                'title' => 'Film Indonesia yang Sukses di Festival Internasional',
                'body' => "Film lokal kini tak kalah kualitasnya dengan film luar negeri. Beberapa di antaranya bahkan berhasil menembus festival bergengsi dunia, membuktikan potensi besar industri kreatif tanah air.",
            ],
            [
                'title' => 'Musik Indie Lokal yang Sedang Naik Daun',
                'body' => "Band dan musisi indie Indonesia makin banyak dikenal karena kreativitas dan orisinalitasnya. Tanpa label besar, mereka membangun komunitas kuat lewat media sosial dan platform streaming.",
            ],
            [
                'title' => 'Rahasia di Balik Kesuksesan Content Creator',
                'body' => "Menjadi content creator sukses bukan cuma soal viral. Konsistensi, ide kreatif, dan interaksi dengan audiens adalah kunci utama untuk membangun komunitas yang loyal.",
            ],
            [
                'title' => 'Game Online Terpopuler di Tahun 2025',
                'body' => "Industri game terus berkembang pesat. Tahun 2025, banyak game online baru yang menawarkan pengalaman bermain lebih imersif dengan dukungan teknologi VR dan AI.",
            ],
            [
                'title' => 'Seni Digital Peluang Baru Bagi Generasi Kreatif',
                'body' => "NFT dan seni digital membuka jalan baru bagi seniman muda untuk berkarya dan mendapatkan penghasilan. Dunia seni kini tak lagi terbatas pada kanvas fisik, tapi juga dunia maya.",
            ],
            [
                'title' => 'Belajar Efektif dengan Metode Pomodoro',
                'body' => "Teknik Pomodoro membantu kamu fokus dengan membagi waktu belajar jadi sesi 25 menit. Setelah itu istirahat sebentar sebelum lanjut lagi, biar otak nggak cepat capek.",
            ],
            [
                'title' => 'Pentingnya Skill Komunikasi di Dunia Kerja Modern',
                'body' => "Komunikasi yang baik bisa membuat kerja tim lebih efisien dan menghindari miskomunikasi. Di era digital, kemampuan menyampaikan ide dengan jelas jadi nilai tambah besar.",
            ],
            [
                'title' => 'Manfaat Kursus Online untuk Pengembangan Karier',
                'body' => "Belajar nggak harus di kampus. Dengan kursus online, kamu bisa menambah skill baru kapan pun dan di mana pun. Banyak platform kini menyediakan sertifikat yang diakui perusahaan.",
            ],
            [
                'title' => 'Teknik Menulis Artikel yang Menarik di Era Digital',
                'body' => "Menulis di internet butuh gaya yang ringan dan informatif. Gunakan judul yang menarik dan isi yang padat, agar pembaca betah dan mau berbagi tulisanmu ke orang lain.",
            ],
            [
                'title' => 'Membangun Mindset Positif untuk Meraih Kesuksesan',
                'body' => "Segala sesuatu dimulai dari pikiran. Dengan mindset positif, kita lebih mudah menghadapi tantangan dan tetap semangat mencapai tujuan, sekecil apa pun langkahnya.",
            ],
        ];

        foreach ($newsData as $news) {
            News::create([
                'news_tag' => Str::slug($news['title']),
                'title' => $news['title'],
                'body' => $news['body'],
                'author_nip' => 'NIP' . rand(1000, 9999),
            ]);
        }
    }
}
