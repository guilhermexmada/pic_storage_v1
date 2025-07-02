
# 🖼 Pic Storage

Pequeno projeto pessoal de website para armazenamento de imagens com scripts PHP. 

Este website foi construído com intenção de estudar operações CRUD (create, read, update, delete) com PHP e estilização de páginas com CSS.

![image](https://github.com/user-attachments/assets/4137f0e8-5205-4cf2-9006-6a2f445bbb5f)

## ⚙️ Funcionalidades

O website apresenta as seguintes funcionalidades:
- ☑️ CRUD de imagens
- 🔍 Pesquisa de imagens por nome
- 📊 Criação e exclusão de grupos para imagens
- 👥 Cadastro e exclusão de funcionários

🎨 Além disso, houve uma dedicação com o design das páginas, buscando exibir elementos visuais interessantes e animações dinâmicas. 

📚 A biblioteca de ícones **Ionicons** foi utilizada em alguns elementos de design. 

## 🗃 Como visualizar?
Aqui vai um passo a passo para visualizar o projeto:

1. Baixe este repositório.
2. Instale o PHP. Você pode usar [este](https://www.php.net/downloads.php) link.
3. Instale o XAMPP. Você pode usar [este](https://www.apachefriends.org/pt_br/index.html) link.
4. Instale o HeidiSQL. Você pode usar [este](https://www.heidisql.com/download.php) link.
5. No painel de controle do XAMPP, você deve iniciar os serviços **Apache** e **MySQL**.
6. No gerenciador de sessões do HeidiSQL, você deve adicionar uma sessão usando o botão "Nova". A sessão deve possuir:
- Servidor/IP: **127.0.0.1**
- Usuário: **root**
- Nenhuma senha
7. Entre no repositório baixado e procure o arquivo *sql.sql*
8. Abra o arquivo *.sql* com o programa HeidiSQL e execute o código usando **CTRL+A** e **F9**. Você também pode entrar na sessão do HeidiSQL e selecionar a opção *arquivo > executar arquivo SQL...* (isto deve baixar o banco de dados)
9. Copie ou recorte o repositório baixado.
10. Cole o repositório em *xampp\htdocs*. A pasta "htdocs" é o diretório padrão para visualização de projetos dentro da pasta de instalação do XAMPP. 
11. Abra o seu navegador padrão e digite *localhost* na barra de pesquisa. Você deve ser redirecionado para o diretório "htdocs" no seu computador, como se estivesse acessando um servidor on-line.
12. Navegue pela interface do servidor e selecione o repositório, então você provavelmente será redirecionado ao **index.php**, podendo visualizar o website.

## ⛵️ Como navegar?

O repositório apresenta a seguinte estrutura interna:
- 📄 ***index.php*** : arquivo inicial que é aberto quando você entra no site. Apenas redireciona o usuário para outra página.
- 📄 ***sql.sql*** : arquivo que guarda o banco de dados do website. Deve ser executado por um SGBD relacional para que o site funcione.
- 📁 **conexao** : guarda o arquivo de conexão com o banco de dados. 
- 📁 **back** : guarda os arquivos responsáveis por tratamento de dados e operação com banco de dados. 
- 📁 **front** : guarda os arquivos *.php* para visualização das páginas do website.
- 📁 **style** : guarda os arquivos *.css* para estilização das páginas e dos seus componentes. 
- 📁 **pic_base** : armazena os arquivos de imagens salvos pelo usuário.
- 📁 **assets** : guarda os arquivos de tipografias e imagens usadas para personalizar o website.
- 📁 **components** : guarda os arquivos *.php* de componentização das páginas, ou seja, estruturas que se repetem dentro do website.

👤 No primeiro acesso, você deve cadastrar-se como um novo usuário. 

Na página inicial, você pode:
- 🖼 Fazer o upload de imagens do seu dispositivo
- 📂 Criar um álbum para guardar imagens
- 🔍 Pesquisar imagens pelo nome
- 🚪 Sair da sua conta (*logout*)

Todas as imagens salvas sem álbum específico são direcionadas para um álbum chamado *"general"*, que é visualizado na página inicial. 

Clique nas imagens para visualizá-las em tamanho original e descobrir seus detalhes. Na página de visualização das imagens, você também pode movê-las de um álbum para o outro ou excluí-las. 

Clique nos álbums para visualizar as imagens ali armazenadas. Você pode realizar pesquisas dentro do álbum ou excluir o álbum (o que também exclui todo o conteúdo do mesmo)

Na página de configurações, você pode excluir sua conta (com todas as suas imagens e álbuns)

**⚠️ Futuramente, mais funcionalidades serão implementadas. Sinta-se à vontade para informar bugs e sugerir melhorias.** 

## ✏️ Meu aprendizado

- Funcionamento das sessões PHP
- Componentização de elementos visuais
- Lógica de armazenamento de imagens em bancos de dados relacionais
- Animações CSS controladas por JS
- Efeito *parallax* simples

## Tecnologias utilizadas

[![My Skills](https://skillicons.dev/icons?i=html,css,js,php,mysql)](https://skillicons.dev)

## 📃 Licença

- [MIT](https://choosealicense.com/licenses/mit/)

## 👤 Sobre mim
- 👤 Guilherme Shimada Pereira ([guilhermexmada](https://github.com/guilhermexmada))
- 🎓 Técnico em Desenvolvimento de Sistemas (2024)
- 🎓 Cursando Desenvolvimento de Software Multiplataforma (até 2027!) 
- 🚀 Rumo à Cibersegurança!

## 🔗 Referências

- XAMPP: [apachefriends.org](https://www.apachefriends.org/pt_br/index.html)
- PHP: [php/downloads](https://www.php.net/downloads.php)
- HeidiSQL: [heidisql/download](https://www.heidisql.com/download.php)
- Ionicons: [ionic.io/ionicons](https://ionic.io/ionicons)
- Ícones das tecnologias: [tandpfun/skill-icons](https://github.com/tandpfun/skill-icons)
- Emojis: [piliapp/emoji](https://getemoji.com/)
