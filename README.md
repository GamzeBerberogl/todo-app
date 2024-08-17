
# Todo Uygulaması
<img width="1591" alt="Screenshot 2024-08-17 at 07 15 43" src="https://github.com/user-attachments/assets/5d744cab-99ff-4a2a-a22b-24f6582aecaa">

<img width="1591" alt="Screenshot 2024-08-17 at 07 09 12" src="https://github.com/user-attachments/assets/f61065e7-15c5-400d-b67f-ff7c92adb192">



- **todo-api**: Uygulamanın backend kısmını, yani RESTful API'yi sağlamak için Laravel kullanılarak geliştirilmiştir.
- **todo-ui**: Uygulamanın frontend kısmını oluşturmak için Vue.js ve TailwindCSS kullanılarak oluşturulmuş modern bir arayüz sağlar.

## Özellikler

- **Kullanıcı Yönetimi**: Kullanıcı kaydı, giriş yapma ve profil yönetimi.
- **Todo Yönetimi**: Kullanıcılar todo listeleri oluşturabilir, güncelleyebilir ve silebilir.
- **Vue.js ile Dinamik Arayüz**: Anlık olarak yapılacaklar listesini yönetme.
- **TailwindCSS ile Modern Tasarım**: Duyarlı ve kullanıcı dostu arayüz tasarımı.


## Gereksinimler

Projenin çalışabilmesi için aşağıdaki yazılımların sisteminizde yüklü olması gerekmektedir:

- PHP >= 8.2
- Composer
- Node.js & npm/yarn
- MySQL veritabanı 

## Kurulum

### Genel Kurulum

1. **Repository'yi klonlayın:**

    ```bash
    git clone [https://github.com/kullanıcı_adı/todo-app.git](https://github.com/GamzeBerberogl/todo-app)
    cd todo-app
    ```

2. **.env dosyasını yapılandırın:**

    - `todo-api` klasöründeki `.env.example` dosyasını kopyalayarak `.env` dosyasını oluşturun ve veritabanı bilgilerini girin.
    
    ```bash
    cp todo-api/.env.example todo-api/.env
    ```

3. **API Kurulumu (`todo-api`):**

    ```bash
    cd todo-api
    composer install
    php artisan key:generate
    ```

4. **Veritabanı migrasyonlarını ve seed işlemini çalıştırın:**

    ```bash
    php artisan migrate --seed
    ```

    Bu adım, veritabanı tablolarını oluşturur ve test verilerini ekler.
    Kullanıcı girişi için test veriler:
     'email' => 'atlas@example.com',
     'password' => 'password123'



6. **UI Kurulumu (`todo-ui`):**

    ```bash
    cd ../todo-ui
    npm install
    npm run build
    ```

    Bu adım, Vue.js ile oluşturulan frontend'i derleyecektir.

### Geliştirme Sunucusunu Başlatma

1. **API Sunucusunu Başlatın:**

    ```bash
    cd ../todo-api
    php artisan serve
    ```

    API artık `http://localhost:8000` adresinden erişilebilir durumda.

2. **Frontend'i Yerel Sunucuda Çalıştırın:**

    İsterseniz frontend'i de bir geliştirme sunucusunda çalıştırabilirsiniz:

    ```bash
    cd ../todo-ui
    npm run dev
    ```

## Kullanım

- **Kullanıcı Kaydı ve Giriş**: Uygulamaya yeni kullanıcılar kaydolabilir veya mevcut kullanıcılar giriş yapabilir.
- **Todo Listesi Yönetimi**: Giriş yaptıktan sonra, kullanıcılar todo listesi oluşturabilir, mevcut görevleri düzenleyebilir veya silebilir.
- **Responsive Tasarım**: Uygulama, farklı cihaz boyutlarında rahatlıkla kullanılabilir.


## Lisans

MIT lisansı altında lisanslanmıştır.

---

Bu yapılandırma, projenizin hem API hem de UI kısımlarını kapsayan detaylı bir kurulum ve kullanım kılavuzu sunmaktadır.
