# 🎓 Mini Udemy (Laravel 11)

Mini-Udemy – bu Laravel + MySQL + TailwindCSS asosida yaratilgan o‘quv platformasi. Loyihada student, teacher va admin rollari mavjud bo‘lib, kurslar, darslar va enrollmentlar boshqariladi.

## 🚀 Texnologiyalar
- [Laravel 11](https://laravel.com/)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/) (rol va huquqlar)
- Blade templating
- Bootstrap 5
- MySQL

## 🔑 Hozirgacha tayyor bo‘lgan funksiyalar

### 1-bosqich: Auth + Role System
- Login / Register
- Rollar: **Admin**, **Teacher**, **Student**
- Default ro‘l assign qilish (masalan, yangi user → student)
- Role-based redirect (login bo‘lganda har kim o‘z dashboardiga yo‘naltiriladi)

### 2-bosqich: Category Management (Admin)
- Admin kategoriyalarni yaratishi, tahrirlashi va o‘chirishi mumkin.

### 3.1-bosqich: Course & Lesson (Teacher)
- Teacher yangi kurs yaratadi (title, description, price, image).
- Kurs ichida darslar qo‘shadi (matn + video).
- Teacher dashboardda o‘z kurslarini ko‘radi.
- Lesson CRUD (create, edit, delete) ishlaydi.
- Video upload va brauzerda ko‘rsatish qo‘shilgan.

### 3.2-bosqich (boshlanishi): Admin approve
- Kurslar default `pending` statusda yaratiladi.
- Admin dashboardda kurslarni ko‘radi va **approve / reject** qila oladi.

## Qilgan o‘zgarishlar (oxirgi commit)

- Student dashboard optimallashtirildi: enroll bo‘lgan kurslar alohida ko‘rinadi  
- Teacher dashboard optimallashtirildi: kurslar, status, lessons va enrollments kartalarda ko‘rinadi  
- Admin dashboard yangilandi: teacher requestlar, kurslar va enrollments statistikasi ko‘rinadi  
- Blade fayllar va routelar optimallashtirildi  
- Role-based dashboard yo‘naltirish qo‘shildi (student → teacher request → teacher)  
- TailwindCSS bilan UI yanada zamonaviylashtirildi 

## 📂 Loyihani ishga tushirish

1. Repository’ni clone qiling:
   ```bash
   git clone [https://github.com/](https://github.com/Shoh-27/mini-udemy.git)
   cd mini-udemy

## Composer install:
- composer install


## .env faylini sozlang va keyin:
- php artisan key:generate
- php artisan migrate --seed
- php artisan storage:link


## Serverni ishga tushiring:
- php artisan serve

🔮 Keyingi bosqichlar (reja)

Sotib olish (dummy payment → Stripe/Payme integratsiya).

Progress tracking, review va chat funksiyalari. 

<img width="1898" height="935" alt="image" src="https://github.com/user-attachments/assets/c08a6426-32af-41cc-a87f-dc8cf68c18c3" />

<img width="1881" height="884" alt="image" src="https://github.com/user-attachments/assets/f6bcaa26-1beb-4dd4-9a49-ef6ba8d5cb4d" />

<img width="1916" height="861" alt="image" src="https://github.com/user-attachments/assets/75bab29d-f78d-4632-a8d1-fd7bb6f5a61a" />

👨‍💻 Author: [Nizomov Shohrux]

