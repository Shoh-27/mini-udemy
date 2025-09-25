# 🎓 Mini Udemy (Laravel 11)

Bu loyiha — **boshlovchi dasturchilar uchun step-by-step kurs loyihasi**, kichik hajmda **Udemy** funksiyalarini o‘rganish va amalda sinab ko‘rish uchun yaratilgan.

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

## 📂 Loyihani ishga tushirish

1. Repository’ni clone qiling:
   ```bash
   git clone https://github.com/<username>/<repo>.git
   cd <repo>

