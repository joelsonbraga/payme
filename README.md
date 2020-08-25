# Payme

## Instalação do docker

Siga as instruções para instalar o Docker no seu sistema operacional. Veja instruções para [Ubuntu](https://docs.docker.com/engine/install/ubuntu/) e [Debian](https://docs.docker.com/engine/install/debian/). Instale também o pacote `build-essential`.

```bash
sudo apt install build-essential
```

Após a instalação do Docker, rode os seguintes comandos para utilizar o mesmo sem necessitar de sudo:

```bash
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
```

Instale também o docker-compose:

```bash
sudo curl -L "https://github.com/docker/compose/releases/download/1.25.5/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

Reinicie seu computador.

## Trabalhando no projeto

Após clonar o projeto no github, você terá uma série de comandos a sua disposição. São eles:

```bash
make prepare
```

Este comando irá construir a imagem Docker, rodar a mesma, rodar o composer, arrumar as permissões de diretório e rodar uma migration fresh. Deve ser usada na primeira vez que o projeto for montado.

---

```bash
make build
```

Este comando irá construir a imagem do Docker.

---

```bash
make up
```

Este comando irá subir as imagens do Docker necessárias

---

```bash
make stop
```

Este comando irá parar as imagens do Docker, mantendo quaisquer alterações dentro da imagem do Docker

---

```bash
make down
```

Este comando irá parar e apagar quaisquer alterações dentro da imagem do Docker

---

```bash
make console
```

Este comando lhe dará acesso ao Bash da imagem do Docker

---

```bash
make php <argumentos>
```

Este comando é um atalho para você utilizar o PHP da imagem do Docker, e aceita parâmetros, por exemplo `make php artisan route:list`

---

```bash
make test
```

Este comando irá rodar o PHP Unit e os testes da aplicação. Relatórios de cobertura aparecerão na pasta `tests/_reports`

---

```bash
make composer <argumentos>
```

Este comando irá rodar o composer, via uma imagem do Docker e aceita parâmetros, por exemplo, `make composer install` ou `make composer require phpinsights`

---

```bash
make analyse
```
Este comando irá rodar o Larastan.

---

```bash
make insights
```
Este comando irá rodar o PHP Insights

---

## Decisões tecnológicas

- Para garantir que exista o banco de dados de testes no Postgres, o PHP Unit sempre rodará primeiro o arquivo `botstrap/testing.php`, que basicamente recria o banco de dados de testes.

- As variáveis de ambiente imutáveis devem ser adicionadas no arquivo `docker-compose.yml`. Já as dinâmicas, como API keys e afins, em um arquivo `.env`.
