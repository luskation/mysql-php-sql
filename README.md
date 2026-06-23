# 🐾 PetCare — Sistema de Gerenciamento de Clínica Veterinária

Trabalho prático da disciplina **GCC263 – Introdução a Sistemas de Banco de Dados**, desenvolvido em três etapas cobrindo modelagem ER, modelo relacional e implementação SQL com interface web em PHP.

**Universidade Federal de Lavras (UFLA) — Departamento de Ciência da Computação (DCC)**  
Professor: Denilson Alves Pereira

**Autores:** Anthony José da Silva, Juliano Vieira Goulart, Lucas Oliveira Rodrigues, Luiz Paulo Selvati Fonseca Felizali, Thawan Victor Carvalho Santos, Willian Custódio de Oliveira

---

## 📋 Sobre o Projeto

O PetCare é um sistema de banco de dados para gerenciar os dados operacionais de uma clínica veterinária fictícia. Cobre cadastro de tutores e pets, histórico de consultas, exames clínicos e especializações dos veterinários.

A interface web permite listar, incluir, editar e excluir tutores diretamente pelo navegador.

---

## 🗂 Estrutura do Repositório

```
mysql-php-sql/
├── config.php          # Conexão PDO com o banco de dados
├── index.php           # Listagem de tutores com ações de editar/excluir
├── form_incluir.php    # Formulário de inclusão e edição de tutores
├── excluir.php         # Exclusão de tutor via GET
└── petcare_scripts.sql # Script completo do banco (DDL, DML, views, procedures, triggers)
```

---

## 🗃 Modelo de Dados

O banco é composto por **9 tabelas**:

| Tabela                 | Descrição                                               |
|------------------------|---------------------------------------------------------|
| `Tutor`                | Clientes responsáveis pelos pets                        |
| `TelefoneTutor`        | Telefones dos tutores (atributo multivalorado)          |
| `Pet`                  | Animais cadastrados na clínica                          |
| `Veterinario`          | Profissionais do corpo clínico                          |
| `TelefoneVeterinario`  | Telefones dos veterinários (atributo multivalorado)     |
| `Especialidade`        | Áreas de atuação médica (Cardiologia, Dermatologia...)  |
| `Atuacao`              | Relacionamento N:M entre Veterinário e Especialidade    |
| `Consulta`             | Atendimentos realizados                                 |
| `Exame`                | Exames solicitados durante consultas                    |

### Relacionamentos

- **Tutor → Pet**: 1:N
- **Pet → Consulta**: 1:N
- **Veterinario → Consulta**: 1:N
- **Veterinario ↔ Especialidade**: N:M via tabela `Atuacao`
- **Consulta → Exame**: 1:N

---

## ⚙️ Pré-requisitos

- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP)
- MySQL 5.7+ ou MariaDB equivalente
- Navegador web

---

## 🚀 Como Rodar Localmente

### 1. Importar o banco de dados

1. Inicie o **Apache** e o **MySQL** pelo painel do XAMPP.
2. Acesse o [phpMyAdmin](http://localhost/phpmyadmin).
3. Clique em **Importar** → selecione `petcare_scripts.sql` → **Executar**.

Isso cria o banco `petcare` com todas as tabelas, dados de exemplo, views, procedures, functions e triggers.

### 2. Configurar a interface web

1. Clone ou copie os arquivos para `C:\xampp\htdocs\petcare\`.
2. Confirme que o `config.php` está com as credenciais corretas (padrão XAMPP já está configurado):

```php
$host    = '127.0.0.1';
$db_name = 'petcare';
$usuario = 'root';
$senha   = '';
```

3. Acesse no navegador: [http://localhost/petcare](http://localhost/petcare)

---

## 💻 Interface Web

A interface cobre o CRUD de **Tutores**:

| Arquivo           | Função                                      |
|-------------------|---------------------------------------------|
| `index.php`       | Lista todos os tutores cadastrados          |
| `form_incluir.php`| Formulário de inclusão e edição de tutores  |
| `excluir.php`     | Exclui um tutor pelo CPF                    |
| `config.php`      | Conexão PDO com o banco (charset UTF-8)     |

---

## 📦 O que está incluído no script SQL

| Item    | Conteúdo |
|---------|----------|
| **(A)** | `CREATE TABLE` com `PRIMARY KEY`, `FOREIGN KEY`, `UNIQUE`, `DEFAULT` |
| **(B)** | `ALTER TABLE` (ADD COLUMN, MODIFY COLUMN, ADD CONSTRAINT) e `DROP TABLE` |
| **(C)** | `INSERT` com mínimo de 5 registros por tabela |
| **(D)** | 5× `UPDATE`, incluindo UPDATE com subconsulta |
| **(E)** | 5× `DELETE`, incluindo DELETE com subconsulta |
| **(F)** | 12 queries: INNER/OUTER JOIN, GROUP BY, HAVING, UNION, IN, LIKE, IS NULL, ANY, ALL, EXISTS, BETWEEN, subconsultas |
| **(G)** | 3 Views: `vw_pet_tutor`, `vw_consultas_realizadas`, `vw_veterinario_especialidade` |
| **(H)** | `CREATE USER`, `GRANT`, `REVOKE` com perfis `recepcao_petcare` e `vet_petcare` |
| **(I)** | Procedure `sp_total_consultas_pet` (IN/OUT), `sp_resumo_clinica`, Function `fn_categoria_pet` (CASE, TIMESTAMPDIFF) |
| **(J)** | Trigger `trg_insert_exame` (BEFORE INSERT), `trg_update_consulta` (BEFORE UPDATE), `trg_delete_veterinario` (BEFORE DELETE) |

---

## 🛡 Regras de Negócio (Triggers)

- **Exame**: não permite cadastro com data futura.
- **Consulta**: não permite atualização para data futura.
- **Veterinário**: não permite exclusão se houver consultas vinculadas.

---

## 🔒 Controle de Acesso

| Usuário             | Permissões |
|---------------------|------------|
| `recepcao_petcare`  | SELECT, INSERT, UPDATE em Tutor, TelefoneTutor, Pet, Consulta |
| `vet_petcare`       | SELECT geral + INSERT em Exame + UPDATE em Consulta |

---

## 📄 Etapas do Trabalho

| Etapa       | Descrição |
|-------------|-----------|
| **Etapa 1** | Modelagem ER com notação Elmasri & Navathe + dicionário de dados |
| **Etapa 2** | Modelo relacional normalizado + diagrama físico |
| **Etapa 3** | Scripts SQL completos + interface web em PHP |
