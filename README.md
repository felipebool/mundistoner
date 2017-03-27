# Mundistoner
Este projeto foi desenvolvido como parte de um processo seletivo para vaga
de desenvolvedor. A tarefa era a seguinte: consumir uma api com php, usando
docker e docker-compose. A solução precisava estar dividida em dois containers
de tal forma que, em um deles, eu teria uma api e no outro um frontend que
consumiria esta api. Além do docker e docker-compose, resolvi usar também o
nginx fazendo proxy reverso para o Apache e um micro framework que sempre
tive curiosidade, o Slim.

As próximas seções explicam melhor como foi feita a solução.

## Docker
A ideia de usar o proxy reverso era testar como seria feito o networking
entre os containers e expor somente uma porta para o exterior, ao invés
de uma para a api e outra para o frontend. Desta forma, no host, eu consegui
ficar só com a porta 80 (poderia ser a 443) pra fora e o resto fechado.

## Arquitetura da solução
![Image of Yaktocat](https://github.com/felipebool/mundistoner/blob/master/mundistoner.png)

## Considerações
* Como não há qualquer interação entre a minha aplicação e uma base de dados,
ela simplesmente consome a api, faz sentido pra mim que a obrigação de sanitizar,
filtrar e checar a segurança dos dados deva ser da api que estou consumindo.
Não foi nenhum tipo de descuido, foi decisão de projeto mesmo. A checagem que
é feita simplesmente garante que o usuário enviou os campos necessário.

## Conclusão
Este projeto foi bem bacana por vários motivos. Antes de qualquer coisa,
foi um incentivo para estudar um monte de coisas que estavam na minha lista,
docker, docker-compose, Slim, proxy reverso e nginx. Além disso, serviu
de reciclagem. Até então, todos os meus projetos eram monolíticos, numa VPS só,
agora dividir em conteineres parece o melhor caminho.

É isto.
