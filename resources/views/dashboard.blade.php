{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- 1. İstatistik Kartları -->
        <div class="row gy-5 g-xl-8">
            <!-- Toplam Görev -->
            <div class="col-xxl-4 col-md-6">
                <div class="card card-flush h-md-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-4">
                            <span class="svg-icon svg-icon-primary svg-icon-3x me-3">
                                <!-- Buraya SVG ikon ekle -->
                            </span>
                            <div>
                                <div class="fs-2hx fw-bolder">120</div>
                                <div class="fw-semibold fs-5 text-gray-600">Toplam Görev</div>
                            </div>
                        </div>
                        <a href="#" class="mt-auto btn btn-sm btn-primary">Görev Listesine Git</a>
                    </div>
                </div>
            </div>

            <!-- Tamamlanan Görev -->
            <div class="col-xxl-4 col-md-6">
                <div class="card card-flush h-md-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-4">
                            <span class="svg-icon svg-icon-success svg-icon-3x me-3">
                                <!-- Buraya SVG ikon ekle -->
                            </span>
                            <div>
                                <div class="fs-2hx fw-bolder">75</div>
                                <div class="fw-semibold fs-5 text-gray-600">Tamamlanan Görev</div>
                            </div>
                        </div>
                        <a href="#" class="mt-auto btn btn-sm btn-success">Detaya Git</a>
                    </div>
                </div>
            </div>

            <!-- Bekleyen Görev -->
            <div class="col-xxl-4 col-md-6">
                <div class="card card-flush h-md-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-4">
                            <span class="svg-icon svg-icon-warning svg-icon-3x me-3">
                                <!-- Buraya SVG ikon ekle -->
                            </span>
                            <div>
                                <div class="fs-2hx fw-bolder">45</div>
                                <div class="fw-semibold fs-5 text-gray-600">Bekleyen Görev</div>
                            </div>
                        </div>
                        <a href="#" class="mt-auto btn btn-sm btn-warning">Detaya Git</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Proje Açıklaması Kartı -->
        <!-- 2. Proje Açıklaması Kartı -->
        <div class="card mt-8">
            <div class="card-header">
                <h3 class="card-title fw-bold">Proje ve Dashboard Açıklaması</h3>
            </div>
            <div class="card-body">
                <p class="mb-4">
                    Bu dashboard, Laravel 12.x ve Metronic 8 (Demo 14) kullanılarak geliştirilmiş modern bir yönetim
                    panelidir. Aşağıdaki içerik statik olarak tanımlanmıştır; değerlerin güncellenmesi için doğrudan bu
                    sayfa düzenlenebilir.
                </p>

                <p class="mb-4">
                    <strong>1. Proje Yapısı:</strong><br>
                    - Laravel 12.x tabanlıdır.<br>
                    - Repository ve Service pattern kullanılmıştır.<br>
                    - Kod organizasyonu: <code>app/Services</code>, <code>app/Repositories</code>,
                    <code>app/Http/Controllers</code>, <code>app/Models</code><br>
                    - Clean Code prensiplerine dikkat edilmiştir.
                </p>

                <p class="mb-4">
                    <strong>2. Todo Modülü (Örnek Modül):</strong><br>
                    - Listeleme: <code>index.blade.php</code> üzerinden çağrılır, <code>todoTableComponents.blade.php</code>
                    ile component olarak ayrılmıştır.<br>
                    - Ekleme: <code>modal/create.blade.php</code> üzerinden modal ile veya ayrı sayfa üzerinden
                    yapılabilir.<br>
                    - Güncelleme: Modal yerine ayrı sayfada gerçekleştirilir.<br>
                    - Silme: SweetAlert ile onay alındıktan sonra yapılır.<br>
                    - Backend: <code>TodoController</code>, <code>TodoService</code>, <code>TodoRepository</code> bağlı
                    çalışır.<br>
                    - Validasyon: FormRequest yapısı kullanılır.<br>
                    - JavaScript: Tüm işlemler <code>resources/js/todo.js</code> içinde, inline JS kullanılmaz.
                </p>

                <p class="mb-4">
                    <strong>3. View Katmanı & Metronic Entegrasyonu:</strong><br>
                    - Tema: Metronic 8 Demo 14 birebir uyarlanmıştır.<br>
                    - Yapı: <code>layouts.admin</code> ana şablon, <code>partials/sidebar</code> ve
                    <code>partials/navbar</code> ile parçalanmış yapı.<br>
                    - Sidebar ve Navbar: Görsel uyumlu, spacing/padding dengeli.<br>
                    - JS yönetimi: <code>@stack('scripts')</code> ile kontrollü.
                </p>

                <p class="mb-4">
                    <strong>4. Yayına Alma & AWS:</strong><br>
                    - Altyapı: Amazon EC2 + Ubuntu + Apache<br>
                    - Laravel kurulumu, PHP 8.3+, Composer ve modüller tamamlanmış.<br>
                    - Ortam: <code>.env.production</code> yapılandırıldı.<br>
                    - Veritabanı: RDS ya da EC2 içinde MySQL<br>
                    - SSL ve domain yönlendirme hazır (Route 53 veya alternatif).<br>
                    - Deploy: Şu an manuel, ileride GitHub Actions veya Envoyer entegrasyonu planlanıyor.<br>
                    - Log takibi: <code>sudo tail -n 30 /var/log/apache2/error.log</code>
                </p>

                <p class="mb-4">
                    <strong>5. Ek Özellikler & UX Detayları:</strong><br>
                    - Bootstrap 5 ile paginasyon entegre.<br>
                    - SweetAlert ile kullanıcı dostu geri bildirimler.<br>
                    - Boş veri kontrolü, animasyon ve görsel iyileştirmeler.<br>
                    - Hata yönetimi ve undefined değişken sorunları çözüldü.
                </p>

                <p>
                    <strong>Sıradaki Aşamalar:</strong><br>
                    ✅ Kullanıcı kimlik doğrulama sistemi (Auth)<br>
                    ✅ Rol ve yetki yönetimi (Spatie veya özel çözüm)<br>
                    ✅ Diğer modüllerin eklenmesi (Görev kategorileri, kullanıcı bazlı görevler)<br>
                    ✅ API desteği (Mobil uygulamalar için JSON endpoint'leri)<br>
                    ✅ Otomatik deploy sistemi (GitHub Actions, CI/CD)
                </p>
            </div>
        </div>

    </div>
@endsection
