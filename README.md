
# Todo Uygulaması

![Todo Uygulaması Ekran Görüntüsü](https://github.com/user-attachments/assets/5d744cab-99ff-4a2a-a22b-24f6582aecaa)

## Özellikler

- **Kullanıcı Yönetimi**: 
  - Kullanıcı kaydı ve oturum açma.
  - Kullanıcı profil yönetimi.
- **Todo Yönetimi**: 
  - Dinamik olarak todo listeleri oluşturma, güncelleme ve silme.
- **Vue.js ile Dinamik Arayüz**: 
  - Anlık güncellenen ve kullanıcı dostu bir arayüz.
- **TailwindCSS ile Modern Tasarım**: 
  - Duyarlı, şık ve kullanıcı odaklı arayüz.
  
![Todo Uygulaması Ekran Görüntüsü](https://github.com/user-attachments/assets/f61065e7-15c5-400d-b67f-ff7c92adb192)

## Gereksinimler

Bu projeyi çalıştırmak için aşağıdaki yazılımların sisteminizde yüklü olması gerekmektedir:

- **Docker**: Uygulamanın container'larda çalıştırılması için.
- **Node.js**: Frontend derleme işlemleri için.

## Proje Mimarisi

Uygulama, modern web uygulamaları geliştirme prensiplerine dayanarak iki ana bileşen olarak tasarlanmıştır:

- **Backend** (`todo-api`): Laravel kullanılarak geliştirilmiş RESTful API.
- **Frontend** (`todo-ui`): Vue.js ve TailwindCSS kullanılarak geliştirilmiş dinamik kullanıcı arayüzü.

## Kurulum

### 1. Repository'yi Klonlayın

Proje dosyalarını bilgisayarınıza indirin ve dizine geçin:

```bash
git clone https://github.com/GamzeBerberogl/todo-app
cd todo-app
```

### 2. API Kurulumu (`todo-api`)

Docker'ı kullanarak backend uygulamasını çalıştırın:

```bash
cd todo-api
docker compose up -d
```

### 3. Veritabanı Migrasyonlarını ve Seed İşlemlerini Çalıştırın

Laravel uygulamanızın veritabanını hazırlamak için:

```bash
docker compose exec laravel-app php artisan migrate --seed
```

Bu komut, veritabanı tablolarını oluşturur ve örnek test verilerini ekler. Test kullanıcısı için bilgiler: 
- **E-posta**: `atlas@example.com`
- **Şifre**: `password123`

### 4. UI Kurulumu ve Yerel Sunucuda Çalıştırma (`todo-ui`)

Vue.js ile oluşturulmuş frontend'i kurup çalıştırın:

```bash
cd ../todo-ui
npm install && npm run dev
```

Bu adım, TailwindCSS ile stillendirilmiş, modern ve duyarlı kullanıcı arayüzünü yerel sunucuda çalıştıracaktır.

## Kullanım

- **Kullanıcı Kaydı ve Giriş**: Yeni kullanıcılar kaydolabilir veya mevcut kullanıcılar giriş yapabilir.
- **Todo Listesi Yönetimi**: Giriş yaptıktan sonra, kullanıcılar todo listeleri oluşturabilir, mevcut görevleri düzenleyebilir veya silebilir.
- **Responsive Tasarım**: Uygulama, mobil, tablet ve masaüstü cihazlarda sorunsuz çalışacak şekilde tasarlanmıştır.

## Proje Durumu ve Geliştirme Süreci

- **Proje Durumu**: Tamamlanmış ve test edilmiştir.
- **Geliştirme Süreci**: SOLID prensipleri, PSR-2 standartları ve AirBnb JavaScript Stil Rehberi göz önünde bulundurularak geliştirilmiştir.
- **Git Commit Mesajları**: Anlamlı ve projenin gelişimini izlemeyi kolaylaştıran commit mesajları kullanılmıştır.

## Ek Özellikler

- **Docker Entegrasyonu**: Proje Docker ile containerize edilmiştir, bu sayede kurulum ve çalıştırma işlemleri oldukça basittir.
- **PSR-2 ve AirBnb Kod Standartları**: Kod kalitesi için standartlara uyulmuştur.

## Lisans

Bu proje [MIT Lisansı](LICENSE) altında lisanslanmıştır.

