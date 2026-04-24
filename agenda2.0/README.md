# 📋 Agenda Moderna - Gestão de Tarefas

Uma aplicação web moderna para gerenciar tarefas com sistema Kanban, desenvolvida em **HTML, CSS e PHP**.

## 🎯 Características

- ✨ **Design Moderno**: Interface limpa e profissional
- 📊 **Sistema Kanban**: 3 colunas (A Fazer, Concluído, Cancelado)
- 📱 **Responsivo**: Funciona em desktop, tablet e mobile
- 🔄 **Gerenciamento de Status**: Mude o status das tarefas facilmente
- 💾 **Persistência**: Dados salvos em banco de dados MySQL
- 🎨 **Menu Lateral**: Navegação intuitiva

## 📁 Estrutura do Projeto

```
agenda-html-css-php/
├── index.php                 # Página principal
├── css/
│   └── style.css            # Estilos CSS modernos
├── api/
│   ├── gravar_tarefa.php    # Criar nova tarefa
│   ├── status_concluido.php # Marcar como concluído
│   ├── status_pendente.php  # Marcar como pendente
│   └── status_cancelado.php # Cancelar tarefa
├── conexao/
│   └── conexao.php          # Conexão com banco de dados
├── img/                      # Imagens e ícones
└── agenda.sql               # Script do banco de dados
```

## 🚀 Como Usar

### 1. Preparar o Banco de Dados

Importe o arquivo `agenda.sql` no seu MySQL:

```bash
mysql -u seu_usuario -p sua_senha < agenda.sql
```

### 2. Configurar a Conexão

Edite o arquivo `conexao/conexao.php` com suas credenciais:

```php
$host = 'localhost';
$db = 'agenda';
$user = 'seu_usuario';
$pass = 'sua_senha';
```

### 3. Colocar no Servidor

Copie todos os arquivos para a pasta `htdocs` (XAMPP) ou `www` (WAMP):

```bash
cp -r agenda-html-css-php/* /caminho/para/htdocs/
```

### 4. Acessar a Aplicação

Abra no navegador:

```
http://localhost/agenda-html-css-php/
```

## 🎨 Paleta de Cores

- **Primária**: #2563eb (Azul)
- **Secundária**: #f59e0b (Âmbar - Pendente)
- **Sucesso**: #10b981 (Verde - Concluído)
- **Perigo**: #ef4444 (Vermelho - Cancelado)

## 📝 Funcionalidades

### Criar Tarefa
- Preencha o formulário com título, descrição e datas
- Clique em "Salvar Tarefa"
- A tarefa aparecerá na coluna "A Fazer"

### Mudar Status
- Clique em "Concluir" para marcar como concluído
- Clique em "Pendente" para voltar ao status anterior
- Clique em "Cancelar" para cancelar a tarefa

### Visualizar Tarefas
- As tarefas são organizadas em 3 colunas por status
- Cada coluna mostra o número total de tarefas
- Máximo de 10 tarefas por coluna

## 🔧 Requisitos

- PHP 7.4+
- MySQL 5.7+
- Navegador moderno (Chrome, Firefox, Safari, Edge)

## 📱 Responsividade

- **Desktop**: 3 colunas lado a lado
- **Tablet**: 2-3 colunas adaptáveis
- **Mobile**: 1 coluna com scroll

## 🐛 Troubleshooting

### Erro de conexão com banco de dados
- Verifique se o MySQL está rodando
- Confirme as credenciais em `conexao/conexao.php`
- Certifique-se de que o banco `agenda` existe

### Tarefas não aparecem
- Verifique se a tabela `agenda` foi criada
- Importe novamente o arquivo `agenda.sql`

### Estilos não carregam
- Certifique-se de que o arquivo `css/style.css` está no lugar correto
- Limpe o cache do navegador (Ctrl+Shift+Delete)

## 📄 Licença

Este projeto é de código aberto e pode ser usado livremente.

## 👨‍💻 Desenvolvido com ❤️

Agenda Moderna - Gestão de Tarefas Inteligente
