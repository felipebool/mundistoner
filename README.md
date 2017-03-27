# Mundistoner
Este projeto foi desenvolvido como parte de um processo seletivo para vaga
de desenvolvedor. A tarefa era a seguinte: consumir uma api com php, usando
docker e docker-compose. A solução precisava estar dividida em dois containers
de tal forma que, em um deles eu teria uma api e no outro um frontend que
consumiria esta api. Além do docker e docker-compose, resolvi usar também o
nginx fazendo proxy reverso para o Apache, além de um micro framework que sempre
tive curiosidade, o Slim.

As próximas seções explicam melhor como foi feita a solução.

## Docker
A ideia de usar o proxy reverso era testar como seria feito o networking
entre os containers e expor somente uma porta para o exterior, ao invés
de uma para a api e outra para o frontend. Desta forma, no host, eu consegui
ficar só com a porta 80 (poderia ser a 443) pra fora e o resto fechado.

Os três containers:
* Proxy (Dockerfile)
    * Base image: nginx:stable
    * Web server: Nginx
    * Função: proxy reverso

* Api (Dockerfile)
    * Base image: debian:stable
    * Web server: Apache
    * Função: servir conteúdo dinâmico

* Front (Dockerfile)
    * Base image: nginx:stable
    * Web server: Nginx
    * Função: servir conteúdo estático

### Arquitetura da solução

### Volumes
Não tenho certeza disto, mas a maneira como usei os volumes faz muito mais
sentido durante o desenvolvimento, não em produção. Como eu queria subir os
containers e editar os arquivos sem precisar gerar tudo novamente, montei
um volume para cada container (front e api) e assim eu conseguiria editar
os arquivos e ver o resultado na hora. Em produção não se edita arquivo.

### Não foi feito

### Considerações
* Como não há qualquer interação entre a minha aplicação e uma base de dados,
ela simplesmente consome a api, faz sentido pra mim que a obrigação de sanitizar,
filtrar e checar a segurança dos dados deva ser da api que estou consumindo.
Não foi nenhum tipo de descuido, foi decisão de projeto mesmo. A checagem que
é feita simplesmente garante que o usuário enviou os campos necessário.

Este projeto foi bem bacana por vários motivos. Antes de qualquer coisa,
foi um incentivo para estudar um monte de coisa que estavam na minha lista,
docker, docker-compose, Slim, proxy reverso e nginx. Além disso, serviu
de reciclagem. Até então, todos os meus projetos eram monolíticos, numa VPS só,
agora dividir em conteineres parece o melhor caminho.

É isto.
