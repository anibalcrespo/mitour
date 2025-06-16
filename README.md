# MiTour - Proyecto Laravel

Sitio web desarrollado con Laravel para ofrecer experiencias turísticas personalizadas.

---

## 🚀 Requisitos

- PHP >= 8.1  
- Composer  
- MySQL o base de datos compatible  
- Node.js y npm (para assets)  
- Servidor web (Apache/Nginx)

---

## ⚙️ Instalación

1. Cloná el repositorio:  
```bash
git clone https://github.com/tuusuario/mitour.git
cd mitour

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

npm install

npm run dev

php artisan serve
