
# Todo Uygulaması
<img width="1591" alt="Screenshot 2024-08-17 at 07 15 43" src="https://github.com/user-attachments/assets/5d744cab-99ff-4a2a-a22b-24f6582aecaa">

## Özellikler

- **Kullanıcı Yönetimi**: Kullanıcı kaydı, giriş yapma ve profil yönetimi.
- **Todo Yönetimi**: Kullanıcılar todo listeleri oluşturabilir, güncelleyebilir ve silebilir.
- **Vue.js ile Dinamik Arayüz**: Anlık olarak yapılacaklar listesini yönetme.
- **TailwindCSS ile Modern Tasarım**: Duyarlı ve kullanıcı dostu arayüz tasarımı.

<img width="1591" alt="Screenshot 2024-08-17 at 07 09 12" src="https://github.com/user-attachments/assets/f61065e7-15c5-400d-b67f-ff7c92adb192">

## Gereksinimler

Projenin çalışabilmesi için aşağıdaki yazılımların sisteminizde yüklü olması gerekmektedir:

- Docker 
- Node.js

## Kurulum

- **todo-api**: Uygulamanın backend kısmını, yani RESTful API'yi sağlamak için Laravel kullanılarak geliştirilmiştir.
- **todo-ui**: Uygulamanın frontend kısmını oluşturmak için Vue.js ve TailwindCSS kullanılarak oluşturulmuş modern bir arayüz sağlar.

### Genel Kurulum

1. **Repository'yi klonlayın:**

    ```bash
    git clone https://github.com/GamzeBerberogl/todo-app
    cd todo-app
    ```


2. **API Kurulumu (`todo-api`):**

    ```bash
    cd todo-api
    docker compose up -d
    ```

3. **Veritabanı migrasyonlarını ve seed işlemini çalıştırın:**

    ```bash
    docker compose exec laravel-app php artisan migrate --seed
    ```

    Bu adım, veritabanı tablolarını oluşturur ve test verilerini ekler.
    Kullanıcı girişi için test veriler: atlas@example.com - password123


4. **UI Kurulumu ve Yerel Sunucuda Çalıştırma(`todo-ui`):**

    ```bash
    cd ../todo-ui
    npm install && npm run dev
    ```

    Bu adım, Vue.js ile oluşturulan frontend'i derleyecektir.


## Kullanım

- **Kullanıcı Kaydı ve Giriş**: Uygulamaya yeni kullanıcılar kaydolabilir veya mevcut kullanıcılar giriş yapabilir.
- **Todo Listesi Yönetimi**: Giriş yaptıktan sonra, kullanıcılar todo listesi oluşturabilir, mevcut görevleri düzenleyebilir veya silebilir.
- **Responsive Tasarım**: Uygulama, farklı cihaz boyutlarında rahatlıkla kullanılabilir.


## Lisans

MIT lisansı altında lisanslanmıştır.

