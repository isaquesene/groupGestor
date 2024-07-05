
# Group Gestor - Sistema de gestão para grupos econômicos

<div class="filament-hidden">

![Design sem nome (1)](https://github.com/isaquesene/groupGestor/assets/109972304/d7cea22e-0e0b-4eab-9e04-79aba2793437)

</div>

Sistema de gestão para um grupo econômico que possui várias bandeiras, unidades e colaboradores. 

## Configurações

- Laravel Sail v11
- Filament v3
- Livewire 3
- Vue.js
- Tailwind
- Docker Compose
- WSL Linux
- MySQL

## Plugins

- Spatie/Laravel-activitylog v4
- Excel Export
- Livewire Components tables

## Instalação

### Clonar o projeto do repositório:
\`\`\`bash
git clone https://github.com/isaquesene/groupGestor.git my-project
\`\`\`

### No diretório do projeto, instale o composer:
\`\`\`bash
composer install
\`\`\`

Se não tiver o composer instalado na sua máquina, entre no [site oficial do Composer](https://getcomposer.org/download/) e realize a instalação.

Para certificar-se de que o composer está instalado corretamente no seu ambiente, abra o terminal do seu sistema operacional e execute:
\`\`\`bash
composer --version
\`\`\`

### Gere uma nova chave de aplicativo:
\`\`\`bash
php artisan key:generate
\`\`\`

### Se a sua máquina não tiver Node.js instalado, rode:
\`\`\`bash
npm install
\`\`\`

### Execute o comando para rodar o ambiente de desenvolvimento:
\`\`\`bash
npm run dev
\`\`\`

### Execute o comando para construir os assets:
\`\`\`bash
npm run build
\`\`\`

### Execute as migrações da aplicação:
\`\`\`bash
php artisan migrate
\`\`\`

### Configurar arquivo .env dependendo se for usar Docker ou Xampp:

Para rodar com XAMPP:
\`\`\`env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=groupgestor
DB_USERNAME=root
DB_PASSWORD=
\`\`\`

Para rodar com Docker:
\`\`\`env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=groupgestor
DB_USERNAME=sail
DB_PASSWORD=password
\`\`\`

## Instalar o Docker

Link para baixar o Docker: [Docker Install](https://docs.docker.com/desktop/install/windows-install/)

![docker-app-search](https://github.com/isaquesene/groupGestor/assets/109972304/c4a5dc91-9cdd-4c48-8861-d1bf4d70af06)

## Configurar o Docker

Após a instalação do Docker, será preciso instalar o WSL, um serviço Linux para facilitar a configuração do ambiente Laravel Sail.

### Passos para configurar e subir a aplicação no ambiente Docker usando o WSL do Linux:

Após instalar o Docker, vá em Resources > WSL e habilite para poder usar.

![WSL2_4_012](https://github.com/isaquesene/groupGestor/assets/109972304/ac21d885-f69a-454c-982a-dbd6ac94ab72)

### Comandos para Rodar o Laravel Sail pelo WSL

No Windows, vá em iniciar e procure pelo terminal do WSL:

![wsl_windows_04](https://github.com/isaquesene/groupGestor/assets/109972304/9685b921-66f2-4955-8ee0-2e5c053a3dd5)

### Abrir o Arquivo docker-compose.yml e certificar-se das credenciais do banco:

Configuração docker-compose.yml:
\`\`\`yaml
mysql:
  image: 'mysql/mysql-server:8.0'
  ports:
    - '3306:3306'
  environment:
    MYSQL_ROOT_PASSWORD: 'password'
    MYSQL_ROOT_HOST: '%'
    MYSQL_DATABASE: 'groupgestor'
    MYSQL_USER: 'sail'
    MYSQL_PASSWORD: 'password'
    MYSQL_ALLOW_EMPTY_PASSWORD: 1
\`\`\`

### Certifique-se de que as configurações do .env correspondem ao que foi definido no docker-compose.yml:

\`\`\`env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=groupgestor
DB_USERNAME=root
DB_PASSWORD=newpassword
\`\`\`

No terminal do Ubuntu WSL, navegue até o diretório do seu projeto e execute:

\`\`\`bash
cd /mnt/c/Users/DELL/Documents/teste\ Voch\ Tech/groupGestor
\`\`\`

### Suba os contêineres:

\`\`\`bash
./vendor/bin/sail up -d
\`\`\`

### Executar as Migrações:

\`\`\`bash
./vendor/bin/sail artisan migrate
\`\`\`

![imagem_2024-07-04_203533566](https://github.com/isaquesene/groupGestor/assets/109972304/83ecfad8-8cd2-4442-be76-75f7bea8990b)

Depois, no seu navegador, acesse localhost para ver a aplicação.

## Subindo aplicação com ambiente XAMPP

Link para baixar o XAMPP: [XAMPP Install](https://www.apachefriends.org/pt_br/index.html)

Depois de instalar o XAMPP, execute o Apache e o serviço MySQL:

![imagem_2024-07-04_204600694](https://github.com/isaquesene/groupGestor/assets/109972304/91047167-4080-45fe-b3c1-1dbe7e634487)

No serviço MySQL, navegue até a opção de Admin. Ao clicar, você será levado à página do PhpMyAdmin. Assim, será possível criar um banco de dados para rodar as migrações do projeto.

Após criar o banco no PhpMyAdmin, navegue até o diretório do projeto:
\`\`\`bash
cd Documents/teste\ Voch\ Tech/groupGestor
\`\`\`

### Rode as migrações:
\`\`\`bash
php artisan migrate
\`\`\`

### Para rodar a aplicação, execute:
\`\`\`bash
php artisan serve
\`\`\`


