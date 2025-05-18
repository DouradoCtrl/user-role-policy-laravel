<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre o repositório

### Imagens
As imagens abaixo mostram as principais telas do sistema de gerenciamento de usuários:

*(em desenvolvimento - serão adicionadas capturas de tela do painel de controle, modais de gerenciamento de usuários e páginas de perfil)*

### Descrição
Este projeto implementa um sistema completo de gerenciamento de usuários (CRUD) sobre o autenticador Laravel Breeze, com uma página de gestão construída com Tailwind CSS e Alpine.js. O sistema permite criar, visualizar, editar e excluir usuários de forma intuitiva através de modais interativos.

A finalidade principal é restringir níveis de acesso a determinados tipos de usuários, sendo eles: Atendente, Administrador e Estoque, que representam as permissões que esses usuários possuem. Foram implementados alguns conceitos importantes do Laravel como: Gates, Policies e Middlewares.

O sistema inclui:
- Gerenciamento completo de usuários (CRUD)
- Controle de acesso baseado em funções (RBAC)
- Interface de usuário responsiva e moderna
- Sistema de autenticação seguro
- Camada de serviço para lógica de negócios

Os Gates nessa aplicação foram utilizados somente para restringir certos componentes da página que podiam ser filtrados para determinado tipo de usuário. Já as Policies e Middlewares foram utilizados para restringir e proteger as rotas de acesso da aplicação.

### Tecnologias utilizadas

- PHP 8.2+
- Laravel 11.31+
- NGINX (última versão disponível)
- MySQL 8.1
- Adminer (última versão disponível)
- Mailpit (última versão disponível)
- Redis (última versão disponível)
- TailwindCSS 3.1.0
- Alpine.js 3.4.2
- Vite 6.0.11

O projeto está configurado com o Mailpit para garantir o envio de e-mail SMTP para realizar redefinição de senha caso seja necessário.

### Funcionalidades do Sistema de Gestão de Usuários

O sistema oferece uma interface completa para gerenciamento de usuários com as seguintes operações:

- **Criação de Usuários**: Interface amigável para cadastro de novos usuários com definição de função
- **Visualização de Usuários**: Lista paginada com todos os usuários cadastrados no sistema
- **Edição de Usuários**: Modal interativo para atualização de dados e função do usuário
- **Exclusão de Usuários**: Funcionalidade protegida por verificação de senha do administrador
- **Controle de Acesso**: Sistema de RBAC (Role-Based Access Control) para limitar o acesso com base no papel do usuário
- **Camada de Serviço**: Lógica de negócios encapsulada em serviços para melhor organização e manutenção do código

### Instalação

Para instalar o projeto, siga os passos abaixo:

1. Clonar o repositório
```bash
git clone https://github.com/DouradoCtrl/user-role-policy-laravel.git
```

2. Construir e acessar o ambiente Docker
```bash
cd user-role-policy-laravel
docker compose up -d
docker exec -it user-role-policy-laravel-php-1 bash
```

3. Configurar o ambiente
   1. Copiar o arquivo .env.example para .env
   ```bash
   cp .env.example .env
   ```
   
   2. Configurar o arquivo `.env` conforme as informações dos containers em `docker-compose.yml`

4. Construir a aplicação
```bash
# Gerar chave de aplicação
php artisan key:generate

# Executar as migrações
php artisan migrate

# Instalar dependências na sua máquina local
composer install
npm install
npm run build
```

5. Criar usuário de acesso
```bash
php artisan tinker

\App\Models\User::create([
    'name' => 'Administrador', 
    'email' => 'admin@exemplo.com', 
    'password' => bcrypt('password'),
    'role' => 'Administrador'
]);
```

### Arquitetura e Estrutura

O projeto segue as melhores práticas de desenvolvimento Laravel, com foco na separação de responsabilidades:

- **Controllers**: Manipulam as requisições HTTP e retornam respostas
- **Services**: Contêm a lógica de negócios encapsulada, como o `UserManagementService`
- **Models**: Representam as entidades do banco de dados e suas relações
- **Policies**: Implementam regras de autorização para acesso a recursos
- **Gates**: Definem permissões granulares baseadas no papel do usuário
- **Middlewares**: Filtram requisições HTTP antes de chegarem aos controllers
- **Views**: Organizadas em componentes e partials reutilizáveis

A arquitetura em camadas facilita a manutenção, testabilidade e escalabilidade do código.

### Sistema de Papéis (Roles)

O aplicativo implementa um sistema de controle de acesso baseado em papéis (RBAC) com três níveis:

1. **Administrador**: Acesso completo ao sistema, incluindo gerenciamento de usuários (CRUD)
2. **Atendente**: Acesso às funcionalidades de atendimento ao cliente
3. **Estoque**: Acesso às funcionalidades de gerenciamento de estoque

Cada papel tem permissões específicas implementadas através de Gates e Policies no Laravel:
- Gates controlam o acesso a componentes de interface
- Policies controlam o acesso a rotas e recursos
- Middlewares filtram requisições com base no papel do usuário

O papel do usuário é armazenado na coluna `role` da tabela `users` e é definido durante a criação do usuário.


## URLs das Ferramentas

### Aplicação Laravel
URL: http://localhost

### Mailpit (serviço de e-mail para testes)
URL: http://localhost:8025

### Adminer (gerenciador de banco de dados)
URL: http://localhost:9090

Dados de acesso ao banco:
- Servidor: db
- Usuário: laravel
- Senha: secret
- Banco de dados: laravelPolicyUser


## Comandos úteis do Docker

```bash
# Construir ou reconstruir serviços
docker compose build

# Criar e iniciar containers
docker compose up -d

# Parar e remover containers e redes
docker compose down

# Parar todos os serviços
docker compose stop

# Reiniciar containers de serviços
docker compose restart

# Executar um comando dentro de um container
docker compose exec [container] [comando]
```

## Comandos úteis do Artisan

```bash
# Exibir informações básicas sobre sua aplicação
php artisan about

# Remover o arquivo de cache de configuração
php artisan config:clear

# Limpar o cache da aplicação
php artisan cache:clear

# Limpar todos os eventos e listeners em cache
php artisan event:clear

# Excluir todos os jobs da fila especificada
php artisan queue:clear

# Remover o arquivo de cache de rotas
php artisan route:clear

# Limpar todos os arquivos de view compilados
php artisan view:clear

# Remover o arquivo de classe compilado
php artisan clear-compiled

# Remover os arquivos de bootstrap em cache
php artisan optimize:clear

# Excluir os arquivos de mutex em cache criados pelo agendador
php artisan schedule:clear-cache

# Limpar tokens expirados de redefinição de senha
php artisan auth:clear-resets
```

## Licença

O framework Laravel é um software de código aberto licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).
