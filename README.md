# attendance-application

## 主な機能

- ユーザー登録、ログイン、ログアウト（Laravel Fortify）
- 一般ユーザー機能(勤怠登録、勤怠修正申請)
- 管理者機能(勤怠修正、修正申請承認)

---

## 技術スタック

- OS：Linux（Docker）
- バックエンド：PHP 7.4 / Laravel 8
- フロントエンド：Blade, JavaScript（fetch API）
- データベース：MySQL 8.0
- Webサーバー：nginx 1.21

---

## セットアップ手順（ローカル環境）

### 1. リポジトリのクローン

```bash
git clone https://github.com/k1haraRen/imitation-matter.git
cd imitation-matter
```

2. Docker 起動
```bash
docker-compose up -d --build
```

3. PHP コンテナに入る
```bash
docker-compose exec php bash
```

4. Composer インストール
```bash
composer install
```

5. .env 設定
```bash
cp .env.example .env
```
.env に以下の環境変数を記述：

```env
DB_HOST=mysql
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

```
6. Laravel のセットアップ
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```
Fortify セットアップ手順
```bash
composer require laravel/fortify
```
config/app.php に以下を追加：

```php
App\Providers\FortifyServiceProvider::class,
```
以下のコマンドを実行：

```bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
php artisan migrate
```

## 管理者権限

### 管理者ユーザー

-データベースから直接操作になります。useers_tabelのis_adminカラムの値を1にして管理者権限の付与ができます。

### ダミーの管理者ユーザー

- name 管理者
- email test@test.com
- password testtest

