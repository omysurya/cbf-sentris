**Pemasangan**
```bash
$ git clone git@github.com:omysurya/cbf-sentris.git
$ cd cbf-sentris
$ composer update
$ composer dump-autoload
```
**Test framework default**
1. Setting koneksi database di file .env
2. Import database cbf-sentris.sql
3. Jalankan php artisan config:cache
4. Buka halaman http://localhost/cbf-sentris/public
5. Silahkan login menggunakan username dan password admin

**Pengembangan -> Backend -> public/admin/nama_controller/method**
1. Buat controller
   ```bash
   $ php artisan make:controller AdminNamaController
   ```
2. Daftarkan controller ke Route folder routes/web.php mulai baris ke 65
   ```bash
   routeController('berita','AdminBeritaController');
   ```
3. Buat method dengan prefix method get/post
   ```php
   namespace App\Http\Controllers;
   use Illuminate\Http\Request;
   use DB;
   class AdminBeritaController extends Controller
   {
      //url: public/admin/berita
      public function getIndex() {
         //kode index disini
      }

      //url: public/admin/berita/add
      public function getAdd() {
            //kode untuk menampilkan form add berita
      }
      public function postAdd() {
            //kode untuk handle dari form add berita
      }
   }
   ```
4. Untuk devel lebih lanjut silahkan lihat di contoh code yg sudah berjalan
5. Bersihkan cache
   ```bash
   $ php artisan route:cache
   ```
6. Happy coding, semoga bermanfaat dan mudah-mudahan bisa kita kembangkan sesuai update-an Laravel

**Pengembangan -> API -> public/api/nama_controller/method**
1. Buat controller
   ```bash
   $ php artisan make:controller ApiNamaController
   ```
2. Daftarkan controller ke Route folder routes/web.php mulai baris ke 42
   ```php
   routeController('berita','ApiBeritaController');
   ```
   ini akan menjadi url -> public/api/berita
   
3. Pelajari penggunaan get/post/put/update/delete karena cara kerja nya sama dengan pembuatan controller laravel

## Special Thanks to :+1:
@laravel
@crocodic-studio
@fherryfherry
@studionet
@pharmasolindo
@sentris
@omysurya