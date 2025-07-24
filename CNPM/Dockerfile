FROM php:8.2-apache

# Cài extension pdo_mysql cho PHP
RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ mã nguồn vào thư mục web trong container
COPY . /var/www/html/

# Bật rewrite module (quan trọng nếu có htaccess hay URL đẹp)
RUN a2enmod rewrite

# Phân quyền lại cho web chạy ổn
RUN chown -R www-data:www-data /var/www/html

# Apache mặc định expose port 80 