# 🚀 Teste Rápido do CoreCRM

## ⚡ Início Rápido (Windows)

### 1. Setup Automático
```bash
setup.bat
```

### 2. Iniciar Servidor
```bash
start_server.bat
```

### 3. Acessar no Navegador
- **Login**: http://localhost:8000/login
- **Admin**: http://localhost:8000/admin

## 🔑 Credenciais de Teste

| Usuário | Senha | Permissão |
|---------|-------|-----------|
| `admin` | `admin123` | Administrador |
| `user` | `user123` | Usuário |

## 📱 Páginas Disponíveis

### 🔐 Página de Login
- **URL**: `/login`
- **Arquivo**: `plugins/system_manager/templates/login.php`
- **Recursos**:
  - Design moderno com glass effect
  - Animações suaves
  - Validação de formulário
  - Responsivo

### 🎛️ Painel Administrativo
- **URL**: `/admin`
- **Arquivo**: `plugins/system_manager/templates/admin_panel.php`
- **Recursos**:
  - Dashboard com cards informativos
  - Menu de navegação
  - Ações rápidas
  - Sistema de logout

## 🎨 Recursos Visuais

### ✨ Animações
- **Anime.js** para animações suaves
- **CSS Transitions** para efeitos hover
- **Glass Effect** para design moderno
- **Gradientes** para backgrounds

### 📱 Design Responsivo
- **Tailwind CSS** para estilização
- **Mobile-first** approach
- **Flexbox/Grid** para layout

## 🔧 Comandos Manuais

### Instalar Dependências
```bash
composer install
```

### Gerar CSS (se necessário)
```bash
npm install
npm run build:css
```

### Iniciar Servidor
```bash
php -S localhost:8000
```

## 🐛 Solução de Problemas

### Erro 404
- Verifique se está no diretório correto
- Confirme que o PHP está rodando

### CSS não carrega
- Execute `build_css.bat` para regenerar

### Erro de Dependências
- Execute `composer install`

## 📁 Estrutura Importante

```
CoreCRM/
├── index.php                    # Entrada principal
├── bootstrap.php               # Inicialização
├── config/config.php           # Configurações
├── plugins/system_manager/     # Plugin de auth
│   ├── main.php               # Rotas
│   └── templates/             # Templates
│       ├── login.php          # Login
│       └── admin_panel.php    # Admin
├── output.css                 # CSS compilado
└── .htaccess                  # Rewrite rules
```

## 🎯 Próximos Passos

1. **Teste o login** com as credenciais
2. **Explore o painel admin**
3. **Modifique o design** conforme necessário
4. **Adicione novas funcionalidades**

## 📞 Suporte

- Verifique os logs em `logs/`
- Confirme as configurações em `config/config.php`
- Teste em diferentes navegadores 