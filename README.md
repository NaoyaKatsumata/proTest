# proTest
<h1>開発環境構築</h1>
<ul>
    <li>githubからファイルをローカルへ<br>
        　URL->https://github.com/NaoyaKatsumata/proTest
    </li>
    <li>クローンしたフォルダに移動</li>
    <li>dockerが起動しているのを確認し、ビルド<br>
        　docker-compose up -d --build
    </li>
    <li>composerをインストール<br>
        　docker-compose exec php bash<br>　composer install
    </li>
    <li>.envファイルをコピーし編集<br>
        　cp .env.example .env<br>
        　nano .env<br>
        　(テキストエディタがない場合はインストール)<br>
        　apt install nano<br><br>
        　.env編集箇所<br>
        　DB_CONNECTION=mysql<br>
        　DB_HOST=mysql<br>
        　DB_PORT=3306<br>
        　DB_DATABASE=laravel_db<br>
        　DB_USERNAME=laravel_user<br>
        　DB_PASSWORD=laravel_pass<br>
    </li>
    <li>keyの作成<br>
        　php artisan key:generate
    </li>
    <li>npmのインストール<br>
        コンテナから出る<br>
        　exit<br>
        srcに移動<br>
        　cd src<br>
        npmをインストール<br>
        　npm install
    </li>
    <li>npmを起動<br>
        　npm run dev
    </li>
    <li>ダミーデータの投入<br>
        　phpコンテナに移動<br>
        　docker-compose exec php bash<br>
        　データ投入<br>
        　php artisan migrate<br>
        　php artisan db:seed
    </li>
    <li>
        ストレージとリンク<br>
        　php artisan storage:link
    </li>
</ul>
<h1>使用技術</h1>
<ul>
    <li>laravel：9.52.16</li>
    <li>php：8.1.30</li>
    <li>composer：2.8.1</li>
    <li>DB：Mysql</li>
</ul>
<h1>ER図</h1>
<img src="src/public/img/ER.png">

<h1>URL</h1>
<p>開発環境:http://localhost</p>

<h1>csvファイルフォーマット</h1>
<p>店舗名,店舗詳細,カテゴリーID,エリアID</p>
<p>カテゴリーID(1:寿司,2:焼肉,3:居酒屋,4:イタリアン,5:ラーメン)</p>
<p>エリアID(1:東京,2:大阪府,3:福岡)</p>