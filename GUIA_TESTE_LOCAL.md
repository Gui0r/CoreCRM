# Guia para Testar o CoreCRM Localmente

## Pré-requisitos

1. **PHP 7.4 ou superior**
2. **Servidor web local** (XAMPP, WAMP, ou servidor PHP built-in)
3. **Composer** (para gerenciar dependências)

## Opção 1: Usando o Servidor PHP Built-in (Mais Simples)

### Passo 1: Instalar Dependências
```bash
composer install
```

### Passo 2: Iniciar o Servidor
No diretório raiz do projeto, execute:
```bash
php -S localhost:8000
```

### Passo 3: Acessar as Páginas
- **Página de Login**: http://localhost:8000/login
- **Painel Admin**: http://localhost:8000/admin (requer login)

## Opção 2: Usando XAMPP/WAMP

### Passo 1: Configurar o Projeto
1. Copie a pasta `CoreCRM` para `htdocs` (XAMPP) ou `www` (WAMP)
2. Instale as dependências: `composer install`

### Passo 2: Acessar via Localhost
- **Página de Login**: http://localhost/CoreCRM/login
- **Painel Admin**: http://localhost/CoreCRM/admin

## Credenciais de Teste

### Usuário Admin
- **Usuário**: `admin`
- **Senha**: `admin123`
- **Permissão**: Administrador

### Usuário Normal
- **Usuário**: `user`
- **Senha**: `user123`
- **Permissão**: Usuário

## Estrutura das Páginas

### Página de Login (`/login`)
- **Arquivo**: `plugins/system_manager/templates/login.php`
- **Funcionalidades**:
  - Formulário de login com validação
  - Animações CSS/JavaScript
  - Design responsivo com glass effect
  - Redirecionamento após login

### Painel Admin (`/admin`)
- **Arquivo**: `plugins/system_manager/templates/admin_panel.php`
- **Funcionalidades**:
  - Dashboard com cards informativos
  - Menu de navegação
  - Ações rápidas
  - Animações e efeitos visuais
  - Sistema de logout

## Fluxo de Teste

1. **Acesse a página de login**: http://localhost:8000/login
2. **Faça login** com as credenciais acima
3. **Explore o painel admin**: http://localhost:8000/admin
4. **Teste as funcionalidades**:
   - Cards do dashboard
   - Botões de ação rápida
   - Menu de navegação
   - Logout

## Recursos Visuais

### Animações
- **Anime.js**: Biblioteca para animações suaves
- **CSS Transitions**: Efeitos de hover e focus
- **Glass Effect**: Efeito de vidro fosco
- **Gradientes**: Backgrounds coloridos

### Design Responsivo
- **Tailwind CSS**: Framework CSS utilitário
- **Mobile-first**: Design adaptável
- **Flexbox/Grid**: Layout moderno

## Solução de Problemas

### Erro 404
- Verifique se o arquivo `.htaccess` está presente
- Confirme que o mod_rewrite está habilitado (Apache)
- Para servidor built-in, não é necessário

### Erro de Dependências
```bash
composer install
```

### Erro de Permissões
- Certifique-se de que o PHP tem permissão de leitura
- Para logs, verifique a pasta `logs/`

### CSS não carrega
- Verifique se o arquivo `output.css` existe
- Execute: `npm install && npm run build` (se usar Tailwind)

## Desenvolvimento

### Modificando as Páginas
- **Login**: Edite `plugins/system_manager/templates/login.php`
- **Admin**: Edite `plugins/system_manager/templates/admin_panel.php`

### Adicionando Novas Rotas
Edite `plugins/system_manager/main.php`:
```php
RoutesHandler::addRoute("GET", "/nova-rota", function() {
    // Seu código aqui
});
```

### Debug
O modo debug está ativado em `config/config.php`:
```php
'debug' => true
```

## Estrutura de Arquivos Importantes

```
CoreCRM/
├── index.php              # Ponto de entrada
├── bootstrap.php          # Inicialização do sistema
├── config/config.php      # Configurações
├── core/                  # Módulos principais
├── plugins/system_manager/ # Plugin de autenticação
│   ├── main.php          # Rotas do plugin
│   └── templates/        # Templates das páginas
│       ├── login.php     # Página de login
│       └── admin_panel.php # Painel admin
└── .htaccess             # Configuração do Apache
```

## Próximos Passos

1. **Teste todas as funcionalidades**
2. **Explore o código fonte**
3. **Modifique o design conforme necessário**
4. **Adicione novas funcionalidades**

## Suporte

Se encontrar problemas:
1. Verifique os logs em `logs/`
2. Confirme as configurações em `config/config.php`
3. Teste com diferentes navegadores
4. Verifique o console do navegador para erros JavaScript 